<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetState; // Importa el modelo (crea este modelo si no existe)

class AssetStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assetStates = [
            ['id' => 1, 'name' => 'NUEVO', 'description' => 'El bien ha sido adquirido recientemente y no ha sido usado.'],
            ['id' => 2, 'name' => 'BUENO', 'description' => 'El bien se encuentra en condiciones óptimas para su uso.'],
            ['id' => 3, 'name' => 'REGULAR', 'description' => 'El bien presenta desgaste o fallas menores, pero es funcional.'],
            ['id' => 4, 'name' => 'MALO', 'description' => 'El bien está deteriorado y requiere reparación para su uso.'],
            ['id' => 5, 'name' => 'INOPERATIVO', 'description' => 'El bien no funciona y no puede ser utilizado.'],
            ['id' => 6, 'name' => 'EN MANTENIMIENTO', 'description' => 'El bien está en proceso de revisión o reparación.'],
            ['id' => 7, 'name' => 'DADO DE BAJA', 'description' => 'El bien ha sido retirado oficialmente del inventario.'],
            ['id' => 8, 'name' => 'REASIGNADO', 'description' => 'El bien ha sido transferido a otra oficina o usuario.'],
        ];

        foreach ($assetStates as $assetState) {
            AssetState::firstOrCreate(
                ['id' => $assetState['id']], // Clave única para buscar
                [
                    'name' => $assetState['name'],
                    'description' => $assetState['description'],
                ]
            );
        }
    }
}