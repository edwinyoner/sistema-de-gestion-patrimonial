@extends('layouts.main')

@section('subtitle', 'Crear Trabajador')
@section('content_header_title', 'Trabajadores')
@section('content_header_subtitle', 'Registrar nuevo trabajador')

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
            <x-adminlte-card title="Crear Nuevo Trabajador" theme="info" icon="fas fa-user-plus" collapsible>
                <form method="POST" action="{{ route('workers.store') }}">
                    @csrf

                    <div class="row">
                        <!-- Columna 1 -->
                        <div class="col-md-4">
                            <x-adminlte-input name="dni" label="DNI" placeholder="Ej. 12345678" label-class="text-lightblue"
                                value="{{ old('dni') }}" required maxlength="8" id="dni">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-id-card text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>

                        <!-- Columna 2 -->
                        <div class="col-md-4">
                            <x-adminlte-input name="first_name" label="Nombre" placeholder="Ej. Juan"
                                label-class="text-lightblue" value="{{ old('first_name') }}" required
                                class="auto-uppercase auto-email-trigger" id="first_name">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>

                        <!-- Columna 3 -->
                        <div class="col-md-4">
                            <x-adminlte-input name="last_name_paternal" label="Apellido Paterno" placeholder="Ej. Pérez"
                                label-class="text-lightblue" value="{{ old('last_name_paternal') }}" required
                                class="auto-uppercase auto-email-trigger" id="last_name_paternal">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Columna 1 -->
                        <div class="col-md-4">
                            <x-adminlte-input name="last_name_maternal" label="Apellido Materno" placeholder="Ej. García"
                                label-class="text-lightblue" value="{{ old('last_name_maternal') }}" required
                                class="auto-uppercase auto-email-trigger" id="last_name_maternal">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>

                        <!-- Columna 2 -->
                        <div class="col-md-4">
                            <x-adminlte-input name="email" label="Correo Electrónico"
                                placeholder="Ej. jperezg@winner-systems.com" label-class="text-lightblue"
                                value="{{ old('email') }}" required type="email" id="email">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>

                        <!-- Columna 3 -->
                        <div class="col-md-4">
                            <x-adminlte-input name="phone" label="Teléfono" placeholder="Ej. 987654321"
                                label-class="text-lightblue" value="{{ old('phone') }}" maxlength="9" nullable id="phone">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-phone text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Columna 1 -->
                        <div class="col-md-4">
                            <x-adminlte-select name="office_id" label="Oficina" label-class="text-lightblue" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-building text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="" disabled selected>Seleccione una oficina</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                        {{ $office->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>

                        <!-- Columna 2 -->
                        <div class="col-md-4">
                            <x-adminlte-select name="job_position_id" label="Cargo" label-class="text-lightblue" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-briefcase text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="" disabled selected>Seleccione un cargo</option>
                                @foreach ($jobPositions as $jobPosition)
                                    <option value="{{ $jobPosition->id }}" {{ old('job_position_id') == $jobPosition->id ? 'selected' : '' }}>
                                        {{ $jobPosition->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>

                        <!-- Columna 3 -->
                        <div class="col-md-4">
                            <x-adminlte-select name="contract_type_id" label="Tipo de Contrato" label-class="text-lightblue" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-file-signature text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="" disabled selected>Seleccione un tipo de contrato</option>
                                @foreach ($contractTypes as $contractType)
                                    <option value="{{ $contractType->id }}" {{ old('contract_type_id') == $contractType->id ? 'selected' : '' }}>
                                        {{ $contractType->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('workers.index') }}" class="btn btn-secondary btn-sm">
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
        #success-alert {
            transition: opacity 0.5s ease;
        }
        #success-alert[style*="display: none"] {
            opacity: 0;
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
                }, 3000);
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

            // Convertir a mayúsculas en tiempo real
            ['first_name', 'last_name_paternal', 'last_name_maternal'].forEach(fieldId => {
                const input = document.getElementById(fieldId);
                input.addEventListener('input', function (e) {
                    this.value = this.value.toUpperCase();
                });
            });

            function generateEmail() {
                const firstName = firstNameInput.value.trim();
                const lastNamePaternal = lastNamePaternalInput.value.trim();
                const lastNameMaternal = lastNameMaternalInput.value.trim();
                if (firstName && lastNamePaternal && lastNameMaternal) {
                    const firstLetterName = firstName.charAt(0).toLowerCase();
                    const paternalFull = lastNamePaternal.toLowerCase();
                    const maternalFirstLetter = lastNameMaternal.charAt(0).toLowerCase();
                    const email = `${firstLetterName}${paternalFull}${maternalFirstLetter}@winner-systems.com`;
                    emailInput.value = email;
                }
            }

            // Generar correo cuando cambien los campos relevantes
            [firstNameInput, lastNamePaternalInput, lastNameMaternalInput].forEach(input => {
                input.addEventListener('input', generateEmail);
                input.addEventListener('blur', generateEmail);
            });

            // Restaurar valor old si existe al cargar la página
            if (document.querySelector('input[name="email"][value]')) {
                emailInput.value = document.querySelector('input[name="email"][value]').value;
            }
        });

    </script>
@endpush