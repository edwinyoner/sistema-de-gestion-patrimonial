<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Autoridad', 'Usuario'];

        foreach ($roles as $role) {
            // Para usuarios web (sesiones)
            Role::firstOrCreate([
                'name' => $role, 
                'guard_name' => 'web'
            ]);

            // Para usuarios API (tokens)
            // Role::firstOrCreate([
            //     'name' => $role, 
            //     'guard_name' => 'sanctum'
            // ]);
        }
    }
}
