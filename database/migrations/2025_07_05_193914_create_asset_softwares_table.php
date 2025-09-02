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
        Schema::create('asset_softwares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_asset_id')->unique()->constrained('company_assets')->restrictOnDelete()->comment('ID del activo, referencia a la tabla company_assets');
            $table->foreignId('software_type_id')->constrained('software_types')->restrictOnDelete()->comment('ID del tipo de software, referencia a la tabla software_types');
            $table->string('software_name', 100)->notNull()->comment('Nombre detallado del software, obligatorio');
            $table->string('version', 25)->nullable()->comment('Versión del software');
            $table->string('license_key', 255)->nullable()->comment('Clave de licencia del software');
            $table->date('license_expiry')->nullable()->comment('Fecha de expiración de la licencia');
            $table->text('description')->nullable()->comment('Descripción detallada del software, incluyendo notas adicionales');
            $table->boolean('status')->default(true)->comment('Estado del software: true (activo), false (inactivo)');
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
        Schema::dropIfExists('asset_softwares');
    }
};
