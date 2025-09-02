@extends('layouts.main')

@section('subtitle', 'Editar Estado de Activo')
@section('content_header_title', 'Estados de Activos')
@section('content_header_subtitle', 'Editar información del estado de activo')

@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <x-adminlte-card title="Editar Estado de Activo" theme="warning" icon="fas fa-edit">

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

                <form method="POST" action="{{ route('asset_states.update', $assetState->id) }}">
                    @csrf
                    @method('PUT')

                    <x-adminlte-input
                        name="name"
                        label="Nombre del Estado de Activo"
                        placeholder="Ej. NUEVO"
                        label-class="text-lightblue"
                        value="{{ old('name', $assetState->name) }}"
                        required
                        id="name">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-warning">
                                <i class="fas fa-briefcase text-white"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-textarea
                        name="description"
                        label="Descripción"
                        placeholder="Actualiza la descripción del estado de activo"
                        label-class="text-lightblue"
                        rows="3"
                        igroup-size="md">{{ old('description', $assetState->description) }}
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-warning">
                                <i class="fas fa-align-left text-white"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-textarea>

                    <div class="form-group">
                        <label class="text-lightblue">Estado</label>
                        <div class="toggle-container">
                            <div class="toggle-wrap">
                                <input type="hidden" name="status" id="status-value" value="{{ $assetState->status ? 1 : 0 }}">
                                <input class="toggle-input" id="holo-toggle" type="checkbox" {{ $assetState->status ? 'checked' : '' }} onchange="document.getElementById('status-value').value = this.checked ? 1 : 0;">
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
                        <small class="form-text text-muted">Desactiva este estado de activo si no está en uso.</small>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('asset_states.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>
                        <x-adminlte-button
                            class="btn-sm"
                            type="submit"
                            label="Actualizar"
                            theme="warning"
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

            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.display = 'none';
                }, 5000);
            }

            const nameInput = document.getElementById('name');
            if (nameInput) {
                nameInput.addEventListener('input', function (e) {
                    // Convertir a mayúsculas y permitir solo letras, espacios y guiones
                    this.value = this.value.toUpperCase().replace(/[^A-Z\s\-]/g, '');
                    if (this.value.length > 25) this.value = this.value.slice(0, 25);
                });
            }
        });
    </script>
@endpush