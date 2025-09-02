<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan make:model ContractType  -m -c -r 
     */
    public function up()
    {
        Schema::create('contract_types', function (Blueprint $table) {
            $table->id()->comment('Identificador único del tipo de contrato');
            $table->string('name', 50)->unique()->comment('Nombre del tipo de contrato, debe ser único');
            $table->text('description')->nullable()->comment('Descripción opcional del tipo de contrato');
            $table->boolean('status')->default(true)->comment('Estado del tipo de contrato: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_types');
    }
};
