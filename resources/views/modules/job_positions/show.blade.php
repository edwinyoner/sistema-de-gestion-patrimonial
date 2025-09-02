@extends('layouts.main')

{{-- Personalización de secciones del layout --}}
@section('subtitle', 'Detalle del Cargo')
@section('content_header_title', 'Cargo')
@section('content_header_subtitle', 'Detalles del Cargo')

{{-- Cuerpo principal --}}
@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <x-adminlte-card title="Información del Cargo" theme="info" icon="fas fa-briefcase">

                <div class="mb-3">
                    <strong>ID:</strong>
                    <span class="text-muted">{{ $jobPosition->id }}</span>
                </div>

                <div class="mb-3">
                    <strong>Nombre del Cargo:</strong>
                    <span class="text-muted">{{ $jobPosition->name }}</span>
                </div>

                <div class="mb-3">
                    <strong>Descripción:</strong>
                    <span class="text-muted">{{ $jobPosition->description ?? 'Sin descripción disponible' }}</span>
                </div>

                <div class="mb-3">
                    <strong>Estado:</strong>
                    <span class="badge {{ $jobPosition->status ? 'badge-success' : 'badge-danger' }}">
                        {{ $jobPosition->status ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>

                {{-- Botones de regreso y edición con disposición ajustada --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('job_positions.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('job_positions.edit', $jobPosition->id) }}" class="btn btn-sm btn-primary">
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