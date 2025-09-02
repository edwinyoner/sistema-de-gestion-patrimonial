@extends('layouts.main')

@section('subtitle', 'Detalle del Tipo de Contrato')
@section('content_header_title', 'Tipos de Contrato')
@section('content_header_subtitle', 'Detalles del Tipo de Contrato')

@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <x-adminlte-card title="Información del Tipo de Contrato" theme="info" icon="fas fa-file-signature">

                <div class="mb-3">
                    <strong>ID:</strong>
                    <span class="text-muted">{{ $contractType->id }}</span>
                </div>

                <div class="mb-3">
                    <strong>Nombre del Tipo de Contrato:</strong>
                    <span class="text-muted">{{ $contractType->name }}</span>
                </div>

                <div class="mb-3">
                    <strong>Descripción:</strong>
                    <span class="text-muted">{{ $contractType->description ?? 'Sin descripción disponible' }}</span>
                </div>

                <div class="mb-3">
                    <strong>Estado:</strong>
                    <span class="badge {{ $contractType->status ? 'badge-success' : 'badge-danger' }}">
                        {{ $contractType->status ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>

                <!-- Botones de regreso y edición con disposición ajustada -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('contract_types.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('contract_types.edit', $contractType->id) }}" class="btn btn-sm btn-primary">
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