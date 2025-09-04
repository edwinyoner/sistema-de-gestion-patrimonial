<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nombre del usuario');
            $table->string('email')->unique()->comment('Correo electrónico del usuario, debe ser único');
            $table->timestamp('email_verified_at')->nullable()->comment('Marca de tiempo para verificar el correo electrónico, nullable si no está verificado');
            $table->string('password')->comment('Contraseña del usuario, debe ser hasheada');
            $table->rememberToken()->comment('Token para recordar la sesión del usuario');
            $table->foreignId('current_team_id')->nullable()->comment('ID del equipo actual del usuario');
            $table->string('profile_photo_path', 2048)->nullable()->comment('Ruta de la foto de perfil del usuario, nullable si no tiene foto de perfil');
            //$table->boolean('force_password_change')->default(true)->comment('Indica si el usuario debe cambiar la contraseña al primer inicio');
            $table->boolean('status')->default(true)->comment('Estado del usuario: true (activo), false (inactivo)');
            $table->softDeletes()->comment('Fecha de eliminación lógica para soft deletes');
            $table->timestamps();

            // Índices opcionales para mejorar rendimiento
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
