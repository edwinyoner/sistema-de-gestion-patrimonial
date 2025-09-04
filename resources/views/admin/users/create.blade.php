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

    {{-- Validación de errores --}}
    @if ($errors->any())
        <x-adminlte-alert theme="danger" id="error-alert" title="Errores" dismissable>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    @endif

    {{-- Formulario en dos columnas --}}
    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-adminlte-card title="Crear Nuevo Usuario" theme="info" icon="fas fa-user" collapsible>
                <form method="POST" action="{{ route('users.store') }}" id="userForm">
                    @csrf

                    {{-- Nombre --}}
                    <x-adminlte-input name="name" label="Nombre del Usuario" placeholder="Ej. Juan Pérez"
                        label-class="text-lightblue" value="{{ old('name') }}" required class="uppercase-input">
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
                        <small class="text-muted">La contraseña será enviada al usuario y deberá cambiarla al iniciar sesión.</small>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-lock text-white"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-select name="role" label="Rol" label-class="text-lightblue" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-info">
                                <i class="fas fa-users-cog text-white"></i>
                            </div>
                        </x-slot>
                        <option value="" disabled selected>Seleccione un rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </x-adminlte-select>

                    {{-- Botón Guardar --}}
                    <div class="d-flex justify-content-end mt-4">
                        <x-adminlte-button class="btn-sm" type="submit" label="Guardar" theme="success"
                            icon="fas fa-save" id="saveButton" />
                    </div>
                </form>
            </x-adminlte-card>
        </div>

        <div class="col-md-6">
            <x-adminlte-card title="Credenciales Generadas" theme="info" icon="fas fa-key" collapsible>
                <div id="credentialsSection" style="display: none;">
                    <p><strong>Nombre:</strong> <span id="generatedName"></span></p>
                    <p><strong>Correo:</strong> <span id="generatedEmail"></span></p>
                    <p><strong>Contraseña Inicial:</strong> <span id="generatedPassword"></span></p>
                    <p><strong>Link del Sistema:</strong> <a href="{{ url('/login') }}" target="_blank">{{ url('/login') }}</a></p>
                    <p><small>El usuario deberá usar estas credenciales para iniciar sesión y cambiar la contraseña.</small></p>
                    <x-adminlte-button class="btn-sm mt-2" label="Enviar Credenciales" theme="primary" icon="fas fa-paper-plane"
                        id="sendCredentials" disabled />
                </div>
                <p id="noCredentials" class="text-muted">Guarda el usuario para generar y ver las credenciales.</p>
            </x-adminlte-card>
        </div>
    </div>
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
    </style>
@endpush

{{-- JS extra --}}
@push('js')
    <script>
        // Convertir a mayúsculas en tiempo real (solo para nombre)
        document.querySelectorAll('.uppercase-input').forEach(input => {
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
                }, 3000); // 3 segundos
            }
        });

        // Manejar el envío del formulario y mostrar credenciales
        document.getElementById('userForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevenir envío inmediato

            const formData = new FormData(this);
            const generatedPassword = document.querySelector('input[name="password"]').value; // Usar la contraseña generada

            // Mostrar credenciales después de guardar
            document.getElementById('generatedName').textContent = document.querySelector('input[name="name"]').value;
            document.getElementById('generatedEmail').textContent = document.querySelector('input[name="email"]').value;
            document.getElementById('generatedPassword').textContent = generatedPassword;
            document.getElementById('credentialsSection').style.display = 'block';
            document.getElementById('noCredentials').style.display = 'none';
            document.getElementById('sendCredentials').disabled = false;

            // Enviar formulario al servidor
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: data.success,
                        timer: 3000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.error || 'Ocurrió un error al guardar.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al procesar la solicitud.',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        });

        // Enviar credenciales por correo
        document.getElementById('sendCredentials').addEventListener('click', function () {
            const name = document.getElementById('generatedName').textContent;
            const email = document.getElementById('generatedEmail').textContent;
            const password = document.getElementById('generatedPassword').textContent;

            fetch('/send-credentials', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    password: password,
                    login_url: '{{ url('/login') }}' // Incluir link del sistema
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Enviado',
                        text: 'Credenciales enviadas con éxito.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    this.disabled = true;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.error || 'No se pudo enviar las credenciales.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al enviar las credenciales.',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        });
    </script>
@endpush