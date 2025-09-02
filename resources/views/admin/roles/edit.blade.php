@extends('layouts.main')

@section('subtitle', 'Editar Rol')
@section('content_header_title', 'Roles')
@section('content_header_subtitle', 'Editar información del rol')

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

    @if (session('error'))
        <x-adminlte-alert theme="danger" id="error-alert" title="Error" dismissable>
            {{ session('error') }}
        </x-adminlte-alert>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-adminlte-card title="Editar Rol" theme="warning" icon="fas fa-users-cog">
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <x-adminlte-input
                        name="name"
                        label="Nombre del Rol"
                        placeholder="Ej. Desarrollador del Sistema"
                        label-class="text-lightblue"
                        value="{{ old('name', $role->name) }}"
                        required
                        class="uppercase-input">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-warning">
                                <i class="fas fa-user-tag text-white"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <div class="form-group">
                        <label class="text-lightblue">Asignar Permisos</label>
                        <div class="row">
                            @php
                                $permissionsCount = $permissions->count();
                                $chunkSize = ceil($permissionsCount / 3);
                                $permissionChunks = $permissions->chunk($chunkSize);
                            @endphp
                            @foreach ($permissionChunks as $index => $chunk)
                                <div class="col-md-4">
                                    @foreach ($chunk as $permission)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   name="permissions[]"
                                                   id="permission_{{ $permission->id }}"
                                                   value="{{ $permission->name }}"
                                                   {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                   class="custom-control-input">
                                            <label class="custom-control-label" for="permission_{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>
                        <x-adminlte-button
                            class="btn-sm"
                            type="submit"
                            label="Actualizar"
                            theme="warning"
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
        #error-alert { transition: opacity 0.5s ease; }
        #error-alert[style*="display: none"] { opacity: 0; }
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

            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(() => { errorAlert.style.display = 'none'; }, 10000);
            }
        });
    </script>
@endpush