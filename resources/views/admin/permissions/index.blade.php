@extends('layouts.main')

@section('subtitle', 'Permisos')
@section('content_header_title', 'Permisos')
@section('content_header_subtitle', 'Bienvenido a la gestión de permisos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)

@section('content_body')
<div class="container-fluid">
    {{-- Header mejorado con gradiente --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-gradient-primary text-white rounded">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-0 font-weight-bold">
                        <i class="fas fa-shield-alt mr-2"></i>GESTIÓN DE PERMISOS
                    </h2>
                    <p class="mb-0 mt-2 opacity-8">
                        Administra los permisos del sistema y sus asignaciones
                    </p>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                    <div class="d-flex justify-content-md-end align-items-center">
                        <div class="bg-white bg-opacity-20 px-3 py-2 rounded mr-3">
                            <span class="h4 mb-0 font-weight-bold">{{ $permissions->count() }}</span>
                            <small class="d-block">Total Permisos</small>
                        </div>
                        @can('crear permisos')
                            <a href="{{ route('permissions.create') }}" class="btn btn-light btn-sm shadow-sm">
                                <i class="fas fa-plus-circle mr-2"></i>Nuevo Permiso
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alertas mejoradas --}}
    @if (session('success'))
        <x-adminlte-alert theme="success" id="success-alert" title="Éxito" dismissable>
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </x-adminlte-alert>
    @elseif (session('error'))
        <x-adminlte-alert theme="danger" id="error-alert" title="Error" dismissable>
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </x-adminlte-alert>
    @elseif (session('warning'))
        <x-adminlte-alert theme="warning" id="warning-alert" title="Advertencia" dismissable>
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('warning') }}
        </x-adminlte-alert>
    @endif

    {{-- Filtros adicionales --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body py-2">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label class="mb-0 small text-muted">Filtrar por Guard:</label>
                        <select id="guardFilter" class="form-control form-control-sm">
                            <option value="">Todos los Guards</option>
                            <option value="web">Web</option>
                            <option value="api">API</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label class="mb-0 small text-muted">Buscar por nombre:</label>
                        <input type="text" id="nameSearch" class="form-control form-control-sm" placeholder="Buscar permiso...">
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <button id="clearFilters" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times mr-1"></i>Limpiar Filtros
                    </button>
                    @can('exportar permisos')
                        <button id="exportExcel" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-file-excel mr-1"></i>Exportar Excel
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de permisos --}}
    <div class="row">
        <div class="col-12">
            <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" 
                           title="Lista de Permisos" icon="fas fa-shield-alt">

                @php
                    $heads = [
                        ['label' => '#', 'width' => 5],
                        ['label' => 'Nombre del Permiso', 'width' => 35],
                        ['label' => 'Guard', 'width' => 15],
                        ['label' => 'Roles Asignados', 'width' => 20],
                        ['label' => 'Creado', 'width' => 15],
                        ['label' => 'Acciones', 'no-export' => true, 'width' => 10],
                    ];

                    $config = [
                        'language' => ['url' => asset('/assets/js/es-ES.json')],
                        'responsive' => true,
                        'autoWidth' => false,
                        'paging' => true,
                        'searching' => true,
                        'ordering' => true,
                        'pageLength' => 10,
                        'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                        'dom' => '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
                        'buttons' => ['excel', 'pdf', 'print'],
                        'order' => [[0, 'asc']],
                        'columnDefs' => [
                            ['className' => 'text-center', 'targets' => [0, 2, 4, 5]],
                            ['orderable' => false, 'targets' => [5]]
                        ]
                    ];
                @endphp

                <x-adminlte-datatable id="permissionsTable" :heads="$heads" :config="$config" 
                                    striped hoverable bordered compressed>
                    @foreach ($permissions as $permission)
                        <tr data-guard="{{ $permission->guard_name }}" data-name="{{ strtolower($permission->name) }}">
                            <td>
                                <span class="badge badge-dark">{{ $permission->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-key text-primary mr-2"></i>
                                    <div>
                                        <span class="font-weight-bold">{{ $permission->name }}</span>
                                        @if($permission->description)
                                            <small class="d-block text-muted">{{ $permission->description }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-{{ $permission->guard_name == 'web' ? 'info' : 'warning' }}">
                                    <i class="fas fa-{{ $permission->guard_name == 'web' ? 'globe' : 'code' }} mr-1"></i>
                                    {{ $permission->guard_name ?? 'web' }}
                                </span>
                            </td>
                            <td>
                                @if($permission->roles->count() > 0)
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($permission->roles->take(3) as $role)
                                            <span class="badge badge-secondary">{{ $role->name }}</span>
                                        @endforeach
                                        @if($permission->roles->count() > 3)
                                            <span class="badge badge-dark">+{{ $permission->roles->count() - 3 }}</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted small">Sin roles asignados</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $permission->created_at->format('d/m/Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    @can('ver permisos')
                                        <a href="{{ route('permissions.show', $permission->id) }}"
                                           class="btn btn-sm btn-outline-info" 
                                           data-toggle="tooltip" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                    @can('actualizar permisos')
                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                           class="btn btn-sm btn-outline-primary" 
                                           data-toggle="tooltip" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('eliminar permisos')
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger delete-permission" 
                                                data-id="{{ $permission->id }}"
                                                data-name="{{ $permission->name }}"
                                                data-toggle="tooltip" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>

                {{-- Footer del card con información adicional --}}
                <x-slot name="footerSlot">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-info-circle mr-1"></i>
                            Los permisos controlan el acceso a las funcionalidades del sistema
                        </small>
                        <small class="text-muted">
                            Última actualización: {{ now()->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>

    {{-- Formulario oculto para eliminación --}}
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@stop

@push('css')
    <style>
        /* Estilos mejorados */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .bg-opacity-20 {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .opacity-8 {
            opacity: 0.8;
        }
        
        #permissionsTable tbody tr {
            transition: all 0.3s ease;
        }
        
        #permissionsTable tbody tr:hover {
            transform: translateX(5px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
        
        .btn-group .btn {
            border-radius: 0;
        }
        
        .btn-group .btn:first-child {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }
        
        .btn-group .btn:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }
        
        /* Animación para alertas */
        .alert {
            animation: slideIn 0.5s ease;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Inicializar tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            // DataTable instance
            const table = $('#permissionsTable').DataTable();
            
            // Filtro por Guard
            $('#guardFilter').on('change', function() {
                const guard = $(this).val();
                if (guard) {
                    table.column(2).search(guard).draw();
                } else {
                    table.column(2).search('').draw();
                }
            });
            
            // Búsqueda por nombre
            $('#nameSearch').on('keyup', function() {
                table.column(1).search($(this).val()).draw();
            });
            
            // Limpiar filtros
            $('#clearFilters').on('click', function() {
                $('#guardFilter').val('');
                $('#nameSearch').val('');
                table.search('').columns().search('').draw();
            });
            
            // Exportar a Excel (si tienes la librería)
            $('#exportExcel').on('click', function() {
                table.button('.buttons-excel').trigger();
            });
            
            // Confirmación de eliminación mejorada
            $('.delete-permission').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                
                Swal.fire({
                    title: '¿Eliminar Permiso?',
                    html: `
                        <div class="text-center">
                            <i class="fas fa-shield-alt fa-3x text-danger mb-3"></i>
                            <p>Estás a punto de eliminar el permiso:</p>
                            <p class="font-weight-bold text-primary">"${name}"</p>
                            <p class="text-warning small mt-3">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Esta acción eliminará el permiso de todos los roles asignados
                            </p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '<i class="fas fa-trash mr-1"></i> Sí, eliminar',
                    cancelButtonText: '<i class="fas fa-times mr-1"></i> Cancelar',
                    reverseButtons: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return new Promise((resolve) => {
                            $('#deleteForm').attr('action', `/permissions/${id}`);
                            $('#deleteForm').submit();
                            resolve();
                        });
                    }
                });
            });
            
            // Auto-ocultar alertas con animación
            setTimeout(function() {
                $('.alert').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 5000);
            
            // Toastr para notificaciones rápidas (opcional)
            @if(session('toast_success'))
                toastr.success('{{ session('toast_success') }}');
            @endif
            
            @if(session('toast_error'))
                toastr.error('{{ session('toast_error') }}');
            @endif
        });
        
        //Configuración global de Toastr (solo si está disponible)
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000"
            };
            
            @if(session('toast_success'))
                toastr.success('{{ session('toast_success') }}');
            @endif
            
            @if(session('toast_error'))
                toastr.error('{{ session('toast_error') }}');
            @endif
        }
    </script>
@endpush