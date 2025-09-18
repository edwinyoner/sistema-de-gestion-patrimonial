@extends('layouts.main')

@section('subtitle', 'Cargos')
@section('content_header_title', 'Cargos')
@section('content_header_subtitle', 'Bienvenido a la gestión de cargos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    {{-- Verificar si el usuario tiene permiso para ver puestos de trabajo --}}
    @cannot('ver puestos de trabajo')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-adminlte-card title="Acceso Denegado" theme="danger" icon="fas fa-exclamation-triangle">
                    <div class="text-center">
                        <i class="fas fa-lock fa-4x text-danger mb-3"></i>
                        <h4>No tienes permisos</h4>
                        <p class="text-muted">No tienes los permisos necesarios para ver la lista de puestos de trabajo.</p>
                        
                        <div class="mt-3">
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                            </a>
                        </div>
                    </div>
                </x-adminlte-card>
            </div>
        </div>
    @else
        <!-- Título mejorado con HTML puro -->
        <div class="card-header bg-gradient-primary text-white text-center py-3 mb-4">
            <h2 class="mb-0">CARGOS</h2>
            <div class="mt-2">
                <span class="ml-2"><i class="fas fa-briefcase mr-1"></i> Gestión de Cargos</span>
                <span class="badge badge-light">{{ $jobPositions->count() }} Cargos</span>
            </div>
        </div>

        @if (session('success'))
            <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
                {{ session('success') }}
            </x-adminlte-alert>
        @elseif (session('error'))
            <x-adminlte-alert theme="danger" id="error-alert" title="Error" dismissable>
                {{ session('error') }}
            </x-adminlte-alert>
        @endif

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="mb-3 text-right">
                    @can('crear puestos de trabajo')
                    <a href="{{ route('job_positions.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus mr-2"></i> Crear Cargo
                    </a>
                    @endcan
                </div>

                <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Cargos Registrados">
                    @php
                        $heads = [
                            ['label' => 'ID', 'width' => 5],
                            ['label' => 'Nombre', 'width' => 25],
                            ['label' => 'Descripción', 'width' => 35],
                            ['label' => 'Estado', 'width' => 15],
                            ['label' => 'Acciones', 'no-export' => true, 'width' => 20],
                        ];

                        $config = [
                            'language' => [
                                'url' => asset('/assets/js/es-ES.json'),
                            ],
                            'responsive' => true,
                            'autoWidth' => false,
                            'paging' => true,
                            'searching' => true,
                            'ordering' => true,
                            'pageLength' => 10,
                        ];
                    @endphp

                    <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable bordered sm>
                        @foreach ($jobPositions as $jobPosition)
                            <tr>
                                <td>{{ $jobPosition->id }}</td>
                                <td>{{ $jobPosition->name }}</td>
                                <td>{{ $jobPosition->description }}</td>
                                <td>
                                    <span style="color: {{ $jobPosition->status ? 'green' : 'red' }}; font-weight: bold;">
                                        {{ $jobPosition->status ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Ver -->
                                        @can('ver puestos de trabajo')
                                            <a href="{{ route('job_positions.show', $jobPosition->id) }}"
                                                class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del cargo">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan

                                        <!-- Editar -->
                                        @can('actualizar puestos de trabajo')
                                            <a href="{{ route('job_positions.edit', $jobPosition->id) }}"
                                                class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar cargo">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        <!-- Eliminar -->
                                        @can('eliminar puestos de trabajo')
                                            <form id="deleteForm{{ $jobPosition->id }}" class="d-inline" method="POST"
                                                action="{{ route('job_positions.destroy', $jobPosition->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1"
                                                    title="Eliminar cargo" onclick="confirmDelete({{ $jobPosition->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </x-adminlte-card>
            </div>
        </div>
    @endcannot
</div>
@stop

{{-- Extra CSS (opcional) --}}
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

{{-- Scripts JS --}}
@push('js')
    <script>
        // Función para cerrar alertas automáticamente
        document.addEventListener('DOMContentLoaded', function () {
            // Cerrar alerta de éxito después de 3 segundos con animación
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000); // 3000 ms = 3 segundos
            }

            // Inicializar DataTable
            if ($.fn.DataTable.isDataTable('#table1')) {
                $('#table1').DataTable();
            }
        });

        // Función para confirmación de eliminación con Sweetalert2
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esta acción!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>
@endpush