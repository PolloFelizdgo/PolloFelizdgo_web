<?php

namespace App\Services\Panel;

use App\Models\ActivityLog;
use App\Models\ContentBlock;
use App\Models\ContentRevision;
use App\Models\PanelSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class PanelContentService
{
    private const SCHEDULE_KEY = 'content.publish_schedule';

    public function getPublishedPayload(string $section, mixed $fallback = []): mixed
    {
        if (! Schema::hasTable('content_blocks')) {
            return $fallback;
        }

        try {
            $block = ContentBlock::query()
                ->where('section', $section)
                ->where('status', 'published')
                ->latest('id')
                ->first();
        } catch (QueryException) {
            return $fallback;
        }

        if (! $block) {
            return $fallback;
        }

        $payload = json_decode((string) $block->payload, true);

        return is_array($payload) ? $payload : $fallback;
    }

    public function saveDraft(string $section, array $payload, ?int $userId, ?string $changeNote = null): ContentBlock
    {
        $draft = ContentBlock::query()
            ->where('section', $section)
            ->where('status', 'draft')
            ->latest('id')
            ->first();

        $previousPayload = $draft?->payload;

        if (! $draft) {
            $published = ContentBlock::query()
                ->where('section', $section)
                ->where('status', 'published')
                ->latest('id')
                ->first();

            $draft = new ContentBlock();
            $draft->section = $section;
            $draft->status = 'draft';
            $draft->version = (int) ($published?->version ?? 0) + 1;
        }

        $draft->payload = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $draft->updated_by = $userId;
        $draft->save();

        ContentRevision::query()->create([
            'content_block_id' => $draft->id,
            'previous_payload' => $previousPayload,
            'new_payload' => $draft->payload,
            'change_note' => $changeNote,
            'changed_by' => $userId,
            'created_at' => now(),
        ]);

        $this->logAction($userId, 'content.draft_saved', 'content_block', (string) $draft->id, [
            'section' => $section,
        ]);

        return $draft;
    }

    public function publish(string $section, ?int $userId, ?string $changeNote = null): ContentBlock
    {
        $draft = ContentBlock::query()
            ->where('section', $section)
            ->where('status', 'draft')
            ->latest('id')
            ->firstOrFail();

        $published = ContentBlock::query()
            ->where('section', $section)
            ->where('status', 'published')
            ->latest('id')
            ->first();

        if (! $published) {
            $published = new ContentBlock();
            $published->section = $section;
            $published->status = 'published';
            $published->version = 1;
        } else {
            $published->version = max(1, (int) $published->version + 1);
        }

        $previousPayload = $published->payload;
        $published->payload = $draft->payload;
        $published->published_at = now();
        $published->updated_by = $userId;
        $published->save();

        ContentRevision::query()->create([
            'content_block_id' => $published->id,
            'previous_payload' => $previousPayload,
            'new_payload' => $published->payload,
            'change_note' => $changeNote,
            'changed_by' => $userId,
            'created_at' => now(),
        ]);

        $this->clearSectionCache($section);

        $this->logAction($userId, 'content.published', 'content_block', (string) $published->id, [
            'section' => $section,
        ]);

        return $published;
    }

    public function formatPayloadForEditor(mixed $payload): string
    {
        $data = is_array($payload) ? $payload : [];

        return (string) json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function getRecentRevisions(string $section, int $limit = 10): Collection
    {
        if (! Schema::hasTable('content_blocks') || ! Schema::hasTable('content_revisions')) {
            return collect();
        }

        try {
            $revisions = ContentRevision::query()
                ->select('content_revisions.*')
                ->join('content_blocks', 'content_blocks.id', '=', 'content_revisions.content_block_id')
                ->where('content_blocks.section', $section)
                ->orderByDesc('content_revisions.created_at')
                ->limit($limit)
                ->get();
        } catch (QueryException) {
            return collect();
        }

        if ($revisions->isEmpty()) {
            return collect();
        }

        $userIds = $revisions
            ->pluck('changed_by')
            ->filter(fn ($id) => is_numeric($id))
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        $usersById = User::query()
            ->whereIn('id', $userIds)
            ->get(['id', 'name', 'email'])
            ->keyBy('id');

        return $revisions->map(function (ContentRevision $revision) use ($usersById): array {
            $user = $revision->changed_by ? $usersById->get((int) $revision->changed_by) : null;

            return [
                'id' => $revision->id,
                'change_note' => (string) ($revision->change_note ?? ''),
                'changed_by' => $revision->changed_by,
                'changed_by_name' => $user?->name ?? null,
                'changed_by_email' => $user?->email ?? null,
                'created_at' => $revision->created_at,
            ];
        });
    }

    public function getThemePresets(): array
    {
        if (! Schema::hasTable('panel_settings')) {
            return [];
        }

        $settings = PanelSetting::query()
            ->where('group', 'theme_presets')
            ->orderBy('key')
            ->get(['key', 'value']);

        return $settings->map(function (PanelSetting $setting): ?array {
            $decoded = json_decode((string) $setting->value, true);
            if (! is_array($decoded)) {
                return null;
            }

            $name = trim((string) ($decoded['name'] ?? ''));
            $payload = $decoded['payload'] ?? null;

            if ($name === '' || ! is_array($payload)) {
                return null;
            }

            $slug = str_replace('theme.preset.', '', (string) $setting->key);

            return [
                'slug' => $slug,
                'name' => $name,
                'payload' => $payload,
            ];
        })->filter()->values()->all();
    }

    public function saveThemePreset(string $name, array $payload, ?int $userId): array
    {
        if (! Schema::hasTable('panel_settings')) {
            throw new RuntimeException('La tabla de configuracion del panel no esta disponible.');
        }

        $cleanName = trim($name);
        if ($cleanName === '') {
            throw new RuntimeException('El nombre del preset es obligatorio.');
        }

        $slug = (string) str($cleanName)
            ->lower()
            ->ascii()
            ->replaceMatches('/[^a-z0-9]+/', '-')
            ->trim('-');

        if ($slug === '') {
            $slug = 'preset-'.time();
        }

        $key = 'theme.preset.'.$slug;

        $setting = PanelSetting::query()->firstOrNew(['key' => $key]);
        $setting->group = 'theme_presets';
        $setting->is_public = false;
        $setting->updated_by = $userId;
        $setting->value = json_encode([
            'name' => $cleanName,
            'payload' => $payload,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $setting->save();

        $this->logAction($userId, 'theme.preset_saved', 'panel_setting', (string) $setting->id, [
            'key' => $key,
        ]);

        return [
            'slug' => $slug,
            'name' => $cleanName,
            'payload' => $payload,
        ];
    }

    public function deleteThemePreset(string $slug, ?int $userId): bool
    {
        if (! Schema::hasTable('panel_settings')) {
            return false;
        }

        $cleanSlug = trim($slug);
        if ($cleanSlug === '') {
            return false;
        }

        $key = 'theme.preset.'.$cleanSlug;

        $setting = PanelSetting::query()->where('key', $key)->first();
        if (! $setting) {
            return false;
        }

        $id = $setting->id;
        $setting->delete();

        $this->logAction($userId, 'theme.preset_deleted', 'panel_setting', (string) $id, [
            'key' => $key,
        ]);

        return true;
    }

    public function getScheduledPublishAt(string $section): ?Carbon
    {
        $schedule = $this->readSchedule();
        $value = $schedule[$section] ?? null;

        if (! is_array($value) || ! isset($value['publish_at'])) {
            return null;
        }

        try {
            return Carbon::parse((string) $value['publish_at']);
        } catch (\Throwable) {
            return null;
        }
    }

    public function schedulePublish(string $section, Carbon $publishAt, ?int $userId, ?string $changeNote = null): void
    {
        $schedule = $this->readSchedule();
        $schedule[$section] = [
            'publish_at' => $publishAt->toIso8601String(),
            'change_note' => $changeNote,
            'scheduled_by' => $userId,
            'scheduled_at' => now()->toIso8601String(),
        ];

        $this->writeSchedule($schedule, $userId);

        $this->logAction($userId, 'content.publish_scheduled', 'content_block', $section, [
            'publish_at' => $publishAt->toIso8601String(),
        ]);
    }

    public function cancelScheduledPublish(string $section, ?int $userId): void
    {
        $schedule = $this->readSchedule();

        if (! array_key_exists($section, $schedule)) {
            return;
        }

        unset($schedule[$section]);
        $this->writeSchedule($schedule, $userId);

        $this->logAction($userId, 'content.publish_schedule_canceled', 'content_block', $section, []);
    }

    public function processDueScheduledPublishes(): int
    {
        $schedule = $this->readSchedule();
        if ($schedule === []) {
            return 0;
        }

        $updated = $schedule;
        $publishedCount = 0;
        $now = now();

        foreach ($schedule as $section => $meta) {
            if (! is_array($meta) || ! isset($meta['publish_at'])) {
                continue;
            }

            try {
                $publishAt = Carbon::parse((string) $meta['publish_at']);
            } catch (\Throwable) {
                continue;
            }

            if ($publishAt->gt($now)) {
                continue;
            }

            try {
                $this->publish(
                    section: (string) $section,
                    userId: isset($meta['scheduled_by']) && is_numeric($meta['scheduled_by']) ? (int) $meta['scheduled_by'] : null,
                    changeNote: trim((string) ($meta['change_note'] ?? '')) !== ''
                        ? (string) $meta['change_note']
                        : 'Publicacion programada ejecutada'
                );

                unset($updated[$section]);
                $publishedCount++;
            } catch (\Throwable) {
                // Keep schedule if publishing fails, so it can be retried.
            }
        }

        if ($updated !== $schedule) {
            $this->writeSchedule($updated, null);
        }

        return $publishedCount;
    }

    public function getSectionStatuses(array $sections): array
    {
        if (! Schema::hasTable('content_blocks')) {
            $result = [];
            foreach ($sections as $section) {
                $result[$section] = [
                    'has_published' => false,
                    'has_draft' => false,
                    'published_at' => null,
                    'draft_updated_at' => null,
                    'published_version' => null,
                ];
            }

            return $result;
        }

        $result = [];

        foreach ($sections as $section) {
            $published = ContentBlock::query()
                ->where('section', $section)
                ->where('status', 'published')
                ->latest('id')
                ->first();

            $draft = ContentBlock::query()
                ->where('section', $section)
                ->where('status', 'draft')
                ->latest('id')
                ->first();

            $result[$section] = [
                'has_published' => (bool) $published,
                'has_draft' => (bool) $draft,
                'published_at' => $published?->published_at,
                'draft_updated_at' => $draft?->updated_at,
                'published_version' => $published?->version,
            ];
        }

        return $result;
    }

    public function revertDraftToPublished(string $section, ?int $userId, ?string $changeNote = null): ContentBlock
    {
        if (! Schema::hasTable('content_blocks')) {
            throw new RuntimeException('La tabla de contenido no esta disponible.');
        }

        $published = ContentBlock::query()
            ->where('section', $section)
            ->where('status', 'published')
            ->latest('id')
            ->first();

        if (! $published) {
            throw new RuntimeException('No existe una version publicada para restaurar.');
        }

        $draft = ContentBlock::query()
            ->where('section', $section)
            ->where('status', 'draft')
            ->latest('id')
            ->first();

        $previousPayload = $draft?->payload;

        if (! $draft) {
            $draft = new ContentBlock();
            $draft->section = $section;
            $draft->status = 'draft';
            $draft->version = (int) $published->version + 1;
        }

        $draft->payload = $published->payload;
        $draft->updated_by = $userId;
        $draft->save();

        ContentRevision::query()->create([
            'content_block_id' => $draft->id,
            'previous_payload' => $previousPayload,
            'new_payload' => $draft->payload,
            'change_note' => $changeNote ?: 'Borrador restaurado desde publicado',
            'changed_by' => $userId,
            'created_at' => now(),
        ]);

        $this->logAction($userId, 'content.draft_reverted', 'content_block', (string) $draft->id, [
            'section' => $section,
        ]);

        return $draft;
    }

    private function clearSectionCache(string $section): void
    {
        if ($section === 'home.content') {
            Cache::forget('home.static_data.v1');
        }

        if ($section === 'about.content') {
            Cache::forget('about.static_data.v1');
            Cache::forget('home.static_data.v1');
        }

        if ($section === 'footer.copy') {
            Cache::forget('home.static_data.v1');
        }

        if ($section === 'menu.items') {
            Cache::forget('menu.items.v1');
        }

        if ($section === 'theme.settings') {
            Cache::forget('home.static_data.v1');
            Cache::forget('about.static_data.v1');
            Cache::forget('menu.items.v1');
        }
    }

    private function logAction(?int $userId, string $action, string $targetType, ?string $targetId, array $meta = []): void
    {
        ActivityLog::query()->create([
            'actor_id' => $userId,
            'action' => $action,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'meta' => json_encode($meta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'ip_address' => request()->ip(),
            'user_agent' => substr((string) request()->userAgent(), 0, 255),
            'created_at' => now(),
        ]);
    }

    private function readSchedule(): array
    {
        if (! Schema::hasTable('panel_settings')) {
            return [];
        }

        $setting = PanelSetting::query()->where('key', self::SCHEDULE_KEY)->first();
        if (! $setting) {
            return [];
        }

        $decoded = json_decode((string) $setting->value, true);
        return is_array($decoded) ? $decoded : [];
    }

    private function writeSchedule(array $schedule, ?int $userId): void
    {
        if (! Schema::hasTable('panel_settings')) {
            return;
        }

        $setting = PanelSetting::query()->firstOrNew(['key' => self::SCHEDULE_KEY]);
        $setting->group = 'content';
        $setting->is_public = false;
        $setting->updated_by = $userId;
        $setting->value = json_encode($schedule, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $setting->save();
    }
}
