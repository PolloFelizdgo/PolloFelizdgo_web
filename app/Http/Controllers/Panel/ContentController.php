<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PublishPanelContentRequest;
use App\Http\Requests\Panel\UpdatePanelContentRequest;
use App\Services\Panel\PanelContentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function __construct(private readonly PanelContentService $contentService)
    {
    }

    public function editHome(): View
    {
        return $this->editorView(
            section: 'home.content',
            title: 'Editar contenido: Home',
            fallbackPayload: config('site_content.home', [])
        );
    }

    public function updateHome(UpdatePanelContentRequest $request): RedirectResponse
    {
        return $this->saveDraft($request, 'home.content', 'Contenido Home guardado en borrador.');
    }

    public function publishHome(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->publish($request, 'home.content', 'Contenido Home publicado y cache limpiado.');
    }

    public function revertHome(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->revertToPublished($request, 'home.content', 'Borrador Home restaurado desde la version publicada.');
    }

    public function editAbout(): View
    {
        return $this->editorView(
            section: 'about.content',
            title: 'Editar contenido: Acerca',
            fallbackPayload: config('site_content.about', [])
        );
    }

    public function updateAbout(UpdatePanelContentRequest $request): RedirectResponse
    {
        return $this->saveDraft($request, 'about.content', 'Contenido Acerca guardado en borrador.');
    }

    public function publishAbout(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->publish($request, 'about.content', 'Contenido Acerca publicado y cache limpiado.');
    }

    public function revertAbout(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->revertToPublished($request, 'about.content', 'Borrador Acerca restaurado desde la version publicada.');
    }

    public function editFooter(): View
    {
        return $this->editorView(
            section: 'footer.copy',
            title: 'Editar contenido: Footer',
            fallbackPayload: config('site_content.footer', [])
        );
    }

    public function updateFooter(UpdatePanelContentRequest $request): RedirectResponse
    {
        return $this->saveDraft($request, 'footer.copy', 'Contenido Footer guardado en borrador.');
    }

    public function publishFooter(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->publish($request, 'footer.copy', 'Contenido Footer publicado y cache limpiado.');
    }

    public function revertFooter(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->revertToPublished($request, 'footer.copy', 'Borrador Footer restaurado desde la version publicada.');
    }

    public function editMenu(): View
    {
        return $this->editorView(
            section: 'menu.items',
            title: 'Editar contenido: Menu',
            fallbackPayload: [
                'items' => [
                    ['name' => 'Pollo Asado Entero', 'price' => '$199'],
                    ['name' => 'Medio Pollo', 'price' => '$109'],
                    ['name' => 'Combo Familiar', 'price' => '$289'],
                    ['name' => 'Complementos', 'price' => 'Desde $45'],
                    ['name' => 'Bebidas', 'price' => 'Desde $25'],
                    ['name' => 'Paquete Ejecutivo', 'price' => '$149'],
                    ['name' => 'Combo Infantil', 'price' => '$99'],
                    ['name' => 'Papas Especiales', 'price' => '$59'],
                    ['name' => 'Complementos', 'price' => 'Desde $45'],
                    ['name' => 'Bebidas', 'price' => 'Desde $25'],
                    ['name' => 'Paquete Ejecutivo', 'price' => '$149'],
                    ['name' => 'Combo Infantil', 'price' => '$99'],
                    ['name' => 'Papas Especiales', 'price' => '$59'],
                    ['name' => 'Complementos', 'price' => 'Desde $45'],
                    ['name' => 'Bebidas', 'price' => 'Desde $25'],
                    ['name' => 'Paquete Ejecutivo', 'price' => '$149'],
                    ['name' => 'Combo Infantil', 'price' => '$99'],
                    ['name' => 'Papas Especiales', 'price' => '$59'],
                ],
            ]
        );
    }

    public function editTheme(): View
    {
        return $this->editorView(
            section: 'theme.settings',
            title: 'Editar contenido: Estilo',
            fallbackPayload: config('site_content.theme', [])
        );
    }

    public function updateMenu(UpdatePanelContentRequest $request): RedirectResponse
    {
        return $this->saveDraft($request, 'menu.items', 'Contenido Menu guardado en borrador.');
    }

    public function updateTheme(UpdatePanelContentRequest $request): RedirectResponse
    {
        return $this->saveDraft($request, 'theme.settings', 'Estilo guardado en borrador.');
    }

    public function publishMenu(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->publish($request, 'menu.items', 'Contenido Menu publicado y cache limpiado.');
    }

    public function publishTheme(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->publish($request, 'theme.settings', 'Estilo publicado y cache limpiado.');
    }

    public function saveThemePreset(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'preset_name' => ['required', 'string', 'max:80'],
            'preset_payload_json' => ['required', 'string'],
        ]);

        $payload = json_decode((string) $validated['preset_payload_json'], true);
        if (! is_array($payload)) {
            return back()->withErrors([
                'payload_json' => 'No se pudo guardar el preset: JSON invalido.',
            ]);
        }

        $payloadErrors = $this->validatePayloadBySection('theme.settings', $payload);
        if (! empty($payloadErrors)) {
            return back()->withErrors($payloadErrors);
        }

        $this->contentService->saveThemePreset(
            name: (string) $validated['preset_name'],
            payload: $payload,
            userId: $request->user()?->id,
        );

        return back()->with('success', 'Preset de estilo guardado.');
    }

    public function deleteThemePreset(Request $request, string $slug): RedirectResponse
    {
        $this->contentService->deleteThemePreset($slug, $request->user()?->id);

        return back()->with('success', 'Preset de estilo eliminado.');
    }

    public function scheduleThemePublish(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'publish_at' => ['required', 'date'],
            'change_note' => ['nullable', 'string', 'max:255'],
        ]);

        $publishAt = Carbon::parse((string) $validated['publish_at']);
        if ($publishAt->lessThan(now()->addMinute())) {
            return back()->withErrors([
                'payload_json' => 'La fecha de publicacion debe ser al menos un minuto en el futuro.',
            ]);
        }

        $this->contentService->schedulePublish(
            section: 'theme.settings',
            publishAt: $publishAt,
            userId: $request->user()?->id,
            changeNote: (string) ($validated['change_note'] ?? ''),
        );

        return back()->with('success', 'Publicacion de Estilo programada correctamente.');
    }

    public function cancelThemeScheduledPublish(Request $request): RedirectResponse
    {
        $this->contentService->cancelScheduledPublish('theme.settings', $request->user()?->id);

        return back()->with('success', 'Publicacion programada de Estilo cancelada.');
    }

    public function revertMenu(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->revertToPublished($request, 'menu.items', 'Borrador Menu restaurado desde la version publicada.');
    }

    public function revertTheme(PublishPanelContentRequest $request): RedirectResponse
    {
        return $this->revertToPublished($request, 'theme.settings', 'Borrador Estilo restaurado desde la version publicada.');
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:5120'],
        ]);

        $image = $validated['image'];
        $directory = public_path('images/panel');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $extension = strtolower((string) $image->getClientOriginalExtension());
        $filename = now()->format('YmdHis').'-'.Str::random(10).'.'.$extension;
        $image->move($directory, $filename);

        $relativePath = 'images/panel/'.$filename;

        return response()->json([
            'path' => $relativePath,
            'url' => asset($relativePath),
        ]);
    }

    private function editorView(string $section, string $title, array $fallbackPayload): View
    {
        $this->contentService->processDueScheduledPublishes();

        $published = $this->contentService->getPublishedPayload($section, $fallbackPayload);
        $payload = is_array($published) ? $published : $fallbackPayload;

        return view('panel.content.edit', [
            'section' => $section,
            'title' => $title,
            'payloadJson' => $this->contentService->formatPayloadForEditor($payload),
            'payload' => $payload,
            'revisions' => $this->contentService->getRecentRevisions($section, 12),
            'themePresets' => $section === 'theme.settings' ? $this->contentService->getThemePresets() : [],
            'scheduledPublishAt' => $section === 'theme.settings' ? $this->contentService->getScheduledPublishAt($section) : null,
        ]);
    }

    private function saveDraft(UpdatePanelContentRequest $request, string $section, string $message): RedirectResponse
    {
        $payload = json_decode((string) $request->input('payload_json'), true);

        if (! is_array($payload)) {
            return back()->withInput()->withErrors([
                'payload_json' => 'El JSON no es valido. Revisa llaves, comas y comillas.',
            ]);
        }

        $payloadErrors = $this->validatePayloadBySection($section, $payload);

        if (! empty($payloadErrors)) {
            return back()->withInput()->withErrors($payloadErrors);
        }

        $this->contentService->saveDraft(
            section: $section,
            payload: $payload,
            userId: $request->user()?->id,
            changeNote: $request->string('change_note')->toString()
        );

        return back()->with('success', $message);
    }

    private function validatePayloadBySection(string $section, array $payload): array
    {
        if ($section !== 'menu.items') {
            if ($section !== 'theme.settings') {
                return [];
            }

            $required = ['primary_color', 'accent_color', 'card_color', 'text_color', 'muted_text_color', 'heading_font', 'body_font'];
            foreach ($required as $field) {
                if (trim((string) ($payload[$field] ?? '')) === '') {
                    return ['payload_json' => "El campo {$field} de Estilo es obligatorio."];
                }
            }

            $backgroundColor = trim((string) ($payload['background_color'] ?? $payload['surface_color'] ?? ''));
            if ($backgroundColor === '') {
                return ['payload_json' => 'El campo background_color de Estilo es obligatorio.'];
            }

            $themeColors = [
                'primary_color' => trim((string) ($payload['primary_color'] ?? '')),
                'accent_color' => trim((string) ($payload['accent_color'] ?? '')),
                'background_color' => $backgroundColor,
                'card_color' => trim((string) ($payload['card_color'] ?? '')),
                'text_color' => trim((string) ($payload['text_color'] ?? '')),
                'muted_text_color' => trim((string) ($payload['muted_text_color'] ?? '')),
            ];

            foreach ($themeColors as $colorField => $color) {
                if (! preg_match('/^#[0-9A-Fa-f]{6}$/', $color)) {
                    return ['payload_json' => "El campo {$colorField} debe ser un color HEX valido como #DC2626."];
                }
            }

            return [];
        }

        $items = $payload['items'] ?? null;

        if (! is_array($items) || empty($items)) {
            return ['payload_json' => 'Debes capturar al menos un platillo en Menu.'];
        }

        foreach ($items as $index => $item) {
            $row = $index + 1;

            if (! is_array($item)) {
                return ['payload_json' => "El registro {$row} del Menu no es valido."];
            }

            $name = trim((string) ($item['name'] ?? ''));
            $price = trim((string) ($item['price'] ?? ''));

            if ($name === '') {
                return ['payload_json' => "El platillo {$row} no tiene nombre."];
            }

            if ($price === '') {
                return ['payload_json' => "El platillo {$row} no tiene precio."];
            }

            if (mb_strlen($name) > 120) {
                return ['payload_json' => "El nombre del platillo {$row} no debe exceder 120 caracteres."];
            }

            if (mb_strlen($price) > 60) {
                return ['payload_json' => "El precio del platillo {$row} no debe exceder 60 caracteres."];
            }
        }

        return [];
    }

    private function publish(PublishPanelContentRequest $request, string $section, string $message): RedirectResponse
    {
        $this->contentService->publish(
            section: $section,
            userId: $request->user()?->id,
            changeNote: $request->string('change_note')->toString()
        );

        return back()->with('success', $message);
    }

    private function revertToPublished(PublishPanelContentRequest $request, string $section, string $message): RedirectResponse
    {
        try {
            $this->contentService->revertDraftToPublished(
                section: $section,
                userId: $request->user()?->id,
                changeNote: $request->string('change_note')->toString()
            );
        } catch (\RuntimeException $exception) {
            return back()->withErrors([
                'payload_json' => $exception->getMessage(),
            ]);
        }

        return back()->with('success', $message);
    }
}
