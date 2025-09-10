@extends('layouts.main')

@section('subtitle', 'Editar Usuario')
@section('content_header_title', 'Usuarios')
@section('content_header_subtitle', 'Edición de usuario')

@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    {{-- Verificar si el usuario tiene permisos para editar usuarios --}}
    @cannot('actualizar usuarios')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-adminlte-card title="Acceso Denegado" theme="danger" icon="fas fa-exclamation-triangle">
                    <div class="text-center">
                        <i class="fas fa-lock fa-4x text-danger mb-3"></i>
                        <h4>No tienes permisos</h4>
                        <p class="text-muted">No tienes los permisos necesarios para editar usuarios.</p>
                        
                        <div class="mt-3">
                            @can('ver usuarios')
                                <a href="{{ route('users.index') }}" class="btn btn-primary">
                                    <i class="fas fa-users mr-1"></i> Ver Usuarios
                                </a>
                            @endcan
                            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                            </a>
                        </div>
                    </div>
                </x-adminlte-card>
            </div>
        </div>
    @else
        {{-- Verificar restricciones específicas: Autoridad no puede editar Admins --}}
        @if(auth()->user()->hasRole('Autoridad') && $user->hasRole('Admin'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <x-adminlte-card title="Acción Restringida" theme="warning" icon="fas fa-shield-alt">
                        <div class="text-center">
                            <i class="fas fa-user-shield fa-4x text-warning mb-3"></i>
                            <h4>No puedes editar este usuario</h4>
                            <p class="text-muted">Como usuario "Autoridad", no puedes editar cuentas de "Administrador".</p>
                            <p class="text-muted">Solo los administradores pueden gestionar otras cuentas de administrador.</p>
                            
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle"></i>
                                <strong>Usuario a editar:</strong> {{ $user->name }} ({{ $user->roles->first()?->name }})
                            </div>

                            <div class="mt-3">
                                @can('ver usuarios')
                                    <a href="{{ route('users.index') }}" class="btn btn-primary">
                                        <i class="fas fa-users mr-1"></i> Volver a Usuarios
                                    </a>
                                @endcan
                                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                                </a>
                            </div>
                        </div>
                    </x-adminlte-card>
                </div>
            </div>
        @else
            {{-- Formulario de edición permitido --}}
            {{-- Mensaje de éxito con desaparición automática --}}
            @if (session('success'))
                <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
                    {{ session('success') }}
                </x-adminlte-alert>
            @endif

            {{-- Alertas de errores de validación (dinámicas desde JS) --}}
            <div id="validation-alert" style="display: none;">
                <x-adminlte-alert theme="danger" id="error-alert" title="Errores de validación" dismissable>
                    <ul id="error-list" class="mb-0"></ul>
                </x-adminlte-alert>
            </div>

            {{-- Formulario en dos columnas --}}
            <div class="row justify-content-center equal-height-cards">
                <div class="col-md-6">
                    <x-adminlte-card title="Editar Usuario" theme="warning" icon="fas fa-user-edit" collapsible>
                        <form method="POST" action="{{ route('users.update', $user) }}" id="userForm">
                            @csrf
                            @method('PUT')

                            {{-- Información del usuario actual --}}
                            <div class="alert alert-info mb-3">
                                <i class="fas fa-info-circle"></i>
                                <strong>Editando:</strong> {{ $user->name }} 
                                <span class="badge badge-{{ $user->hasRole('Admin') ? 'danger' : ($user->hasRole('Autoridad') ? 'warning' : 'info') }}">
                                    {{ $user->roles->first()?->name ?? 'Sin rol' }}
                                </span>
                            </div>

                            {{-- Nombre --}}
                            <x-adminlte-input name="name" label="Nombre del Usuario" placeholder="Ej. Juan Pérez"
                                label-class="text-warning" value="{{ old('name', $user->name) }}" required class="uppercase-input name-input">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            {{-- Correo --}}
                            <x-adminlte-input name="email" label="Correo Electrónico" placeholder="Ej. juan@ejemplo.com"
                                label-class="text-warning" value="{{ old('email', $user->email) }}" type="email" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-warning">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            {{-- Select de Rol con restricciones --}}
                            @can('gestionar roles de usuarios')
                                <x-adminlte-select name="role" label="Rol" label-class="text-warning" required>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-warning">
                                            <i class="fas fa-users-cog text-white"></i>
                                        </div>
                                    </x-slot>
                                    <option value="" disabled>Seleccione un rol</option>
                                    @foreach ($roles as $role)
                                        {{-- Admin puede asignar cualquier rol --}}
                                        @if (auth()->user()->hasRole('Admin'))
                                            <option value="{{ $role->name }}" 
                                                {{ (old('role') ?? $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        {{-- Autoridad: restricciones específicas --}}
                                        @elseif (auth()->user()->hasRole('Autoridad'))
                                            {{-- No puede asignar rol Admin --}}
                                            @if ($role->name !== 'Admin')
                                                <option value="{{ $role->name }}" 
                                                    {{ (old('role') ?? $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </x-adminlte-select>
                                
                                {{-- Mensaje informativo para Autoridad --}}
                                @if (auth()->user()->hasRole('Autoridad'))
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Como Autoridad, no puedes asignar rol de Administrador.
                                    </small>
                                @endif
                            @else
                                {{-- Si no puede gestionar roles, mantener el rol actual --}}
                                <input type="hidden" name="role" value="{{ $user->roles->first()?->name ?? 'Usuario' }}">
                                <div class="form-group">
                                    <label class="text-warning">Rol</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-warning">
                                                <i class="fas fa-users-cog text-white"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="{{ $user->roles->first()?->name ?? 'Usuario' }}" readonly>
                                    </div>
                                    <small class="text-muted">No tienes permisos para cambiar el rol de este usuario.</small>
                                </div>
                            @endcan

                            {{-- Estado con restricciones --}}
                            @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('Autoridad') && !$user->hasRole('Admin')))
                                <!-- Botón estado (switch holográfico) -->
                                <div class="form-group">
                                    <label class="text-warning">Estado</label>
                                    <div class="toggle-container">
                                        <div class="toggle-wrap">
                                            <input type="hidden" name="status" id="status-value" value="{{ old('status', $user->status) ? 1 : 0 }}">
                                            <input class="toggle-input" id="holo-toggle" type="checkbox" {{ old('status', $user->status) ? 'checked' : '' }} onchange="document.getElementById('status-value').value = this.checked ? 1 : 0;">
                                            <label class="toggle-track" for="holo-toggle">
                                                <div class="track-lines">
                                                    <div class="track-line"></div>
                                                </div>
                                                <div class="toggle-thumb">
                                                    <div class="thumb-core"></div>
                                                    <div class="thumb-inner"></div>
                                                    <div class="thumb-scan"></div>
                                                    <div class="thumb-particles">
                                                        <div class="thumb-particle"></div>
                                                        <div class="thumb-particle"></div>
                                                        <div class="thumb-particle"></div>
                                                        <div class="thumb-particle"></div>
                                                        <div class="thumb-particle"></div>
                                                    </div>
                                                </div>
                                                <div class="toggle-data">
                                                    <div class="data-text off">OFF</div>
                                                    <div class="data-text on">ON</div>
                                                    <div class="status-indicator off"></div>
                                                    <div class="status-indicator on"></div>
                                                </div>
                                                <div class="energy-rings">
                                                    <div class="energy-ring"></div>
                                                    <div class="energy-ring"></div>
                                                    <div class="energy-ring"></div>
                                                </div>
                                                <div class="interface-lines">
                                                    <div class="interface-line"></div>
                                                    <div class="interface-line"></div>
                                                    <div class="interface-line"></div>
                                                    <div class="interface-line"></div>
                                                    <div class="interface-line"></div>
                                                    <div class="interface-line"></div>
                                                </div>
                                                <div class="toggle-reflection"></div>
                                                <div class="holo-glow"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        {{ $user->status ? 'Usuario activo' : 'Usuario inactivo' }} - 
                                        {{ auth()->user()->hasRole('Autoridad') ? 'Como Autoridad, puedes gestionar el estado de usuarios operativos.' : 'Puedes activar/desactivar este usuario.' }}
                                    </small>
                                </div>
                            @else
                                {{-- Mostrar estado actual sin poder editarlo --}}
                                <input type="hidden" name="status" value="{{ $user->status ? 1 : 0 }}">
                                <div class="form-group">
                                    <label class="text-warning">Estado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-warning">
                                                <i class="fas fa-toggle-{{ $user->status ? 'on' : 'off' }} text-white"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" value="{{ $user->status ? 'Activo' : 'Inactivo' }}" readonly>
                                    </div>
                                    <small class="text-muted">No puedes cambiar el estado de este usuario.</small>
                                </div>
                            @endif

                            {{-- Botones --}}
                            <div class="d-flex justify-content-between mt-4">
                                {{-- Botón Volver --}}
                                @can('ver usuarios')
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-arrow-left"></i> Volver a Usuarios
                                    </a>
                                @else
                                    <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-tachometer-alt"></i> Dashboard
                                    </a>
                                @endcan
                                
                                {{-- Botón Actualizar --}}
                                <x-adminlte-button class="btn-sm" type="submit" label="Actualizar Usuario" theme="warning"
                                    icon="fas fa-save" id="updateButton" />
                            </div>
                        </form>
                    </x-adminlte-card>
                </div>

                <div class="col-md-6">
                    <x-adminlte-card title="Generar Nueva Contraseña" theme="info" icon="fas fa-key" collapsible>
                        <div class="mb-3">
                            <p class="text-muted">Si el usuario reporta que no recibió sus credenciales o necesita una nueva contraseña, puede generar una nueva y enviarla por correo.</p>
                        </div>

                        {{-- Contraseña generada --}}
                        <x-adminlte-input name="new_password" label="Nueva Contraseña" type="text" 
                            id="newPasswordField" readonly label-class="text-info" style="display: none;">
                            <small class="text-muted">Esta contraseña será enviada al usuario.</small>
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-info">
                                    <i class="fas fa-lock text-white"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        {{-- Botones para generar y enviar con permisos --}}
                        <div class="d-flex flex-column gap-2">
                            @can('actualizar usuarios')
                                <x-adminlte-button class="btn-sm" label="Generar Nueva Contraseña" theme="info" 
                                    icon="fas fa-key" id="generatePassword" />
                                
                                <x-adminlte-button class="btn-sm" label="Enviar Credenciales" theme="success" 
                                    icon="fas fa-paper-plane" id="sendNewCredentials" disabled style="display: none;" />
                            @else
                                <div class="text-center">
                                    <p class="text-muted">
                                        <i class="fas fa-lock"></i>
                                        No tienes permisos para generar nuevas contraseñas.
                                    </p>
                                </div>
                            @endcan
                        </div>

                        {{-- Información de credenciales --}}
                        <div id="credentialsInfo" style="display: none;" class="mt-3">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-info-circle"></i> Credenciales a enviar:</h6>
                                <p class="mb-1"><strong>Nombre:</strong> {{ $user->name }}</p>
                                <p class="mb-1"><strong>Correo:</strong> {{ $user->email }}</p>
                                <p class="mb-1"><strong>Nueva Contraseña:</strong> <span id="displayPassword" class="text-monospace text-success"></span></p>
                                <p class="mb-0"><strong>Link del Sistema:</strong> <a href="{{ url('/login') }}" target="_blank">{{ url('/login') }}</a></p>
                            </div>
                        </div>
                    </x-adminlte-card>
                </div>
            </div>
        @endif
    @endcannot
</div>
@stop

{{-- CSS extra --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/partials/toggle-switch.css') }}">
    <style>
        #success-alert {
            transition: opacity 0.5s ease;
        }

        #success-alert[style*="display: none"] {
            opacity: 0;
        }

        .uppercase-input {
            text-transform: uppercase;
        }

        .equal-height-cards .col-md-6 {
            display: flex;
        }

        .equal-height-cards .card {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
        }

        .equal-height-cards .card-body {
            flex-grow: 1;
        }

        #validation-alert {
            transition: opacity 0.3s ease;
            margin-bottom: 20px;
        }

        #validation-alert[style*="display: none"] {
            opacity: 0;
        }

        .gap-2 > * + * {
            margin-top: 0.5rem;
        }

        .text-monospace {
            font-family: 'Courier New', monospace !important;
            font-weight: bold;
        }
    </style>
@endpush

{{-- JS extra --}}
@push('js')
    {{-- JS solo para usuarios con permisos de actualizar --}}
    @can('actualizar usuarios')
    <script>
        // Función para validar solo texto (letras, espacios y guiones)
        function validateTextInput(input) {
            const regex = /^[\p{L}\s\-]*$/u;
            return regex.test(input);
        }

        // Convertir a mayúsculas en tiempo real y validar solo texto para el campo nombre
        document.querySelectorAll('.name-input').forEach(input => {
            input.addEventListener('input', function (e) {
                let value = this.value;
                
                // Filtrar solo caracteres válidos (letras, espacios y guiones)
                value = value.replace(/[^\p{L}\s\-]/gu, '');
                
                // Convertir a mayúsculas
                this.value = value.toUpperCase();
            });
            
            input.addEventListener('paste', function (e) {
                e.preventDefault();
                let paste = (e.clipboardData || window.clipboardData).getData('text');
                // Filtrar solo caracteres válidos
                paste = paste.replace(/[^\p{L}\s\-]/gu, '');
                this.value = paste.toUpperCase();
            });
        });

        // Convertir a mayúsculas para otros inputs uppercase
        document.querySelectorAll('.uppercase-input:not(.name-input)').forEach(input => {
            input.addEventListener('input', function (e) {
                this.value = this.value.toUpperCase();
            });
        });

        // Cerrar alerta de éxito automáticamente
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000);
            }
        });

        // Función para mostrar errores de validación
        function showValidationErrors(errors) {
            const errorList = document.getElementById('error-list');
            const validationAlert = document.getElementById('validation-alert');
            
            errorList.innerHTML = '';
            
            if (errors.errors && typeof errors.errors === 'object') {
                Object.values(errors.errors).forEach(errorMessages => {
                    if (Array.isArray(errorMessages)) {
                        errorMessages.forEach(message => {
                            const li = document.createElement('li');
                            li.textContent = message;
                            errorList.appendChild(li);
                        });
                    }
                });
            } else if (errors.message) {
                const li = document.createElement('li');
                li.textContent = errors.message;
                errorList.appendChild(li);
            }
            
            validationAlert.style.display = 'block';
            validationAlert.scrollIntoView({ behavior: 'smooth' });
            
            setTimeout(() => {
                validationAlert.style.display = 'none';
            }, 7000);
        }

        // Función para ocultar errores de validación
        function hideValidationErrors() {
            document.getElementById('validation-alert').style.display = 'none';
        }

        // Generar nueva contraseña (solo si el elemento existe)
        const generatePasswordBtn = document.getElementById('generatePassword');
        if (generatePasswordBtn) {
            generatePasswordBtn.addEventListener('click', function () {
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$%&*';
                let newPassword = '';
                
                for (let i = 0; i < 12; i++) {
                    newPassword += characters.charAt(Math.floor(Math.random() * characters.length));
                }
                
                // Mostrar la contraseña generada
                const passwordField = document.getElementById('newPasswordField');
                const displayPassword = document.getElementById('displayPassword');
                const credentialsInfo = document.getElementById('credentialsInfo');
                const sendButton = document.getElementById('sendNewCredentials');
                
                passwordField.value = newPassword;
                displayPassword.textContent = newPassword;
                
                // Mostrar elementos
                passwordField.style.display = 'block';
                credentialsInfo.style.display = 'block';
                sendButton.style.display = 'inline-block';
                sendButton.disabled = false;
                
                // Cambiar texto del botón
                this.innerHTML = '<i class="fas fa-sync-alt"></i> Generar Nueva Contraseña';
                
                Swal.fire({
                    icon: 'success',
                    title: 'Contraseña Generada',
                    text: 'Se ha generado una nueva contraseña. Ahora puedes enviarla al usuario.',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        }

        // Enviar nuevas credenciales (solo si el elemento existe)
        const sendNewCredentialsBtn = document.getElementById('sendNewCredentials');
        if (sendNewCredentialsBtn) {
            sendNewCredentialsBtn.addEventListener('click', function () {
                const sendButton = this;
                const newPassword = document.getElementById('newPasswordField').value;
                
                if (!newPassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Primero debe generar una nueva contraseña.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }
                
                sendButton.disabled = true;
                sendButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';

                // Actualizar la contraseña en la base de datos y enviar credenciales
                fetch('/update-password-and-send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        user_id: {{ $user->id }},
                        name: '{{ $user->name }}',
                        email: '{{ $user->email }}',
                        password: newPassword,
                        login_url: '{{ url('/login') }}'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Credenciales Enviadas',
                            text: data.message || 'Las nuevas credenciales han sido enviadas con éxito.',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            // Redirigir al index después de enviar credenciales
                            window.location.href = '{{ route("users.index") }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.error || 'No se pudieron enviar las credenciales.',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al enviar las credenciales.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                })
                .finally(() => {
                    sendButton.disabled = false;
                    sendButton.innerHTML = '<i class="fas fa-paper-plane"></i> Enviar Credenciales';
                });
            });
        }

        // Manejar el envío del formulario de actualización
        document.getElementById('userForm').addEventListener('submit', function (e) {
            e.preventDefault();

            hideValidationErrors();

            const updateButton = document.getElementById('updateButton');
            updateButton.disabled = true;
            updateButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Actualizando...';

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errors => {
                        throw { status: response.status, errors: errors };
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario Actualizado',
                        text: data.message || 'Usuario actualizado correctamente.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '{{ route("users.index") }}';
                    });
                }
            })
            .catch(error => {
                console.error('Error completo:', error);
                
                if (error.status === 422) {
                    showValidationErrors(error.errors);
                } else {
                    showValidationErrors({ 
                        message: error.errors?.message || 'Ocurrió un error al procesar la solicitud.' 
                    });
                }
            })
            .finally(() => {
                updateButton.disabled = false;
                updateButton.innerHTML = '<i class="fas fa-save"></i> Actualizar Usuario';
            });
        });
    </script>
    @endcan
@endpush