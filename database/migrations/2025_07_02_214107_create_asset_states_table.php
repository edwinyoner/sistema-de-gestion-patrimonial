<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan make:model AssetState -m -c -r
     */
    public function up()
    {
        Schema::create('asset_states', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25)->unique()->comment('Nombre del estado del activo, debe ser único');
            $table->text('description')->nullable()->comment('Descripción opcional del estado del activo');
            $table->boolean('status')->default(true)->comment('Estado del tipo de activo: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_states');
    }
};

