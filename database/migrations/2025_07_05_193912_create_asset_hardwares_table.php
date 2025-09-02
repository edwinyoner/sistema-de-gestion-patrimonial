<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_hardwares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_asset_id')->constrained('company_assets')->restrictOnDelete()->comment('ID del activo, referencia a la tabla company_assets');
            $table->string('hardware_name', 100)->notNull()->comment('Nombre detallado del hardware, obligatorio');
            $table->string('brand', 50)->nullable()->comment('Marca del hardware');
            $table->string('model', 50)->nullable()->comment('Modelo del hardware');
            $table->string('color', 50)->nullable()->comment('Color del hardware');
            $table->string('serial_number', 30)->nullable()->comment('Número de serie del hardware');
            $table->text('description')->nullable()->comment('Descripción detallada del hardware, incluyendo atributos específicos como procesador, memoria, puertos, o capacidad para equipos IT');
            $table->boolean('status')->default(true)->comment('Estado del hardware: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->timestamps();
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_hardwares');
    }
};
