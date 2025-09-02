@extends('layouts.main')

@section('subtitle', 'Crear Usuario')
@section('content_header_title', 'Usuarios')
@section('content_header_subtitle', 'Bienvenido a la gestión de usuarios')

@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    {{-- Mensaje de éxito con desaparición automática --}}
    @if (session('success'))
        <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    {{-- Validación de errores --}}
    @if ($errors->any())
        <x-adminlte-alert theme="danger" id="error-alert" title="Errores" dismissable>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    @endif

    {{-- Formulario centrado y estilizado --}}
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <x-adminlte-card title="Crear Nuevo Usuario" theme="info" icon="fas fa-user" collapsible>
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    {{-- Nombre --}}
                    <x-adminlte-input name="name" label="Nombre del Usuario" placeholder="Ej. Juan Pérez"
                        label-class="text-lightblue" value="{{ old('name') }}" required class="uppercase-input">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    {{-- Correo --}}
                    <x-adminlte-input name="email" label="Correo Electrónico" placeholder="Ej. juan@ejemplo.com"
                        label-class="text-lightblue" value="{{ old('email') }}" type="email" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    {{-- Contraseña Inicial (generada automáticamente) --}}
                    <x-adminlte-input name="password" label="Contraseña Inicial" type="text"
                        value="{{ \Illuminate\Support\Str::random(12) }}" readonly label-class="text-lightblue">
                        <small class="text-muted">La contraseña será enviada al usuario y deberá cambiarla al iniciar sesión.</small>
                    </x-adminlte-input>

                    <x-adminlte-select name="role" label="Rol" label-class="text-lightblue" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-users-cog text-white"></i>
                            </div>
                        </x-slot>
                        <option value="" disabled selected>Seleccione un rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </x-adminlte-select>

                    {{-- Botones --}}
                    <div class="d-flex justify-content-between mt-4">
                        {{-- Botón Volver --}}
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>

                        {{-- Botón Guardar --}}
                        <x-adminlte-button class="btn-sm" type="submit" label="Guardar" theme="success"
                            icon="fas fa-save" />
                    </div>
                </form>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

{{-- CSS extra --}}
@push('css')
    <style>
        #success-alert {
            transition: opacity 0.5s ease;
        }

        #success-alert[style*="display: none"] {
            opacity: 0;
        }

        .uppercase-input {
            text-transform: uppercase;
        }
    </style>
@endpush

{{-- JS extra --}}
@push('js')
    <script>
        // Convertir a mayúsculas en tiempo real (solo para nombre)
        document.querySelectorAll('.uppercase-input').forEach(input => {
            input.addEventListener('input', function (e) {
                this.value = this.value.toUpperCase();
            });
        });

        // Cerrar alerta de éxito automáticamente
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000); // 3 segundos
            }
        });
    </script>
@endpush