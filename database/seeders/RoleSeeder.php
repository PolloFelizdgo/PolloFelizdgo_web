<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $legacyMap = [
            'admin' => 'administrador',
            'editor' => 'superusario',
            'viewer' => 'diseño',
        ];

        foreach ($legacyMap as $legacyName => $newName) {
            $newRole = Role::query()->firstOrCreate([
                'name' => $newName,
            ]);

            $legacyRole = Role::query()->where('name', $legacyName)->first();
            if (! $legacyRole) {
                continue;
            }

            User::query()
                ->where('role_id', $legacyRole->id)
                ->update(['role_id' => $newRole->id]);

            $legacyRole->delete();
        }

        foreach (['administrador', 'superusario', 'diseño'] as $name) {
            Role::query()->firstOrCreate([
                'name' => $name,
            ]);
        }

        Role::query()
            ->whereNotIn('name', ['administrador', 'superusario', 'diseño'])
            ->whereDoesntHave('users')
            ->delete();
    }
}
