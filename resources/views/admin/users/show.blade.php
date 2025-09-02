@extends('layouts.main')

@section('subtitle', 'Detalle del Usuario')
@section('content_header_title', 'Usuario')
@section('content_header_subtitle', 'Detalles del Usuario')

@section('content_body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <x-adminlte-card title="Información del Usuario" theme="info" icon="fas fa-user">

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
                    <span class="text-muted">{{ $user->roles->first()->name ?? 'Sin rol asignado' }}</span>
                </div>

                <div class="mb-3">
                    <strong>Estado:</strong>
                    <span class="badge {{ $user->status ? 'badge-success' : 'badge-danger' }}">
                        {{ $user->status ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>

                {{-- Botones de regreso y edición con disposición ajustada --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                </div>

            </x-adminlte-card>
        </div>
    </div>
</div>
@stop

@push('css')
@endpush

@push('js')
@endpush