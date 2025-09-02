@extends('layouts.main')

@section('subtitle', 'Crear Rol')
@section('content_header_title', 'Roles')
@section('content_header_subtitle', 'Crear un nuevo rol')

@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    @if (session('success'))
        <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    @if ($errors->any())
        <x-adminlte-alert theme="danger" id="error-alert" title="Errores" dismissable>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <x-adminlte-card title="Crear Nuevo Rol" theme="info" icon="fas fa-users-cog" collapsible>
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <x-adminlte-input
                        name="name"
                        label="Nombre del Rol"
                        placeholder="Ej. Desarrollador del Sistema"
                        label-class="text-lightblue"
                        value="{{ old('name') }}"
                        required
                        class="uppercase-input">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-user-tag text-white"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>
                        <x-adminlte-button
                            class="btn-sm"
                            type="submit"
                            label="Guardar"
                            theme="success"
                            icon="fas fa-save" />
                    </div>
                </form>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('css')
    <style>
        #success-alert { transition: opacity 0.5s ease; }
        #success-alert[style*="display: none"] { opacity: 0; }
        .uppercase-input { text-transform: uppercase; }
    </style>
@endpush

@push('js')
    <script>
        document.querySelectorAll('.uppercase-input').forEach(input => {
            input.addEventListener('input', function(e) {
                this.value = this.value.toUpperCase();
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => { successAlert.style.display = 'none'; }, 3000);
            }
        });
    </script>
@endpush