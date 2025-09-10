<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContractType; // Importa el modelo (crea este modelo si no existe)

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contractTypes = [
            ['id' => 1, 'name' => 'NOMBRADO', 'description' => 'Trabajador bajo el régimen del Decreto Legislativo N.° 276, con estabilidad laboral.'],
            ['id' => 2, 'name' => 'CONTRATADO D.L. 276', 'description' => 'Contrato temporal bajo el régimen de la Ley N.° 276.'],
            ['id' => 3, 'name' => 'CONTRATO CAS', 'description' => 'Contrato Administrativo de Servicios regulado por la Ley N.° 1057.'],
            ['id' => 4, 'name' => 'LOCACIÓN DE SERVICIOS', 'description' => 'Prestación de servicios por terceros sin vínculo laboral directo.'],
            ['id' => 5, 'name' => 'PRACTICANTE PRE-PROFESIONAL', 'description' => 'Estudiante en formación que realiza prácticas supervisadas.'],
            ['id' => 6, 'name' => 'PRACTICANTE PROFESIONAL', 'description' => 'Egresado de una carrera profesional que realiza prácticas profesionales.'],
            ['id' => 7, 'name' => 'SUPLENCIA', 'description' => 'Contrato temporal para reemplazo de personal con licencia o inasistencia prolongada.'],
            ['id' => 8, 'name' => 'SERVICIOS PERSONALES', 'description' => 'Vinculación por honorarios en labores específicas no permanentes.'],
            ['id' => 9, 'name' => 'CONTRATO TEMPORAL', 'description' => 'Modalidad de contratación eventual por necesidad institucional.'],
        ];

        foreach ($contractTypes as $contractType) {
            ContractType::firstOrCreate(
                ['id' => $contractType['id']], // Clave única para buscar
                [
                    'name' => $contractType['name'],
                    'description' => $contractType['description'],
                ]
            );
        }
    }
}