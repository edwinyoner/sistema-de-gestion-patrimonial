@extends('layouts.main')

{{-- Personalización de secciones del layout --}}
@section('subtitle', 'Detalle del Tipo de Activo')
@section('content_header_title', 'Tipo de Activo')
@section('content_header_subtitle', 'Detalles del Tipo de Activo')

{{-- Cuerpo principal --}}
@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <x-adminlte-card title="Información del Tipo de Activo" theme="info" icon="fas fa-briefcase">

                <div class="mb-3">
                    <strong>ID:</strong>
                    <span class="text-muted">{{ $assetType->id }}</span>
                </div>

                <div class="mb-3">
                    <strong>Nombre del Tipo de Activo:</strong>
                    <span class="text-muted">{{ $assetType->name }}</span>
                </div>

                <div class="mb-3">
                    <strong>Descripción:</strong>
                    <span class="text-muted">{{ $assetType->description ?? 'Sin descripción disponible' }}</span>
                </div>

                <div class="mb-3">
                    <strong>Estado:</strong>
                    <span class="badge {{ $assetType->status ? 'badge-success' : 'badge-danger' }}">
                        {{ $assetType->status ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>

                {{-- Botones de regreso y edición con disposición ajustada --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('asset_types.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    @can('actualizar tipos de activos')
                        <a href="{{ route('asset_types.edit', $assetType->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    @endcan
                </div>

            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

{{-- Estilos opcionales --}}
@push('css')
@endpush

{{-- Scripts opcionales --}}
@push('js')
@endpush