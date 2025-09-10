@extends('layouts.main')

@section('subtitle', 'Detalle del Usuario')
@section('content_header_title', 'Usuario')
@section('content_header_subtitle', 'Detalles del Usuario')

@section('content_body')
<div class="container-fluid">
    {{-- Verificar si el usuario tiene permiso para ver usuarios --}}
    @cannot('ver usuarios')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-adminlte-card title="Acceso Denegado" theme="danger" icon="fas fa-exclamation-triangle">
                    <div class="text-center">
                        <i class="fas fa-lock fa-4x text-danger mb-3"></i>
                        <h4>No tienes permisos</h4>
                        <p class="text-muted">No tienes los permisos necesarios para ver detalles de usuarios.</p>
                        
                        <div class="mt-3">
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                            </a>
                        </div>
                    </div>
                </x-adminlte-card>
            </div>
        </div>
    @else
        {{-- Verificar restricciones específicas: Autoridad no puede ver detalles de Admin --}}
        @if(auth()->user()->hasRole('Autoridad') && $user->hasRole('Admin'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <x-adminlte-card title="Vista Restringida" theme="warning" icon="fas fa-shield-alt">
                        <div class="text-center">
                            <i class="fas fa-user-shield fa-4x text-warning mb-3"></i>
                            <h4>No puedes ver este usuario</h4>
                            <p class="text-muted">Como usuario "Autoridad", no puedes ver detalles de cuentas "Administrador".</p>
                            <p class="text-muted">Solo los administradores pueden ver detalles de otras cuentas de administrador.</p>
                            
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle"></i>
                                <strong>Usuario solicitado:</strong> {{ $user->name }} ({{ $user->roles->first()?->name }})
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
            {{-- Mostrar detalles del usuario --}}
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <x-adminlte-card title="Información del Usuario" theme="info" icon="fas fa-user">
                        {{-- Información básica siempre visible para usuarios autorizados --}}
                        <div class="mb-3">
                            <strong>ID:</strong>
                            <span class="text-muted">{{ $user->id }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Nombre del Usuario:</strong>
                            <span class="text-muted">{{ $user->name }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Correo Electrónico:</strong>
                            <span class="text-muted">{{ $user->email }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Rol:</strong>
                            @php
                                $userRole = $user->roles->first()?->name ?? 'Sin rol asignado';
                                $badgeClass = match($userRole) {
                                    'Admin' => 'badge-danger',
                                    'Autoridad' => 'badge-warning', 
                                    'Usuario' => 'badge-info',
                                    default => 'badge-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $userRole }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Estado:</strong>
                            <span class="badge {{ $user->status ? 'badge-success' : 'badge-danger' }}">
                                <i class="fas fa-{{ $user->status ? 'check-circle' : 'times-circle' }}"></i>
                                {{ $user->status ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>

                        {{-- Información adicional solo para Admin --}}
                        @if(auth()->user()->hasRole('Admin'))
                            <hr>
                            <div class="mb-3">
                                <strong>Email Verificado:</strong>
                                <span class="badge {{ $user->email_verified_at ? 'badge-success' : 'badge-warning' }}">
                                    <i class="fas fa-{{ $user->email_verified_at ? 'check-circle' : 'clock' }}"></i>
                                    {{ $user->email_verified_at ? 'Verificado' : 'Pendiente' }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <strong>Creado:</strong>
                                <span class="text-muted">{{ $user->created_at->format('d/m/Y H:i:s') }}</span>
                            </div>

                            <div class="mb-3">
                                <strong>Última Actualización:</strong>
                                <span class="text-muted">{{ $user->updated_at->format('d/m/Y H:i:s') }}</span>
                            </div>
                        @endif

                        {{-- Botones de acción con permisos --}}
                        <div class="d-flex justify-content-between mt-4">
                            {{-- Botón Volver --}}
                            @can('ver usuarios')
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-arrow-left"></i> Volver a Lista
                                </a>
                            @else
                                <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            @endcan

                            {{-- Botón Editar con restricciones --}}
                            @can('actualizar usuarios')
                                {{-- Admin puede editar cualquier usuario --}}
                                @if(auth()->user()->hasRole('Admin'))
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Editar Usuario
                                    </a>
                                {{-- Autoridad no puede editar Admins --}}
                                @elseif(auth()->user()->hasRole('Autoridad') && !$user->hasRole('Admin'))
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Editar Usuario
                                    </a>
                                @elseif(auth()->user()->hasRole('Autoridad') && $user->hasRole('Admin'))
                                    <button class="btn btn-sm btn-secondary" disabled title="No puedes editar administradores">
                                        <i class="fas fa-lock"></i> Protegido
                                    </button>
                                @endif
                            @else
                                <span class="text-muted">
                                    <i class="fas fa-info-circle"></i> Sin permisos de edición
                                </span>
                            @endcan
                        </div>

                        {{-- Acciones adicionales solo para Admin --}}
                        @if(auth()->user()->hasRole('Admin'))
                            <hr>
                            <div class="text-center">
                                <small class="text-muted">
                                    <i class="fas fa-crown text-warning"></i>
                                    Funciones de administrador disponibles
                                </small>
                            </div>
                        @endif
                    </x-adminlte-card>
                </div>
            </div>
        @endif
    @endcannot
</div>
@stop

@push('css')
    <style>
        .badge {
            font-size: 0.875em;
            padding: 0.4em 0.6em;
        }
        
        .badge i {
            margin-right: 0.25em;
        }

        .text-muted {
            font-weight: 500;
        }

        hr {
            margin: 1.5rem 0;
            border-top: 1px solid #dee2e6;
        }

        .btn[disabled] {
            cursor: not-allowed;
        }
    </style>
@endpush

@push('js')
    <script>
        // Solo cargar JavaScript si el usuario tiene permisos de ver
        @can('ver usuarios')
        document.addEventListener('DOMContentLoaded', function() {
            // Agregar tooltip a botones deshabilitados
            const disabledButtons = document.querySelectorAll('button[disabled]');
            disabledButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    // Puedes agregar lógica adicional aquí si necesitas tooltips más avanzados
                });
            });
        });
        @endcan
    </script>
@endpush