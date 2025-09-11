<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class RoleController extends Controller
{
    public function __construct()
    {
        // Middleware para verificar permisos
        $this->middleware('permission:ver roles')->only(['index', 'show']);
        $this->middleware('permission:crear roles')->only(['create', 'store']);
        $this->middleware('permission:actualizar roles')->only(['edit', 'update']);
        $this->middleware('permission:eliminar roles')->only(['destroy']);
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        try {
            $role = Role::create($request->only('name', 'guard_name'));
            $permissionIds = $request->input('permissions', []);
            Log::info('Permisos recibidos: ' . json_encode($permissionIds));

            // Filtrar solo los IDs de permisos que existen
            $existingPermissions = Permission::whereIn('id', $permissionIds)->pluck('id')->toArray();
            if (count($existingPermissions) !== count($permissionIds)) {
                Log::warning('Algunos permisos no existen. IDs válidos: ' . json_encode($existingPermissions));
            }

            $role->syncPermissions($existingPermissions);

            return Response::json(['success' => true, 'message' => 'Rol creado exitosamente.', 'redirect' => route('roles.index')]);
        } catch (\Exception $e) {
            Log::error('Error al crear rol: ' . $e->getMessage());
            return Response::json(['success' => false, 'message' => 'Error al crear el rol. Consulta los logs para más detalles.'], 500);
        }
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        try {
            $data = $request->only('guard_name');
            if (!in_array($role->name, ['Admin', 'Autoridad', 'Usuario'])) {
                $data['name'] = $request->input('name');
            }
            $role->update($data);

            $permissionIds = $request->input('permissions', []);
            Log::info('Permisos recibidos en update: ' . json_encode($permissionIds));

            // Filtrar y convertir IDs a instancias de Permission
            $existingPermissions = Permission::whereIn('id', $permissionIds)->get();
            $role->syncPermissions($existingPermissions);

            return Response::json(['success' => true, 'message' => 'Rol actualizado exitosamente.', 'redirect' => route('roles.index')]);
        } catch (\Exception $e) {
            Log::error('Error al actualizar rol: ' . $e->getMessage());
            return Response::json(['success' => false, 'message' => 'Error al actualizar el rol. Consulta los logs para más detalles.'], 500);
        }
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}