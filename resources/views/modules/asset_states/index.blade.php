@extends('layouts.main')

@section('subtitle', 'Estados de Activos')
@section('content_header_title', 'Estados de Activos')
@section('content_header_subtitle', 'Bienvenido a la gestión de estados de activos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">

    <!-- Título mejorado con HTML puro -->
    <div class="card-header bg-gradient-primary text-white text-center py-3 mb-4">
        <h2 class="mb-0">ESTADOS DE ACTIVOS</h2>
        <div class="mt-2">
            <span class="ml-2"><i class="fas fa-list mr-1"></i> Gestión de Estados de Activos</span>
            <span class="badge badge-light">{{ $assetStates->count() }} Estados de Activos</span>
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
                @can('crear estados de activos')
                    <a href="{{ route('asset_states.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus mr-2"></i> Crear Estado de Activo
                    </a>
                @endcan
            </div>

            <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Estados de Activos Registrados">
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
                    @foreach ($assetStates as $assetState)
                        <tr>
                            <td>{{ $assetState->id }}</td>
                            <td>{{ $assetState->name }}</td>
                            <td>{{ $assetState->description }}</td>
                            <td>
                                <span style="color: {{ $assetState->status ? 'green' : 'red' }}; font-weight: bold;">
                                    {{ $assetState->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Ver -->
                                    @can('ver estados de activos')
                                        <a href="{{ route('asset_states.show', $assetState->id) }}"
                                            class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del estado de activo">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan

                                    <!-- Editar -->
                                    @can('actualizar estados de activos')
                                        <a href="{{ route('asset_states.edit', $assetState->id) }}"
                                            class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar estado de activo">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan

                                    <!-- Eliminar -->
                                    @can('eliminar estados de activos')
                                        <form id="deleteForm{{ $assetState->id }}" class="d-inline" method="POST"
                                            action="{{ route('asset_states.destroy', $assetState->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1"
                                                title="Eliminar estado de activo" onclick="confirmDelete({{ $assetState->id }})">
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

            if ($.fn.DataTable.isDataTable('#table1')) {
                $('#table1').DataTable();
            }
        });

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