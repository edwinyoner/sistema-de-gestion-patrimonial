@extends('layouts.main')

@section('subtitle', 'Tipos de Software')
@section('content_header_title', 'Tipos de Software')
@section('content_header_subtitle', 'Bienvenido a la gestión de tipos de software')

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
        <div class="col-md-6 col-lg-5">
            <x-adminlte-card title="Crear Nuevo Tipo de Software" theme="info" icon="fas fa-layer-group" collapsible>

                <form method="POST" action="{{ route('software_types.store') }}">
                    @csrf

                    <x-adminlte-input name="name" label="Nombre del Tipo de Software" placeholder="Ej. LICENCIADO"
                        label-class="text-lightblue" value="{{ old('name') }}" required id="name">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-briefcase text-white"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-textarea name="description" label="Descripción"
                        placeholder="Breve descripción del tipo de software" label-class="text-lightblue" rows="3"
                        igroup-size="md">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-align-left text-white"></i>
                            </div>
                        </x-slot>
                        {{ old('description') }}
                    </x-adminlte-textarea>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('software_types.index') }}" class="btn btn-secondary btn-sm">
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

            const nameInput = document.getElementById('name');
            if (nameInput) {
                nameInput.addEventListener('input', function (e) {
                    // Convertir a mayúsculas y permitir solo letras, espacios y guiones
                    this.value = this.value.toUpperCase().replace(/[^A-Z\s\-]/g, '');
                    if (this.value.length > 50) this.value = this.value.slice(0, 50); // Ajustado a 50 caracteres
                });
            }
        });
    </script>
@endpush