@extends('layouts.main')

@section('subtitle', 'Detalles del Mobiliario')
@section('content_header_title', 'Activos de Mobiliarios')
@section('content_header_subtitle', 'Ver información del mobiliario')

@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Detalles del Mobiliario {{ $furnitureAsset->furniture_name }}">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Datos Generales</h5>
                        <hr>
                        <p><strong>ID:</strong> {{ $furnitureAsset->companyAsset->id ?? 'No especificado' }}</p>
                        <p><strong>Código Patrimonial:</strong> {{ $furnitureAsset->companyAsset->patrimonial_code ?? 'No especificado' }}</p>
                        <p><strong>Nombre Genérico:</strong> {{ $furnitureAsset->companyAsset->generic_name ?? 'No especificado' }}</p>
                        <p><strong>Oficina:</strong> {{ $furnitureAsset->companyAsset->office->name ?? 'Sin oficina asignada' }}</p>
                        <p><strong>Usuario Final:</strong> {{ $furnitureAsset->companyAsset->finalUser->full_name ?? 'No asignado' }}</p>
                        <p><strong>Responsable:</strong> {{ $furnitureAsset->companyAsset->responsibleUser->full_name ?? 'No asignado' }}</p>
                        <p><strong>Fecha de Adquisición:</strong> {{ $furnitureAsset->companyAsset->acquisition_date ? $furnitureAsset->companyAsset->acquisition_date->format('d/m/Y') : 'Sin fecha' }}</p>
                        <p><strong>Fecha de Inventario:</strong> {{ $furnitureAsset->companyAsset->inventory_date ? $furnitureAsset->companyAsset->inventory_date->format('d/m/Y') : 'Sin fecha' }}</p>
                        <p><strong>Estado del Activo:</strong> {{ $furnitureAsset->companyAsset->assetState->name ?? 'Sin estado asignado' }}</p>
                        <p><strong>Estado:</strong> <span style="color: {{ $furnitureAsset->companyAsset->status ?? false ? 'green' : 'red' }}; font-weight: bold;">{{ $furnitureAsset->companyAsset->status ?? false ? 'Activo' : 'Inactivo' }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <h5>Foto del Mobiliario</h5>
                            <hr>
                            @if ($furnitureAsset->companyAsset->photo_path)
                                <img src="{{ $furnitureAsset->companyAsset->photo_path }}" alt="{{ $furnitureAsset->furniture_name }}" width="200" style="object-fit: cover; border-radius: 5px;">
                            @else
                                <p><em>Sin imagen disponible</em></p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5>Datos Específicos del Mobiliario</h5>
                        <hr>
                        <p><strong>Nombre del Mobiliario:</strong> {{ $furnitureAsset->furniture_name ?? 'No especificado' }}</p>
                        <p><strong>Marca:</strong> {{ $furnitureAsset->brand ?? 'No especificada' }}</p>
                        <p><strong>Modelo:</strong> {{ $furnitureAsset->model ?? 'No especificado' }}</p>
                        <p><strong>Color:</strong> {{ $furnitureAsset->color ?? 'No especificado' }}</p>
                        <p><strong>Material:</strong> {{ $furnitureAsset->material ?? 'No especificado' }}</p>
                        <p><strong>Dimensiones:</strong> {{ $furnitureAsset->dimensions ?? 'No especificadas' }}</p>
                        <p><strong>Descripción:</strong> {{ $furnitureAsset->description ?? 'No especificada' }}</p>
                        <p><strong>Estado Específico:</strong> <span style="color: {{ $furnitureAsset->status ?? false ? 'green' : 'red' }}; font-weight: bold;">{{ $furnitureAsset->status ?? false ? 'Activo' : 'Inactivo' }}</span></p>
                    </div>
                </div>

                <div class="mt-4 text-right">
                    <a href="{{ route('asset_furnitures.index') }}" class="btn btn-sm btn-default">
                        <i class="fas fa-arrow-left mr-2"></i> Volver
                    </a>
                    <a href="{{ route('asset_furnitures.edit', $furnitureAsset->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit mr-2"></i> Editar
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