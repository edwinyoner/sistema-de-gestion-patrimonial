@extends('layouts.main')

@section('subtitle', 'Filtros de Reporte')
@section('content_header_title', 'Configurar Reporte')
@section('content_header_subtitle', 'Reporte de ' . $reportConfig['name'])

@section('content_body')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <x-adminlte-card title="Configurar Filtros - {{ $reportConfig['name'] }}" 
                           theme="{{ $reportConfig['color'] }}" 
                           icon="{{ $reportConfig['icon'] }}">
                <form action="{{ route('reports.generate', $type) }}" method="POST" id="reportForm">
                    @csrf
                    
                    <!-- Filtros Generales -->
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="date_from" 
                                            label="Fecha Desde" 
                                            type="date"
                                            value="{{ old('date_from') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-{{ $reportConfig['color'] }}">
                                        <i class="fas fa-calendar-alt text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="date_to" 
                                            label="Fecha Hasta" 
                                            type="date"
                                            value="{{ old('date_to') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-{{ $reportConfig['color'] }}">
                                        <i class="fas fa-calendar-alt text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <!-- Filtros Específicos -->
                    @if(in_array($type, ['trabajadores', 'activos_generales']))
                    <div class="row">
                        <div class="col-md-12">
                            <x-adminlte-select name="office_id" label="Filtrar por Oficina">
                                <option value="">-- Todas las Oficinas --</option>
                                @foreach(\App\Models\Office::all() as $office)
                                    <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                        {{ $office->name }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>
                    @endif

                    @if($type === 'trabajadores')
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-select name="contract_type_id" label="Tipo de Contrato">
                                <option value="">-- Todos los Contratos --</option>
                                @foreach(\App\Models\ContractType::all() as $contract)
                                    <option value="{{ $contract->id }}">{{ $contract->name }}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-select name="job_position_id" label="Cargo">
                                <option value="">-- Todos los Cargos --</option>
                                @foreach(\App\Models\JobPosition::all() as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>
                    @endif

                    @if($type === 'usuarios')
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-select name="role" label="Rol de Usuario">
                                <option value="">-- Todos los Roles --</option>
                                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="active_only">Estado</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active_only" name="active_only" value="1">
                                    <label class="custom-control-label" for="active_only">Solo usuarios activos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($type === 'activos_generales')
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-select name="asset_type_id" label="Tipo de Activo">
                                <option value="">-- Todos los Tipos --</option>
                                @foreach(\App\Models\AssetType::all() as $assetType)
                                    <option value="{{ $assetType->id }}">{{ $assetType->name }}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-select name="asset_state_id" label="Estado del Activo">
                                <option value="">-- Todos los Estados --</option>
                                @foreach(\App\Models\AssetState::all() as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                    </div>
                    @endif

                    <!-- Formato de Exportación -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>Formato de Exportación</label>
                            <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="export_format" value="preview" checked> 
                                    <i class="fas fa-eye mr-1"></i>Vista Previa
                                </label>
                                <label class="btn btn-outline-success">
                                    <input type="radio" name="export_format" value="excel"> 
                                    <i class="fas fa-file-excel mr-1"></i>Excel
                                </label>
                                <label class="btn btn-outline-danger">
                                    <input type="radio" name="export_format" value="pdf"> 
                                    <i class="fas fa-file-pdf mr-1"></i>PDF
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-2"></i>Volver
                                </a>
                                <button type="submit" class="btn btn-{{ $reportConfig['color'] }}">
                                    <i class="fas fa-chart-bar mr-2"></i>Generar Reporte
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-adminlte-card>
        </div>

        <!-- Información del Reporte -->
        <div class="col-md-4">
            <x-adminlte-card title="Información del Reporte" theme="secondary" icon="fas fa-info-circle">
                <div class="report-info">
                    <div class="info-item mb-3">
                        <strong><i class="fas fa-database mr-2"></i>Tabla:</strong>
                        <span class="badge badge-info">{{ $reportConfig['table'] }}</span>
                    </div>
                    <div class="info-item mb-3">
                        <strong><i class="fas fa-tag mr-2"></i>Tipo:</strong>
                        <span>{{ $reportConfig['name'] }}</span>
                    </div>
                    <div class="info-item mb-3">
                        <strong><i class="fas fa-info mr-2"></i>Descripción:</strong>
                        <p class="text-muted small">{{ $reportConfig['description'] }}</p>
                    </div>
                </div>

                <hr>

                <h6><i class="fas fa-lightbulb text-warning mr-2"></i>Consejos</h6>
                <ul class="small text-muted">
                    <li>Puedes dejar los filtros vacíos para obtener todos los registros</li>
                    <li>Los rangos de fecha son opcionales</li>
                    <li>La vista previa te permite revisar antes de exportar</li>
                    <li>Los archivos Excel incluyen el logo institucional</li>
                </ul>
            </x-adminlte-card>

            <!-- Accesos Rápidos -->
            <x-adminlte-card title="Otros Reportes" theme="info" icon="fas fa-bolt">
                <div class="quick-reports">
                    <a href="{{ route('reports.filters', 'trabajadores') }}" class="btn btn-sm btn-outline-primary btn-block mb-2">
                        <i class="fas fa-users mr-2"></i>Trabajadores
                    </a>
                    <a href="{{ route('reports.filters', 'activos_generales') }}" class="btn btn-sm btn-outline-success btn-block mb-2">
                        <i class="fas fa-boxes mr-2"></i>Activos Generales
                    </a>
                    <a href="{{ route('reports.filters', 'oficinas') }}" class="btn btn-sm btn-outline-warning btn-block">
                        <i class="fas fa-building mr-2"></i>Oficinas
                    </a>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop