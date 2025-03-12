<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
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

        $permissions = [
            'list',
            'create',
            'edit',
            'delete'
        ];


        foreach ($pages as $page) {
            foreach ($permissions as $permission) {
                Permission::create([
                    'name' => $page . '-' . $permission
                ]);
            }
        }

        $permissionsID = Permission::all()->pluck('id');

        $role = Role::findByName('admin');
        $role->syncPermissions($permissionsID);
    }
}
