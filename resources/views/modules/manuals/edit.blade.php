@extends('layouts.main')

@section('subtitle', 'Editar Manual')
@section('content_header_title', 'Manual del Usuario')
@section('content_header_subtitle', 'Editar manual existente')

@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-adminlte-card title="Editar Manual: {{ $manual->title }}" theme="warning" icon="fas fa-edit">
                <form action="{{ route('manual-usuario.update', $manual) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <x-adminlte-input name="title" label="Título del Manual"
                                placeholder="Ej: Manual de Usuario v2.0" value="{{ old('title', $manual->title) }}"
                                required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-heading text-warning"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="version" label="Versión" placeholder="Ej: 1.0, 2.1, etc."
                                value="{{ old('version', $manual->version) }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-tags text-info"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_active">Estado</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                        value="1" {{ old('is_active', $manual->is_active) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">Manual activo</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <x-adminlte-textarea name="description" label="Descripción"
                                placeholder="Describe brevemente el contenido del manual..."
                                rows="3">{{ old('description', $manual->description) }}</x-adminlte-textarea>
                        </div>
                    </div>

                    <!-- Archivo actual -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h6 class="card-title">Archivo Actual</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i
                                            class="fas fa-file-{{ $manual->file_type === 'application/pdf' ? 'pdf' : 'word' }} fa-2x text-muted mr-3"></i>
                                        <div>
                                            <strong>{{ $manual->file_name }}</strong><br>
                                            <small class="text-muted">{{ $manual->file_size_human }} - Subido el
                                                {{ $manual->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div class="ml-auto">
                                            <a href="{{ route('manual-usuario.download', $manual) }}"
                                                class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-download mr-1"></i>Descargar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nuevo archivo (opcional) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Reemplazar Archivo (Opcional)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                                        id="file" name="file" accept=".pdf,.doc,.docx">
                                    <label class="custom-file-label" for="file">Seleccionar nuevo archivo...</label>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Solo seleccione un archivo si desea reemplazar el actual. Formatos: PDF, DOC, DOCX.
                                    Max: 10MB
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('manual-usuario.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save mr-2"></i>Actualizar Manual
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-adminlte-card>
        </div>
    </div>
</div>
@stop
@push('css')
    <style>
        /* Tarjetas de manuales */
        .manual-card {
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .manual-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .manual-card .card-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .manual-card .card-title {
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Información del manual */
        .manual-info {
            border-top: 1px solid #e9ecef;
            padding-top: 10px;
            margin-top: 10px;
        }

        .manual-info small {
            line-height: 1.6;
        }

        /* Botones de acción */
        .manual-actions {
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .manual-card:hover .manual-actions {
            opacity: 1;
        }

        .btn-group-sm .btn {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        /* Vista previa de PDF */
        .pdf-preview {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
        }

        .pdf-preview iframe {
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Información detallada */
        .manual-detail h6 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        /* Botones de acción */
        .action-buttons .btn {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .action-buttons .btn:hover {
            transform: translateX(5px);
        }

        /* Información de ayuda */
        .help-info h6 {
            color: #17a2b8;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .help-info ul li {
            margin-bottom: 0.5rem;
        }

        /* Archivo actual en edición */
        .card-outline {
            border-width: 1px;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .manual-card .card-header .d-flex {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .manual-actions {
                margin-top: 0.5rem;
            }

            .btn-group {
                width: 100%;
            }

            .btn-group .btn {
                flex: 1;
            }

            .pdf-preview iframe {
                height: 400px !important;
            }

            .action-buttons .btn:hover {
                transform: none;
            }
        }

        /* Estados de archivos */
        .file-type-pdf {
            color: #dc3545 !important;
        }

        .file-type-doc {
            color: #007bff !important;
        }

        /* Loading state para upload */
        .upload-progress {
            display: none;
            margin-top: 1rem;
        }

        .upload-progress .progress {
            height: 25px;
        }

        /* Custom file input styling */
        .custom-file-label::after {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        /* Dropdown personalizado */
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            transform: translateX(2px);
        }

        /* Estados activo/inactivo */
        .badge-success {
            background-color: #28a745 !important;
        }

        .badge-secondary {
            background-color: #6c757d !important;
        }

        /* Tabla de información */
        .table-borderless td {
            border: none;
            padding: 0.3rem 0;
        }

        .table-borderless td:first-child {
            width: 40%;
            color: #6c757d;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .manual-card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Print styles */
        @media print {

            .manual-actions,
            .action-buttons,
            .help-info {
                display: none !important;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function () {

            // Actualizar label del input file con el nombre del archivo seleccionado
            $('.custom-file-input').on('change', function () {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);

                // Mostrar información del archivo
                if (this.files && this.files[0]) {
                    var fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
                    var fileType = this.files[0].type;
                    var fileIcon = fileType === 'application/pdf' ? 'fas fa-file-pdf text-danger' : 'fas fa-file-word text-primary';

                    var fileInfo = `
                    <div class="mt-2 p-2 bg-light rounded file-info">
                        <small class="text-muted">
                            <i class="${fileIcon} mr-1"></i>
                            ${fileName} (${fileSize} MB)
                        </small>
                    </div>
                `;

                    // Remover info anterior si existe
                    $(this).closest('.form-group').find('.file-info').remove();
                    // Agregar nueva info
                    $(this).closest('.custom-file').after(fileInfo);
                }
            });

            // Confirmación para eliminar manuales
            $('form[action*="destroy"]').on('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: '¿Está seguro?',
                    text: "Esta acción eliminará permanentemente el manual y su archivo.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            // Confirmación para cambiar estado
            $('form[action*="toggle-status"]').on('submit', function (e) {
                e.preventDefault();

                var isActive = $(this).find('button').text().trim().includes('Desactivar');
                var action = isActive ? 'desactivar' : 'activar';

                Swal.fire({
                    title: `¿${action.charAt(0).toUpperCase() + action.slice(1)} manual?`,
                    text: `El manual será ${isActive ? 'ocultado' : 'visible'} para los usuarios.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: isActive ? '#6c757d' : '#007bff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: `Sí, ${action}`,
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            // Progress bar para upload de archivos
            $('form[enctype="multipart/form-data"]').on('submit', function () {
                var fileInput = $(this).find('input[type="file"]');

                if (fileInput.val()) {
                    // Mostrar progress bar
                    var progressHtml = `
                    <div class="upload-progress">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-muted">Subiendo archivo...</small>
                            <small class="text-muted">0%</small>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                 role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                `;

                    $(this).find('.card-body').append(progressHtml);
                    $('.upload-progress').show();

                    // Simular progreso (en producción esto sería real)
                    var progress = 0;
                    var interval = setInterval(function () {
                        progress += Math.random() * 15;
                        if (progress > 90) {
                            progress = 90;
                        }

                        $('.progress-bar').css('width', progress + '%');
                        $('.upload-progress small:last-child').text(Math.round(progress) + '%');

                        if (progress >= 90) {
                            clearInterval(interval);
                        }
                    }, 200);
                }
            });

            // Tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Copiar enlace de descarga
            $('.copy-download-link').on('click', function (e) {
                e.preventDefault();

                var downloadUrl = $(this).data('url');

                // Crear elemento temporal para copiar
                var tempInput = document.createElement('input');
                tempInput.value = window.location.origin + downloadUrl;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);

                // Mostrar confirmación
                $(this).tooltip('hide')
                    .attr('data-original-title', '¡Enlace copiado!')
                    .tooltip('show');

                setTimeout(() => {
                    $(this).attr('data-original-title', 'Copiar enlace');
                }, 2000);
            });

            // Buscar en la tabla
            $('#manualSearch').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('.manual-card').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Filtros por tipo de archivo
            $('.filter-file-type').on('click', function (e) {
                e.preventDefault();

                var filterType = $(this).data('type');

                $('.manual-card').show();

                if (filterType !== 'all') {
                    $('.manual-card').each(function () {
                        var cardType = $(this).find('.fa-file-pdf').length > 0 ? 'pdf' : 'doc';
                        if (cardType !== filterType) {
                            $(this).hide();
                        }
                    });
                }

                // Actualizar botón activo
                $('.filter-file-type').removeClass('active');
                $(this).addClass('active');
            });

            // Auto-ocultar alertas después de 5 segundos
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Validación del formulario
            $('form').on('submit', function (e) {
                var fileInput = $(this).find('input[type="file"][required]');

                if (fileInput.length > 0 && !fileInput.val()) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Archivo requerido',
                        text: 'Debe seleccionar un archivo para continuar.',
                        icon: 'warning',
                        confirmButtonText: 'Entendido'
                    });

                    fileInput.focus();
                    return false;
                }
            });

            // Previsualización mejorada para PDFs
            $('iframe').on('load', function () {
                $(this).fadeIn('slow');
            });

            // Botón de pantalla completa para PDFs
            $('.fullscreen-pdf').on('click', function (e) {
                e.preventDefault();

                var iframe = $(this).siblings('iframe')[0];

                if (iframe.requestFullscreen) {
                    iframe.requestFullscreen();
                } else if (iframe.webkitRequestFullscreen) {
                    iframe.webkitRequestFullscreen();
                } else if (iframe.mozRequestFullScreen) {
                    iframe.mozRequestFullScreen();
                }
            });

        });

        // Función para formatear tamaños de archivo
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Función para validar tipos de archivo
        function validateFileType(file) {
            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            return allowedTypes.includes(file.type);
        }

        // Función para mostrar notificaciones personalizadas
        function showNotification(type, title, message) {
            Swal.fire({
                icon: type,
                title: title,
                text: message,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }
    </script>

    <!-- SweetAlert2 para confirmaciones (agregar en el layout principal si no está) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush