@extends('layouts.main')

@section('subtitle', 'Activos')
@section('content_header_title', 'Activos')
@section('content_header_subtitle', 'Bienvenido a la gestión de activos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.DatatablesButtons', true)
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

@section('content_body')
<div class="container-fluid">

    <!-- Título mejorado con HTML puro -->
    <div class="card-header bg-gradient-primary text-white text-center py-3 mb-4">
        <h2 class="mb-0">ACTIVOS</h2>
        <div class="mt-2">
            <span class="ml-2"><i class="fas fa-briefcase mr-1"></i> Gestión de Activos</span>
            <span class="badge badge-light">{{ $companyAssets->count() }} Activos</span>
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
                <a href="{{ route('company_assets.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-2"></i> Crear Activo
                </a>
            </div>

            <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Activos Registrados">
                @php
                    $heads = [
                        ['label' => 'ID', 'width' => 5],
                        ['label' => 'Código Patrimonial', 'width' => 10],
                        ['label' => 'Tipo de Activo', 'width' => 15],
                        ['label' => 'Nombre', 'width' => 15],
                        ['label' => 'Oficina', 'width' => 15],
                        ['label' => 'Fecha Inventario', 'width' => 10],
                        ['label' => 'Estado', 'width' => 10],
                        ['label' => 'Foto', 'width' => 10],
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

                <x-adminlte-datatable id="table7" :heads="$heads" head-theme="light" theme="white" :config="$config" striped hoverable with-buttons>
                    @foreach ($companyAssets as $asset)
                        <tr>
                            <td>{{ $asset->id }}</td>
                            <td>{{ $asset->patrimonial_code }}</td>
                            <td>{{ $asset->assetType->name ?? 'Sin tipo asignado' }}</td>
                            <td>
                                @php
                                    switch ($asset->asset_type_id) {
                                        case 1: // HARDWARE
                                            $name = $asset->hardware->hardware_name ?? $name;
                                            break;
                                        case 2: // SOFTWARE
                                            $name = $asset->software->software_name ?? $name;
                                            break;
                                        case 3: // FURNITURE
                                            $name = $asset->furniture->furniture_name ?? $name;
                                            break;
                                        case 4: // MACHINERY
                                            $name = $asset->machinery->machinerie_name ?? $name;
                                            break;
                                        case 5: // TOOLS
                                            $name = $asset->tool->tool_name ?? $name;
                                            break;
                                        case 6: // OTHER
                                            $name = $asset->other->other_name ?? $name;
                                            break;
                                        default:
                                            $name = 'Activo sin nombre';
                                    }
                                @endphp
                                {{ $name }}
                            </td>
                            <td>{{ $asset->office->name ?? 'Sin oficina asignada' }}</td>
                            <td>{{ $asset->inventory_date ? $asset->inventory_date->format('d/m/Y') : 'Sin fecha' }}</td>
                            <td>{{ $asset->assetState->name ?? 'Sin estado asignado' }}</td>
                            <td>
                                @if ($asset->photo_path)
                                    <img src="{{ $asset->photo_path }}" alt="{{ $asset->generic_name ?? 'Activo' }}" width="100" style="object-fit: cover;">
                                @else
                                    <span>Sin imagen</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('company_assets.show', $asset->id) }}" class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('company_assets.edit', $asset->id) }}" class="btn btn-sm btn-outline-success shadow-sm mx-1" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="deleteForm{{ $asset->id }}" class="d-inline" method="POST" action="{{ route('company_assets.destroy', $asset->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1" title="Eliminar" onclick="confirmDelete({{ $asset->id }})">
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
    <link rel="stylesheet" href="{{ asset('assets/css/company_assets/index.css') }}">
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
            if ($.fn.DataTable.isDataTable('#table7')) {
                $('#table7').DataTable();
            }
        });
    </script>
@endpush