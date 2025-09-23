@extends('layouts.main')

@section('subtitle', 'Generador de Reportes')
@section('content_header_title', 'Generador de Reportes')
@section('content_header_subtitle', 'Selecciona el tipo de reporte a generar')

@section('content_body')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="hero-reports bg-gradient-primary p-4 rounded shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-6 text-white mb-3">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Sistema de Reportes
                        </h1>
                        <p class="lead text-white-75 mb-0">
                            Genera reportes detallados y personalizados de todos los módulos del sistema
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-file-export fa-5x text-white opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tipos de Reportes -->
    <div class="row">
        @foreach($reportTypes as $key => $report)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card report-card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="report-icon bg-{{ $report['color'] }} text-white mb-3">
                        <i class="{{ $report['icon'] }} fa-2x"></i>
                    </div>
                    <h5 class="card-title font-weight-bold">{{ $report['name'] }}</h5>
                    <p class="card-text text-muted small">{{ $report['description'] }}</p>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('reports.filters', $key) }}" 
                       class="btn btn-{{ $report['color'] }} btn-block">
                        <i class="fas fa-filter mr-2"></i>Generar Reporte
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Estadísticas Rápidas -->
    <div class="row mt-5">
        <div class="col-12">
            <x-adminlte-card title="Estadísticas Generales" theme="info" icon="fas fa-chart-pie" collapsible>
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Trabajadores</span>
                                <span class="info-box-number">{{ \App\Models\Worker::count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-boxes"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Activos</span>
                                <span class="info-box-number">{{ \App\Models\CompanyAsset::count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-building"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Oficinas</span>
                                <span class="info-box-number">{{ \App\Models\Office::count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fas fa-user-shield"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Usuarios Sistema</span>
                                <span class="info-box-number">{{ \App\Models\User::count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop