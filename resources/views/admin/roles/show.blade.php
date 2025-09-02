@extends('layouts.main')

{{-- Personalización de secciones del layout --}}
@section('subtitle', 'Detalle del Rol')
@section('content_header_title', 'Rol')
@section('content_header_subtitle', 'Detalles del Rol')

{{-- Cuerpo principal --}}
@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <x-adminlte-card title="Información del Rol" theme="info" icon="fas fa-users-cog">

                <div class="mb-3">
                    <strong>ID:</strong>
                    <span class="text-muted">{{ $role->id }}</span>
                </div>

                <div class="mb-3">
                    <strong>Nombre del Rol:</strong>
                    <span class="text-muted">{{ $role->name }}</span>
                </div>

                <div class="mb-3">
                    <strong>Permisos Asociados:</strong>
                    <div class="mt-2">
                        @forelse ($role->permissions as $permission)
                            <span class="badge badge-info mr-1">{{ $permission->name }}</span>
                        @empty
                            <span class="text-muted">No hay permisos asignados</span>
                        @endforelse
                    </div>
                </div>

                {{-- Botones de regreso y edición con disposición ajustada --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                </div>

            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

{{-- Estilos opcionales --}}
@push('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Scripts opcionales --}}
@push('js')
@endpush