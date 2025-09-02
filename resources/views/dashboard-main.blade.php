@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{ __('Dashboard') }}
@stop

@section('content')
    <div class="container-fluid">
        <!-- Título y bienvenida -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Sistema de Gestión de Activos - Municipalidad Provincial de Bolognesi</h3>
            </div>
            <div class="card-body">
                <p class="lead">Bienvenido al sistema que centraliza la gestión de los bienes de la <strong>Municipalidad Provincial de Bolognesi</strong>. Aquí puedes:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-boxes text-info mr-2"></i> Registrar y gestionar bienes como equipos de cómputo y mobiliario.</li>
                    <li class="list-group-item"><i class="fas fa-building text-success mr-2"></i> Consultar bienes por oficina o área.</li>
                    <li class="list-group-item"><i class="fas fa-user-tie text-warning mr-2"></i> Asignar responsables y trabajadores a los bienes.</li>
                    <li class="list-group-item"><i class="fas fa-clipboard-check text-danger mr-2"></i> Realizar inventarios con verificación de estados.</li>
                </ul>
            </div>
        </div>

        <!-- Estadísticas resumidas -->
        <div class="row">
            <!-- Card: Total de bienes -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalAssets ?? 0 }}</h3>
                        <p>Total de Bienes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    {{-- <a href="{{ route('assets.index') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a> --}}
                    <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Card: Total de oficinas -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalOffices ?? 0 }}</h3>
                        <p>Oficinas Registradas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <a href="{{ route('offices.index') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Card: Bienes en mal estado -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $damagedAssets ?? 0 }}</h3>
                        <p>Bienes en Mal Estado</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    {{-- <a href="{{ route('assets.index', ['status' => 'damaged']) }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a> --}}
                    <a href="{{ route('workers.index', ['status' => 'damaged']) }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Card: Inventarios realizados -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalInventories ?? 0 }}</h3>
                        <p>Inventarios Realizados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    {{-- <a href="{{ route('inventories.index') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a> --}}
                    <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Gráfico de bienes por oficina -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Distribución de Bienes por Oficina</h3>
            </div>
            <div class="card-body">
                <canvas id="bienesPorOficinaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.css">
    <style>
        #success-alert {
            transition: opacity 0.5s ease;
        }
        #success-alert[style*="display: none"] {
            opacity: 0;
        }
        #error-alert {
            transition: opacity 0.5s ease;
        }
        #error-alert[style*="display: none"] {
            opacity: 0;
        }
        .small-box .inner h3 {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000); // 3 segundos
            }

            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.display = 'none';
                }, 5000); // 5 segundos para el error
            }

            // Gráfico de bienes por oficina
            const ctx = document.getElementById('bienesPorOficinaChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($officeNames ?? []),
                    datasets: [{
                        label: 'Cantidad de Bienes',
                        data: @json($assetsPerOffice ?? []),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Número de Bienes'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Oficinas'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });

            console.log("Hi, I'm using the Laravel-AdminLTE package with an enhanced dashboard!");
        });
    </script>
@stop