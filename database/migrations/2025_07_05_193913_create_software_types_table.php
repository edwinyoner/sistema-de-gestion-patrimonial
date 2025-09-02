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
        Schema::create('software_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->comment('Nombre del tipo de software, debe ser único');
            $table->string('description', 500)->nullable()->comment('Descripción del tipo de software, opcional');
            $table->boolean('status')->default(true)->comment('Estado del activo: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->index('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software_types');
    }
};
