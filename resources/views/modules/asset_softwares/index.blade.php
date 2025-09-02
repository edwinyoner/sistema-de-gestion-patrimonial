@extends('layouts.main')

@section('subtitle', 'Software')
@section('content_header_title', 'Software')
@section('content_header_subtitle', 'Bienvenido a la gestión de software')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">

    <!-- Título mejorado con HTML puro -->
    <div class="card-header bg-gradient-primary text-white text-center py-3 mb-4">
        <h2 class="mb-0">SOFTWARE</h2>
        <div class="mt-2">
            <span class="ml-2"><i class="fas fa-laptop-code mr-1"></i> Gestión de Software</span>
            <span class="badge badge-light">{{ $assetSoftwares->count() }} Software</span>
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
                <a href="{{ route('asset_softwares.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-2"></i> Crear Software
                </a>
            </div>

            <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Software Registrados">
                @php
                    $heads = [
                        ['label' => 'ID', 'width' => 5],
                        ['label' => 'Código Patrimonial', 'width' => 10],
                        ['label' => 'Nombre del Software', 'width' => 15],
                        ['label' => 'Tipo de Software', 'width' => 15],
                        ['label' => 'Versión', 'width' => 10],
                        ['label' => 'Clave de Licencia', 'width' => 15],
                        ['label' => 'Foto', 'width' => 10],
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
                    @foreach ($assetSoftwares as $assetSoftware)
                        <tr>
                            <td>{{ $assetSoftware->id }}</td>
                            <td>{{ $assetSoftware->companyAsset->patrimonial_code ?? 'N/A' }}</td>
                            <td>{{ $assetSoftware->software_name ?? 'N/A' }}</td>
                            <td>{{ $assetSoftware->softwareType->name ?? 'N/A' }}</td>
                            <td>{{ $assetSoftware->version ?? 'N/A' }}</td>
                            <td>{{ $assetSoftware->license_key ?? 'N/A' }}</td>
                            <td>
                                @if ($assetSoftware->companyAsset->photo_path)
                                    <img src="{{ $assetSoftware->companyAsset->photo_path }}" alt="Foto del software" style="max-width: 50px; max-height: 50px;">
                                @else
                                    <span>No disponible</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-weight: bold;">
                                    {{ $assetSoftware->companyAsset->assetState->name ?? 'Sin estado' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Ver -->
                                    <a href="{{ route('asset_softwares.show', $assetSoftware->id) }}"
                                       class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del software">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Editar -->
                                    <a href="{{ route('asset_softwares.edit', $assetSoftware->id) }}"
                                       class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar software">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Eliminar -->
                                    <form id="deleteForm{{ $assetSoftware->id }}" class="d-inline" method="POST"
                                          action="{{ route('asset_softwares.destroy', $assetSoftware->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1"
                                                title="Eliminar software" onclick="confirmDelete({{ $assetSoftware->id }})">
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