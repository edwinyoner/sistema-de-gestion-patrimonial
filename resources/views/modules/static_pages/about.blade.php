{{-- resources/views/modules/static_pages/about.blade.php --}}
@extends('layouts.main')

@section('subtitle', 'Acerca del Sistema')
@section('content_header_title', 'Acerca del Sistema')
@section('content_header_subtitle', 'Información sobre nuestra solución de gestión patrimonial')

@section('content_body')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="hero-section p-4 rounded shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 text-white mb-3">
                            <i class="fas fa-building mr-2"></i>
                            Sistema de Gestión Patrimonial
                        </h1>
                        <p class="lead text-white-75 mb-4">
                            Solución integral diseñada para optimizar la administración de activos, roles y permisos en
                            la Municipalidad Provincial de Bolognesi - Ancash.
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
                            <span class="badge badge-light badge-pill px-3 py-2">
                                <i class="fas fa-clock mr-1"></i> Tiempo Real
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="system-logo-container">
                            <i class="fas fa-city fa-6x text-white opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información Institucional -->
    <div class="row mb-4">
        <div class="col-md-12">
            <x-adminlte-card title="Municipalidad Provincial de Bolognesi" theme="warning" icon="fas fa-landmark">
                <div class="row">
                    <div class="col-md-8">
                        <div class="institutional-info">
                            <h5><i class="fas fa-info-circle text-primary mr-2"></i>Acerca de Nuestra Institución</h5>
                            <p class="text-justify mb-3">
                                La Municipalidad Provincial de Bolognesi es una institución pública comprometida con el
                                desarrollo
                                sostenible y el bienestar de nuestros ciudadanos. Ubicada en la hermosa región de
                                Ancash,
                                trabajamos día a día para brindar servicios de calidad y promover el progreso de nuestra
                                provincia.
                            </p>

                            <div class="mission-vision">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-card">
                                            <h6><i class="fas fa-bullseye text-success mr-2"></i>Misión</h6>
                                            <p class="small">
                                                Brindar servicios públicos eficientes y transparentes, promoviendo el
                                                desarrollo
                                                integral de la provincia de Bolognesi a través de una gestión participativa
                                                e innovadora.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-card">
                                            <h6><i class="fas fa-eye text-info mr-2"></i>Visión</h6>
                                            <p class="small">
                                                Ser una municipalidad modelo en gestión pública, líder en desarrollo
                                                sostenible
                                                y en la mejora de la calidad de vida de nuestros ciudadanos.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="contact-info-institutional mt-3">
                                <h6><i class="fas fa-map-marker-alt text-danger mr-2"></i>Información de Contacto</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i
                                                    class="fas fa-map-marker-alt text-muted mr-2"></i><strong>Dirección:</strong>
                                                Plaza de Armas S/N, Bolognesi, Ancash</li>
                                            <li><i class="fas fa-phone text-muted mr-2"></i><strong>Teléfono:</strong>
                                                +51 (043) 39-3001</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-envelope text-muted mr-2"></i><strong>Email:</strong>
                                                info@muniBolognesi.gob.pe</li>
                                            <li><i class="fas fa-globe text-muted mr-2"></i><strong>Web:</strong>
                                                www.muniBolognesi.gob.pe</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="institutional-stats">
                            <h6><i class="fas fa-chart-bar text-primary mr-2"></i>Datos Institucionales</h6>
                            <div class="stat-mini-card mb-2">
                                <div class="stat-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-content">
                                    <h6>~55,000</h6>
                                    <small>Ciudadanos Atendidos</small>
                                </div>
                            </div>
                            <div class="stat-mini-card mb-2">
                                <div class="stat-icon bg-success">
                                    <i class="fas fa-map"></i>
                                </div>
                                <div class="stat-content">
                                    <h6>8</h6>
                                    <small>Distritos</small>
                                </div>
                            </div>
                            <div class="stat-mini-card mb-2">
                                <div class="stat-icon bg-warning">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="stat-content">
                                    <h6>{{ date('Y') }}</h6>
                                    <small>Año de Gestión</small>
                                </div>
                            </div>
                            <div class="stat-mini-card mb-2">
                                <div class="stat-icon bg-info">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <div class="stat-content">
                                    <h6>15+</h6>
                                    <small>Servicios Digitales</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>

    <!-- Información del Sistema -->
    <div class="row">
        <div class="col-lg-8">
            <x-adminlte-card title="Información del Sistema" theme="success" icon="fas fa-desktop" collapsible>
                <div class="system-info">
                    <p class="lead mb-4">
                        Nuestro Sistema de Gestión Patrimonial está diseñado con tecnologías de vanguardia para
                        garantizar eficiencia, seguridad y una experiencia de usuario excepcional en la administración
                        de los recursos municipales.
                    </p>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6><i class="fas fa-star text-warning mr-2"></i>Características Principales</h6>
                            <ul class="feature-list">
                                <li><i class="fas fa-check text-success mr-2"></i>Gestión integral de activos
                                    patrimoniales</li>
                                <li><i class="fas fa-check text-success mr-2"></i>Control de roles y permisos granular
                                </li>
                                <li><i class="fas fa-check text-success mr-2"></i>Reportes y analíticas en tiempo real
                                </li>
                                <li><i class="fas fa-check text-success mr-2"></i>Interfaz intuitiva y moderna</li>
                                <li><i class="fas fa-check text-success mr-2"></i>Auditoría completa de operaciones</li>
                                <li><i class="fas fa-check text-success mr-2"></i>Respaldos automáticos diarios</li>
                                <li><i class="fas fa-check text-success mr-2"></i>Notificaciones en tiempo real</li>
                                <li><i class="fas fa-check text-success mr-2"></i>Acceso desde cualquier dispositivo
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-code text-primary mr-2"></i>Stack Tecnológico</h6>
                            <div class="tech-stack">
                                <div class="tech-category mb-3">
                                    <span class="tech-label">Backend:</span>
                                    <div>
                                        <span class="tech-badge bg-danger">Laravel 10</span>
                                        <span class="tech-badge bg-primary">PHP 8.2</span>
                                        <span class="tech-badge bg-info">MySQL 8.0</span>
                                    </div>
                                </div>
                                <div class="tech-category mb-3">
                                    <span class="tech-label">Frontend:</span>
                                    <div>
                                        <span class="tech-badge bg-success">AdminLTE 3</span>
                                        <span class="tech-badge bg-warning">Bootstrap 4</span>
                                        <span class="tech-badge bg-secondary">jQuery</span>
                                    </div>
                                </div>
                                <div class="tech-category mb-3">
                                    <span class="tech-label">Herramientas:</span>
                                    <div>
                                        <span class="tech-badge bg-dark">Jetstream</span>
                                        <span class="tech-badge bg-purple">Livewire</span>
                                        <span class="tech-badge bg-orange">Spatie</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="benefits-section">
                        <h6><i class="fas fa-trophy text-warning mr-2"></i>Beneficios del Sistema</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="benefit-item">
                                    <div class="benefit-icon bg-success">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <h6>Eficiencia Operativa</h6>
                                    <p class="small text-muted">Automatización de procesos y reducción de tiempos de
                                        gestión</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="benefit-item">
                                    <div class="benefit-icon bg-primary">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h6>Seguridad Avanzada</h6>
                                    <p class="small text-muted">Protección de datos y control de acceso robusto</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="benefit-item">
                                    <div class="benefit-icon bg-info">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <h6>Transparencia</h6>
                                    <p class="small text-muted">Trazabilidad completa y reportes detallados</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stats-section mt-4">
                        <h6 class="mb-3"><i class="fas fa-chart-bar text-primary mr-2"></i>Estadísticas del Sistema</h6>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon bg-info">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h4 id="userCount">{{ \App\Models\User::count() ?? 0 }}</h4>
                                        <p>Usuarios Activos</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon bg-success">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h4 id="assetCount">0</h4>
                                        <p>Activos Registrados</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon bg-warning">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h4 id="daysActive">
                                            {{ now()->diffInDays(\Carbon\Carbon::parse('2025-09-17')) + 1 }}
                                        </h4>
                                        <p>Días en Operación</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon bg-danger">
                                        <i class="fas fa-server"></i>
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

        <!-- Información de Versión y Enlaces -->
        <div class="col-lg-4">
            <x-adminlte-card title="Información de Versión" theme="info" icon="fas fa-tag">
                <div class="version-info">
                    <div class="version-badge text-center mb-3">
                        <span class="badge badge-primary badge-lg">v1.0.0</span>
                        <p class="text-muted small mt-1">Versión Actual</p>
                    </div>

                    <div class="version-details">
                        <div class="version-item">
                            <strong><i class="fas fa-code-branch mr-2"></i>Versión:</strong>
                            <span>1.0.0 (Estable)</span>
                        </div>
                        <div class="version-item">
                            <strong><i class="fas fa-calendar mr-2"></i>Lanzamiento:</strong>
                            <span>17 de septiembre de 2025</span>
                        </div>
                        <div class="version-item">
                            <strong><i class="fas fa-user-tie mr-2"></i>Desarrollado por:</strong>
                            <span>Equipo TI Municipal</span>
                        </div>
                        <div class="version-item">
                            <strong><i class="fas fa-sync-alt mr-2"></i>Última actualización:</strong>
                            <span>{{ now()->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="version-item">
                            <strong><i class="fas fa-database mr-2"></i>Base de datos:</strong>
                            <span>MySQL 8.0</span>
                        </div>
                    </div>

                    <hr>

                    <h6><i class="fas fa-history mr-2"></i>Historial de Versiones</h6>
                    <div class="changelog">
                        <div class="changelog-item">
                            <span class="badge badge-success">v1.0.0</span>
                            <small class="text-muted">17/09/2025</small>
                            <ul class="changelog-list">
                                <li>Lanzamiento inicial del sistema</li>
                                <li>Gestión de usuarios y roles</li>
                                <li>Sistema de permisos</li>
                                <li>Interfaz administrativa</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>

            <!-- Enlaces Rápidos -->
            <x-adminlte-card title="Enlaces Útiles" theme="secondary" icon="fas fa-external-link-alt">
                <div class="quick-links">
                    <a href="{{ route('user_manuals.index') }}" class="btn btn-outline-primary btn-block mb-2">
                        <i class="fas fa-book mr-2"></i>Manual de Usuario
                    </a>
                    <a href="{{ route('support') }}" class="btn btn-outline-success btn-block mb-2">
                        <i class="fas fa-headset mr-2"></i>Soporte Técnico
                    </a>
                    <a href="mailto:sistemas@muniBolognesi.gob.pe" class="btn btn-outline-info btn-block mb-2">
                        <i class="fas fa-envelope mr-2"></i>Contactar TI
                    </a>
                    <a href="#" class="btn btn-outline-warning btn-block mb-2" onclick="showCredits()">
                        <i class="fas fa-award mr-2"></i>Créditos
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-block" onclick="showLicense()">
                        <i class="fas fa-balance-scale mr-2"></i>Licencia
                    </a>
                </div>
            </x-adminlte-card>

            <!-- Sistema de Calificación -->
            <x-adminlte-card title="¿Te gusta nuestro sistema?" theme="warning" icon="fas fa-star">
                <div class="rating-system text-center">
                    <p class="text-muted small mb-3">Ayúdanos a mejorar calificando tu experiencia</p>
                    <div class="stars mb-3">
                        <i class="fas fa-star star-rating" data-rating="1"></i>
                        <i class="fas fa-star star-rating" data-rating="2"></i>
                        <i class="fas fa-star star-rating" data-rating="3"></i>
                        <i class="fas fa-star star-rating" data-rating="4"></i>
                        <i class="fas fa-star star-rating" data-rating="5"></i>
                    </div>
                    <button class="btn btn-warning btn-sm" onclick="submitRating()">
                        <i class="fas fa-paper-plane mr-1"></i>Enviar Calificación
                    </button>
                    <div class="rating-result mt-2" style="display: none;">
                        <span class="badge badge-success">¡Gracias por tu calificación!</span>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>

    <!-- Footer del Sistema -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="system-footer bg-light p-4 rounded">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Powered by Winner Systems Corporation S.A.C.</h6>
                        <p class="text-muted small mb-2">
                            <strong>Sistema de Gestión Patrimonial</strong> desarrollado por Winner Systems,
                            empresa peruana especializada en transformación digital para municipalidades.
                        </p>
                        <div class="company-info">
                            <p class="small mb-1">
                                <i class="fas fa-building mr-2"></i>
                                <strong>RUC:</strong> 20613731335
                            </p>
                            <p class="small mb-1">
                                <i class="fas fa-globe mr-2"></i>
                                <strong>Web:</strong> <a href="https://www.winner-systems.com"
                                    target="_blank">www.winner-systems.com</a>
                            </p>
                            <p class="small mb-2">
                                <i class="fas fa-envelope mr-2"></i>
                                <strong>Contacto:</strong> <a
                                    href="mailto:info@winner-systems.com">info@winner-systems.com</a>
                            </p>
                        </div>
                        <div class="social-links">
                            <a href="#" class="btn btn-sm btn-outline-primary mr-1" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-success mr-1" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.winner-systems.com" class="btn btn-sm btn-outline-info" title="Website"
                                target="_blank">
                                <i class="fas fa-globe"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <div class="winner-systems-logo">
                            <h4 class="text-primary mb-2">
                                <i class="fas fa-trophy mr-2"></i>
                                WINNER SYSTEMS
                            </h4>
                            <p class="text-muted small mb-1">
                                <strong>Transformación Digital Municipal</strong>
                            </p>
                        </div>
                        <div class="copyright-info mt-3">
                            <p class="text-muted small mb-1">
                                © {{ date('Y') }} Winner Systems Corporation S.A.C.
                            </p>
                            <p class="text-muted small mb-1">
                                Todos los derechos reservados
                            </p>
                            <p class="text-muted small">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Huaraz, Ancash, Perú
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .text-white-75 {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .opacity-75 {
            opacity: 0.75;
        }

        /* Info Cards */
        .info-card {
            padding: 15px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #007bff;
        }

        .info-card h6 {
            margin-bottom: 10px;
        }

        /* Feature List */
        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            padding: 6px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        /* Tech Stack */
        .tech-category {
            margin-bottom: 15px;
        }

        .tech-label {
            display: block;
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .tech-badge {
            display: inline-block;
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            margin: 2px;
        }

        .bg-purple {
            background-color: #6f42c1 !important;
        }

        .bg-orange {
            background-color: #fd7e14 !important;
        }

        /* Benefits */
        .benefit-item {
            text-align: center;
            margin-bottom: 20px;
        }

        .benefit-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
            color: white;
            font-size: 1.5rem;
        }

        .benefit-item h6 {
            color: #495057;
            margin-bottom: 8px;
        }

        /* Stats Section */
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
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

        /* Mini Stats */
        .stat-mini-card {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 3px solid #007bff;
        }

        .stat-mini-card .stat-icon {
            width: 35px;
            height: 35px;
            margin-right: 10px;
            font-size: 0.9rem;
        }

        .stat-mini-card h6 {
            margin: 0;
            font-size: 1rem;
            color: #495057;
        }

        .stat-mini-card small {
            color: #6c757d;
        }

        /* Version Info */
        .version-badge {
            padding: 20px;
        }

        .badge-lg {
            font-size: 1.1rem;
            padding: 8px 16px;
        }

        .version-item {
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .version-item:last-child {
            border-bottom: none;
        }

        /* Changelog */
        .changelog-item {
            padding: 15px 0;
            border-left: 3px solid #28a745;
            padding-left: 15px;
            margin-bottom: 15px;
        }

        .changelog-list {
            list-style: none;
            padding: 0;
            margin: 10px 0 0 0;
        }

        .changelog-list li {
            padding: 2px 0;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .changelog-list li::before {
            content: "•";
            color: #28a745;
            margin-right: 8px;
        }

        /* Quick Links */
        .quick-links .btn {
            transition: all 0.3s ease;
            text-align: left;
        }

        .quick-links .btn:hover {
            transform: translateX(5px);
        }

        /* Rating System */
        .star-rating {
            font-size: 1.5rem;
            color: #ddd;
            cursor: pointer;
            margin: 0 2px;
            transition: color 0.2s ease;
        }

        .star-rating:hover,
        .star-rating.active {
            color: #ffc107;
        }

        /* System Footer */
        .system-footer {
            border-top: 3px solid #007bff;
        }

        .social-links .btn {
            width: 35px;
            height: 35px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .stat-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                margin-bottom: 20px;
            }

            .version-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .quick-links .btn:hover {
                transform: none;
            }

            .benefit-item {
                margin-bottom: 30px;
            }

            .tech-badge {
                display: block;
                margin: 5px 0;
                text-align: center;
            }

            .system-footer .row {
                text-align: center;
            }

            .system-footer .col-md-6:last-child {
                margin-top: 20px;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function () {

            // Animación de contadores
            $('.stat-content h4').each(function () {
                const $this = $(this);
                const countTo = parseInt($this.text());

                if (!isNaN(countTo)) {
                    $({ countNum: 0 }).animate({
                        countNum: countTo
                    }, {
                        duration: 2000,
                        easing: 'linear',
                        step: function () {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function () {
                            $this.text(this.countNum);
                        }
                    });
                }
            });

            // Sistema de calificación con estrellas
            let selectedRating = 0;

            $('.star-rating').on('mouseenter', function () {
                const rating = $(this).data('rating');
                highlightStars(rating);
            });

            $('.star-rating').on('mouseleave', function () {
                highlightStars(selectedRating);
            });

            $('.star-rating').on('click', function () {
                selectedRating = $(this).data('rating');
                highlightStars(selectedRating);
            });

            function highlightStars(rating) {
                $('.star-rating').each(function () {
                    const starRating = $(this).data('rating');
                    if (starRating <= rating) {
                        $(this).addClass('active');
                    } else {
                        $(this).removeClass('active');
                    }
                });
            }

            // Tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Smooth scroll para enlaces internos
            $('a[href^="#"]').on('click', function (event) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 70
                    }, 1000);
                }
            });

            // Efecto parallax suave en hero section
            $(window).scroll(function () {
                var scrolled = $(this).scrollTop();
                $('.hero-section::before').css('transform', 'translateY(' + (scrolled * 0.5) + 'px)');
            });

            // Auto-refresh de estadísticas cada 5 minutos
            setInterval(function () {
                // Aquí podrías hacer una llamada AJAX para actualizar estadísticas
                $('#lastUpdate').text(new Date().toLocaleString());
            }, 300000);

            // Animación de elementos al hacer scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationDelay = '0.2s';
                        entry.target.classList.add('animate__fadeInUp');
                    }
                });
            });

            // Observar elementos para animación
            document.querySelectorAll('.stat-card, .benefit-item, .info-card').forEach((el) => {
                observer.observe(el);
            });
        });

        // Función para mostrar créditos
        function showCredits() {
            Swal.fire({
                title: 'Desarrollado por Winner Systems',
                html: `
                <div class="text-left">
                    <div class="text-center mb-4">
                        <h4 class="text-primary">
                            <i class="fas fa-trophy mr-2"></i>
                            WINNER SYSTEMS CORPORATION S.A.C.
                        </h4>
                        <p class="text-muted">Transformación Digital Municipal</p>
                        <hr>
                    </div>

                    <h6><i class="fas fa-building text-primary mr-2"></i>Información Corporativa</h6>
                    <ul class="list-unstyled mb-3">
                        <li><i class="fas fa-id-card text-info mr-2"></i><strong>RUC:</strong> 20613731335</li>
                        <li><i class="fas fa-globe text-success mr-2"></i><strong>Web:</strong> www.winner-systems.com</li>
                        <li><i class="fas fa-envelope text-warning mr-2"></i><strong>Email:</strong> info@winner-systems.com</li>
                        <li><i class="fas fa-map-marker-alt text-danger mr-2"></i><strong>Ubicación:</strong> Huaraz, Ancash, Perú</li>
                    </ul>

                    <h6><i class="fas fa-code text-secondary mr-2"></i>Stack Tecnológico</h6>
                    <div class="mb-3">
                        <span class="badge badge-danger mr-1">Laravel 10</span>
                        <span class="badge badge-primary mr-1">AdminLTE 3</span>
                        <span class="badge badge-success mr-1">Bootstrap 4</span>
                        <span class="badge badge-warning mr-1">MySQL 8</span>
                        <span class="badge badge-info mr-1">jQuery</span>
                    </div>

                    <h6><i class="fas fa-users text-primary mr-2"></i>Especialización</h6>
                    <ul class="small text-muted list-unstyled">
                        <li><i class="fas fa-check text-success mr-1"></i>Sistemas de gestión patrimonial</li>
                        <li><i class="fas fa-check text-success mr-1"></i>Soluciones para municipalidades</li>
                        <li><i class="fas fa-check text-success mr-1"></i>Transformación digital pública</li>
                        <li><i class="fas fa-check text-success mr-1"></i>Desarrollo de software a medida</li>
                    </ul>

                    <div class="text-center mt-4">
                        <a href="https://www.winner-systems.com" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fas fa-globe mr-1"></i>
                            Visitar Winner Systems
                        </a>
                        <a href="mailto:info@winner-systems.com" class="btn btn-success btn-sm ml-2">
                            <i class="fas fa-envelope mr-1"></i>
                            Contactar
                        </a>
                    </div>
                </div>
            `,
                confirmButtonText: 'Cerrar',
                width: '700px',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }

        // Función para mostrar licencia
        function showLicense() {
            Swal.fire({
                title: 'Información de Licencia',
                html: `
                    <div class="text-left">
                        <h6><i class="fas fa-balance-scale text-warning mr-2"></i>Licencia del Software</h6>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Propietario:</strong> Municipalidad Provincial de Bolognesi
                        </div>

                        <h6>Términos de Uso:</h6>
                        <ul class="small">
                            <li>Este software es propiedad exclusiva de la Municipalidad Provincial de Bolognesi</li>
                            <li>Su uso está restringido al personal autorizado de la institución</li>
                            <li>Queda prohibida la copia, distribución o modificación sin autorización</li>
                            <li>El acceso y uso del sistema está sujeto a auditoría</li>
                        </ul>

                        <h6>Bibliotecas de Terceros:</h6>
                        <p class="small text-muted">
                            Este software utiliza bibliotecas de código abierto bajo sus respectivas licencias:
                            MIT, Apache 2.0, y otras. Para más detalles, contacte al administrador del sistema.
                        </p>

                        <div class="mt-3 p-2 bg-light rounded">
                            <small class="text-muted">
                                <i class="fas fa-copyright mr-1"></i>
                                © {{ date('Y') }} Municipalidad Provincial de Bolognesi. Todos los derechos reservados.
                            </small>
                        </div>
                    </div>
                `,
                confirmButtonText: 'Entendido',
                width: '700px',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }

        // Función para enviar calificación
        function submitRating() {
            if (selectedRating === 0) {
                Swal.fire({
                    title: 'Selecciona una calificación',
                    text: 'Por favor, selecciona el número de estrellas antes de enviar.',
                    icon: 'warning',
                    confirmButtonText: 'Entendido'
                });
                return;
            }

            // Simular envío de calificación
            Swal.fire({
                title: '¡Gracias por tu calificación!',
                html: `
                    <p>Has calificado nuestro sistema con <strong>${selectedRating}</strong> estrella${selectedRating > 1 ? 's' : ''}.</p>
                    <div class="my-3">
                        ${'<i class="fas fa-star text-warning"></i>'.repeat(selectedRating)}
                        ${'<i class="far fa-star text-muted"></i>'.repeat(5 - selectedRating)}
                    </div>
                    <p class="small text-muted">Tu opinión nos ayuda a mejorar continuamente.</p>
                `,
                icon: 'success',
                confirmButtonText: 'De nada!',
                showClass: {
                    popup: 'animate__animated animate__bounceIn'
                }
            }).then(() => {
                $('.rating-result').show();
                $('.stars, button').hide();
            });

            // Aquí podrías enviar la calificación al servidor
            // fetch('/api/rating', { method: 'POST', body: JSON.stringify({rating: selectedRating}) });
        }

        // Función para copiar información del sistema
        function copySystemInfo() {
            const systemInfo = `
        Sistema de Gestión Patrimonial
        Versión: 1.0.0
        Institución: Municipalidad Provincial de Bolognesi
        Ubicación: Bolognesi, Ancash, Perú
        Fecha: ${new Date().toLocaleDateString()}
            `;

            navigator.clipboard.writeText(systemInfo).then(() => {
                Swal.fire({
                    title: '¡Información copiada!',
                    text: 'La información del sistema ha sido copiada al portapapeles.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        }

        // Actualizar hora en tiempo real
        function updateCurrentTime() {
            const now = new Date();
            const timeString = now.toLocaleString('es-PE', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            // Si existe un elemento con id para mostrar la hora actual
            const timeElement = document.getElementById('currentTime');
            if (timeElement) {
                timeElement.textContent = timeString;
            }
        }

        // Actualizar cada segundo
        setInterval(updateCurrentTime, 1000);

        // Detectar cuando el usuario ha estado inactivo
        let inactivityTime = function () {
            let time;
            window.onload = resetTimer;
            document.onmousemove = resetTimer;
            document.onkeypress = resetTimer;

            function resetTimer() {
                clearTimeout(time);
                time = setTimeout(() => {
                    // Usuario inactivo por 30 minutos
                    console.log('Usuario inactivo detectado');
                }, 1800000); // 30 minutos
            }
        };

        inactivityTime();
    </script>

    <!-- SweetAlert2 y Animate.css -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endpush