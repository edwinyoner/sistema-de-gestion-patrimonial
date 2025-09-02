@extends('layouts.main')

@section('subtitle', 'Cargos')
@section('content_header_title', 'Cargos')
@section('content_header_subtitle', 'Bienvenido a la gestión de cargos')

@section('plugins.Sweetalert2', true) <!-- Quité Datatables ya que no se usa -->

@section('content_body')
<div class="container-fluid">

    {{-- Mensaje de éxito con desaparición automática --}}
    @if (session('success'))
        <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    {{-- Validación de errores --}}
    @if ($errors->any())
        <x-adminlte-alert theme="danger" id="error-alert" title="Errores" dismissable>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    @endif

    {{-- Formulario centrado y estilizado --}}
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <x-adminlte-card title="Crear Nuevo Cargo" theme="info" icon="fas fa-table" collapsible>

                <form method="POST" action="{{ route('job_positions.store') }}">
                    @csrf

                    {{-- Nombre --}}
                    <x-adminlte-input name="name" label="Nombre del Cargo" placeholder="Ej. GERENTE DE TI"
                        label-class="text-lightblue" value="{{ old('name') }}" required class="uppercase-input">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-briefcase text-white"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    {{-- Descripción --}}
                    <x-adminlte-textarea name="description" label="Descripción"
                        placeholder="Breve descripción del cargo" label-class="text-lightblue" rows="3"
                        igroup-size="md">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-align-left text-white"></i>
                            </div>
                        </x-slot>
                        {{ old('description') }}
                    </x-adminlte-textarea>

                    {{-- Botones --}}
                    <div class="d-flex justify-content-between mt-4">
                        {{-- Botón Volver --}}
                        <a href="{{ route('job_positions.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver
                        </a>

                        {{-- Botón Guardar --}}
                        <x-adminlte-button class="btn-sm" type="submit" label="Guardar" theme="success"
                            icon="fas fa-save" />
                    </div>
                </form>

            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

{{-- CSS extra --}}
@push('css')
    <style>
        #success-alert {
            transition: opacity 0.5s ease;
        }
        #success-alert[style*="display: none"] {
            opacity: 0;
        }
        .uppercase-input {
            text-transform: uppercase;
        }
    </style>
@endpush

{{-- JS extra --}}
@push('js')
    <script>
        // Convertir a mayúsculas en tiempo real
        document.querySelectorAll('.uppercase-input').forEach(input => {
            input.addEventListener('input', function (e) {
                this.value = this.value.toUpperCase();
            });
        });

        // Cerrar alerta de éxito automáticamente
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000); // 3 segundos
            }
        });
    </script>
@endpush