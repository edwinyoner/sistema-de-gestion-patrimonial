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
        Schema::create('asset_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_asset_id')->unique()->constrained('company_assets')->cascadeOnDelete()->comment('ID del activo, referencia a la tabla company_assets');
            $table->string('tool_name', 100)->notNull()->comment('Nombre detallado de la herramienta, obligatorio');
            $table->string('brand', 50)->nullable()->comment('Marca de la herramienta');
            $table->string('model', 50)->nullable()->comment('Modelo de la herramienta');
            $table->string('color', 50)->nullable()->comment('Color de la herramienta');
            $table->text('description')->nullable()->comment('Descripción detallada de la herramienta, incluyendo atributos específicos como tipo, uso, o características técnicas');
            $table->boolean('status')->default(true)->comment('Estado de la herramienta: true (activo), false (inactivo)');
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
        Schema::dropIfExists('asset_tools');
    }
};
