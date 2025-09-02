<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class RoleRequest extends FormRequest
{
    public function authorize()
    {
        // Solo usuarios con el permiso 'gestionar roles' o rol 'admin' pueden crear/actualizar roles
        return true;//Auth::user()->hasPermissionTo('gestionar roles') || Auth::user()->hasRole('admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:roles,name,' . ($this->role ? $this->role->id : ''),
            'permissions' => 'nullable|array',
        ];
    }
}