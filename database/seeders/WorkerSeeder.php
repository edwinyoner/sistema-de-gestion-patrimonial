<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Worker; // Importa el modelo (crea este modelo si no existe)

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workers = [
            [
                'id' => 1,
                'dni' => '72581301',
                'first_name' => 'JUAN ELMER',
                'last_name_paternal' => 'RAMIREZ',
                'last_name_maternal' => 'QUISPE',
                'email' => 'juan.ramirez@winner-systems.com',
                'phone' => '912345670',
                'office_id' => 1,
                'job_position_id' => 1,
                'contract_type_id' => 1,
            ],
            [
                'id' => 2,
                'dni' => '70819234',
                'first_name' => 'MARIA DEL CARMEN',
                'last_name_paternal' => 'HUAMAN',
                'last_name_maternal' => 'CARRILLO',
                'email' => 'maria.huaman@winner-systems.com',
                'phone' => '912345671',
                'office_id' => 2,
                'job_position_id' => 2,
                'contract_type_id' => 2,
            ],
            [
                'id' => 3,
                'dni' => '71234567',
                'first_name' => 'LUIS MIGUEL',
                'last_name_paternal' => 'ESPINOZA',
                'last_name_maternal' => 'SALAZAR',
                'email' => 'luis.espinoza@winner-systems.com',
                'phone' => '912345672',
                'office_id' => 3,
                'job_position_id' => 3,
                'contract_type_id' => 1,
            ],
            [
                'id' => 4,
                'dni' => '71543218',
                'first_name' => 'MARÍA JOSEFA',
                'last_name_paternal' => 'SALAZAR',
                'last_name_maternal' => 'MENDOZA',
                'email' => 'maria.salazar@winner-systems.com',
                'phone' => '912345673',
                'office_id' => 4,
                'job_position_id' => 4,
                'contract_type_id' => 3,
            ],
            [
                'id' => 5,
                'dni' => '70192384',
                'first_name' => 'CARLOS ANDRÉS',
                'last_name_paternal' => 'CCAPA',
                'last_name_maternal' => 'VALVERDE',
                'email' => 'carlos.ccapa@winner-systems.com',
                'phone' => '912345674',
                'office_id' => 5,
                'job_position_id' => 5,
                'contract_type_id' => 6,
            ],
            [
                'id' => 6,
                'dni' => '70458291',
                'first_name' => 'ROSARIO ELENA',
                'last_name_paternal' => 'CHÁVEZ',
                'last_name_maternal' => 'RAMÍREZ',
                'email' => 'rosario.chavez@winner-systems.com',
                'phone' => '912345675',
                'office_id' => 6,
                'job_position_id' => 6,
                'contract_type_id' => 2,
            ],
            [
                'id' => 7,
                'dni' => '71639125',
                'first_name' => 'HUGO MANUEL',
                'last_name_paternal' => 'LOPEZ',
                'last_name_maternal' => 'QUISPE',
                'email' => 'hugo.lopez@winner-systems.com',
                'phone' => '912345676',
                'office_id' => 7,
                'job_position_id' => 7,
                'contract_type_id' => 1,
            ],
            [
                'id' => 8,
                'dni' => '70518342',
                'first_name' => 'PAULA GABRIELA',
                'last_name_paternal' => 'CRUZ',
                'last_name_maternal' => 'GONZALES',
                'email' => 'paula.cruz@winner-systems.com',
                'phone' => '912345677',
                'office_id' => 8,
                'job_position_id' => 8,
                'contract_type_id' => 1,
            ],
            [
                'id' => 9,
                'dni' => '71128394',
                'first_name' => 'JORGE ANTONIO',
                'last_name_paternal' => 'MAMANI',
                'last_name_maternal' => 'HUERTA',
                'email' => 'jorge.mamani@winner-systems.com',
                'phone' => '912345678',
                'office_id' => 9,
                'job_position_id' => 9,
                'contract_type_id' => 3,
            ],
            [
                'id' => 10,
                'dni' => '72239184',
                'first_name' => 'SANDRA MILAGROS',
                'last_name_paternal' => 'APAZA',
                'last_name_maternal' => 'LUQUE',
                'email' => 'sandra.apaza@winner-systems.com',
                'phone' => '912345679',
                'office_id' => 10,
                'job_position_id' => 10,
                'contract_type_id' => 4,
            ],
        ];

        foreach ($workers as $worker) {
            Worker::firstOrCreate(
                ['id' => $worker['id']], // Clave única para buscar
                [
                    'dni' => $worker['dni'],
                    'first_name' => $worker['first_name'],
                    'last_name_paternal' => $worker['last_name_paternal'],
                    'last_name_maternal' => $worker['last_name_maternal'],
                    'email' => $worker['email'],
                    'phone' => $worker['phone'],
                    'office_id' => $worker['office_id'],
                    'job_position_id' => $worker['job_position_id'],
                    'contract_type_id' => $worker['contract_type_id'],
                ]
            );
        }
    }
}