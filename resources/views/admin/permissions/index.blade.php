@extends('layouts.main')

@section('subtitle', 'Permisos')
@section('content_header_title', 'Permisos')
@section('content_header_subtitle', 'Bienvenido a la gestión de permisos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_body')
<div class="container-fluid">
    <div class="card-header bg-primary text-white text-center py-3 mb-4">
        <h2 class="mb-0">PERMISOS</h2>
        <div class="mt-2">
            <span class="ml-2"><i class="fas fa-shield-alt mr-1"></i> Gestión de Permisos</span>
            <span class="badge badge-light">{{ $permissions->count() }} Permisos</span>
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
                <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus mr-2"></i> Crear Permiso
                </a>
            </div>

            <x-adminlte-card theme="dark" header-class="bg-gradient-dark text-white" title="Permisos Registrados">
                @php
                    $heads = [
                        ['label' => 'ID', 'width' => 5],
                        ['label' => 'Nombre', 'width' => 40],
                        ['label' => 'Guard Name', 'width' => 20],
                        ['label' => 'Acciones', 'no-export' => true, 'width' => 25],
                    ];

                    $config = [
                        'language' => ['url' => asset('/assets/js/es-ES.json')],
                        'responsive' => true,
                        'autoWidth' => false,
                        'paging' => true,
                        'searching' => true,
                        'ordering' => true,
                        'pageLength' => 10,
                    ];
                @endphp

                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable bordered sm>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name ?? 'web' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('permissions.show', $permission->id) }}"
                                       class="btn btn-sm btn-outline-info shadow-sm mx-1" title="Ver detalles del permiso">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                       class="btn btn-sm btn-outline-primary shadow-sm mx-1" title="Editar permiso">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @can('elimar permisos')
                                    <form id="deleteForm{{ $permission->id }}" class="d-inline" method="POST"
                                          action="{{ route('permissions.destroy', $permission->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm mx-1"
                                                title="Eliminar permiso" onclick="confirmDelete({{ $permission->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endcan
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

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/permissions/index.css') }}">
    <style>
        #success-alert { transition: opacity 0.5s ease; }
        #success-alert[style*="display: none"] { opacity: 0; }
    </style>
@endpush

@push('js')
    <script>
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

        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => { successAlert.style.display = 'none'; }, 3000);
            }

            if ($.fn.DataTable.isDataTable('#table1')) {
                $('#table1').DataTable();
            }
        });
    </script>
@endpush