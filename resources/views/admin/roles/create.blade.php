@extends('layouts.main')

@section('subtitle', 'Crear Rol')
@section('content_header_title', 'Roles')
@section('content_header_subtitle', 'Creación de nuevo rol')

@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    {{-- Verificar si el usuario tiene permiso para crear roles --}}
    @cannot('crear roles')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <x-adminlte-card title="Acceso Denegado" theme="danger" icon="fas fa-exclamation-triangle">
                    <div class="text-center">
                        <i class="fas fa-lock fa-4x text-danger mb-3"></i>
                        <h4>No tienes permisos</h4>
                        <p class="text-muted">No tienes los permisos necesarios para crear roles.</p>
                        
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
        {{-- Verificar que solo Admin puede crear roles --}}
        @if(!auth()->user()->hasRole('Admin'))
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <x-adminlte-card title="Acción Restringida" theme="warning" icon="fas fa-shield-alt">
                        <div class="text-center">
                            <i class="fas fa-user-shield fa-4x text-warning mb-3"></i>
                            <h4>Solo administradores pueden crear roles</h4>
                            <p class="text-muted">Como usuario "{{ auth()->user()->roles->first()?->name }}", no puedes crear nuevos roles del sistema.</p>
                            <p class="text-muted">Solo los administradores pueden gestionar la configuración de roles y permisos.</p>

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
            {{-- Formulario de creación para Admin --}}
            {{-- Mensaje de éxito con desaparición automática --}}
            @if (session('success'))
                <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
                    {{ session('success') }}
                </x-adminlte-alert>
            @endif

            {{-- Alertas de errores de validación --}}
            <div id="validation-alert" style="display: none;">
                <x-adminlte-alert theme="danger" id="error-alert" title="Errores de validación" dismissable>
                    <ul id="error-list" class="mb-0"></ul>
                </x-adminlte-alert>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <x-adminlte-card title="Crear Nuevo Rol" theme="success" icon="fas fa-plus-circle" collapsible>
                        <form method="POST" action="{{ route('roles.store') }}" id="roleForm">
                            @csrf

                            {{-- Nombre del rol --}}
                            <x-adminlte-input name="name" label="Nombre del Rol" placeholder="Ej. Supervisor"
                                label-class="text-success" value="{{ old('name') }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-success">
                                        <i class="fas fa-users-cog text-white"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            {{-- Selección de permisos --}}
                            <div class="form-group">
                                <label class="text-success">
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
                                                                    <div class="form-check">
                                                                        <input class="form-check-input permission-checkbox" 
                                                                               type="checkbox" 
                                                                               name="permissions[]" 
                                                                               value="{{ $permission->id }}" 
                                                                               id="permission-{{ $permission->id }}"
                                                                               data-category="{{ $categoryName }}"
                                                                               {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
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
                                
                                <x-adminlte-button class="btn-sm" type="submit" label="Crear Rol" theme="success"
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
        #success-alert {
            transition: opacity 0.5s ease;
        }

        #success-alert[style*="display: none"] {
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

        /* Colores específicos para badges */
        .badge-danger { background-color: #dc3545 !important; }
        .badge-warning { background-color: #ffc107 !important; color: #212529 !important; }
        .badge-info { background-color: #17a2b8 !important; }
        .badge-secondary { background-color: #6c757d !important; }
    </style>
@endpush

{{-- JS extra --}}
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cerrar alerta de éxito automáticamente
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000);
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
            document.getElementById('validation-alert').style.display = 'none';
        }

        // Manejar envío del formulario
        document.getElementById('roleForm').addEventListener('submit', function(e) {
            e.preventDefault();

            hideValidationErrors();

            const saveButton = document.getElementById('saveButton');
            saveButton.disabled = true;
            saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creando...';

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
                        title: 'Rol Creado',
                        text: data.message || 'Rol creado correctamente.',
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
                saveButton.innerHTML = '<i class="fas fa-save"></i> Crear Rol';
            });
        });
    </script>
@endpush