@extends('layouts.main')

@section('subtitle', 'Detalles del Trabajador')
@section('content_header_title', 'Trabajadores')
@section('content_header_subtitle', 'Ver información del trabajador')

@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <x-adminlte-card title="Detalles del Trabajador" theme="primary" icon="fas fa-user">

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-lightblue"><strong>DNI:</strong> {{ $worker->dni }}</p>
                            <p class="text-lightblue"><strong>Nombre:</strong> {{ $worker->first_name }}</p>
                            <p class="text-lightblue"><strong>Apellido Paterno:</strong> {{ $worker->last_name_paternal }}</p>
                            <p class="text-lightblue"><strong>Apellido Materno:</strong> {{ $worker->last_name_maternal }}</p>
                            <p class="text-lightblue"><strong>Correo Electrónico:</strong> {{ $worker->email }}</p>
                            <p class="text-lightblue"><strong>Teléfono:</strong> {{ $worker->phone ?? 'No especificado' }}</p>
                            <p class="text-lightblue"><strong>Oficina:</strong> {{ $worker->office->name ?? 'No asignada' }}</p>
                            <p class="text-lightblue"><strong>Cargo:</strong> {{ $worker->jobPosition->name ?? 'No asignado' }}</p>
                            <p class="text-lightblue"><strong>Tipo de Contrato:</strong> {{ $worker->contractType->name ?? 'No asignado' }}</p>
                            <p class="text-lightblue"><strong>Estado:</strong> 
                                <span class="badge {{ $worker->status ? 'badge-success' : 'badge-danger' }}">
                                    {{ $worker->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- Botones de regreso y edición con disposición ajustada --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('workers.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('workers.edit', $worker->id) }}" class="btn btn-sm btn-primary">
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