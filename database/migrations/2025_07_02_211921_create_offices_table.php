<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan make:model Office -m -c -r
     */
    public function up(): void
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique()->comment('Nombre de la oficina, debe ser único');
            $table->string('short_name', 10)->unique()->nullable()->comment('Nombre corto o código del área');
            $table->text('description')->nullable()->comment('Descripción opcional del cargo');
            $table->boolean('status')->default(true)->comment('Estado de la oficina: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->timestamps();

            // Índices opcionales para mejorar rendimiento
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
