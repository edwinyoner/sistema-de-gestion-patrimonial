<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Migración para almacenar detalles de bienes diversos
    public function up(): void
    {
        Schema::create('asset_others', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_asset_id')->unique()->constrained('company_assets')->restrictOnDelete()->comment('ID del activo, referencia a la tabla company_assets');
            $table->string('other_name', 100)->notNull()->comment('Nombre detallado del activo, obligatorio');
            $table->string('brand', 50)->nullable()->comment('Marca del activo');
            $table->string('model', 50)->nullable()->comment('Modelo del activo');
            $table->string('color', 50)->nullable()->comment('Color del activo');
            $table->text('description')->nullable()->comment('Descripción detallada del activo, incluyendo atributos específicos');
            $table->boolean('status')->default(true)->comment('Estado del activo: true (activo), false (inactivo)');
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
        Schema::dropIfExists('asset_others');
    }
};
