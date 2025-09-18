@extends('layouts.main')

@section('subtitle', 'Acerca del Sistema')
@section('content_header_title', 'Acerca del Sistema')
@section('content_header_subtitle', 'Información sobre nuestra solución')

@section('content_body')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="hero-section bg-gradient-info p-4 rounded shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 text-white mb-3">
                            <i class="fas fa-building mr-2"></i>
                            Sistema de Gestión Patrimonial
                        </h1>
                        <p class="lead text-white-75 mb-4">
                            Una solución integral para la administración eficiente de activos, roles y permisos organizacionales.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge badge-light badge-pill px-3 py-2">
                                <i class="fas fa-shield-alt mr-1"></i> Seguro
                            </span>
                            <span class="badge badge-light badge-pill px-3 py-2">
                                <i class="fas fa-rocket mr-1"></i> Moderno
                            </span>
                            <span class="badge badge-light badge-pill px-3 py-2">
                                <i class="fas fa-users mr-1"></i> Colaborativo
                            </span>
                            <span class="badge badge-light badge-pill px-3 py-2">
                                <i class="fas fa-mobile-alt mr-1"></i> Responsivo
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="system-logo-container">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo del Sistema" class="system-logo img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Sistema -->
    <div class="row">
        <div class="col-lg-8">
            <x-adminlte-card title="Información del Sistema" theme="primary" icon="fas fa-info-circle" collapsible>
                <div class="system-info">
                    <p class="lead mb-4">
                        Nuestro sistema está diseñado con las últimas tecnologías para garantizar rendimiento, 
                        seguridad y una experiencia de usuario excepcional.
                    </p>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5><i class="fas fa-cogs text-primary mr-2"></i>Características Principales</h5>
                            <ul class="feature-list">
                                <li><i class="fas fa-check text-success mr-2"></i>Gestión de activos patrimoniales</li>
                                <li><i class="fas fa-check text-success mr-2"></i>Sistema de roles y permisos</li>
                                <li><i class="fas fa-check text-success mr-2"></i>Reportes y analíticas avanzadas</li>
                                <li><i class="fas fa-check text-success mr-2"></i>Interfaz intuitiva y moderna</li>
                                <li><i class="fas fa-check text-success mr-2"></i>Respaldos automáticos</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-code text-primary mr-2"></i>Tecnologías Utilizadas</h5>
                            <div class="tech-stack">
                                <span class="tech-badge">Laravel 10</span>
                                <span class="tech-badge">Jetstream</span>
                                <span class="tech-badge">AdminLTE 3</span>
                                <span class="tech-badge">MySQL</span>
                                <span class="tech-badge">Bootstrap 4</span>
                                <span class="tech-badge">jQuery</span>
                            </div>
                        </div>
                    </div>

                    <div class="stats-section">
                        <h5 class="mb-3"><i class="fas fa-chart-bar text-primary mr-2"></i>Estadísticas del Sistema</h5>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon bg-info">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h4>{{ \App\Models\User::count() }}</h4>
                                        <p>Usuarios Registrados</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon bg-success">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h4>0</h4>
                                        <p>Activos Registrados</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon bg-warning">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h4>{{ now()->diffInDays(\Carbon\Carbon::parse('2025-09-17')) + 1 }}</h4>
                                        <p>Días Activo</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon bg-danger">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h4>99.9%</h4>
                                        <p>Uptime</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
        </div>

        <!-- Información de Versión -->
        <div class="col-lg-4">
            <x-adminlte-card title="Detalles de la Versión" theme="info" icon="fas fa-tags">
                <div class="version-info">
                    <div class="version-item">
                        <strong><i class="fas fa-code-branch mr-2"></i>Versión:</strong>
                        <span class="badge badge-info ml-2">v1.0.0</span>
                    </div>
                    <div class="version-item">
                        <strong><i class="fas fa-calendar mr-2"></i>Lanzamiento:</strong>
                        <span>17 de septiembre de 2025</span>
                    </div>
                    <div class="version-item">
                        <strong><i class="fas fa-user-tie mr-2"></i>Desarrollado por:</strong>
                        <span>Equipo de Desarrollo</span>
                    </div>
                    <div class="version-item">
                        <strong><i class="fas fa-sync-alt mr-2"></i>Última actualización:</strong>
                        <span>{{ now()->format('d/m/Y H:i') }}</span>
                    </div>
                </div>

                <hr>

                <h6><i class="fas fa-history mr-2"></i>Historial de Cambios</h6>
                <div class="changelog">
                    <div class="changelog-item">
                        <span class="badge badge-success">v1.0.0</span>
                        <small class="text-muted">17/09/2025</small>
                        <p class="mb-1">Lanzamiento inicial del sistema</p>
                    </div>
                </div>
            </x-adminlte-card>

            <!-- Enlaces Rápidos -->
            <x-adminlte-card title="Enlaces Rápidos" theme="secondary" icon="fas fa-external-link-alt">
                <div class="quick-links">
                    <a href="#" class="btn btn-outline-primary btn-block mb-2">
                        <i class="fas fa-file-alt mr-2"></i>Documentación
                    </a>
                    <a href="#" class="btn btn-outline-success btn-block mb-2">
                        <i class="fas fa-download mr-2"></i>Descargar Manual
                    </a>
                    <a href="#" class="btn btn-outline-info btn-block mb-2">
                        <i class="fas fa-video mr-2"></i>Tutoriales
                    </a>
                    <a href="#" class="btn btn-outline-warning btn-block">
                        <i class="fas fa-question-circle mr-2"></i>FAQ
                    </a>
                </div>
            </x-adminlte-card>
        </div>
    </div>

    <!-- Contacto y Soporte -->
    <div class="row mt-4">
        <div class="col-md-6">
            <x-adminlte-card title="Contacto y Soporte" theme="success" icon="fas fa-headset">
                <div class="contact-info">
                    <p class="mb-4">
                        Nuestro equipo de soporte está disponible para ayudarle con cualquier consulta o problema técnico.
                    </p>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="method-icon bg-success">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="method-content">
                                <h6>Email</h6>
                                <p>soporte@sistemapatrimonial.com</p>
                                <small class="text-muted">Respuesta en 24 horas</small>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="method-icon bg-info">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="method-content">
                                <h6>Teléfono</h6>
                                <p>+51 123 456 7890</p>
                                <small class="text-muted">Lun - Vie: 9:00 AM - 6:00 PM</small>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="method-icon bg-primary">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="method-content">
                                <h6>Sitio Web</h6>
                                <p><a href="https://sistemapatrimonial.com" target="_blank">sistemapatrimonial.com</a></p>
                                <small class="text-muted">Recursos y documentación</small>
                            </div>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
        </div>

        <!-- Términos y Licencias -->
        <div class="col-md-6">
            <x-adminlte-card title="Términos y Licencias" theme="warning" icon="fas fa-file-contract">
                <div class="legal-info">
                    <p>
                        El uso de este sistema está regulado por nuestros términos de servicio y políticas de privacidad.
                    </p>
                    
                    <div class="legal-links">
                        <a href="#" class="legal-link">
                            <i class="fas fa-file-contract mr-2"></i>
                            <div>
                                <h6>Términos de Servicio</h6>
                                <small>Condiciones de uso del sistema</small>
                            </div>
                        </a>
                        
                        <a href="#" class="legal-link">
                            <i class="fas fa-shield-alt mr-2"></i>
                            <div>
                                <h6>Política de Privacidad</h6>
                                <small>Manejo de datos personales</small>
                            </div>
                        </a>
                        
                        <a href="#" class="legal-link">
                            <i class="fas fa-key mr-2"></i>
                            <div>
                                <h6>Licencias de Software</h6>
                                <small>Componentes de terceros</small>
                            </div>
                        </a>
                    </div>
                    
                    <div class="mt-3 p-3 bg-light rounded">
                        <small class="text-muted">
                            <i class="fas fa-info-circle mr-1"></i>
                            Este software está protegido por derechos de autor. 
                            Todos los derechos reservados © {{ date('Y') }}
                        </small>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('css')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        overflow: hidden;
        position: relative;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .text-white-75 {
        color: rgba(255,255,255,0.9) !important;
    }

    .system-logo {
        max-height: 150px;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        transition: transform 0.3s ease;
    }

    .system-logo:hover {
        transform: scale(1.05);
    }

    /* Feature List */
    .feature-list {
        list-style: none;
        padding: 0;
    }

    .feature-list li {
        padding: 8px 0;
        border-bottom: 1px solid #f8f9fa;
    }

    /* Tech Stack */
    .tech-stack {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .tech-badge {
        background: linear-gradient(45deg, #6c757d, #495057);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Stats Section */
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
        font-size: 1.2rem;
    }

    .stat-content h4 {
        margin: 0;
        font-weight: bold;
        color: #495057;
    }

    .stat-content p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }

    /* Version Info */
    .version-info .version-item {
        padding: 12px 0;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .version-info .version-item:last-child {
        border-bottom: none;
    }

    /* Changelog */
    .changelog-item {
        padding: 10px 0;
        border-left: 3px solid #28a745;
        padding-left: 15px;
        margin-bottom: 10px;
    }

    /* Contact Methods */
    .contact-method {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .method-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
    }

    .method-content h6 {
        margin: 0 0 5px 0;
        color: #495057;
    }

    .method-content p {
        margin: 0 0 3px 0;
        font-weight: 500;
    }

    /* Legal Links */
    .legal-link {
        display: flex;
        align-items: center;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }

    .legal-link:hover {
        background: #e9ecef;
        text-decoration: none;
        color: inherit;
    }

    .legal-link i {
        font-size: 1.5rem;
        width: 40px;
        color: #ffc107;
    }

    .legal-link h6 {
        margin: 0 0 3px 0;
        color: #495057;
    }

    /* Quick Links */
    .quick-links .btn {
        transition: all 0.3s ease;
    }

    .quick-links .btn:hover {
        transform: translateX(5px);
    }

    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            text-align: center;
        }
        
        .display-5 {
            font-size: 1.8rem;
        }
        
        .stat-card {
            flex-direction: column;
            text-align: center;
        }
        
        .stat-icon {
            margin: 0 0 10px 0;
        }
        
        .contact-method {
            flex-direction: column;
            text-align: center;
        }
        
        .method-icon {
            margin: 0 0 10px 0;
        }
    }
</style>
@endpush

@push('js')
<script>
$(document).ready(function() {
    // Animación de contadores
    $('.stat-content h4').each(function() {
        const $this = $(this);
        const countTo = parseInt($this.text());
        
        if (!isNaN(countTo)) {
            $({ countNum: 0 }).animate({
                countNum: countTo
            }, {
                duration: 2000,
                easing: 'linear',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        }
    });

    // Tooltips para badges de características
    $('.badge').tooltip({
        placement: 'top'
    });

    // Smooth scroll para enlaces internos
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 70
            }, 1000);
        }
    });
});
</script>
@endpush