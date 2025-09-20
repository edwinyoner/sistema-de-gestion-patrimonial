@extends('layouts.main')

@section('subtitle', 'Soporte Técnico')
@section('content_header_title', 'Soporte Técnico')
@section('content_header_subtitle', 'Centro de ayuda y asistencia técnica')

@section('content_body')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="hero-support bg-gradient-success p-4 rounded shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 text-white mb-3">
                            <i class="fas fa-headset mr-2"></i>
                            Centro de Soporte Técnico
                        </h1>
                        <p class="lead text-white-75 mb-4">
                            Estamos aquí para ayudarte. Encuentra respuestas rápidas, contacta nuestro equipo o reporta
                            problemas técnicos.
                        </p>
                        <div class="support-stats">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stat-item text-center">
                                        <i class="fas fa-clock fa-2x text-white mb-2"></i>
                                        <h4 class="text-white">
                                            < 2 horas</h4>
                                                <small class="text-white-75">Tiempo de respuesta</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stat-item text-center">
                                        <i class="fas fa-users fa-2x text-white mb-2"></i>
                                        <h4 class="text-white">24/7</h4>
                                        <small class="text-white-75">Disponibilidad</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stat-item text-center">
                                        <i class="fas fa-star fa-2x text-white mb-2"></i>
                                        <h4 class="text-white">98%</h4>
                                        <small class="text-white-75">Satisfacción</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-life-ring fa-5x text-white opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Opciones de Contacto -->
    <div class="row mb-4">
        <div class="col-md-4">
            <x-adminlte-card title="Contacto Winner Systems" theme="primary" icon="fas fa-headset">
                <div class="contact-method">
                    <div class="method-icon bg-primary mb-3">
                        <i class="fas fa-envelope fa-2x"></i>
                    </div>
                    <h5>Soporte Técnico Winner Systems</h5>
                    <p class="text-muted mb-3">
                        Equipo especializado en sistemas de gestión patrimonial municipal.
                        Respuesta garantizada en menos de 4 horas laborales.
                    </p>
                    <div class="contact-info">
                        <div class="info-item mb-2">
                            <strong>Email Principal:</strong><br>
                            <a href="mailto:soporte@winner-systems.com" class="text-primary">
                                <i class="fas fa-paper-plane mr-1"></i>
                                soporte@winner-systems.com
                            </a>
                        </div>
                        <div class="info-item mb-2">
                            <strong>Email Comercial:</strong><br>
                            <a href="mailto:ventas@winner-systems.com" class="text-primary">
                                <i class="fas fa-handshake mr-1"></i>
                                ventas@winner-systems.com
                            </a>
                        </div>
                        <div class="info-item mb-2">
                            <strong>Sitio Web:</strong><br>
                            <a href="https://www.winner-systems.com" target="_blank" class="text-primary">
                                <i class="fas fa-globe mr-1"></i>
                                www.winner-systems.com
                            </a>
                        </div>
                    </div>
                    <a href="mailto:soporte@winner-systems.com?subject=Soporte%20Sistema%20Patrimonial"
                        class="btn btn-primary btn-block mt-3">
                        <i class="fas fa-envelope mr-2"></i>Contactar Winner Systems
                    </a>
                </div>
            </x-adminlte-card>
        </div>

        <div class="col-md-4">
            <x-adminlte-card title="Teléfono de Soporte" theme="success" icon="fas fa-phone">
                <div class="contact-method">
                    <div class="method-icon bg-success mb-3">
                        <i class="fas fa-phone fa-2x"></i>
                    </div>
                    <h5>Asistencia Telefónica</h5>
                    <p class="text-muted mb-3">
                        Llámanos para resolver consultas urgentes o recibir asistencia inmediata.
                    </p>
                    <div class="contact-info">
                        <div class="info-item mb-2">
                            <strong>Teléfono Principal:</strong><br>
                            <a href="tel:+51043123456" class="text-success">
                                <i class="fas fa-phone mr-1"></i>
                                +51 (043) 12-3456
                            </a>
                        </div>
                        <div class="info-item mb-2">
                            <strong>WhatsApp:</strong><br>
                            <a href="https://wa.me/51931741355" class="text-success" target="_blank">
                                <i class="fab fa-whatsapp mr-1"></i>
                                +51 931-741-355
                            </a>
                        </div>
                        <div class="schedule mt-2">
                            <small class="text-muted">
                                <i class="fas fa-clock mr-1"></i>
                                Lunes a Viernes: 8:00 AM - 6:00 PM<br>
                                Sábados: 9:00 AM - 1:00 PM
                            </small>
                        </div>
                    </div>
                    <a href="tel:+51043123456" class="btn btn-success btn-block mt-3">
                        <i class="fas fa-phone mr-2"></i>Llamar Ahora
                    </a>
                </div>
            </x-adminlte-card>
        </div>

        <div class="col-md-4">
            <x-adminlte-card title="Mesa de Ayuda" theme="warning" icon="fas fa-ticket-alt">
                <div class="contact-method">
                    <div class="method-icon bg-warning mb-3">
                        <i class="fas fa-ticket-alt fa-2x"></i>
                    </div>
                    <h5>Ticket de Soporte</h5>
                    <p class="text-muted mb-3">
                        Crea un ticket para dar seguimiento detallado a tu consulta o reporte de error.
                    </p>
                    <div class="ticket-info">
                        <div class="info-item mb-2">
                            <strong>Portal Web:</strong><br>
                            <a href="#" class="text-warning">
                                <i class="fas fa-globe mr-1"></i>
                                soporte.jangas.gob.pe
                            </a>
                        </div>
                        <div class="info-item mb-2">
                            <strong>Por Email:</strong><br>
                            <span class="text-muted">
                                <i class="fas fa-envelope mr-1"></i>
                                Incluye #TICKET en asunto
                            </span>
                        </div>
                    </div>
                    <button class="btn btn-warning btn-block mt-3" onclick="createTicket()">
                        <i class="fas fa-plus mr-2"></i>Crear Ticket
                    </button>
                </div>
            </x-adminlte-card>
        </div>
    </div>

    <!-- Preguntas Frecuentes -->
    <div class="row mb-4">
        <div class="col-12">
            <x-adminlte-card title="Preguntas Frecuentes (FAQ)" theme="info" icon="fas fa-question-circle" collapsible>
                <div class="faq-section">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ 1 -->
                        <div class="card">
                            <div class="card-header" id="faq1">
                                <h6 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapse1">
                                        <i class="fas fa-question-circle text-info mr-2"></i>
                                        ¿Cómo puedo restablecer mi contraseña?
                                    </button>
                                </h6>
                            </div>
                            <div id="collapse1" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Para restablecer tu contraseña:</p>
                                    <ol>
                                        <li>Ve a la página de inicio de sesión</li>
                                        <li>Haz clic en "¿Olvidaste tu contraseña?"</li>
                                        <li>Ingresa tu correo electrónico</li>
                                        <li>Revisa tu bandeja de entrada para el enlace de restablecimiento</li>
                                        <li>Sigue las instrucciones en el correo</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="card">
                            <div class="card-header" id="faq2">
                                <h6 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse2">
                                        <i class="fas fa-question-circle text-info mr-2"></i>
                                        ¿Cómo reporto un error en el sistema?
                                    </button>
                                </h6>
                            </div>
                            <div id="collapse2" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Para reportar un error:</p>
                                    <ul>
                                        <li><strong>Email:</strong> Envía detalles a soporte@jangas.gob.pe</li>
                                        <li><strong>Incluye:</strong> Capturas de pantalla, pasos para reproducir el
                                            error</li>
                                        <li><strong>Especifica:</strong> Navegador, hora del error, página afectada</li>
                                        <li><strong>Urgente:</strong> Llama al +51 (043) 12-3456</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="card">
                            <div class="card-header" id="faq3">
                                <h6 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse3">
                                        <i class="fas fa-question-circle text-info mr-2"></i>
                                        ¿Qué navegadores son compatibles?
                                    </button>
                                </h6>
                            </div>
                            <div id="collapse3" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Navegadores recomendados (versiones actuales):</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul>
                                                <li><i class="fab fa-chrome text-warning mr-2"></i>Google Chrome
                                                    (recomendado)</li>
                                                <li><i class="fab fa-firefox text-orange mr-2"></i>Mozilla Firefox</li>
                                                <li><i class="fab fa-safari text-primary mr-2"></i>Safari (macOS)</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul>
                                                <li><i class="fab fa-edge text-info mr-2"></i>Microsoft Edge</li>
                                                <li><i class="fab fa-opera text-danger mr-2"></i>Opera</li>
                                            </ul>
                                            <small class="text-muted">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Internet Explorer no es compatible
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="card">
                            <div class="card-header" id="faq4">
                                <h6 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse4">
                                        <i class="fas fa-question-circle text-info mr-2"></i>
                                        ¿Cómo solicito permisos adicionales?
                                    </button>
                                </h6>
                            </div>
                            <div id="collapse4" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Para solicitar permisos adicionales:</p>
                                    <ol>
                                        <li>Contacta a tu supervisor inmediato</li>
                                        <li>Envía solicitud por correo a sistemas@jangas.gob.pe</li>
                                        <li>Incluye justificación del permiso solicitado</li>
                                        <li>Espera aprobación del administrador del sistema</li>
                                    </ol>
                                    <div class="alert alert-info mt-2">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Las solicitudes son procesadas en 1-2 días hábiles.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
    </div>

    <!-- Recursos Adicionales -->
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card title="Recursos de Ayuda" theme="secondary" icon="fas fa-book">
                <div class="resources-list">
                    <div class="resource-item">
                        <div class="resource-icon">
                            <i class="fas fa-file-pdf text-danger"></i>
                        </div>
                        <div class="resource-content">
                            <h6>Manual del Usuario</h6>
                            <p class="text-muted small">Guía completa del sistema</p>
                            <a href="{{ route('user_manuals.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download mr-1"></i>Ver Manuales
                            </a>
                        </div>
                    </div>

                    <div class="resource-item">
                        <div class="resource-icon">
                            <i class="fas fa-video text-success"></i>
                        </div>
                        <div class="resource-content">
                            <h6>Tutoriales en Video</h6>
                            <p class="text-muted small">Aprende paso a paso</p>
                            <a href="#" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-play mr-1"></i>Ver Videos
                            </a>
                        </div>
                    </div>

                    <div class="resource-item">
                        <div class="resource-icon">
                            <i class="fas fa-comments text-info"></i>
                        </div>
                        <div class="resource-content">
                            <h6>Chat de Soporte</h6>
                            <p class="text-muted small">Asistencia en tiempo real</p>
                            <button class="btn btn-sm btn-outline-info" onclick="openChat()">
                                <i class="fas fa-comment mr-1"></i>Abrir Chat
                            </button>
                        </div>
                    </div>
                </div>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card title="Estado del Sistema" theme="success" icon="fas fa-server">
                <div class="system-status">
                    <div class="status-item">
                        <div class="status-indicator bg-success"></div>
                        <div class="status-content">
                            <h6>Servidor Principal</h6>
                            <span class="badge badge-success">Operativo</span>
                            <small class="text-muted d-block">Última verificación:
                                {{ now()->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>

                    <div class="status-item">
                        <div class="status-indicator bg-success"></div>
                        <div class="status-content">
                            <h6>Base de Datos</h6>
                            <span class="badge badge-success">Operativo</span>
                            <small class="text-muted d-block">Tiempo de respuesta: 45ms</small>
                        </div>
                    </div>

                    <div class="status-item">
                        <div class="status-indicator bg-warning"></div>
                        <div class="status-content">
                            <h6>Mantenimiento Programado</h6>
                            <span class="badge badge-warning">Próximamente</span>
                            <small class="text-muted d-block">Domingo 22/09 - 02:00 AM - 04:00 AM</small>
                        </div>
                    </div>

                    <div class="mt-3 p-3 bg-light rounded">
                        <h6><i class="fas fa-bell text-info mr-2"></i>Notificaciones</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="small text-muted">
                                <i class="fas fa-check text-success mr-1"></i>
                                Sistema actualizado a la versión 1.2.0
                            </li>
                            <li class="small text-muted">
                                <i class="fas fa-shield-alt text-primary mr-1"></i>
                                Parche de seguridad aplicado
                            </li>
                        </ul>
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
        .hero-support {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .hero-support::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .text-white-75 {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .opacity-75 {
            opacity: 0.75;
        }

        /* Contact Methods */
        .contact-method {
            text-align: center;
        }

        .method-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            color: white;
        }

        .contact-info {
            text-align: left;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .info-item {
            padding: 5px 0;
        }

        /* FAQ Section */
        .faq-section .card {
            border: none;
            border-bottom: 1px solid #e9ecef;
        }

        .faq-section .btn-link {
            text-decoration: none;
            color: #495057;
            width: 100%;
            text-align: left;
            padding: 15px 20px;
        }

        .faq-section .btn-link:hover {
            text-decoration: none;
            color: #007bff;
        }

        /* Resources */
        .resource-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .resource-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .resource-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
        }

        .resource-content {
            flex: 1;
        }

        .resource-content h6 {
            margin: 0 0 5px 0;
            color: #495057;
        }

        /* System Status */
        .status-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .status-item:last-child {
            border-bottom: none;
        }

        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .status-content {
            flex: 1;
        }

        .status-content h6 {
            margin: 0 0 5px 0;
            color: #495057;
        }

        /* Support Stats */
        .support-stats {
            margin-top: 2rem;
        }

        .stat-item {
            padding: 1rem;
        }

        /* Schedule */
        .schedule {
            background: rgba(255, 255, 255, 0.1);
            padding: 8px;
            border-radius: 4px;
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero-support {
                text-align: center;
            }

            .display-5 {
                font-size: 1.8rem;
            }

            .support-stats .row {
                text-align: center;
            }

            .contact-method {
                margin-bottom: 2rem;
            }

            .resource-item {
                flex-direction: column;
                text-align: center;
            }

            .resource-icon {
                margin: 0 0 10px 0;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            // Inicializar tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Auto-expandir primera FAQ
            $('#collapse1').addClass('show');

            // Smooth scroll para FAQ
            $('.btn-link').on('click', function (e) {
                setTimeout(() => {
                    const target = $($(this).attr('data-target'));
                    if (target.hasClass('show')) {
                        $('html, body').animate({
                            scrollTop: target.offset().top - 100
                        }, 500);
                    }
                }, 350);
            });
        });

        // Función para crear ticket
        function createTicket() {
            Swal.fire({
                title: 'Crear Ticket de Soporte',
                html: `
                <div class="text-left">
                    <div class="form-group">
                        <label>Tipo de Problema:</label>
                        <select class="form-control" id="ticketType">
                            <option value="technical">Problema Técnico</option>
                            <option value="access">Problema de Acceso</option>
                            <option value="feature">Solicitud de Funcionalidad</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Prioridad:</label>
                        <select class="form-control" id="ticketPriority">
                            <option value="low">Baja</option>
                            <option value="medium">Media</option>
                            <option value="high">Alta</option>
                            <option value="urgent">Urgente</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Descripción del Problema:</label>
                        <textarea class="form-control" id="ticketDescription" rows="4" placeholder="Describe detalladamente tu problema o consulta..."></textarea>
                    </div>
                </div>
            `,
                confirmButtonText: 'Crear Ticket',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                width: '600px',
                preConfirm: () => {
                    const type = document.getElementById('ticketType').value;
                    const priority = document.getElementById('ticketPriority').value;
                    const description = document.getElementById('ticketDescription').value;

                    if (!description.trim()) {
                        Swal.showValidationMessage('La descripción es requerida');
                        return false;
                    }

                    return {
                        type: type,
                        priority: priority,
                        description: description
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simular creación de ticket
                    const ticketNumber = 'TK' + Math.random().toString(36).substr(2, 9).toUpperCase();

                    // Crear email con información del ticket
                    const emailBody = `Nuevo Ticket de Soporte

    Número de Ticket: ${ticketNumber}
    Tipo: ${result.value.type}
    Prioridad: ${result.value.priority}
    Usuario: {{ Auth::user()->name ?? 'Usuario' }}
    Email: {{ Auth::user()->email ?? 'email@example.com' }}

    Descripción:
    ${result.value.description}

    Fecha: ${new Date().toLocaleString()}
    `;

                    const mailtoLink = `mailto:soporte@jangas.gob.pe?subject=Ticket ${ticketNumber}&body=${encodeURIComponent(emailBody)}`;
                    window.location.href = mailtoLink;

                    Swal.fire({
                        title: '¡Ticket Creado!',
                        html: `
                        <p>Tu ticket ha sido creado exitosamente.</p>
                        <p><strong>Número:</strong> <code>${ticketNumber}</code></p>
                        <p>Recibirás una confirmación por email en breve.</p>
                    `,
                        icon: 'success',
                        confirmButtonText: 'Entendido'
                    });
                }
            });
        }

        // Función para abrir chat (simulado)
        function openChat() {
            Swal.fire({
                title: 'Chat de Soporte',
                html: `
                <div class="text-left">
                    <div class="chat-container" style="background: #f8f9fa; padding: 15px; border-radius: 8px; height: 200px; overflow-y: auto;">
                        <div class="chat-message">
                            <strong>Soporte:</strong> ¡Hola! ¿En qué puedo ayudarte hoy?
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" id="chatMessage" placeholder="Escribe tu mensaje...">
                    </div>
                    <small class="text-muted">
                        <i class="fas fa-info-circle mr-1"></i>
                        El chat estará disponible próximamente. Por ahora, puedes contactarnos por email o teléfono.
                    </small>
                </div>
            `,
                confirmButtonText: 'Cerrar',
                showCancelButton: false,
                width: '500px'
            });
        }

    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush