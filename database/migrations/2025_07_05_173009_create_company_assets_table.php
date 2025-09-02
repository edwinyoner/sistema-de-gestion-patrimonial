<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // php artisan make:model CompanyAsset -m -c -r

    public function up(): void
    {
        Schema::create('company_assets', function (Blueprint $table) {
            $table->id();
            $table->string('patrimonial_code', 10)->unique()->notNull()->comment('Código patrimonial del activo, debe ser único');
            $table->foreignId('office_id')->constrained('offices')->restrictOnDelete()->comment('ID de la oficina del activo, referencia a la tabla offices');
            $table->foreignId('final_user_id')->nullable()->constrained('workers')->onDelete('set null')->comment('ID del usuario final (trabajador), referencia a la tabla workers');
            $table->foreignId('responsible_user_id')->nullable()->constrained('workers')->onDelete('set null')->comment('ID del usuario responsable (jefe), referencia a la tabla workers');
            $table->foreignId('asset_type_id')->constrained('asset_types')->restrictOnDelete()->comment('ID del tipo de activo, referencia a la tabla asset_types');
            $table->foreignId('asset_state_id')->constrained('asset_states')->restrictOnDelete()->comment('ID del estado del activo, referencia a la tabla asset_states');
            $table->date('acquisition_date')->nullable()->comment('Fecha de adquisición del activo');
            $table->date('inventory_date')->notNull()->comment('Fecha del inventario del activo');
            $table->string('photo_path', 255)->nullable()->comment('Ruta de la foto del activo, opcional');
            $table->boolean('status')->default(true)->comment('Estado del activo: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->timestamps();

            // Índices opcionales para mejorar rendimiento
            $table->index('status');
            $table->index('office_id');
            $table->index('patrimonial_code');
            $table->index('asset_type_id');
            $table->index('asset_state_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_assets');
    }
};