<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los roles
        $adminRole = Role::where('name', 'Admin')->first();
        $autoridadRole = Role::where('name', 'Autoridad')->first();
        $usuarioRole = Role::where('name', 'Usuario')->first();

        // PERMISOS PARA ADMIN (Acceso total)
        $adminPermissions = Permission::all(); // Todos los permisos
        $adminRole->syncPermissions($adminPermissions);

        // PERMISOS PARA AUTORIDAD (Gestión operativa sin configuración de sistema)
        $autoridadPermissions = [
            // Puede ver usuarios pero no crear/eliminar administradores
            'ver usuarios',
            'crear usuarios',
            'actualizar usuarios',
            // 'eliminar usuarios', // No puede eliminar usuarios
            'gestionar roles de usuarios',

            // Solo ver roles y permisos, no modificar
            'ver roles',
            'ver permisos',

            // Gestión completa de estructura organizacional
            'ver oficinas',
            'crear oficinas',
            'actualizar oficinas',
            'eliminar oficinas',

            'ver puestos de trabajo',
            'crear puestos de trabajo',
            'actualizar puestos de trabajo',
            'eliminar puestos de trabajo',

            'ver tipos de contratos',
            'crear tipos de contratos',
            'actualizar tipos de contratos',
            'eliminar tipos de contratos', 

            // Gestión completa de trabajadores
            'ver trabajadores',
            'crear trabajadores',
            'actualizar trabajadores',
            'eliminar trabajadores',
            //'asignar trabajadores',

            // Gestión de tipos y estados (configuración operativa)
            'ver tipos de activos',
            'crear tipos de activos',
            'actualizar tipos de activos',
            'eliminar tipos de activos',

            'ver estados de activos',
            'crear estados de activos',
            'actualizar estados de activos',
            'eliminar estados de activos',

            'ver tipos de software',
            'crear tipos de software',
            'actualizar tipos de software',
            'eliminar tipos de software',

            // Gestión completa de activos (operaciones principales)
            'ver activos de la empresa',
            'crear activos de la empresa',
            'actualizar activos de la empresa',
            'eliminar activos de la empresa',
            //'aprobar activos de la empresa',

            // Gestión de hardware
            'ver hardware',
            'crear hardware',
            'actualizar hardware',
            'eliminar hardware',
            //'asignar hardware',

            // Gestión de software
            'ver software',
            'crear software',
            'actualizar software',
            'eliminar software',
            //'licenciar software',

            // Gestión de mobiliarios
            'ver mobiliarios',
            'crear mobiliarios',
            'actualizar mobiliarios',
            'eliminar mobiliarios',
            //'asignar mobiliarios',

            // Gestión de maquinaria
            'ver maquinaria',
            'crear maquinaria',
            'actualizar maquinaria',
            'eliminar maquinaria',
            //'asignar maquinaria',

            // Gestión de otros activos
            'ver otros activos',
            'crear otros activos',
            'actualizar otros activos',
            'eliminar otros activos',
            //'asignar otros activos',            
        ];

        $autoridadRole->syncPermissions($autoridadPermissions);

        // PERMISOS PARA USUARIO (Solo consultas y operaciones básicas)
        $usuarioPermissions = [
            // Solo visualización de usuarios (sus colegas)
            'ver usuarios',

            // Solo visualización de estructura organizacional
            'ver oficinas',
            'ver tipos de contratos',
            'ver puestos de trabajo',
            'ver trabajadores',

            // Solo visualización de tipos y estados
            'ver tipos de activos',
            'ver estados de activos',
            'ver tipos de software',

            // Visualización de activos y operaciones básicas
            'ver activos de la empresa',
            'ver mobiliarios',
            'ver hardware',
            'ver maquinaria',
            'ver otros activos',
            'ver software',

            // Podría tener permisos básicos de creación dependiendo del flujo de trabajo
            // Por ejemplo, solicitar nuevos activos que requieren aprobación
            'ver activos de la empresa',
            'crear activos de la empresa',
            'actualizar activos de la empresa',
            'eliminar activos de la empresa',
        ];

        $usuarioRole->syncPermissions($usuarioPermissions);

        $this->command->info('Permisos asignados a roles exitosamente.');
        $this->command->info('Admin: ' . $adminRole->permissions->count() . ' permisos');
        $this->command->info('Autoridad: ' . $autoridadRole->permissions->count() . ' permisos');
        $this->command->info('Usuario: ' . $usuarioRole->permissions->count() . ' permisos');
    }
}