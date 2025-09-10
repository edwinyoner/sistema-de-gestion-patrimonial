<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetType; // Importa el modelo (crea este modelo si no existe)

class AssetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assetTypes = [
            ['id' => 1, 'name' => 'HARDWARE', 'description' => 'Laptops, CPUs, monitores, teclados, mouse, impresoras, escáneres.'],
            ['id' => 2, 'name' => 'SOFTWARE', 'description' => 'Windows 10, Microsoft Office, Adobe Photoshop, AutoCAD, Visual Studio Code, IntelliJ IDEA, Kaspersky, ESET, LibreOffice, SPSS, Matlab.'],
            ['id' => 3, 'name' => 'MOBILIARIOS', 'description' => 'Sillas, escritorios, estantes, mesas, vitrinas, etc.'],
            ['id' => 4, 'name' => 'MAQUINARÍAS', 'description' => 'Autos, camionetas, motos, volquetes, maquinaria pesada, etc.'],
            ['id' => 5, 'name' => 'HERRAMIENTAS', 'description' => 'Taladros, llaves inglesas, destornilladores, martillos, alicates, sierras, pinzas, niveles, llaves de tubo, cintas métricas.'],
            ['id' => 6, 'name' => 'OTROS', 'description' => 'Electrodomésticos u otros activos no clasificados, como microondas, refrigeradoras, ventiladores, cocinas eléctricas, termos, entre otros.'],
        ];

        foreach ($assetTypes as $assetType) {
            AssetType::firstOrCreate(
                ['id' => $assetType['id']], // Clave única para buscar
                [
                    'name' => $assetType['name'],
                    'description' => $assetType['description'],
                ]
            );
        }
    }
}