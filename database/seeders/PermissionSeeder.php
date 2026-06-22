<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'manage_users', 'description' => 'Permite gestionar usuarios del sistema'],
            ['name' => 'manage_roles', 'description' => 'Permite gestionar roles'],
            ['name' => 'manage_permissions', 'description' => 'Permite gestionar permisos'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
