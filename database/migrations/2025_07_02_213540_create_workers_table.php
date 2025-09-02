<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan make:model Worker -m -c -r
     */
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8)->unique()->comment('DNI del trabajador, debe ser único');
            $table->string('first_name', 100)->comment('Nombre del trabajador');
            $table->string('last_name_paternal', 50)->comment('Apellido paterno del trabajador');
            $table->string('last_name_maternal', 50)->comment('Apellido materno del trabajador');
            $table->string('email', 50)->unique()->comment('Correo electrónico del trabajador, debe ser único');
            $table->string('phone', 9)->nullable()->comment('Teléfono del trabajador, opcional');
            $table->foreignId('office_id')->constrained('offices')->restrictOnDelete()->comment('ID de la oficina del trabajador, referencia a la tabla offices');
            $table->unsignedBigInteger('job_position_id')->comment('ID del cargo del trabajador');            
            $table->unsignedBigInteger('contract_type_id')->nullable()->comment('ID del tipo de contrato (referencia a contract_types)');
            $table->boolean('status')->default(true)->comment('Estado del trabajador: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->timestamps();

            $table->foreign('job_position_id')->references('id')->on('job_positions')->onDelete('restrict');
            $table->foreign('contract_type_id')->references('id')->on('contract_types')->onDelete('set null');

            // Índices opcionales para mejorar rendimiento
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};