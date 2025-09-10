@extends('layouts.main')

@section('subtitle', 'Crear Usuario')
@section('content_header_title', 'Usuarios')
@section('content_header_subtitle', 'Bienvenido a la gestión de usuarios')

@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
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

    {{-- Verificar si tiene permisos básicos para estar aquí --}}
    @cannot('crear usuarios')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-adminlte-card title="Acceso Denegado" theme="danger" icon="fas fa-exclamation-triangle">
                    <div class="text-center">
                        <i class="fas fa-lock fa-4x text-danger mb-3"></i>
                        <h4>No tienes permisos</h4>
                        <p class="text-muted">No tienes los permisos necesarios para crear usuarios.</p>
                        
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
        {{-- Formulario en dos columnas --}}
        <div class="row justify-content-center equal-height-cards">
            <div class="col-md-6">
                <x-adminlte-card title="Crear Nuevo Usuario" theme="info" icon="fas fa-user" collapsible>
                    <form method="POST" action="{{ route('users.store') }}" id="userForm">
                        @csrf

                        {{-- Nombre --}}
                        <x-adminlte-input name="name" label="Nombre del Usuario" placeholder="Ej. Juan Pérez"
                            label-class="text-lightblue" value="{{ old('name') }}" required class="uppercase-input name-input">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-info">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        {{-- Correo --}}
                        <x-adminlte-input name="email" label="Correo Electrónico" placeholder="Ej. juan@ejemplo.com"
                            label-class="text-lightblue" value="{{ old('email') }}" type="email" required>
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-info">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        {{-- Contraseña Inicial (generada aleatoriamente) --}}
                        <?php $generatedPassword = \Illuminate\Support\Str::random(12); ?>
                        <x-adminlte-input name="password" label="Contraseña Inicial" type="text"
                            value="{{ $generatedPassword }}" readonly label-class="text-lightblue">
                            <small class="text-muted">La contraseña será enviada al usuario.</small>
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-info">
                                    <i class="fas fa-lock text-white"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                        {{-- Select de Rol con permisos --}}
                        @can('gestionar roles de usuarios')
                            <x-adminlte-select name="role" label="Rol" label-class="text-lightblue" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-info">
                                        <i class="fas fa-users-cog text-white"></i>
                                    </div>
                                </x-slot>
                                <option value="" disabled selected>Seleccione un rol</option>
                                @foreach ($roles as $role)
                                    {{-- Admin puede asignar cualquier rol --}}
                                    @if (auth()->user()->hasRole('Admin'))
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    {{-- Autoridad no puede crear otros Admins --}}
                                    @elseif (auth()->user()->hasRole('Autoridad') && $role->name !== 'Admin')
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </x-adminlte-select>
                        @else
                            {{-- Rol por defecto si no puede gestionar roles --}}
                            <input type="hidden" name="role" value="Usuario">
                            <div class="form-group">
                                <label class="text-lightblue">Rol</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-info">
                                            <i class="fas fa-users-cog text-white"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="Usuario" readonly>
                                </div>
                                <small class="text-muted">Se asignará el rol de Usuario automáticamente.</small>
                            </div>
                        @endcan

                        {{-- Botones con permisos específicos --}}
                        <div class="d-flex justify-content-between mt-4">
                            {{-- Botón Volver --}}
                            @can('ver usuarios')
                                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left mr-1"></i> Volver a Usuarios
                                </a>
                            @else
                                <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                                </a>
                            @endcan
                            
                            {{-- Botón Guardar (siempre visible para quien tiene crear usuarios) --}}
                            <x-adminlte-button class="btn-sm" type="submit" label="Crear Usuario" theme="success"
                                icon="fas fa-save" id="saveButton" />
                        </div>
                    </form>
                </x-adminlte-card>
            </div>

            <div class="col-md-6">
                <x-adminlte-card title="Credenciales Generadas" theme="warning" icon="fas fa-key" collapsible>
                    <div id="credentialsSection" style="display: none;">
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-info-circle"></i> Usuario creado exitosamente</h6>
                            <p><strong>Nombre:</strong> <span id="generatedName"></span></p>
                            <p><strong>Correo:</strong> <span id="generatedEmail"></span></p>
                            <p><strong>Contraseña:</strong> <span id="generatedPassword" class="text-monospace"></span></p>
                            <p><strong>Link del Sistema:</strong> <a href="{{ url('/login') }}" target="_blank">{{ url('/login') }}</a></p>
                            <p><small>El usuario podrá usar estas credenciales para iniciar sesión.</small></p>
                        </div>

                        {{-- Botón para enviar credenciales (solo si tiene el permiso) --}}
                        @can('crear usuarios')
                            <div class="text-center">
                                <x-adminlte-button class="btn-sm" label="Enviar Credenciales por Email" theme="primary" 
                                    icon="fas fa-paper-plane" id="sendCredentials" disabled />
                            </div>
                            <small class="text-muted d-block text-center mt-2">
                                Se enviará un correo con las credenciales y link de verificación.
                            </small>
                        @else
                            <div class="text-center">
                                <p class="text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Contacta al administrador para enviar las credenciales.
                                </p>
                            </div>
                        @endcan
                    </div>
                    <p id="noCredentials" class="text-muted text-center">
                        <i class="fas fa-key"></i> 
                        Crea el usuario para generar las credenciales automáticamente.
                    </p>
                </x-adminlte-card>
            </div>
        </div>
    @endcannot
</div>
@stop

{{-- CSS extra --}}
@push('css')
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

        .text-monospace {
            font-family: 'Courier New', monospace !important;
            font-weight: bold;
            color: #296d9b;
        }
    </style>
@endpush

{{-- JS extra --}}
@push('js')
    {{-- JS solo para usuarios con permisos de crear --}}
    @can('crear usuarios')
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

        // Manejar el envío del formulario y mostrar credenciales
        document.getElementById('userForm').addEventListener('submit', function (e) {
            e.preventDefault();

            hideValidationErrors();

            const saveButton = document.getElementById('saveButton');
            saveButton.disabled = true;
            saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creando...';

            const formData = new FormData(this);
            const generatedPassword = document.querySelector('input[name="password"]').value;

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
                    // Mostrar credenciales
                    document.getElementById('generatedName').textContent = document.querySelector('input[name="name"]').value;
                    document.getElementById('generatedEmail').textContent = document.querySelector('input[name="email"]').value;
                    document.getElementById('generatedPassword').textContent = generatedPassword;
                    document.getElementById('credentialsSection').style.display = 'block';
                    document.getElementById('noCredentials').style.display = 'none';
                    
                    // Habilitar botón enviar solo si existe (tiene permisos)
                    const sendButton = document.getElementById('sendCredentials');
                    if (sendButton) {
                        sendButton.disabled = false;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario Creado',
                        text: data.message || 'Usuario creado correctamente.',
                        timer: 3000,
                        showConfirmButton: false
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
                
                // Ocultar credenciales si falla
                document.getElementById('credentialsSection').style.display = 'none';
                document.getElementById('noCredentials').style.display = 'block';
            })
            .finally(() => {
                saveButton.disabled = false;
                saveButton.innerHTML = '<i class="fas fa-save"></i> Crear Usuario';
            });
        });

        // Enviar credenciales por correo (solo si el botón existe)
        const sendCredentialsBtn = document.getElementById('sendCredentials');
        if (sendCredentialsBtn) {
            sendCredentialsBtn.addEventListener('click', function () {
                const sendButton = this;
                sendButton.disabled = true;
                sendButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';

                const name = document.getElementById('generatedName').textContent;
                const email = document.getElementById('generatedEmail').textContent;
                const password = document.getElementById('generatedPassword').textContent;

                fetch('/send-credentials', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        password: password,
                        login_url: '{{ url('/login') }}'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Credenciales Enviadas',
                            text: data.message || 'Credenciales enviadas con éxito.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '{{ route("users.index") }}';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.error || 'No se pudieron enviar las credenciales.',
                            timer: 2000,
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
                        timer: 2000,
                        showConfirmButton: false
                    });
                })
                .finally(() => {
                    sendButton.disabled = false;
                    sendButton.innerHTML = '<i class="fas fa-paper-plane"></i> Enviar Credenciales por Email';
                });
            });
        }
    </script>
    @endcan
@endpush