@extends('layouts.main')

@section('subtitle', 'Editar Rol')
@section('content_header_title', 'Roles')
@section('content_header_subtitle', 'Editar información del rol')

@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    {{-- Verificar si el usuario tiene permiso para actualizar roles --}}
    @cannot('actualizar roles')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-adminlte-card title="Acceso Denegado" theme="danger" icon="fas fa-exclamation-triangle">
                    <div class="text-center">
                        <i class="fas fa-lock fa-4x text-danger mb-3"></i>
                        <h4>No tienes permisos</h4>
                        <p class="text-muted">No tienes los permisos necesarios para editar roles.</p>
                        
                        <div class="mt-3">
                            @can('ver roles')
                                <a href="{{ route('roles.index') }}" class="btn btn-primary">
                                    <i class="fas fa-users-cog mr-1"></i> Ver Roles
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
        {{-- Verificar que solo Admin puede editar roles --}}
        @if(!auth()->user()->hasRole('Admin'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <x-adminlte-card title="Acción Restringida" theme="warning" icon="fas fa-shield-alt">
                        <div class="text-center">
                            <i class="fas fa-user-shield fa-4x text-warning mb-3"></i>
                            <h4>Solo administradores pueden editar roles</h4>
                            <p class="text-muted">Como usuario "{{ auth()->user()->roles->first()?->name }}", no puedes modificar roles del sistema.</p>
                            <p class="text-muted">Solo los administradores pueden gestionar la configuración de roles y permisos.</p>

                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle"></i>
                                <strong>Rol a editar:</strong> {{ $role->name }}
                            </div>

                            <div class="mt-3">
                                @can('ver roles')
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye mr-1"></i> Ver Detalles
                                    </a>
                                    <a href="{{ route('roles.index') }}" class="btn btn-primary">
                                        <i class="fas fa-users-cog mr-1"></i> Ver Roles
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
            {{-- Verificar si es un rol del sistema protegido --}}
            @if(in_array($role->name, ['Admin', 'Autoridad', 'Usuario']))
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-adminlte-card title="Rol del Sistema Protegido" theme="danger" icon="fas fa-shield-alt">
                            <div class="text-center">
                                <i class="fas fa-shield-alt fa-4x text-danger mb-3"></i>
                                <h4>Este rol no puede ser modificado</h4>
                                <p class="text-muted">El rol "{{ $role->name }}" es un rol del sistema y está protegido contra modificaciones.</p>
                                <p class="text-muted">Los roles principales del sistema mantienen su configuración original para garantizar la seguridad.</p>

                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Rol protegido:</strong> {{ $role->name }} con {{ $role->permissions->count() }} permisos
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye mr-1"></i> Ver Detalles del Rol
                                    </a>
                                    <a href="{{ route('roles.index') }}" class="btn btn-primary">
                                        <i class="fas fa-users-cog mr-1"></i> Ver Todos los Roles
                                    </a>
                                </div>
                            </div>
                        </x-adminlte-card>
                    </div>
                </div>
            @else
                {{-- Formulario de edición para roles personalizados --}}
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

                @if (session('error'))
                    <x-adminlte-alert theme="danger" id="error-alert" title="Error" dismissable>
                        {{ session('error') }}
                    </x-adminlte-alert>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <x-adminlte-card title="Editar Rol Personalizado" theme="warning" icon="fas fa-user-edit" collapsible>
                            
                            {{-- Información del rol actual --}}
                            <div class="alert alert-info mb-3">
                                <i class="fas fa-info-circle"></i>
                                <strong>Editando:</strong> {{ $role->name }} 
                                <span class="badge badge-light ml-2">{{ $role->permissions->count() }} permisos actuales</span>
                            </div>

                            <form method="POST" action="{{ route('roles.update', $role->id) }}" id="roleForm">
                                @csrf
                                @method('PUT')
                                
                                {{-- Nombre del rol --}}
                                <x-adminlte-input
                                    name="name"
                                    label="Nombre del Rol"
                                    placeholder="Ej. Desarrollador del Sistema"
                                    label-class="text-warning"
                                    value="{{ old('name', $role->name) }}"
                                    required
                                    class="uppercase-input">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-warning">
                                            <i class="fas fa-user-tag text-white"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>

                                {{-- Selección de permisos con categorización --}}
                                <div class="form-group">
                                    <label class="text-warning">
                                        <strong>Permisos del Rol</strong>
                                        <small class="text-muted">(Selecciona los permisos que tendrá este rol)</small>
                                    </label>

                                    {{-- Leyenda de colores --}}
                                    <div class="mb-3 p-2 bg-light rounded">
                                        <small class="text-muted">
                                            <strong>Categorías:</strong>
                                            <span class="badge badge-danger mr-1">Sistema Crítico</span>
                                            <span class="badge badge-warning mr-1">Organización</span>
                                            <span class="badge badge-info mr-1">Activos</span>
                                            <span class="badge badge-secondary mr-1">Otros</span>
                                        </small>
                                    </div>

                                    @if($permissions->count() > 0)
                                        {{-- Agrupar permisos por categoría --}}
                                        @php
                                            $categorizedPermissions = [
                                                'Sistema Crítico' => [],
                                                'Organización' => [],
                                                'Gestión de Activos' => [],
                                                'Otros' => []
                                            ];

                                            foreach($permissions as $permission) {
                                                if (str_contains($permission->name, 'usuarios') || str_contains($permission->name, 'roles') || str_contains($permission->name, 'permisos')) {
                                                    $categorizedPermissions['Sistema Crítico'][] = $permission;
                                                } elseif (str_contains($permission->name, 'oficinas') || str_contains($permission->name, 'puestos') || str_contains($permission->name, 'contratos') || str_contains($permission->name, 'trabajadores')) {
                                                    $categorizedPermissions['Organización'][] = $permission;
                                                } elseif (str_contains($permission->name, 'activos') || str_contains($permission->name, 'hardware') || str_contains($permission->name, 'software') || str_contains($permission->name, 'mobiliarios') || str_contains($permission->name, 'maquinaria') || str_contains($permission->name, 'herramientas')) {
                                                    $categorizedPermissions['Gestión de Activos'][] = $permission;
                                                } else {
                                                    $categorizedPermissions['Otros'][] = $permission;
                                                }
                                            }
                                        @endphp

                                        {{-- Mostrar permisos por categorías --}}
                                        @foreach($categorizedPermissions as $categoryName => $categoryPermissions)
                                            @if(count($categoryPermissions) > 0)
                                                <div class="permission-category mb-4">
                                                    @php
                                                        $categoryClass = match($categoryName) {
                                                            'Sistema Crítico' => 'border-danger',
                                                            'Organización' => 'border-warning',
                                                            'Gestión de Activos' => 'border-info',
                                                            default => 'border-secondary'
                                                        };
                                                        $categoryBadge = match($categoryName) {
                                                            'Sistema Crítico' => 'badge-danger',
                                                            'Organización' => 'badge-warning',
                                                            'Gestión de Activos' => 'badge-info',
                                                            default => 'badge-secondary'
                                                        };
                                                        $categoryIcon = match($categoryName) {
                                                            'Sistema Crítico' => 'fas fa-shield-alt',
                                                            'Organización' => 'fas fa-building',
                                                            'Gestión de Activos' => 'fas fa-boxes',
                                                            default => 'fas fa-cog'
                                                        };
                                                    @endphp
                                                    
                                                    <div class="card {{ $categoryClass }} border-2">
                                                        <div class="card-header p-2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <span class="badge {{ $categoryBadge }}">
                                                                    <i class="{{ $categoryIcon }}"></i> {{ $categoryName }}
                                                                </span>
                                                                <div>
                                                                    <button type="button" class="btn btn-sm btn-outline-success select-all-category" 
                                                                            data-category="{{ $categoryName }}">
                                                                        <i class="fas fa-check-double"></i> Seleccionar Todo
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-outline-secondary deselect-all-category" 
                                                                            data-category="{{ $categoryName }}">
                                                                        <i class="fas fa-times"></i> Deseleccionar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-3">
                                                            <div class="row">
                                                                @foreach($categoryPermissions as $permission)
                                                                    <div class="col-md-6 col-lg-4 mb-2">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                   name="permissions[]"
                                                                                   id="permission_{{ $permission->id }}"
                                                                                   value="{{ $permission->name }}"
                                                                                   {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                                                   class="custom-control-input permission-checkbox"
                                                                                   data-category="{{ $categoryName }}">
                                                                            <label class="custom-control-label" for="permission_{{ $permission->id }}">
                                                                                <small>{{ $permission->name }}</small>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            No hay permisos disponibles en el sistema.
                                        </div>
                                    @endif
                                </div>

                                {{-- Botones --}}
                                <div class="d-flex justify-content-between mt-4">
                                    @can('ver roles')
                                        <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-arrow-left mr-1"></i> Volver a Roles
                                        </a>
                                    @else
                                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                                        </a>
                                    @endcan
                                    
                                    <x-adminlte-button
                                        class="btn-sm"
                                        type="submit"
                                        label="Actualizar Rol"
                                        theme="warning"
                                        icon="fas fa-save"
                                        id="updateButton" />
                                </div>
                            </form>
                        </x-adminlte-card>
                    </div>
                </div>
            @endif
        @endif
    @endcannot
</div>
@stop

@push('css')
    <style>
        #success-alert { transition: opacity 0.5s ease; }
        #success-alert[style*="display: none"] { opacity: 0; }
        #error-alert { transition: opacity 0.5s ease; }
        #error-alert[style*="display: none"] { opacity: 0; }
        
        #validation-alert {
            transition: opacity 0.3s ease;
            margin-bottom: 20px;
        }
        #validation-alert[style*="display: none"] {
            opacity: 0;
        }
        
        .uppercase-input { text-transform: uppercase; }
        
        .permission-category .card-header {
            background-color: #f8f9fa;
        }

        .custom-control {
            padding-left: 1.5rem;
        }

        .custom-control-input {
            margin-top: 0.2rem;
        }

        .custom-control-label {
            margin-bottom: 0;
            cursor: pointer;
        }

        .custom-control-label:hover {
            color: #007bff;
        }

        /* Colores específicos para badges */
        .badge-danger { background-color: #dc3545 !important; }
        .badge-warning { background-color: #ffc107 !important; color: #212529 !important; }
        .badge-info { background-color: #17a2b8 !important; }
        .badge-secondary { background-color: #6c757d !important; }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Convertir a mayúsculas
            document.querySelectorAll('.uppercase-input').forEach(input => {
                input.addEventListener('input', function(e) {
                    this.value = this.value.toUpperCase();
                });
            });

            // Cerrar alertas automáticamente
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => { successAlert.style.display = 'none'; }, 3000);
            }

            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(() => { errorAlert.style.display = 'none'; }, 10000);
            }

            // Botones seleccionar/deseleccionar por categoría
            document.querySelectorAll('.select-all-category').forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.dataset.category;
                    const checkboxes = document.querySelectorAll(`input[data-category="${category}"]`);
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = true;
                    });
                });
            });

            document.querySelectorAll('.deselect-all-category').forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.dataset.category;
                    const checkboxes = document.querySelectorAll(`input[data-category="${category}"]`);
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                });
            });
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
            const validationAlert = document.getElementById('validation-alert');
            if (validationAlert) {
                validationAlert.style.display = 'none';
            }
        }

        // Manejar envío del formulario (si existe)
        const roleForm = document.getElementById('roleForm');
        if (roleForm) {
            roleForm.addEventListener('submit', function(e) {
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
                            title: 'Rol Actualizado',
                            text: data.message || 'Rol actualizado correctamente.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '{{ route("roles.index") }}';
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
                    updateButton.innerHTML = '<i class="fas fa-save"></i> Actualizar Rol';
                });
            });
        }
    </script>
@endpush