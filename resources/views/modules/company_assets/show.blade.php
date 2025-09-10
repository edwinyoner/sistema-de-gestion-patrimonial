@extends('layouts.main')

@section('subtitle', 'Detalles del Activo')
@section('content_header_title', 'Activos')
@section('content_header_subtitle', 'Ver detalles del activo')

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
        <div class="col-md-12 col-lg-10">
            <x-adminlte-card title="Detalles del Activo" theme="info" icon="fas fa-eye" collapsible>
                <div class="row">
                    <!-- Fila 1: Oficina / Área, Responsable y Usuario Final -->
                    <div class="col-md-4">
                        <strong>Oficina / Área:</strong> {{ $companyAsset->office->name ?? 'No asignada' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Responsable:</strong> {{ $companyAsset->responsibleUser ? "{$companyAsset->responsibleUser->first_name} {$companyAsset->responsibleUser->last_name_paternal} {$companyAsset->responsibleUser->last_name_maternal}" : 'No asignado' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Usuario Final:</strong> {{ $companyAsset->finalUser ? "{$companyAsset->finalUser->first_name} {$companyAsset->finalUser->last_name_paternal} {$companyAsset->finalUser->last_name_maternal}" : 'No asignado' }}
                    </div>

                    <!-- Fila 2: Tipo de Activo, Código Patrimonial, Estado del Activo -->
                    <div class="col-md-4">
                        <strong>Tipo de Activo:</strong> {{ $companyAsset->assetType->name ?? 'No definido' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Código Patrimonial:</strong> {{ $companyAsset->patrimonial_code ?? 'No asignado' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Estado del Activo:</strong> {{ $companyAsset->assetState->name ?? 'No definido' }}
                    </div>

                    <!-- Fila 3: Fechas y Foto -->
                    <div class="col-md-4">
                        <strong>Fecha de Adquisición:</strong> {{ $companyAsset->acquisition_date ? $companyAsset->acquisition_date->format('d/m/Y') : 'No definida' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Fecha de Inventario:</strong> {{ $companyAsset->inventory_date ? $companyAsset->inventory_date->format('d/m/Y') : 'No definida' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Foto:</strong>
                        @if ($companyAsset->photo_path)
                            <img src="{{ $companyAsset->photo_path }}" alt="Foto del activo" style="max-width: 150px; max-height: 150px;">
                        @else
                            No disponible
                        @endif
                    </div>
                </div>

                <hr class="">

                <!-- Detalles específicos según el tipo de activo -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h5>Detalles Específicos</h5>
                        @if ($companyAsset->assetType)
                            @php
                                $typeMap = [
                                    'HARDWARE' => 'hardware',
                                    'SOFTWARE' => 'software',
                                    'MOBILIARIOS' => 'furniture',
                                    'MAQUINARÍAS' => 'machinery',
                                    'HERRAMIENTAS' => 'tool',
                                    'OTROS' => 'other',
                                ];
                                $relationName = $typeMap[$companyAsset->assetType->name] ?? null;
                            @endphp
                            @if ($relationName && $companyAsset->$relationName)
                                @switch($companyAsset->assetType->name)
                                    @case('HARDWARE')
                                        <div class="card">
                                            <div class="card-body">
                                                <p><strong>Nombre:</strong> {{ $companyAsset->hardware->hardware_name ?? 'No especificado' }}</p>
                                                <p><strong>Marca:</strong> {{ $companyAsset->hardware->brand ?? 'No especificado' }}</p>
                                                <p><strong>Modelo:</strong> {{ $companyAsset->hardware->model ?? 'No especificado' }}</p>
                                                <p><strong>Color:</strong> {{ $companyAsset->hardware->color ?? 'No especificado' }}</p>
                                                <p><strong>Número de Serie:</strong> {{ $companyAsset->hardware->serial_number ?? 'No especificado' }}</p>
                                                <p><strong>Descripción:</strong> {{ $companyAsset->hardware->description ?? 'No especificado' }}</p>
                                                <p><strong>Estado:</strong> {{ $companyAsset->hardware->status ? 'Activo' : 'Inactivo' }}</p>
                                            </div>
                                        </div>
                                        @break

                                    @case('SOFTWARE')
                                        <div class="card">
                                            <div class="card-body">
                                                <p><strong>Tipo de Software:</strong> {{ $companyAsset->software->softwareType->name ?? 'No especificado' }}</p>
                                                <p><strong>Nombre:</strong> {{ $companyAsset->software->software_name ?? 'No especificado' }}</p>
                                                <p><strong>Versión:</strong> {{ $companyAsset->software->version ?? 'No especificado' }}</p>
                                                <p><strong>Clave de Licencia:</strong> {{ $companyAsset->software->license_key ?? 'No especificado' }}</p>
                                                <p><strong>Fecha de Expiración:</strong> {{ $companyAsset->software->license_expiry ? $companyAsset->software->license_expiry->format('d/m/Y') : 'No especificado' }}</p>
                                                <p><strong>Descripción:</strong> {{ $companyAsset->software->description ?? 'No especificado' }}</p>
                                                <p><strong>Estado:</strong> {{ $companyAsset->software->status ? 'Activo' : 'Inactivo' }}</p>
                                            </div>
                                        </div>
                                        @break

                                    @case('MOBILIARIOS')
                                        <div class="card">
                                            <div class="card-body">
                                                <p><strong>Nombre:</strong> {{ $companyAsset->furniture->furniture_name ?? 'No especificado' }}</p>
                                                <p><strong>Marca:</strong> {{ $companyAsset->furniture->brand ?? 'No especificado' }}</p>
                                                <p><strong>Modelo:</strong> {{ $companyAsset->furniture->model ?? 'No especificado' }}</p>
                                                <p><strong>Color:</strong> {{ $companyAsset->furniture->color ?? 'No especificado' }}</p>
                                                <p><strong>Material:</strong> {{ $companyAsset->furniture->material ?? 'No especificado' }}</p>
                                                <p><strong>Dimensiones:</strong> {{ $companyAsset->furniture->dimensions ?? 'No especificado' }}</p>
                                                <p><strong>Descripción:</strong> {{ $companyAsset->furniture->description ?? 'No especificado' }}</p>
                                                <p><strong>Estado:</strong> {{ $companyAsset->furniture->status ? 'Activo' : 'Inactivo' }}</p>
                                            </div>
                                        </div>
                                        @break

                                    @case('MAQUINARÍAS')
                                        <div class="card">
                                            <div class="card-body">
                                                <p><strong>Nombre:</strong> {{ $companyAsset->machinery->machinerie_name ?? 'No especificado' }}</p>
                                                <p><strong>Marca:</strong> {{ $companyAsset->machinery->brand ?? 'No especificado' }}</p>
                                                <p><strong>Modelo:</strong> {{ $companyAsset->machinery->model ?? 'No especificado' }}</p>
                                                <p><strong>VIN:</strong> {{ $companyAsset->machinery->vin ?? 'No especificado' }}</p>
                                                <p><strong>Número de Motor:</strong> {{ $companyAsset->machinery->engine_number ?? 'No especificado' }}</p>
                                                <p><strong>Número de Serie:</strong> {{ $companyAsset->machinery->serial_number ?? 'No especificado' }}</p>
                                                <p><strong>Año:</strong> {{ $companyAsset->machinery->year ?? 'No especificado' }}</p>
                                                <p><strong>Color:</strong> {{ $companyAsset->machinery->color ?? 'No especificado' }}</p>
                                                <p><strong>Placa:</strong> {{ $companyAsset->machinery->placa ?? 'No especificado' }}</p>
                                                <p><strong>Descripción:</strong> {{ $companyAsset->machinery->description ?? 'No especificado' }}</p>
                                                <p><strong>Estado:</strong> {{ $companyAsset->machinery->status ? 'Activo' : 'Inactivo' }}</p>
                                            </div>
                                        </div>
                                        @break

                                    @case('HERRAMIENTAS')
                                        <div class="card">
                                            <div class="card-body">
                                                <p><strong>Nombre:</strong> {{ $companyAsset->tool->tool_name ?? 'No especificado' }}</p>
                                                <p><strong>Marca:</strong> {{ $companyAsset->tool->brand ?? 'No especificado' }}</p>
                                                <p><strong>Modelo:</strong> {{ $companyAsset->tool->model ?? 'No especificado' }}</p>
                                                <p><strong>Color:</strong> {{ $companyAsset->tool->color ?? 'No especificado' }}</p>
                                                <p><strong>Descripción:</strong> {{ $companyAsset->tool->description ?? 'No especificado' }}</p>
                                                <p><strong>Estado:</strong> {{ $companyAsset->tool->status ? 'Activo' : 'Inactivo' }}</p>
                                            </div>
                                        </div>
                                        @break

                                    @case('OTROS')
                                        <div class="card">
                                            <div class="card-body">
                                                <p><strong>Nombre:</strong> {{ $companyAsset->other->other_name ?? 'No especificado' }}</p>
                                                <p><strong>Marca:</strong> {{ $companyAsset->other->brand ?? 'No especificado' }}</p>
                                                <p><strong>Modelo:</strong> {{ $companyAsset->other->model ?? 'No especificado' }}</p>
                                                <p><strong>Color:</strong> {{ $companyAsset->other->color ?? 'No especificado' }}</p>
                                                <p><strong>Descripción:</strong> {{ $companyAsset->other->description ?? 'No especificado' }}</p>
                                                <p><strong>Estado:</strong> {{ $companyAsset->other->status ? 'Activo' : 'Inactivo' }}</p>
                                            </div>
                                        </div>
                                        @break

                                    @default
                                        <p class="text-warning">No hay detalles específicos disponibles para este tipo de activo.</p>
                                @endswitch
                            @else
                                <p class="text-warning">No hay detalles específicos disponibles para este activo.</p>
                            @endif
                        @else
                            <p class="text-danger">Tipo de activo no definido.</p>
                        @endif
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('company_assets.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                    <a href="{{ route('company_assets.edit', $companyAsset->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit mr-1"></i> Editar
                    </a>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('css')
    <style>
        #success-alert,
        #error-alert {
            transition: opacity 0.5s ease;
            display: block !important;
        }

        #success-alert[style*="display: none"],
        #error-alert[style*="display: none"] {
            opacity: 0;
        }

        .text-danger, .text-warning {
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
        }
    </style>
@endpush