<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $pages = [
            'bmi',
            'user',
            'kategori',
            'sub-kategori',
            'comparison'
        ];

        $permis = [
            'list',
            'create',
            'edit',
            'delete'
        ];

        foreach ($pages as $page) {
            foreach ($permis as $p) {
                $permissions[] = $page . '-' . $p;
            }
        }

        // Buat permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role Admin dan berikan semua permission
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        // Buat role Staf dan berikan hanya permission yang mengandung "list" dan "create"
        $stafRole = Role::firstOrCreate(['name' => 'staf']);
        $allowedPermissions = array_filter($permissions, fn($p) => str_contains($p, 'list') || str_contains($p, 'create'));
        $stafRole->syncPermissions($allowedPermissions);
    }
}
