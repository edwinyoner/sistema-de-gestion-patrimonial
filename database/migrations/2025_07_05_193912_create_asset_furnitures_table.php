<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_furnitures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_asset_id')->unique()->constrained('company_assets')->cascadeOnDelete()->comment('ID del activo de la empresa, referencia única a la tabla company_assets');
            $table->string('furniture_name', 100)->notNull()->comment('Nombre detallado del mobiliario, obligatorio');
            $table->string('brand', 50)->nullable()->comment('Marca del mobiliario');
            $table->string('model', 50)->nullable()->comment('Modelo del mobiliario');
            $table->string('color', 50)->nullable()->comment('Color del mobiliario');
            $table->string('material', 50)->nullable()->comment('Material del mobiliario, ej. madera, metal');
            $table->string('dimensions', 50)->nullable()->comment('Dimensiones del mobiliario, ej. 120x60x80 cm');
            $table->text('description')->nullable()->comment('Descripción detallada del mobiliario, incluyendo atributos específicos');
            $table->boolean('status')->default(true)->comment('Estado del mobiliario: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->timestamps();
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_furnitures');
    }
};