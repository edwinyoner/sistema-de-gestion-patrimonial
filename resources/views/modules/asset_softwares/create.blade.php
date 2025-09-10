@extends('layouts.main')

@section('subtitle', 'Crear Mobiliario')
@section('content_header_title', 'Activos de la Compañía')
@section('content_header_subtitle', 'Registrar nuevo mobiliario')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

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
        <div class="col-12">
            <x-adminlte-card title="Crear Nuevo Mobiliario" theme="info" icon="fas fa-couch" collapsible>
                <form method="POST" action="{{ route('asset_furnitures.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Campo oculto para asset_type con valor por defecto -->
                    <input type="hidden" name="asset_type" value="furniture">

                    <!-- Fila 1: Oficina / Área, Responsable y Usuario Final -->
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-select name="office_id" label="Oficina / Área" label-class="text-lightblue"
                                required id="office_id" onchange="loadWorkersByOffice()">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-building text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="">Seleccione una oficina</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                        {{ $office->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-select name="responsible_user_id" label="Responsable"
                                label-class="text-lightblue" id="responsible_user_id">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-user-shield text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="">Seleccione un responsable</option>
                            </x-adminlte-select>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-select name="final_user_id" label="Usuario Final" label-class="text-lightblue"
                                id="final_user_id">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="">Seleccione un usuario</option>
                            </x-adminlte-select>
                        </div>
                    </div>

                    <!-- Fila 2: Código Patrimonial, Nombre Genérico y Estado del Activo -->
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input name="patrimonial_code" label="Código Patrimonial"
                                placeholder="Ej. A123456" label-class="text-lightblue"
                                value="{{ old('patrimonial_code') }}" required maxlength="10">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-barcode text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="generic_name" label="Nombre Genérico" placeholder="Ej. Mesa"
                                label-class="text-lightblue" value="{{ old('generic_name') }}" required
                                class="auto-uppercase">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-tag text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-select name="asset_state_id" label="Estado del Activo"
                                label-class="text-lightblue" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-info-circle text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="">Seleccione un estado</option>
                                @foreach ($assetStates as $state)
                                    <option value="{{ $state->id }}" {{ old('asset_state_id') == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>

                    <!-- Fila 3: Fecha de Adquisición, Fecha de Inventario y Foto -->
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input name="acquisition_date" label="Fecha de Adquisición" type="date"
                                label-class="text-lightblue" value="{{ old('acquisition_date') }}" nullable>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-calendar text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="inventory_date" label="Fecha de Inventario" type="date"
                                label-class="text-lightblue" value="{{ old('inventory_date') }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-calendar-check text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="photo_path" label="Foto" type="file" label-class="text-lightblue"
                                value="{{ old('photo_path') }}" nullable>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-image text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <!-- Fila 4: Nombre del Mobiliario, Marca y Modelo -->
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input name="furniture_name" label="Nombre del Mobiliario"
                                placeholder="Ej. Mesa Ejecutiva" label-class="text-lightblue"
                                value="{{ old('furniture_name') }}" required class="auto-uppercase">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-signature text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="brand" label="Marca" placeholder="Ej. IKEA"
                                label-class="text-lightblue" value="{{ old('brand') }}" nullable>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-trademark text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="model" label="Modelo" placeholder="Ej. Modelo 2023"
                                label-class="text-lightblue" value="{{ old('model') }}" nullable>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-cogs text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <!-- Fila 5: Color, Material y Dimensiones -->
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input name="color" label="Color" placeholder="Ej. Negro"
                                label-class="text-lightblue" value="{{ old('color') }}" nullable>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-paint-brush text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="material" label="Material" placeholder="Ej. Madera"
                                label-class="text-lightblue" value="{{ old('material') }}" nullable>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-leaf text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="dimensions" label="Dimensiones" placeholder="Ej. 120x60x80 cm"
                                label-class="text-lightblue" value="{{ old('dimensions') }}" nullable>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-ruler text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <!-- Fila 6: Descripción -->
                    <div class="row">
                        <div class="col-md-12">
                            <x-adminlte-textarea name="description" label="Descripción"
                                placeholder="Detalles del mobiliario..." label-class="text-lightblue"
                                value="{{ old('description') }}" nullable rows="5">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-info text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-textarea>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('asset_furnitures.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left mr-1"></i> Volver
                                </a>
                                <x-adminlte-button class="btn-sm" type="submit" label="Guardar" theme="success"
                                    icon="fas fa-save" />
                            </div>
                        </div>
                    </div>
                </form>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('css')
    <style>
        #success-alert {
            transition: opacity 0.5s ease;
        }

        #success-alert[style*="display: none"] {
            opacity: 0;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000);
            }

            function loadWorkersByOffice() {
                const officeId = document.getElementById('office_id').value;
                if (officeId) {
                    $.ajax({
                        url: `/company-assets/workers/${officeId}`, // Ajuste de ruta
                        method: 'GET',
                        success: function (response) {
                            const responsibleUserSelect = document.getElementById('responsible_user_id');
                            const finalUserSelect = document.getElementById('final_user_id');

                            responsibleUserSelect.innerHTML = '<option value="">Seleccione un responsable</option>';
                            finalUserSelect.innerHTML = '<option value="">Seleccione un usuario</option>';

                            response.forEach(worker => {
                                const option = document.createElement('option');
                                option.value = worker.id;
                                option.text = worker.full_name || `${worker.first_name} ${worker.last_name_paternal} ${worker.last_name_maternal || ''}`;
                                responsibleUserSelect.appendChild(option.cloneNode(true));
                                finalUserSelect.appendChild(option.cloneNode(true));
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Error al cargar trabajadores:', error);
                        }
                    });
                } else {
                    document.getElementById('responsible_user_id').innerHTML = '<option value="">Seleccione un responsable</option>';
                    document.getElementById('final_user_id').innerHTML = '<option value="">Seleccione un usuario</option>';
                }
            }

            // Carga inicial si hay un valor preseleccionado
            document.getElementById('office_id').addEventListener('change', loadWorkersByOffice);
            loadWorkersByOffice(); // Carga al iniciar si hay un valor old para office_id
        });
    </script>
@endpush