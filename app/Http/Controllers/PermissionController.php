<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        // Middleware para verificar permisos
        $this->middleware('permission:ver permisos')->only(['index', 'show']);
        $this->middleware('permission:crear permisos')->only(['create', 'store']);
        $this->middleware('permission:actualizar permisos')->only(['edit', 'update']);
        $this->middleware('permission:eliminar permisos')->only(['destroy']);
    }
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'nullable',
        ]);

        Permission::create($request->only('name', 'guard_name'));

        return redirect()->route('permissions.index')->with('success', 'Permiso creado exitosamente.');
    }

    public function show(Permission $permission)
    {
        return view('admin.permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
            'guard_name' => 'nullable',
        ]);

        $permission->update($request->only('name', 'guard_name'));

        return redirect()->route('permissions.index')->with('success', 'Permiso actualizado exitosamente.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permiso eliminado exitosamente.');
    }
}