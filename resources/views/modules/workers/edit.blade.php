@extends('layouts.main')

@section('subtitle', 'Editar Trabajador')
@section('content_header_title', 'Trabajadores')
@section('content_header_subtitle', 'Editar información del trabajador')

@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <x-adminlte-card title="Editar Trabajador" theme="warning" icon="fas fa-user-edit">

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

                @if (session('error'))
                    <x-adminlte-alert theme="danger" id="error-alert" title="Error" dismissable>
                        {{ session('error') }}
                    </x-adminlte-alert>
                @endif

                <form method="POST" action="{{ route('workers.update', $worker->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Fila 1: dni, first_name, last_name_paternal -->
                    <div class="row">
                        <div class="col-md-4">
                            <x-adminlte-input name="dni" label="DNI" placeholder="Ej. 12345678" label-class="text-lightblue"
                                value="{{ old('dni', $worker->dni) }}" required maxlength="8" id="dni">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-id-card text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="first_name" label="Nombre" placeholder="Ej. Juan"
                                label-class="text-lightblue" value="{{ old('first_name', $worker->first_name) }}" required
                                class="auto-uppercase auto-email-trigger" id="first_name">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="last_name_paternal" label="Apellido Paterno" placeholder="Ej. Pérez"
                                label-class="text-lightblue" value="{{ old('last_name_paternal', $worker->last_name_paternal) }}" required
                                class="auto-uppercase auto-email-trigger" id="last_name_paternal">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <!-- Fila 2: last_name_maternal, email, phone -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <x-adminlte-input name="last_name_maternal" label="Apellido Materno" placeholder="Ej. García"
                                label-class="text-lightblue" value="{{ old('last_name_maternal', $worker->last_name_maternal) }}" required
                                class="auto-uppercase auto-email-trigger" id="last_name_maternal">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="email" label="Correo Electrónico"
                                placeholder="Ej. jperezg@winner-systems.com" label-class="text-lightblue"
                                value="{{ old('email', $worker->email) }}" required type="email" id="email">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-input name="phone" label="Teléfono" placeholder="Ej. 987654321"
                                label-class="text-lightblue" value="{{ old('phone', $worker->phone) }}" maxlength="9" nullable id="phone">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-phone text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <!-- Fila 3: office_id, job_position_id, contract_type_id -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <x-adminlte-select name="office_id" label="Oficina" label-class="text-lightblue" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-building text-white"></i>
                                    </div>
                                </x-slot>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}" {{ old('office_id', $worker->office_id) == $office->id ? 'selected' : '' }}>
                                        {{ $office->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-select name="job_position_id" label="Cargo" label-class="text-lightblue" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-briefcase text-white"></i>
                                    </div>
                                </x-slot>
                                @foreach ($jobPositions as $jobPosition)
                                    <option value="{{ $jobPosition->id }}" {{ old('job_position_id', $worker->job_position_id) == $jobPosition->id ? 'selected' : '' }}>
                                        {{ $jobPosition->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <div class="col-md-4">
                            <x-adminlte-select name="contract_type_id" label="Tipo de Contrato" label-class="text-lightblue" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-file-signature text-white"></i>
                                    </div>
                                </x-slot>
                                @foreach ($contractTypes as $contractType)
                                    <option value="{{ $contractType->id }}" {{ old('contract_type_id', $worker->contract_type_id) == $contractType->id ? 'selected' : '' }}>
                                        {{ $contractType->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>

                    <!-- Botón estado (switch holográfico) -->
                    <div class="form-group mt-3">
                        <label class="text-lightblue">Estado</label>
                        <div class="toggle-container">
                            <div class="toggle-wrap">
                                <input type="hidden" name="status" id="status-value" value="{{ $worker->status ? 1 : 0 }}">
                                <input class="toggle-input" id="holo-toggle" type="checkbox" {{ $worker->status ? 'checked' : '' }}
                                    onchange="document.getElementById('status-value').value = this.checked ? 1 : 0;">
                                <label class="toggle-track" for="holo-toggle">
                                    <div class="track-lines">
                                        <div class="track-line"></div>
                                    </div>
                                    <div class="toggle-thumb">
                                        <div class="thumb-core"></div>
                                        <div class="thumb-inner"></div>
                                        <div class="thumb-scan"></div>
                                        <div class="thumb-particles">
                                            <div class="thumb-particle"></div>
                                            <div class="thumb-particle"></div>
                                            <div class="thumb-particle"></div>
                                            <div class="thumb-particle"></div>
                                            <div class="thumb-particle"></div>
                                        </div>
                                    </div>
                                    <div class="toggle-data">
                                        <div class="data-text off">OFF</div>
                                        <div class="data-text on">ON</div>
                                        <div class="status-indicator off"></div>
                                        <div class="status-indicator on"></div>
                                    </div>
                                    <div class="energy-rings">
                                        <div class="energy-ring"></div>
                                        <div class="energy-ring"></div>
                                        <div class="energy-ring"></div>
                                    </div>
                                    <div class="interface-lines">
                                        <div class="interface-line"></div>
                                        <div class="interface-line"></div>
                                        <div class="interface-line"></div>
                                        <div class="interface-line"></div>
                                        <div class="interface-line"></div>
                                        <div class="interface-line"></div>
                                    </div>
                                    <div class="toggle-reflection"></div>
                                    <div class="holo-glow"></div>
                                </label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Desactiva este trabajador si no está en uso.</small>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('workers.index') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>
                        <x-adminlte-button class="btn-sm" type="submit" label="Actualizar" theme="warning"
                            icon="fas fa-save" />
                    </div>
                </form>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/partials/toggle-switch.css') }}">
    <style>
        #success-alert {
            transition: opacity 0.5s ease;
        }
        #success-alert[style*="display: none"] {
            opacity: 0;
        }
        #error-alert {
            transition: opacity 0.5s ease;
        }
        #error-alert[style*="display: none"] {
            opacity: 0;
        }
        .auto-uppercase {
            text-transform: uppercase;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000); // 3 segundos
            }

            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.display = 'none';
                }, 5000); // 5 segundos para el error
            }

            const dniInput = document.getElementById('dni');
            const phoneInput = document.getElementById('phone');
            const firstNameInput = document.getElementById('first_name');
            const lastNamePaternalInput = document.getElementById('last_name_paternal');
            const lastNameMaternalInput = document.getElementById('last_name_maternal');
            const emailInput = document.getElementById('email');

            // Validación para aceptar solo números en DNI y Teléfono
            [dniInput, phoneInput].forEach(input => {
                input.addEventListener('input', function (e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.id === 'dni' && this.value.length > 8) this.value = this.value.slice(0, 8);
                    if (this.id === 'phone' && this.value.length > 9) this.value = this.value.slice(0, 9);
                });
            });

            // Convertir a mayúsculas y generar correo en tiempo real
            ['first_name', 'last_name_paternal', 'last_name_maternal'].forEach(fieldId => {
                const input = document.getElementById(fieldId);
                input.addEventListener('input', function (e) {
                    this.value = this.value.toUpperCase();
                    generateEmail();
                });
                input.addEventListener('blur', generateEmail);
            });

            function generateEmail() {
                const firstName = firstNameInput.value.trim();
                const lastNamePaternal = lastNamePaternalInput.value.trim();
                const lastNameMaternal = lastNameMaternalInput.value.trim();
                if (firstName && lastNamePaternal && lastNameMaternal) {
                    const firstLetterName = firstName.charAt(0).toLowerCase().replace(/[^a-z]/g, '');
                    const paternalFull = lastNamePaternal.toLowerCase().replace(/[^a-z]/g, '');
                    const maternalFirstLetter = lastNameMaternal.charAt(0).toLowerCase().replace(/[^a-z]/g, '');
                    if (firstLetterName && paternalFull && maternalFirstLetter) {
                        emailInput.value = `${firstLetterName}${paternalFull}${maternalFirstLetter}@winner-systems.com`;
                    }
                }
            }

            // Restaurar valor old si existe al cargar la página
            if (old('email')) {
                emailInput.value = old('email', $worker->email);
            }
        });
    </script>
@endpush