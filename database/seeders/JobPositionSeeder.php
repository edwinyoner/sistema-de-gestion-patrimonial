<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobPosition; // Importa el modelo (crea este modelo si no existe)

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobPositions = [
            ['id' => 1, 'name' => 'ALCALDE', 'description' => 'Máxima autoridad ejecutiva de la Municipalidad'],
            ['id' => 2, 'name' => 'SECRETARIO GENERAL', 'description' => 'Encargado de tramitar, notificar y archivar la documentación municipal'],
            ['id' => 3, 'name' => 'GERENTE MUNICIPAL', 'description' => 'Responsable de coordinar y supervisar todas las áreas operativas'],
            ['id' => 4, 'name' => 'ASESOR JURÍDICO', 'description' => 'Asesora en asuntos legales y normativos a todas las unidades'],
            ['id' => 5, 'name' => 'JEFE DE ADMINISTRACIÓN Y FINANZAS', 'description' => 'Dirige la gestión administrativa, logística y financiera'],
            ['id' => 6, 'name' => 'JEFE DE PLANEAMIENTO Y PRESUPUESTO', 'description' => 'Encargado de formular planes y presupuestos institucionales'],
            ['id' => 7, 'name' => 'JEFE DE OGTI', 'description' => 'Encargado de los sistemas informáticos, redes y soporte técnico'],
            ['id' => 8, 'name' => 'JEFE DE TALENTO HUMANO', 'description' => 'Gestiona el personal y recursos humanos'],
            ['id' => 9, 'name' => 'TESORERO MUNICIPAL', 'description' => 'Gestiona ingresos y egresos financieros'],
            ['id' => 10, 'name' => 'CONTADOR MUNICIPAL', 'description' => 'Responsable de la contabilidad y estados financieros'],
            ['id' => 11, 'name' => 'JEFE DE ABASTECIMIENTO', 'description' => 'Gestiona compras, logística y almacén'],
            ['id' => 12, 'name' => 'JEFE DE IMAGEN INSTITUCIONAL', 'description' => 'Comunica y difunde la imagen institucional'],
            ['id' => 13, 'name' => 'JEFE DE CATASTRO', 'description' => 'Administra la base de datos predial y territorial'],
            ['id' => 14, 'name' => 'RESPONSABLE DEMUNA', 'description' => 'Protección de derechos de niños y adolescentes'],
            ['id' => 15, 'name' => 'RESPONSABLE SISFOH', 'description' => 'Administra el sistema de focalización de hogares'],
            ['id' => 16, 'name' => 'SUBGERENTE DE SERVICIOS MUNICIPALES', 'description' => 'Dirige limpieza, residuos y servicios básicos'],
            ['id' => 17, 'name' => 'SUBGERENTE DE DESARROLLO HUMANO', 'description' => 'Gestiona programas sociales y comunitarios'],
            ['id' => 18, 'name' => 'SUBGERENTE DE DESARROLLO ECONÓMICO', 'description' => 'Promueve actividades económicas y productivas'],
            ['id' => 19, 'name' => 'SUBGERENTE DE URBANISMO Y RURALIDAD', 'description' => 'Gestiona zonificación y desarrollo territorial'],
            ['id' => 20, 'name' => 'SUBGERENTE DE EJECUCIÓN DE OBRAS', 'description' => 'Encargado de la ejecución de obras públicas'],
            ['id' => 21, 'name' => 'SUBGERENTE DE ESTUDIOS Y PROYECTOS', 'description' => 'Elabora y evalúa estudios técnicos y de inversión'],
            ['id' => 22, 'name' => 'GERENTE DE TRIBUTACIÓN', 'description' => 'Supervisa y controla el sistema de tributos locales'],
            ['id' => 23, 'name' => 'GERENTE DE DESARROLLO TERRITORIAL', 'description' => 'Coordina obras y ordenamiento físico-territorial'],
            ['id' => 24, 'name' => 'GERENTE DE DESARROLLO SOSTENIBLE', 'description' => 'Lidera programas de sostenibilidad ambiental y social'],
            ['id' => 25, 'name' => 'GERENTE DE SEGURIDAD Y SERENAZGOS', 'description' => NULL],
        ];

        foreach ($jobPositions as $jobPosition) {
            JobPosition::firstOrCreate(
                ['id' => $jobPosition['id']], // Clave única para buscar
                [
                    'name' => $jobPosition['name'],
                    'description' => $jobPosition['description'],
                ]
            );
        }
    }
}