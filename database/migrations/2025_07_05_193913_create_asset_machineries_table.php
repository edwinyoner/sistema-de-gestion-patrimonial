<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asset_machineries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_asset_id')->unique()->constrained('company_assets')->restrictOnDelete()->comment('ID del activo, referencia única a la tabla company_assets');
            $table->string('machinerie_name', 100)->notNull()->comment('Nombre detallado del vehículo o maquinaria, obligatorio');
            $table->string('brand', 50)->notNull()->comment('Marca del vehículo o maquinaria');
            $table->string('model', 50)->notNull()->comment('Modelo del vehículo o maquinaria');
            $table->string('vin', 17)->notNull()->comment('Número de identificación (chasis) del vehículo o maquinaria');
            $table->string('engine_number', 10)->notNull()->comment('Número de motor del vehículo o maquinaria');
            $table->string('serial_number', 17)->notNull()->comment('Número de serie del vehículo o maquinaria');
            $table->string('year', 4)->notNull()->comment('Año de fabricación del vehículo o maquinaria');
            $table->string('color', 50)->notNull()->comment('Color del vehículo o maquinaria');
            $table->string('placa', 6)->nullable()->comment('Placa o matrícula del vehículo');
            $table->text('description')->nullable()->comment('Descripción detallada, incluyendo kilometraje o caballos de fuerza');
            $table->boolean('status')->default(true)->comment('Estado del vehículo o maquinaria: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->timestamps();
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_machineries');
    }
};