<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Usuarios
            ['name' => 'user-list', 'description' => 'Ver lista de usuarios'],
            ['name' => 'user-create', 'description' => 'Crear usuarios'],
            ['name' => 'user-edit', 'description' => 'Editar usuarios'],
            ['name' => 'user-delete', 'description' => 'Eliminar usuarios'],
            ['name' => 'user-assign-role', 'description' => 'Asignar roles a usuarios'],
            
            // Roles
            ['name' => 'role-list', 'description' => 'Ver lista de roles'],
            ['name' => 'role-create', 'description' => 'Crear roles'],
            ['name' => 'role-edit', 'description' => 'Editar roles'],
            ['name' => 'role-delete', 'description' => 'Eliminar roles'],
            
            // Permisos
            ['name' => 'permission-list', 'description' => 'Ver lista de permisos'],
            ['name' => 'permission-create', 'description' => 'Crear permisos'],
            ['name' => 'permission-edit', 'description' => 'Editar permisos'],
            ['name' => 'permission-delete', 'description' => 'Eliminar permisos'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
