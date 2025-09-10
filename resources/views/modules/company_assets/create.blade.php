@extends('layouts.main')

@section('subtitle', 'Crear Activo')
@section('content_header_title', 'Activos')
@section('content_header_subtitle', 'Registrar nuevo activo')

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
        <div class="col-md-12 col-lg-10">
            <x-adminlte-card title="Crear Nuevo Activo" theme="info" icon="fas fa-plus" collapsible>
                <form method="POST" action="{{ route('company_assets.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Fila 1: Oficina / Área, Responsable y Usuario Final -->
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-select name="office_id" label="Oficina / Área" label-class="text-lightblue"
                                required id="office_id">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-building text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="" selected disabled>Seleccione una oficina</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                        {{ $office->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            @error('office_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-select name="responsible_user_id" label="Responsable"
                                label-class="text-lightblue" id="responsible_user_id">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-user-shield text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="" selected disabled>Seleccione un responsable</option>
                                @foreach ($workers as $worker)
                                    <option value="{{ $worker->id }}" {{ old('responsible_user_id') == $worker->id ? 'selected' : '' }}>
                                        {{ $worker->full_name ?? "{$worker->first_name} {$worker->last_name_paternal} {$worker->last_name_maternal}" }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            @error('responsible_user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-select name="final_user_id" label="Usuario Final" label-class="text-lightblue"
                                id="final_user_id">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="" selected disabled>Seleccione un usuario</option>
                                @foreach ($workers as $worker)
                                    <option value="{{ $worker->id }}" {{ old('final_user_id') == $worker->id ? 'selected' : '' }}>
                                        {{ $worker->full_name ?? "{$worker->first_name} {$worker->last_name_paternal} {$worker->last_name_maternal}" }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            @error('final_user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Fila 2: Tipo de Activo, Código Patrimonial, Estado del Activo -->
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-select name="asset_type_id" label="Tipo de Activo" label-class="text-lightblue"
                                required id="asset_type_id">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-list text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="" selected disabled>Seleccione un tipo</option>
                                @foreach ($assetTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('asset_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            @error('asset_type_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="patrimonial_code" label="Código Patrimonial"
                                placeholder="Ej. A123456" label-class="text-lightblue"
                                value="{{ old('patrimonial_code') }}" required maxlength="10" id="patrimonial_code"
                                class="auto-uppercase">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-barcode text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('patrimonial_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-select name="asset_state_id" label="Estado del Activo"
                                label-class="text-lightblue" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-info-circle text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="" selected disabled>Seleccione un estado</option>
                                @foreach ($assetStates as $state)
                                <option value="{{ $state->id }}" {{ old('asset_state_id')==$state->id ? 'selected' : ''
                                    }}>
                                    {{ $state->name }}
                                </option>
                                @endforeach
                            </x-adminlte-select>
                            @error('asset_state_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        

                    </div>

                    <!-- Fila 3: Fecha de Adquisición, Fecha de Inventario, Foto -->
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input name="acquisition_date" label="Fecha de Adquisición" type="date"
                                label-class="text-lightblue" value="{{ old('acquisition_date') }}"
                                id="acquisition_date">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-calendar text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('acquisition_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="inventory_date" label="Fecha de Inventario" type="date"
                                label-class="text-lightblue" value="{{ old('inventory_date') }}" id="inventory_date">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-calendar-check text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('inventory_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="photo_path" label="Foto" type="file" label-class="text-lightblue"
                                value="{{ old('photo_path') }}" nullable id="photo_path">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-image text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            @error('photo_path')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <hr class="">

                    <!-- Campos específicos (renderizados dinámicamente con partials) -->
                    <div class="row mt-4">
                        <div class="col-12" id="specific-fields">
                            <div class="default-message" style="display: block;">
                                <p class="text-warning">Seleccione un tipo de activo para ver los campos específicos.
                                </p>
                            </div>
                            @php
                                $typeMap = [
                                    'HARDWARE' => '_hardware',
                                    'SOFTWARE' => '_software',
                                    'MOBILIARIOS' => '_furniture',
                                    'MAQUINARÍAS' => '_machinery',
                                    'HERRAMIENTAS' => '_tool',
                                    'OTROS' => '_other',
                                ];
                            @endphp
                            @foreach ($assetTypes as $type)
                                <div id="form-{{ $type->id }}" class="specific-form" style="display: none;">
                                    @if (isset($typeMap[$type->name]))
                                        @include('modules.company_assets.partials.' . $typeMap[$type->name])
                                    @else
                                        <p class="text-danger">Partial no definido para {{ $type->name }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('company_assets.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>
                        <x-adminlte-button class="btn-sm" type="submit" label="Guardar" theme="success"
                            icon="fas fa-save" />
                    </div>
                </form>
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
            /* Asegurar que se muestre */
        }

        #success-alert[style*="display: none"],
        #error-alert[style*="display: none"] {
            opacity: 0;
        }

        .text-danger {
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const successAlert = $('#success-alert');
            const errorAlert = $('#error-alert');
            if (successAlert.length) {
                setTimeout(() => {
                    successAlert.fadeOut(500);
                }, 3000);
            }
            // Mantener errorAlert visible hasta que el usuario lo cierre manualmente
            if (errorAlert.length) {
                errorAlert.show();
            }

            function loadWorkersByOffice() {
                const officeId = $('#office_id').val();
                const responsibleUserSelect = $('#responsible_user_id');
                const finalUserSelect = $('#final_user_id');

                responsibleUserSelect.html('<option value="" selected disabled>Seleccione un responsable</option>');
                finalUserSelect.html('<option value="" selected disabled>Seleccione un usuario</option>');

                if (officeId) {
                    $.ajax({
                        url: `/company-assets/get-workers-by-office/${officeId}`,
                        method: 'GET',
                        success: function (response) {
                            response.forEach(worker => {
                                const option = $('<option>').val(worker.id).text(worker.full_name || `${worker.first_name} ${worker.last_name_paternal} ${worker.last_name_maternal}`);
                                responsibleUserSelect.append(option.clone());
                                finalUserSelect.append(option.clone());
                            });
                            responsibleUserSelect.val($('option[selected]', responsibleUserSelect).val() || '');
                            finalUserSelect.val($('option[selected]', finalUserSelect).val() || '');
                        },
                        error: function (xhr, status, error) {
                            console.error('Error al cargar trabajadores:', error);
                        }
                    });
                }
            }

            function updateForm() {
                const assetTypeId = $('#asset_type_id').val();
                console.log('Asset Type ID seleccionado:', assetTypeId);
                const $specificFields = $('#specific-fields');
                $specificFields.find('.specific-form, .default-message').hide();
                if (assetTypeId) {
                    $specificFields.find(`#form-${assetTypeId}`).show();
                } else {
                    $specificFields.find('.default-message').show();
                }
                // Limpiar y deshabilitar campos de partials ocultos
                $specificFields.find('.specific-form').not(`#form-${assetTypeId}`).each(function () {
                    $(this).find('input, select, textarea').removeAttr('required').prop('disabled', true).val('');
                });
                // Habilitar campos del partial visible
                $specificFields.find(`#form-${assetTypeId}`).find('input, select, textarea').prop('disabled', false).filter('[data-required]').attr('required', 'required');
            }

            // Validación en tiempo real para patrimonial_code
            $('#patrimonial_code').on('input', function () {
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9\-]/g, '');
                if (this.value.length > 10) this.value = this.value.slice(0, 10);
            });

            // Manejo del envío del formulario
            $('form').on('submit', function (e) {
                const assetTypeId = $('#asset_type_id').val();
                if (!assetTypeId) {
                    e.preventDefault();
                    alert('Por favor, seleccione un tipo de activo.');
                    return;
                }
                // Eliminar temporalmente los campos de partials ocultos
                $('#specific-fields .specific-form').not(`#form-${assetTypeId}`).each(function () {
                    $(this).find('input, select, textarea').remove();
                });
                console.log('Formulario enviado con datos:', $(this).serializeArray());
                // e.preventDefault(); // Comentado para permitir envío
            });

            // Asignar eventos
            $('#office_id').on('change', loadWorkersByOffice);
            $('#asset_type_id').on('change', updateForm);

            // Carga inicial
            loadWorkersByOffice();
            updateForm();
        });
    </script>
@endpush