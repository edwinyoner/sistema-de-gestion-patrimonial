@extends('layouts.main')

@section('subtitle', 'Perfil de Usuario')
@section('content_header_title', 'Perfil')
@section('content_header_subtitle', 'Ver información del Perfil')

@section('content_body')


<div class="container">
    <!-- Actualizar información del perfil -->
    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Actualizar Información de Perfil" icon="fas fa-user-edit">
            @livewire('profile.update-profile-information-form')
        </x-adminlte-card>
    @endif

    <!-- Cambiar contraseña -->
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Actualizar Contraseña" class="mt-4" icon="fas fa-lock">
            @livewire('profile.update-password-form')
        </x-adminlte-card>
    @endif

    <!-- Autenticación de dos factores -->
    {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Autenticación en Dos Factores"
            class="mt-4" icon="fas fa-shield-alt">
            @livewire('profile.two-factor-authentication-form')
        </x-adminlte-card>
    @endif --}}

    <!-- Cerrar sesiones en otros navegadores -->
    <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white"
        title="Cerrar Sesiones en Otros Navegadores" class="mt-4" icon="fas fa-sign-out-alt">
        @livewire('profile.logout-other-browser-sessions-form')
    </x-adminlte-card>

    <!-- Eliminación de cuenta -->
    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <x-adminlte-card theme="danger" header-class="bg-gradient-danger text-white" title="Eliminar Cuenta" class="mt-4" icon="fas fa-trash">
            @livewire('profile.delete-user-form')
        </x-adminlte-card>
    @endif

</div>

@stop

@push('css')
@endpush

@push('js')
@endpush