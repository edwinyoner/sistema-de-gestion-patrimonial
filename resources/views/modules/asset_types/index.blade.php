@extends('layouts.main')

@section('subtitle', 'Tipos de Activos')
@section('content_header_title', 'Tipos de Activos')
@section('content_header_subtitle', 'Bienvenido a la gestión de tipos de activos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">

    <!-- Título mejorado con HTML puro -->
    <div class="card-header bg-gradient-primary text-white text-center py-3 mb-4">
        <h2 class="mb-0">TIPOS DE ACTIVOS</h2>
        <div class="mt-2">
            <span class="ml-2"><i class="fas fa-list mr-1"></i> Gestión de Tipos de Activos</span>
            <span class="badge badge-light">{{ $assetTypes->count() }} Tipos de Activos</span>
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
                @can('crear tipos de activos')
                    <a href="{{ route('asset_types.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus mr-2"></i> Crear Tipo de Activo
                    </a>
                @endcan
            </div>

            <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Tipos de Activos Registrados">
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
                    @foreach ($assetTypes as $assetType)
                        <tr>
                            <td>{{ $assetType->id }}</td>
                            <td>{{ $assetType->name }}</td>
                            <td>{{ $assetType->description }}</td>
                            <td>
                                <span style="color: {{ $assetType->status ? 'green' : 'red' }}; font-weight: bold;">
                                    {{ $assetType->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Ver -->
                                    @can('ver tipos de activos')
                                        <a href="{{ route('asset_types.show', $assetType->id) }}"
                                            class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del tipo de activo">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan

                                    <!-- Editar -->
                                    @can('actualizar tipos de activos')
                                        <a href="{{ route('asset_types.edit', $assetType->id) }}"
                                            class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar tipo de activo">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan

                                    <!-- Eliminar -->
                                    @can('eliminar tipos de activos')
                                        <form id="deleteForm{{ $assetType->id }}" class="d-inline" method="POST"
                                            action="{{ route('asset_types.destroy', $assetType->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1"
                                                title="Eliminar tipo de activo" onclick="confirmDelete({{ $assetType->id }})">
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