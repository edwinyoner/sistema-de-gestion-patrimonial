@extends('layouts.main')

@section('subtitle', 'Detalle del Estado de Activo')
@section('content_header_title', 'Estado de Activo')
@section('content_header_subtitle', 'Detalles del Estado de Activo')

@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <x-adminlte-card title="Información del Estado de Activo" theme="info" icon="fas fa-briefcase">

                <div class="mb-3">
                    <strong>ID:</strong>
                    <span class="text-muted">{{ $assetState->id }}</span>
                </div>

                <div class="mb-3">
                    <strong>Nombre del Estado de Activo:</strong>
                    <span class="text-muted">{{ $assetState->name }}</span>
                </div>

                <div class="mb-3">
                    <strong>Descripción:</strong>
                    <span class="text-muted">{{ $assetState->description ?? 'Sin descripción disponible' }}</span>
                </div>

                <div class="mb-3">
                    <strong>Estado:</strong>
                    <span class="badge {{ $assetState->status ? 'badge-success' : 'badge-danger' }}">
                        {{ $assetState->status ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>

                <!-- Botones de regreso y edición con disposición ajustada -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('asset_states.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    @can('actualizar estados de activos')
                        <a href="{{ route('asset_states.edit', $assetState->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    @endcan
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