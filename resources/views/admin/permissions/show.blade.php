@extends('layouts.main')

@section('subtitle', 'Detalle del Permiso')
@section('content_header_title', 'Permiso')
@section('content_header_subtitle', 'Detalles del Permiso')

@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <x-adminlte-card title="Información del Permiso" theme="info" icon="fas fa-shield-alt">
                <div class="mb-3">
                    <strong>ID:</strong>
                    <span class="text-muted">{{ $permission->id }}</span>
                </div>

                <div class="mb-3">
                    <strong>Nombre del Permiso:</strong>
                    <span class="text-muted">{{ $permission->name }}</span>
                </div>

                <div class="mb-3">
                    <strong>Guard Name:</strong>
                    <span class="text-muted">{{ $permission->guard_name ?? 'web' }}</span>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('permissions.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('css')
@endpush

@push('js')
@endpush