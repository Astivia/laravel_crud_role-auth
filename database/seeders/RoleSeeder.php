<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['description' => 'Administrador general del sistema', 'is_active' => true]
        );

        // Asignar automáticamente todos los permisos disponibles al rol admin
        $allPermissions = Permission::all();
        $adminRole->permissions()->sync($allPermissions->pluck('id'));
        
        // Crear un rol básico de ejemplo
        Role::firstOrCreate(
            ['name' => 'user'],
            ['description' => 'Usuario estándar del sistema', 'is_active' => true]
        );
    }
}
