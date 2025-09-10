<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Gestión de usuarios
            'ver usuarios',
            'crear usuarios',
            'actualizar usuarios',
            'eliminar usuarios',
            'gestionar roles de usuarios',

            // Gestión de roles
            'ver roles',
            'crear roles',
            'actualizar roles',
            'eliminar roles',

            // Gestión de permisos
            'ver permisos',
            'crear permisos',
            'actualizar permisos',
            'eliminar permisos',

            // Gestión de oficinas
            'ver oficinas',
            'crear oficinas',
            'actualizar oficinas',
            'eliminar oficinas',

            // Puestos de trabajo
            'ver puestos de trabajo',
            'crear puestos de trabajo',
            'actualizar puestos de trabajo',
            'eliminar puestos de trabajo',

            // Tipos de contratos
            'ver tipos de contratos',
            'crear tipos de contratos',
            'actualizar tipos de contratos',
            'eliminar tipos de contratos',

            // Gestión de trabajadores
            'ver trabajadores',
            'crear trabajadores',
            'actualizar trabajadores',
            'eliminar trabajadores',

            // Tipos de activos
            'ver tipos de activos',
            'crear tipos de activos',
            'actualizar tipos de activos',
            'eliminar tipos de activos',

            // Estados de activos
            'ver estados de activos',
            'crear estados de activos',
            'actualizar estados de activos',
            'eliminar estados de activos',

            // Tipos de software
            'ver tipos de software',
            'crear tipos de software',
            'actualizar tipos de software',
            'eliminar tipos de software',

            // Activos de la empresa
            'ver activos de la empresa',
            'crear activos de la empresa',
            'actualizar activos de la empresa',
            'eliminar activos de la empresa',

            // Hardware
            'ver hardware',
            'crear hardware',
            'actualizar hardware',
            'eliminar hardware',

            // Software
            'ver software',
            'crear software',
            'actualizar software',
            'eliminar software',

            // Mobiliarios
            'ver mobiliarios',
            'crear mobiliarios',
            'actualizar mobiliarios',
            'eliminar mobiliarios',

            // Maquinaria
            'ver maquinaria',
            'crear maquinaria',
            'actualizar maquinaria',
            'eliminar maquinaria',

            // Herramientas
            'ver herramientas',
            'crear herramientas',
            'actualizar herramientas',
            'eliminar herramientas',

            // Otros activos
            'ver otros activos',
            'crear otros activos',
            'actualizar otros activos',
            'eliminar otros activos',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $this->command->info('Permisos creados exitosamente.');
    }
}