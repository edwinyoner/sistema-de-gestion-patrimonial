@extends('layouts.main')

@section('subtitle', 'Lista de Usuarios')
@section('content_header_title', 'Usuarios')
@section('content_header_subtitle', 'Bienvenido a la gestión de usuarios')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">

    <!-- Título mejorado con HTML puro -->
    <div class="card-header bg-primary text-white text-center py-3 mb-4">
        <h2 class="mb-0">USUARIOS</h2>
        <div class="mt-2">
            <span class="ml-2"><i class="fas fa-users mr-1"></i> Gestión de Usuarios</span>
            <span class="badge badge-light">{{ $users->count() }} Usuarios</span>
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
            <div class="mb-3 text-right">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-2"></i> Crear Usuario
                </a>
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
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->first()->name ?? 'Sin rol' }}</td>
                            <td>
                                <span style="color: {{ $user->status ? 'green' : 'red' }}; font-weight: bold;">
                                    {{ $user->status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Ver -->
                                    <a href="{{ route('users.show', $user->id) }}"
                                       class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del usuario">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Editar -->
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar usuario">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Eliminar -->
                                    <form id="deleteForm{{ $user->id }}" class="d-inline" method="POST"
                                          action="{{ route('users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1"
                                                title="Eliminar usuario" onclick="confirmDelete({{ $user->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
    </div>
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
    </style>
@endpush

{{-- Scripts JS --}}
@push('js')
    <script>
        // Función para confirmación de eliminación con Sweetalert2 en español
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esta acción!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
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