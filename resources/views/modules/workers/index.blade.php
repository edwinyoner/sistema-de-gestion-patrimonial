@extends('layouts.main')

@section('subtitle', 'Trabajadores')
@section('content_header_title', 'Trabajadores')
@section('content_header_subtitle', 'Bienvenido a la gestión de trabajadores')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">

    <!-- Título mejorado con HTML puro -->
    <div class="card-header bg-gradient-primary text-white text-center py-3 mb-4">
        <h2 class="mb-0">TRABAJADORES</h2>
        <div class="mt-2">
            <span class="ml-2"><i class="fas fa-users mr-1"></i> Gestión de Trabajadores</span>
            <span class="badge badge-light">{{ $workers->count() }} Trabajadores</span>
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
                <a href="{{ route('workers.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-2"></i> Crear Trabajador
                </a>
            </div>

            <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Trabajadores Registrados">
                @php
                    $heads = [
                        ['label' => 'ID', 'width' => 5],
                        ['label' => 'DNI', 'width' => 10],
                        ['label' => 'Nombre', 'width' => 15],
                        ['label' => 'Apellido Paterno', 'width' => 15],
                        ['label' => 'Apellido Materno', 'width' => 15],
                        ['label' => 'Correo', 'width' => 20],
                        ['label' => 'Teléfono', 'width' => 10],
                        ['label' => 'Oficina', 'width' => 10],
                        ['label' => 'Cargo', 'width' => 10],
                        ['label' => 'Contrato', 'width' => 10],
                        ['label' => 'Estado', 'width' => 10],
                        ['label' => 'Acciones', 'no-export' => true, 'width' => 15],
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
                    @foreach ($workers as $worker)
                        <tr>
                            <td>{{ $worker->id }}</td>
                            <td>{{ $worker->dni }}</td>
                            <td>{{ $worker->first_name }}</td>
                            <td>{{ $worker->last_name_paternal }}</td>
                            <td>{{ $worker->last_name_maternal }}</td>
                            <td>{{ $worker->email }}</td>
                            <td>{{ $worker->phone ?? 'No asignado' }}</td>
                            <td>{{ $worker->office->name ?? 'Sin oficina' }}</td>
                            <td>{{ $worker->jobPosition->name ?? 'Sin cargo' }}</td>
                            <td>{{ $worker->contractType->name ?? 'Sin tipo de contrato' }}</td>
                            <td>
                                <span style="color: {{ $worker->status ? 'green' : 'red' }}; font-weight: bold;">
                                    {{ $worker->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Ver -->
                                    <a href="{{ route('workers.show', $worker->id) }}"
                                       class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del trabajador">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Editar -->
                                    <a href="{{ route('workers.edit', $worker->id) }}"
                                       class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar trabajador">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Eliminar -->
                                    <form id="deleteForm{{ $worker->id }}" class="d-inline" method="POST"
                                          action="{{ route('workers.destroy', $worker->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1"
                                                title="Eliminar trabajador" onclick="confirmDelete({{ $worker->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/workers/index.css') }}">
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
        // Función para confirmación de eliminación con Sweetalert2 en español
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

        // Cerrar alerta de éxito automáticamente
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000); // 3 segundos
            }

            // Inicializar DataTable
            if ($.fn.DataTable.isDataTable('#table1')) {
                $('#table1').DataTable();
            }
        });
    </script>
@endpush