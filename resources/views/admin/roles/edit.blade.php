@extends('layouts.main')

@section('subtitle', 'Editar Rol')
@section('content_header_title', 'Roles')
@section('content_header_subtitle', 'Editar rol del sistema')

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
                            <a href="{{ route('roles.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left mr-1"></i> Volver a Roles
                            </a>
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
        @php $user = auth()->user(); @endphp
        @if(!$user->hasRole('Admin'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <x-adminlte-card title="Acción Restringida" theme="warning" icon="fas fa-shield-alt">
                        <div class="text-center">
                            <i class="fas fa-user-shield fa-4x text-warning mb-3"></i>
                            <h4>Solo administradores pueden editar roles</h4>
                            <p class="text-muted">Como usuario "{{ auth()->user()->roles->first()?->name }}", no puedes modificar roles del sistema.</p>
                            <p class="text-muted">Solo los administradores pueden gestionar la configuración de roles y permisos.</p>

                            <div class="mt-3">
                                @can('ver roles')
                                    <a href="{{ route('roles.index') }}" class="btn btn-primary">
                                        <i class="fas fa-users-cog mr-1"></i> Ver Roles
                                    </a>
                                @endcan
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye mr-1"></i> Ver Detalles del Rol
                                </a>
                                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                                </a>
                            </div>
                        </div>
                    </x-adminlte-card>
                </div>
            </div>
        @else
            {{-- Formulario de edición para Admin --}}
            {{-- Mensaje de éxito con desaparición automática --}}
            @if (session('success'))
                <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
                    {{ session('success') }}
                </x-adminlte-alert>
            @endif

            {{-- Mensaje de advertencia para roles del sistema --}}
            @if(session('warning'))
                <x-adminlte-alert theme="warning" id="warning-alert" title="Advertencia" dismissable>
                    {{ session('warning') }}
                </x-adminlte-alert>
            @endif

            {{-- Alertas de errores de validación --}}
            <div id="validation-alert" style="display: none;">
                <x-adminlte-alert theme="danger" id="error-alert" title="Errores de validación" dismissable>
                    <ul id="error-list" class="mb-0"></ul>
                </x-adminlte-alert>
            </div>

            <div class="row">
                {{-- Información del Rol --}}
                <div class="col-md-4">
                    <x-adminlte-card title="Información del Rol" theme="info" icon="fas fa-info-circle" collapsible>
                        <div class="mb-3">
                            <label class="form-label"><strong>Nombre del Rol:</strong></label>
                            <div class="form-control-plaintext">
                                @php
                                    $badgeClass = match($role->name) {
                                        'Admin' => 'badge-danger',
                                        'Autoridad' => 'badge-warning', 
                                        'Usuario' => 'badge-info',
                                        default => 'badge-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} p-2">
                                    <i class="fas fa-user-tag mr-1"></i> {{ $role->name }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"><strong>Guard Name:</strong></label>
                            <div class="form-control-plaintext text-muted">
                                <i class="fas fa-shield-alt mr-1"></i> {{ $role->guard_name }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Permisos Actuales:</strong></label>
                            <div class="form-control-plaintext">
                                <span class="badge badge-primary p-2">
                                    <i class="fas fa-key mr-1"></i> 
                                    <span id="current-permissions-count">{{ $role->permissions->count() }}</span> permisos
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Usuarios con este rol:</strong></label>
                            <div class="form-control-plaintext">
                                <span class="badge badge-success p-2">
                                    <i class="fas fa-users mr-1"></i> {{ $role->users->count() }} usuarios
                                </span>
                            </div>
                        </div>

                        {{-- Advertencia para roles del sistema --}}
                        @if(in_array($role->name, ['Admin', 'Autoridad', 'Usuario']))
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <strong>Rol del Sistema:</strong><br>
                                <small>Modifica con precaución. Este rol tiene configuraciones predefinidas importantes para el funcionamiento del sistema.</small>
                            </div>
                        @endif
                    </x-adminlte-card>
                </div>

                {{-- Formulario de Edición --}}
                <div class="col-md-8">
                    <x-adminlte-card title="Editar Permisos del Rol" theme="primary" icon="fas fa-edit" collapsible>
                        <form method="POST" action="{{ route('roles.update', $role->id) }}" id="roleEditForm">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Selecciona los permisos que debe tener este rol. Los cambios se aplicarán inmediatamente después de guardar.
                                </small>
                            </div>

                            @if(!in_array($role->name, ['Admin', 'Autoridad', 'Usuario']))
                                <x-adminlte-input name="name" label="Nombre del Rol" placeholder="Ej. Supervisor"
                                    label-class="text-primary" value="{{ $role->name }}" required>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-primary">
                                            <i class="fas fa-users-cog text-white"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            @endif

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

                            {{-- Botones de selección global --}}
                            <div class="mb-3 border-bottom pb-3">
                                <button type="button" id="select-all-permissions" class="btn btn-sm btn-success">
                                    <i class="fas fa-check-square"></i> Seleccionar Todos
                                </button>
                                <button type="button" id="deselect-all-permissions" class="btn btn-sm btn-warning">
                                    <i class="fas fa-square"></i> Deseleccionar Todos
                                </button>
                                <span class="ml-3 text-muted">
                                    <i class="fas fa-calculator mr-1"></i>
                                    <span id="selected-count">{{ $role->permissions->count() }}</span> de {{ $permissions->count() }} seleccionados
                                </span>
                            </div>

                            {{-- Organizar permisos por categorías --}}
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
                                            $categorySlug = Str::slug($categoryName);
                                        @endphp
                                        
                                        <div class="card {{ $categoryClass }} border-2">
                                            <div class="card-header p-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="badge {{ $categoryBadge }}">
                                                        <i class="{{ $categoryIcon }}"></i> {{ $categoryName }}
                                                        <small>({{ count($categoryPermissions) }})</small>
                                                    </span>
                                                    <div>
                                                        <button type="button" class="btn btn-sm btn-outline-success select-all-category" 
                                                                data-category="{{ $categorySlug }}">
                                                            <i class="fas fa-check-double"></i> Seleccionar Todo
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary deselect-all-category" 
                                                                data-category="{{ $categorySlug }}">
                                                            <i class="fas fa-times"></i> Deseleccionar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    @foreach($categoryPermissions as $permission)
                                                        <div class="col-md-6 col-lg-4 mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input permission-checkbox category-{{ $categorySlug }}" 
                                                                       type="checkbox" 
                                                                       name="permissions[]" 
                                                                       value="{{ $permission->id }}" 
                                                                       id="permission-{{ $permission->id }}"
                                                                       data-category="{{ $categorySlug }}"
                                                                       {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="permission-{{ $permission->id }}">
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

                            {{-- Botones de envío --}}
                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    @can('ver roles')
                                        <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-arrow-left mr-1"></i> Volver a Roles
                                        </a>
                                    @else
                                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                                        </a>
                                    @endcan
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm ml-2">
                                        <i class="fas fa-eye mr-1"></i> Ver Detalles
                                    </a>
                                </div>
                                
                                <x-adminlte-button class="btn-sm" type="submit" label="Guardar Cambios" theme="primary"
                                    icon="fas fa-save" id="saveButton" />
                            </div>
                        </form>
                    </x-adminlte-card>
                </div>
            </div>
        @endif
    @endcannot
</div>
@stop

{{-- CSS extra --}}
@push('css')
    <style>
        #success-alert, #warning-alert {
            transition: opacity 0.5s ease;
        }

        #success-alert[style*="display: none"], 
        #warning-alert[style*="display: none"] {
            opacity: 0;
        }

        #validation-alert {
            transition: opacity 0.3s ease;
            margin-bottom: 20px;
        }

        #validation-alert[style*="display: none"] {
            opacity: 0;
        }

        .permission-category .card-header {
            background-color: #f8f9fa;
        }

        .form-check {
            padding-left: 1.5rem;
        }

        .form-check-input {
            margin-top: 0.2rem;
        }

        .form-check-label {
            margin-bottom: 0;
            cursor: pointer;
        }

        .form-check-label:hover {
            color: #007bff;
        }

        .form-check-input:checked + .form-check-label {
            font-weight: 600;
            color: #007bff;
        }

        /* Colores específicos para badges */
        .badge-danger { background-color: #dc3545 !important; }
        .badge-warning { background-color: #ffc107 !important; color: #212529 !important; }
        .badge-info { background-color: #17a2b8 !important; }
        .badge-secondary { background-color: #6c757d !important; }
        .badge-success { background-color: #28a745 !important; }
        .badge-primary { background-color: #007bff !important; }

        .badge {
            font-size: 0.8rem;
        }
    </style>
@endpush

{{-- JS extra --}}
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cerrar alertas automáticamente
            const successAlert = document.getElementById('success-alert');
            const warningAlert = document.getElementById('warning-alert');
            
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 4000);
            }
            
            if (warningAlert) {
                setTimeout(() => {
                    warningAlert.style.display = 'none';
                }, 6000);
            }

            // Función para actualizar contador
            function updateSelectedCount() {
                const checkedBoxes = document.querySelectorAll('input[name="permissions[]"]:checked').length;
                const totalBoxes = document.querySelectorAll('input[name="permissions[]"]').length;
                document.getElementById('selected-count').textContent = checkedBoxes;
                document.getElementById('current-permissions-count').textContent = checkedBoxes;
            }

            // Seleccionar todos los permisos
            document.getElementById('select-all-permissions').addEventListener('click', function() {
                document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                    checkbox.checked = true;
                });
                updateSelectedCount();
            });

            // Deseleccionar todos los permisos
            document.getElementById('deselect-all-permissions').addEventListener('click', function() {
                document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
                updateSelectedCount();
            });

            // Seleccionar toda una categoría
            document.querySelectorAll('.select-all-category').forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.dataset.category;
                    document.querySelectorAll(`.category-${category}`).forEach(checkbox => {
                        checkbox.checked = true;
                    });
                    updateSelectedCount();
                });
            });

            // Deseleccionar toda una categoría
            document.querySelectorAll('.deselect-all-category').forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.dataset.category;
                    document.querySelectorAll(`.category-${category}`).forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    updateSelectedCount();
                });
            });

            // Actualizar contador cuando se marque/desmarque un checkbox individual
            document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedCount);
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
            document.getElementById('validation-alert').style.display = 'none';
        }

        // Manejar envío del formulario
        document.getElementById('roleEditForm').addEventListener('submit', function(e) {
            e.preventDefault();

            hideValidationErrors();

            const saveButton = document.getElementById('saveButton');
            const checkedPermissions = document.querySelectorAll('input[name="permissions[]"]:checked').length;
            
            // Confirmación si no se selecciona ningún permiso
            if (checkedPermissions === 0) {
                Swal.fire({
                    title: '¡Atención!',
                    text: 'No has seleccionado ningún permiso. ¿Estás seguro de que quieres continuar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, continuar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitForm();
                    }
                });
                return;
            }

            submitForm();

            function submitForm() {
                saveButton.disabled = true;
                saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';

                const formData = new FormData(document.getElementById('roleEditForm'));

                fetch(document.getElementById('roleEditForm').action, {
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
                    if (data.success || data.redirect) {
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
                    saveButton.disabled = false;
                    saveButton.innerHTML = '<i class="fas fa-save"></i> Guardar Cambios';
                });
            }
        });
    </script>
@endpush