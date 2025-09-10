@extends('layouts.main')

@section('subtitle', 'Roles')
@section('content_header_title', 'Roles')
@section('content_header_subtitle', 'Bienvenido a la gestión de roles')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

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
                        <p class="text-muted">No tienes los permisos necesarios para ver la gestión de roles.</p>
                        
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
        <!-- Título mejorado con HTML puro -->
        <div class="card-header bg-primary text-white text-center py-3 mb-4">
            <h2 class="mb-0">ROLES</h2>
            <div class="mt-2">
                <span class="ml-2"><i class="fas fa-users-cog mr-1"></i> Gestión de Roles</span>
                <span class="badge badge-light">{{ $roles->count() }} Rol{{ $roles->count() !== 1 ? 'es' : '' }}</span>
            </div>
        </div>

        @if (session('success'))
            <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
                {{ session('success') }}
            </x-adminlte-alert>
        @elseif (session('error'))
            <x-adminlte-alert theme="danger" id="error-alert" title="Error" dismissable>
                {{ session('error') }}
            </x-adminlte-alert>
        @endif

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div>
                        @if(auth()->user()->hasRole('Autoridad'))
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i>
                                Como "Autoridad", puedes consultar roles pero no modificarlos.
                            </small>
                        @endif
                    </div>
                    <div>
                        {{-- Botón Crear solo para Admin --}}
                        @can('crear roles')
                            @if(auth()->user()->hasRole('Admin'))
                                <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus mr-2"></i> Crear Rol
                                </a>
                            @endif
                        @endcan
                    </div>
                </div>

                <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Roles Registrados">
                    @php
                        $heads = [
                            ['label' => 'ID', 'width' => 3],
                            ['label' => 'Nombre', 'width' => 15],
                            ['label' => 'Guard Name', 'width' => 12],
                            ['label' => 'Permisos', 'width' => 55],
                            ['label' => 'Acciones', 'no-export' => true, 'width' => 15],
                        ];

                        $config = [
                            'language' => [
                                'url' => asset('/assets/js/es-ES.json'),
                            ],
                            'responsive' => true,
                            'autoWidth' => false,
                            'paging' => true,
                            'searching' => true,
                            'ordering' => true,
                            'pageLength' => 10,
                        ];
                    @endphp

                    <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable bordered sm>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>
                                    @php
                                        $badgeClass = match($role->name) {
                                            'Admin' => 'badge-danger',
                                            'Autoridad' => 'badge-warning', 
                                            'Usuario' => 'badge-info',
                                            default => 'badge-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $role->name }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $role->guard_name }}</span>
                                </td>
                                <td>
                                    {{-- Mostrar permisos con categorización --}}
                                    @php $permissionCount = $role->permissions->count(); @endphp
                                    
                                    @if($permissionCount > 10)
                                        {{-- Si hay muchos permisos, mostrar solo los primeros con un botón para expandir --}}
                                        <div class="permissions-container">
                                            <div class="permissions-preview">
                                                @foreach ($role->permissions->take(8) as $permission)
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
                                                    <span class="badge {{ $permissionClass }} mr-1 mb-1" style="font-size: 0.7rem;">
                                                        {{ $permission->name }}
                                                    </span>
                                                @endforeach
                                                <button class="btn btn-link btn-sm p-0 expand-permissions" 
                                                        data-role-id="{{ $role->id }}" 
                                                        title="Ver todos los permisos">
                                                    <small class="text-primary">
                                                        +{{ $permissionCount - 8 }} más...
                                                    </small>
                                                </button>
                                            </div>
                                            <div class="permissions-full" style="display: none;">
                                                @foreach ($role->permissions as $permission)
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
                                                    <span class="badge {{ $permissionClass }} mr-1 mb-1" style="font-size: 0.7rem;">
                                                        {{ $permission->name }}
                                                    </span>
                                                @endforeach
                                                <button class="btn btn-link btn-sm p-0 collapse-permissions" 
                                                        data-role-id="{{ $role->id }}">
                                                    <small class="text-secondary">Mostrar menos</small>
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        {{-- Si hay pocos permisos, mostrar todos --}}
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
                                            <span class="badge {{ $permissionClass }} mr-1 mb-1" style="font-size: 0.75rem;">
                                                {{ $permission->name }}
                                            </span>
                                        @empty
                                            <span class="text-muted">Sin permisos</span>
                                        @endforelse
                                    @endif

                                    {{-- Contador de permisos --}}
                                    <div class="mt-1">
                                        <small class="text-muted">
                                            <i class="fas fa-key"></i> {{ $permissionCount }} permiso{{ $permissionCount !== 1 ? 's' : '' }}
                                        </small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Botón Ver --}}
                                        @can('ver roles')
                                            <a href="{{ route('roles.show', $role->id) }}"
                                               class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del rol">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan

                                        {{-- Botón Editar (solo Admin) --}}
                                        @can('actualizar roles')
                                            @if(auth()->user()->hasRole('Admin'))
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                   class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar rol">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                        @endcan

                                        {{-- Botón Eliminar (solo Admin y con restricciones) --}}
                                        @can('eliminar roles')
                                            @if(auth()->user()->hasRole('Admin'))
                                                {{-- No permitir eliminar roles del sistema (Admin, Autoridad, Usuario) --}}
                                                @if(!in_array($role->name, ['Admin', 'Autoridad', 'Usuario']))
                                                    <form id="deleteForm{{ $role->id }}" class="d-inline" method="POST"
                                                          action="{{ route('roles.destroy', $role->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1"
                                                                title="Eliminar rol" onclick="confirmDelete({{ $role->id }}, '{{ $role->name }}', {{ $role->permissions->count() }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-sm btn-outline-secondary shadow-sm mx-1" disabled 
                                                            title="Rol del sistema protegido">
                                                        <i class="fas fa-shield-alt"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </x-adminlte-card>
            </div>
        </div>
    @endcannot
</div>
@stop

{{-- Extra CSS --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/roles/index.css') }}">
    <style>
        #success-alert {
            transition: opacity 0.5s ease;
        }
        #success-alert[style*="display: none"] {
            opacity: 0;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25em 0.4em;
        }

        .permissions-container {
            max-width: 100%;
        }

        .expand-permissions, .collapse-permissions {
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            vertical-align: baseline;
        }

        .expand-permissions:hover, .collapse-permissions:hover {
            text-decoration: underline !important;
        }

        /* Colores específicos para badges */
        .badge-danger { background-color: #dc3545 !important; }
        .badge-warning { background-color: #ffc107 !important; color: #212529 !important; }
        .badge-info { background-color: #17a2b8 !important; }
        .badge-secondary { background-color: #6c757d !important; }

        .btn[disabled] {
            cursor: not-allowed;
        }
    </style>
@endpush

{{-- Scripts JS --}}
@push('js')
    <script>
        // Función para expandir/colapsar permisos
        document.addEventListener('click', function(e) {
            if (e.target.closest('.expand-permissions')) {
                const roleId = e.target.closest('.expand-permissions').dataset.roleId;
                const container = e.target.closest('.permissions-container');
                container.querySelector('.permissions-preview').style.display = 'none';
                container.querySelector('.permissions-full').style.display = 'block';
            }
            
            if (e.target.closest('.collapse-permissions')) {
                const roleId = e.target.closest('.collapse-permissions').dataset.roleId;
                const container = e.target.closest('.permissions-container');
                container.querySelector('.permissions-preview').style.display = 'block';
                container.querySelector('.permissions-full').style.display = 'none';
            }
        });

        // Función para confirmación de eliminación mejorada
        function confirmDelete(id, roleName, permissionCount) {
            Swal.fire({
                title: '¿Eliminar rol?',
                html: `
                    <div class="text-left">
                        <p><strong>Rol:</strong> ${roleName}</p>
                        <p><strong>Permisos asociados:</strong> ${permissionCount}</p>
                        <br>
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> Esta acción eliminará el rol y todos sus permisos asociados.</p>
                        <p class="text-warning"><small>Los usuarios con este rol mantendrán sus otros roles.</small></p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '<i class="fas fa-trash"></i> Sí, eliminar',
                cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar loading
                    Swal.fire({
                        title: 'Eliminando...',
                        text: 'Por favor espere',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }

        // Cerrar alerta de éxito automáticamente
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000);
            }

            // Inicializar DataTable
            if ($.fn.DataTable.isDataTable('#table1')) {
                $('#table1').DataTable();
            }
        });
    </script>
@endpush