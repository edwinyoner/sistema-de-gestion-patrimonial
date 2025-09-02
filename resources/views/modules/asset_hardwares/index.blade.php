@extends('layouts.main')

@section('subtitle', 'Hardware')
@section('content_header_title', 'Hardware')
@section('content_header_subtitle', 'Bienvenido a la gestión de hardware')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">

    <!-- Título mejorado con HTML puro -->
    <div class="card-header bg-gradient-primary text-white text-center py-3 mb-4">
        <h2 class="mb-0">HARDWARE</h2>
        <div class="mt-2">
            <span class="ml-2"><i class="fas fa-laptop mr-1"></i> Gestión de Hardware</span>
            <span class="badge badge-light">{{ $hardwareAssets->count() }} Hardware</span>
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
                <a href="{{ route('asset_hardwares.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-2"></i> Crear Hardware
                </a>
            </div>

            <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Hardware Registrados">
                @php
                    $heads = [
                        ['label' => 'ID', 'width' => 5],
                        ['label' => 'Código Patrimonial', 'width' => 10],
                        ['label' => 'Nombre del Hardware', 'width' => 15],
                        ['label' => 'Marca', 'width' => 10],
                        ['label' => 'Modelo', 'width' => 10],
                        ['label' => 'Color', 'width' => 10],
                        ['label' => 'Número de Serie', 'width' => 10],
                        ['label' => 'Descripción', 'width' => 20],
                        ['label' => 'Foto', 'width' => 10],
                        ['label' => 'Estado', 'width' => 10],
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
                    @foreach ($hardwareAssets as $hardwareAsset)
                        <tr>
                            <td>{{ $hardwareAsset->id }}</td>
                            <td>{{ $hardwareAsset->companyAsset->patrimonial_code ?? 'N/A' }}</td>
                            <td>{{ $hardwareAsset->hardware_name ?? 'N/A' }}</td>
                            <td>{{ $hardwareAsset->brand ?? 'N/A' }}</td>
                            <td>{{ $hardwareAsset->model ?? 'N/A' }}</td>
                            <td>{{ $hardwareAsset->color ?? 'N/A' }}</td>
                            <td>{{ $hardwareAsset->serial_number ?? 'N/A' }}</td>
                            <td>{{ $hardwareAsset->description ?? 'N/A' }}</td>
                            <td>
                                @if ($hardwareAsset->companyAsset->photo_path)
                                    <img src="{{ $hardwareAsset->companyAsset->photo_path }}" alt="Foto del hardware" style="max-width: 50px; max-height: 50px;">
                                @else
                                    <span>No disponible</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-weight: bold;">
                                    {{ $hardwareAsset->companyAsset->assetState->name ?? 'Sin estado' }}
                                </span>
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