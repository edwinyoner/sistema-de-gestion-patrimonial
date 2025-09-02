@extends('layouts.main')

{{-- Personalización de secciones del layout --}}
@section('subtitle', 'Detalle de la Oficina')
@section('content_header_title', 'Oficina')
@section('content_header_subtitle', 'Detalles de la Oficina')

{{-- Cuerpo principal --}}
@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <x-adminlte-card title="Información de la Oficina" theme="info" icon="fas fa-building">

                <div class="mb-3">
                    <strong>ID:</strong>
                    <span class="text-muted">{{ $office->id }}</span>
                </div>

                <div class="mb-3">
                    <strong>Nombre de la Oficina:</strong>
                    <span class="text-muted">{{ $office->name }}</span>
                </div>

                <div class="mb-3">
                    <strong>Sigla de la Oficina:</strong>
                    <span class="text-muted">{{ $office->short_name }}</span>
                </div>

                <div class="mb-3">
                    <strong>Descripción:</strong>
                    <span class="text-muted">{{ $office->description ?? 'Sin descripción disponible' }}</span>
                </div>

                <div class="mb-3">
                    <strong>Estado:</strong>
                    <span class="badge {{ $office->status ? 'badge-success' : 'badge-danger' }}">
                        {{ $office->status ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>

                {{-- Botones de regreso y edición con disposición ajustada --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('offices.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('offices.edit', $office->id) }}" class="btn btn-sm btn-primary">
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