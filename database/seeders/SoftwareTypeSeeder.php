<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoftwareType;

class SoftwareTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $softwareTypes = [
            ['id' => 1, 'name' => 'PROPIETARIO', 'description' => 'Software con licencia comercial, derechos de autor restrictivos y código fuente cerrado.'],
            ['id' => 2, 'name' => 'LIBRE', 'description' => 'Software que garantiza las cuatro libertades fundamentales: usar, estudiar, modificar y distribuir.'],
            ['id' => 3, 'name' => 'CÓDIGO ABIERTO', 'description' => 'Software con código fuente accesible, enfocado en el modelo de desarrollo colaborativo.'],
            ['id' => 4, 'name' => 'DESARROLLADO INTERNAMENTE', 'description' => 'Software creado por el personal interno de la organización para necesidades específicas.'],
            ['id' => 5, 'name' => 'HÍBRIDO - FREEMIUM', 'description' => 'Software que combina versiones gratuitas básicas con funcionalidades premium de pago.'],
        ];

        foreach ($softwareTypes as $softwareType) {
            SoftwareType::firstOrCreate(
                ['id' => $softwareType['id']],
                [
                    'name' => $softwareType['name'],
                    'description' => $softwareType['description'],
                ]
            );
        }
    }
}