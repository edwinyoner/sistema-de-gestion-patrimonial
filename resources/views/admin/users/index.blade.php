@extends('layouts.main')

@section('subtitle', 'Lista de Usuarios')
@section('content_header_title', 'Usuarios')
@section('content_header_subtitle', 'Bienvenido a la gestión de usuarios')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

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
                        <p class="text-muted">No tienes los permisos necesarios para ver la lista de usuarios.</p>
                        
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
        <!-- Título mejorado con HTML puro -->
        <div class="card-header bg-primary text-white text-center py-3 mb-4">
            <h2 class="mb-0">USUARIOS</h2>
            <div class="mt-2">
                <span class="ml-2"><i class="fas fa-users mr-1"></i> Gestión de Usuarios</span>
                <span class="badge badge-light">
                    @php
                        // Filtrar usuarios según permisos para mostrar el conteo correcto
                        $visibleUsers = $users;
                        if (auth()->user()->hasRole('Autoridad') || auth()->user()->hasRole('Usuario')) {
                            $visibleUsers = $users->filter(function($user) {
                                return !$user->hasRole('Admin');
                            });
                        }
                    @endphp
                    {{ $visibleUsers->count() }} Usuario{{ $visibleUsers->count() !== 1 ? 's' : '' }}
                </span>
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
                                Como "Autoridad", solo ves usuarios operativos. Los administradores están ocultos.
                            </small>
                        @elseif(auth()->user()->hasRole('Usuario'))
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i>
                                Solo puedes ver usuarios de nivel operativo. Los administradores están ocultos.
                            </small>
                        @endif
                    </div>
                    <div>
                        @can('crear usuarios')
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus mr-2"></i> Crear Usuario
                            </a>
                        @endcan
                    </div>
                </div>

                <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Usuarios Registrados">
                    @php
                        $heads = [
                            ['label' => 'ID', 'width' => 5],
                            ['label' => 'Nombre', 'width' => 25],
                            ['label' => 'Correo', 'width' => 25],
                            ['label' => 'Rol', 'width' => 20],
                            ['label' => 'Estado', 'width' => 15],
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
                        @foreach ($users as $user)
                            {{-- Filtrar usuarios según jerarquía: Autoridad no ve Admins --}}
                            @if(auth()->user()->hasRole('Admin') || !$user->hasRole('Admin'))
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @php
                                            $roleName = $user->roles->first()->name ?? 'Sin rol';
                                            $badgeClass = match($roleName) {
                                                'Admin' => 'badge-danger',
                                                'Autoridad' => 'badge-warning', 
                                                'Usuario' => 'badge-info',
                                                default => 'badge-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $roleName }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $user->status ? 'badge-success' : 'badge-secondary' }}">
                                            <i class="fas fa-{{ $user->status ? 'check-circle' : 'times-circle' }}"></i>
                                            {{ $user->status ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- Botón Ver --}}
                                            @can('ver usuarios')
                                                {{-- Admin puede ver cualquier usuario --}}
                                                @if(auth()->user()->hasRole('Admin'))
                                                    <a href="{{ route('users.show', $user->id) }}"
                                                       class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del usuario">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                {{-- Autoridad no puede ver Admins --}}
                                                @elseif(auth()->user()->hasRole('Autoridad') && !$user->hasRole('Admin'))
                                                    <a href="{{ route('users.show', $user->id) }}"
                                                       class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del usuario">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                            @endcan

                                            {{-- Botón Editar --}}
                                            @can('actualizar usuarios')
                                                {{-- Admin puede editar cualquier usuario --}}
                                                @if(auth()->user()->hasRole('Admin'))
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                       class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar usuario">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                {{-- Autoridad no puede editar Admins --}}
                                                @elseif(auth()->user()->hasRole('Autoridad') && !$user->hasRole('Admin'))
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                       class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar usuario">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                            @endcan

                                            {{-- Botón Eliminar --}}
                                            @can('eliminar usuarios')
                                                {{-- Solo Admin puede eliminar, y no puede eliminarse a sí mismo --}}
                                                @if(auth()->user()->hasRole('Admin') && $user->id !== auth()->id())
                                                    <form id="deleteForm{{ $user->id }}" class="d-inline" method="POST"
                                                          action="{{ route('users.destroy', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1"
                                                                title="Eliminar usuario" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}', '{{ $user->roles->first()->name ?? 'Sin rol' }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                {{-- Mostrar botón deshabilitado para casos restringidos --}}
                                                @elseif(auth()->user()->hasRole('Admin') && $user->id === auth()->id())
                                                    <button class="btn btn-sm btn-outline-secondary shadow-sm mx-1" disabled 
                                                            title="No puedes eliminarte a ti mismo">
                                                        <i class="fas fa-shield-alt"></i>
                                                    </button>
                                                @endif
                                            @endcan

                                            {{-- Mensaje para acciones restringidas --}}
                                            @if(auth()->user()->hasRole('Autoridad') && $user->hasRole('Admin'))
                                                <span class="badge badge-warning" title="Usuario protegido">
                                                    <i class="fas fa-shield-alt"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </x-adminlte-datatable>
                </x-adminlte-card>
            </div>
        </div>
    @endcannot
</div>
@stop

{{-- Extra CSS (opcional) --}}
@push('css')
    <style>
        #success-alert {
            transition: opacity 0.5s ease;
        }
        #success-alert[style*="display: none"] {
            opacity: 0;
        }
        
        .badge {
            font-size: 0.875em;
            padding: 0.4em 0.6em;
        }
        
        .badge i {
            margin-right: 0.25em;
        }

        .btn[disabled] {
            cursor: not-allowed;
        }

        .gap-2 {
            gap: 0.25rem;
        }
    </style>
@endpush

{{-- Scripts JS --}}
@push('js')
    <script>
        // Función para confirmación de eliminación con Sweetalert2 en español - Mejorada
        function confirmDelete(id, userName, userRole) {
            Swal.fire({
                title: '¿Eliminar usuario?',
                html: `
                    <div class="text-left">
                        <p><strong>Usuario:</strong> ${userName}</p>
                        <p><strong>Rol:</strong> ${userRole}</p>
                        <br>
                        <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> Esta acción no se puede deshacer.</p>
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
                    // Mostrar loading mientras se procesa
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
                }, 3000); // 3 segundos
            }

            // Inicializar DataTable
            if ($.fn.DataTable.isDataTable('#table1')) {
                $('#table1').DataTable();
            }
        });
    </script>
@endpush