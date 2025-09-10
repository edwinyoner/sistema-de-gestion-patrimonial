<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Office; // Importa el modelo

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            ['id' => 1, 'name' => 'ALCALDÍA', 'short_name' => 'ALC', 'description' => 'Despacho del alcalde, máxima autoridad del gobierno local.'],
            ['id' => 2, 'name' => 'SECRETARÍA GENERAL', 'short_name' => 'SGEN', 'description' => 'Encargada de tramitar, archivar y dar fe de los actos administrativos.'],
            ['id' => 3, 'name' => 'GERENCIA MUNICIPAL', 'short_name' => 'GEMU', 'description' => 'Coordina y supervisa las áreas operativas y administrativas.'],
            ['id' => 4, 'name' => 'ASESORÍA JURÍDICA', 'short_name' => 'ASEJUR', 'description' => 'Brinda asesoría legal a todas las dependencias municipales.'],
            ['id' => 5, 'name' => 'OFICINA DE GESTIÓN ADMINISTRATIVA Y FINANCIERA', 'short_name' => 'OGAF', 'description' => 'Gestiona los recursos humanos, logísticos y financieros.'],
            ['id' => 6, 'name' => 'OFICINA DE PLANEAMIENTO, PRESUPUESTO Y DESARROLLO', 'short_name' => 'OPPDP', 'description' => 'Elabora y evalúa planes, programas y presupuestos institucionales.'],
            ['id' => 7, 'name' => 'OFICINA DE TECNOLOGÍAS DE LA INFORMACIÓN Y SISTEMAS', 'short_name' => 'OGTI', 'description' => 'Administra la infraestructura tecnológica y sistemas informáticos.'],
            ['id' => 8, 'name' => 'UNIDAD DE TALENTO HUMANO', 'short_name' => 'RH', 'description' => 'Gestiona los recursos humanos y desarrolla capacidades del personal.'],
            ['id' => 9, 'name' => 'UNIDAD DE TESORERÍA', 'short_name' => 'TES', 'description' => 'Administra el flujo de caja, ingresos y egresos de la municipalidad.'],
            ['id' => 10, 'name' => 'UNIDAD DE CONTABILIDAD', 'short_name' => 'CONTA', 'description' => 'Registra y controla la información contable de la entidad.'],
            ['id' => 11, 'name' => 'UNIDAD DE ABASTECIMIENTO', 'short_name' => 'ABA', 'description' => 'Encargada de compras, almacenamiento y distribución de bienes.'],
            ['id' => 12, 'name' => 'OFICINA DE IMAGEN INSTITUCIONAL', 'short_name' => 'IMAG', 'description' => 'Maneja la comunicación y proyección institucional.'],
            ['id' => 13, 'name' => 'UNIDAD DE CATASTRO', 'short_name' => 'CAT', 'description' => 'Administra la información física y legal de los predios del distrito.'],
            ['id' => 14, 'name' => 'UNIDAD DE DEMUNA', 'short_name' => 'DEMUNA', 'description' => 'Defiende y promueve los derechos de los niños y adolescentes.'],
            ['id' => 15, 'name' => 'UNIDAD DE SISFOH', 'short_name' => 'SISFOH', 'description' => 'Administra la clasificación socioeconómica de los hogares.'],
            ['id' => 16, 'name' => 'SUBGERENCIA DE SERVICIOS MUNICIPALES Y AMBIENTALES', 'short_name' => 'SERVMUN', 'description' => 'Gestiona limpieza, áreas verdes, residuos y ornato.'],
            ['id' => 17, 'name' => 'SUBGERENCIA DE DESARROLLO HUMANO Y SOCIAL', 'short_name' => 'DESHUM', 'description' => 'Promueve programas sociales, culturales y educativos.'],
            ['id' => 18, 'name' => 'SUBGERENCIA DE DESARROLLO ECONÓMICO Y SANEAMIENTO', 'short_name' => 'DESECO', 'description' => 'Impulsa la actividad económica local y el saneamiento básico.'],
            ['id' => 19, 'name' => 'SUBGERENCIA DE PLANEAMIENTO URBANO Y RURAL', 'short_name' => 'URBPLAN', 'description' => 'Planifica el crecimiento urbano y rural del distrito.'],
            ['id' => 20, 'name' => 'SUBGERENCIA DE EJECUCIÓN DE INVERSIONES', 'short_name' => 'EJEINV', 'description' => 'Supervisa la ejecución de proyectos de inversión pública.'],
            ['id' => 21, 'name' => 'SUBGERENCIA DE INVERSIONES Y ESTUDIOS', 'short_name' => 'ESTINV', 'description' => 'Elabora estudios técnicos y proyectos de inversión pública.'],
            ['id' => 22, 'name' => 'GERENCIA DE GESTIÓN TRIBUTARIA', 'short_name' => 'GESTTRIB', 'description' => 'Recauda y fiscaliza los tributos municipales.'],
            ['id' => 23, 'name' => 'GERENCIA DE DESARROLLO TERRITORIAL', 'short_name' => 'GESTTERR', 'description' => 'Coordina proyectos de ordenamiento y uso del territorio.'],
            ['id' => 24, 'name' => 'GERENCIA DE DESARROLLO SOSTENIBLE', 'short_name' => 'GESTSOST', 'description' => 'Promueve políticas de sostenibilidad y gestión ambiental.'],
            ['id' => 25, 'name' => 'OFICINA SIN NOMBRE', 'short_name' => 'OSN', 'description' => 'Dependencia sin denominación específica registrada.'],
            ['id' => 26, 'name' => 'OFICINA DE ASUNTOS DESCONOCIDOS', 'short_name' => 'ODAD', 'description' => 'Área genérica utilizada para registros provisionales.'],
            ['id' => 27, 'name' => 'OFICINA DE INNOVACIÓN', 'short_name' => 'OIN', 'description' => 'Promueve la mejora continua e innovación institucional.'],
        ];

        foreach ($offices as $office) {
            Office::firstOrCreate(
                ['id' => $office['id']], // Clave única para buscar
                [
                    'name' => $office['name'],
                    'short_name' => $office['short_name'],
                    'description' => $office['description'],
                ]
            );
        }
    }
}