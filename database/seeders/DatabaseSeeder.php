<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * php artisan db:seed 
     */
    public function run(): void
    {

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            RolePermissionSeeder::class,
            OfficeSeeder::class,
            JobPositionSeeder::class,
            ContractTypeSeeder::class,
            WorkerSeeder::class,
            AssetTypeSeeder::class,
            AssetStateSeeder::class,
            SoftwareTypeSeeder::class,
        ]);
    }
}
