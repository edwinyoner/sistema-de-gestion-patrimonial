@extends('layouts.main')

{{-- Personalización de secciones del layout --}}
@section('subtitle', 'Detalle del Rol')
@section('content_header_title', 'Rol')
@section('content_header_subtitle', 'Detalles del Rol')

{{-- Cuerpo principal --}}
@section('content_body')
<div class="container-fluid">
    {{-- Verificar si el usuario tiene permiso para ver roles --}}
    @cannot('ver roles')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-adminlte-card title="Acceso Denegado" theme="danger" icon="fas fa-exclamation-triangle">
                    <div class="text-center">
                        <i class="fas fa-lock fa-4x text-danger mb-3"></i>
                        <h4>No tienes permisos</h4>
                        <p class="text-muted">No tienes los permisos necesarios para ver detalles de roles.</p>
                        
                        <div class="mt-3">
                            @can('ver usuarios')
                                <a href="{{ route('users.index') }}" class="btn btn-primary">
                                    <i class="fas fa-users mr-1"></i> Gestión de Usuarios
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
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <x-adminlte-card title="Información del Rol" theme="info" icon="fas fa-users-cog">
                    
                    {{-- Información básica del rol --}}
                    <div class="mb-3">
                        <strong>ID:</strong>
                        <span class="text-muted">{{ $role->id }}</span>
                    </div>

                    <div class="mb-3">
                        <strong>Nombre del Rol:</strong>
                        @php
                            $badgeClass = match($role->name) {
                                'Admin' => 'badge-danger',
                                'Autoridad' => 'badge-warning', 
                                'Usuario' => 'badge-info',
                                default => 'badge-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} ml-1">{{ $role->name }}</span>
                    </div>

                    {{-- Información adicional solo para Admin --}}
                    @if(auth()->user()->hasRole('Admin'))
                        <div class="mb-3">
                            <strong>Guard Name:</strong>
                            <span class="text-muted">{{ $role->guard_name }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Creado:</strong>
                            <span class="text-muted">{{ $role->created_at->format('d/m/Y H:i:s') }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Última Actualización:</strong>
                            <span class="text-muted">{{ $role->updated_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                    @endif

                    {{-- Permisos asociados --}}
                    <div class="mb-3">
                        <strong>Permisos Asociados:</strong>
                        <div class="mt-2">
                            @forelse ($role->permissions as $permission)
                                @php
                                    // Categorizar permisos por color
                                    $permissionClass = 'badge-secondary';
                                    
                                    if (str_contains($permission->name, 'usuarios') || str_contains($permission->name, 'roles') || str_contains($permission->name, 'permisos')) {
                                        $permissionClass = 'badge-danger';
                                    } elseif (str_contains($permission->name, 'oficinas') || str_contains($permission->name, 'puestos') || str_contains($permission->name, 'contratos') || str_contains($permission->name, 'trabajadores')) {
                                        $permissionClass = 'badge-warning';
                                    } elseif (str_contains($permission->name, 'activos') || str_contains($permission->name, 'hardware') || str_contains($permission->name, 'software') || str_contains($permission->name, 'mobiliarios') || str_contains($permission->name, 'maquinaria') || str_contains($permission->name, 'herramientas')) {
                                        $permissionClass = 'badge-info';
                                    }
                                @endphp
                                <span class="badge {{ $permissionClass }} mr-1 mb-1" title="Categoría: {{ ucfirst(explode(' ', $permission->name)[0]) }}">
                                    {{ $permission->name }}
                                </span>
                            @empty
                                <span class="text-muted">No hay permisos asignados</span>
                            @endforelse
                        </div>
                        
                        {{-- Contador de permisos --}}
                        @if($role->permissions->count() > 0)
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Total de permisos: <strong>{{ $role->permissions->count() }}</strong>
                                </small>
                            </div>
                        @endif
                    </div>

                    {{-- Usuarios con este rol (solo para Admin) --}}
                    @if(auth()->user()->hasRole('Admin'))
                        <div class="mb-3">
                            <strong>Usuarios con este rol:</strong>
                            <div class="mt-2">
                                @php
                                    $usersWithRole = \App\Models\User::role($role->name)->get();
                                @endphp
                                @forelse ($usersWithRole as $user)
                                    <div class="d-inline-block mr-2 mb-1">
                                        <span class="badge badge-light">
                                            <i class="fas fa-user"></i> {{ $user->name }}
                                            @if(!$user->status)
                                                <i class="fas fa-times-circle text-danger ml-1" title="Usuario inactivo"></i>
                                            @endif
                                        </span>
                                    </div>
                                @empty
                                    <span class="text-muted">No hay usuarios asignados a este rol</span>
                                @endforelse
                            </div>
                            
                            @if($usersWithRole->count() > 0)
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-users"></i>
                                        Total de usuarios: <strong>{{ $usersWithRole->count() }}</strong>
                                        (Activos: {{ $usersWithRole->where('status', true)->count() }})
                                    </small>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Botones de acción con permisos --}}
                    <div class="d-flex justify-content-between mt-4">
                        {{-- Botón Volver --}}
                        @can('ver roles')
                            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-arrow-left"></i> Volver a Roles
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        @endcan

                        {{-- Botón Editar con restricciones --}}
                        @can('actualizar roles')
                            {{-- Solo Admin puede editar roles --}}
                            @if(auth()->user()->hasRole('Admin'))
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Editar Rol
                                </a>
                            @endif
                        @else
                            <span class="text-muted">
                                <i class="fas fa-info-circle"></i> Solo lectura
                            </span>
                        @endcan
                    </div>

                    {{-- Mensaje informativo para Autoridad --}}
                    @if(auth()->user()->hasRole('Autoridad'))
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle"></i>
                            <small>Como "Autoridad", puedes consultar la información de roles pero no modificarla.</small>
                        </div>
                    @endif
                </x-adminlte-card>
            </div>
        </div>
    @endcannot
</div>
@stop

{{-- Estilos adicionales --}}
@push('css')
<style>
.badge {
    font-size: 0.75rem;
    padding: 0.375em 0.5em;
    margin-bottom: 0.25rem;
}

.badge:hover {
    opacity: 0.8;
    cursor: help;
}

/* Colores específicos para categorías de permisos */
.badge-danger { background-color: #dc3545 !important; }
.badge-warning { background-color: #ffc107 !important; color: #212529 !important; }
.badge-info { background-color: #17a2b8 !important; }
.badge-secondary { background-color: #6c757d !important; }
.badge-light { background-color: #f8f9fa !important; color: #495057 !important; }

/* Estilo para badges de usuarios */
.badge-light .fas.fa-times-circle {
    font-size: 0.8em;
}

/* Alert personalizado */
.alert {
    border-left: 4px solid;
}

.alert-info {
    border-left-color: #17a2b8;
}
</style>
@endpush

{{-- Scripts opcionales --}}
@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Agregar tooltips a los badges de permisos
    const permissionBadges = document.querySelectorAll('.badge');
    permissionBadges.forEach(badge => {
        if (!badge.title) {
            badge.setAttribute('data-toggle', 'tooltip');
            badge.setAttribute('data-placement', 'top');
        }
    });

    // Inicializar tooltips si Bootstrap está disponible
    if (typeof $().tooltip === 'function') {
        $('[data-toggle="tooltip"]').tooltip();
    }
});
</script>
@endpush