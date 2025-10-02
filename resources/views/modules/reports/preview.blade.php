@extends('layouts.main')

@section('subtitle', 'Vista Previa del Reporte')
@section('content_header_title', 'Vista Previa')
@section('content_header_subtitle', 'Reporte de ' . $config['name'])

@section('content_body')
<div class="container-fluid">
    <!-- Acciones del Reporte -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <a href="{{ route('reports.filters', $type) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Volver a Filtros
                </a>
                <div class="btn-group">
                    <form action="{{ route('reports.export.excel', $type) }}" method="POST" class="d-inline">
                        @csrf
                        @foreach($filters as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-file-excel mr-2"></i>Exportar Excel
                        </button>
                    </form>
                    <form action="{{ route('reports.export.pdf', $type) }}" method="POST" class="d-inline ml-2">
                        @csrf
                        @foreach($filters as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Reporte -->
    <div class="row mb-3">
        <div class="col-12">
            <x-adminlte-card title="Información del Reporte" theme="{{ $config['color'] }}" icon="{{ $config['icon'] }}" collapsible>
                <div class="row">
                    <div class="col-md-3">
                        <strong>Tipo:</strong> {{ $config['name'] }}
                    </div>
                    <div class="col-md-3">
                        <strong>Total Registros:</strong> {{ $totalRecords }}
                    </div>
                    <div class="col-md-3">
                        <strong>Generado:</strong> {{ now()->format('d/m/Y H:i') }}
                    </div>
                    <div class="col-md-3">
                        <strong>Usuario:</strong> {{ auth()->user()->name }}
                    </div>
                </div>
                @if(!empty($filters['date_from']) || !empty($filters['date_to']))
                <div class="row mt-2">
                    <div class="col-12">
                        <strong>Filtros aplicados:</strong>
                        @if(!empty($filters['date_from']))
                            <span class="badge badge-info">Desde: {{ $filters['date_from'] }}</span>
                        @endif
                        @if(!empty($filters['date_to']))
                            <span class="badge badge-info">Hasta: {{ $filters['date_to'] }}</span>
                        @endif
                    </div>
                </div>
                @endif
            </x-adminlte-card>
        </div>
    </div>

    <!-- Datos del Reporte -->
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Datos del Reporte" theme="primary" icon="fas fa-table">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="reportTable">
                        <thead class="bg-{{ $config['color'] }} text-white">
                            <tr>
                                <th>#</th>
                                @include('modules.reports.partials.table-headers', ['type' => $type])
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    @include('modules.reports.partials.table-row', ['type' => $type, 'item' => $item])
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100" class="text-center text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                        No se encontraron registros con los filtros aplicados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('js')
<script>
$(document).ready(function() {
    $('#reportTable').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'print'
        ]
    });
});
</script>
@endpush