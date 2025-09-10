<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Solo usuarios con el permiso 'gestionar roles' o rol 'admin' pueden crear/actualizar roles
        return true; // Auth::user()->hasPermissionTo('gestionar roles') || Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'unique:roles,name',
                    'regex:/^[\pL\s\-]+$/u', // Solo letras, espacios y guiones (con acentos)
                ],
                'guard_name' => 'required|string|in:web', // 'in:web,sanctum', Permitir ambos guards
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,name', // Cada permiso debe existir
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $roleId = $this->route('role') ? $this->route('role')->id : null;
            return [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    "unique:roles,name,{$roleId}",
                    'regex:/^[\pL\s\-]+$/u', // Solo letras, espacios y guiones (con acentos)
                ],
                'guard_name' => 'required|string|in:web', // 'in:web,sanctum', Permitir ambos guards
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,name', // Cada permiso debe existir
                'status' => 'boolean',
            ];
        }

        return [];
    }

    /**
     * Get the custom messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.string' => 'El nombre del rol debe ser una cadena de texto.',
            'name.min' => 'El nombre del rol debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre del rol no puede exceder los 100 caracteres.',
            'name.unique' => 'Ya existe un rol con este nombre.',
            'name.regex' => 'El nombre del rol solo puede contener letras, espacios y guiones.',
            'guard_name.required' => 'El guard name es obligatorio.',
            'guard_name.string' => 'El guard name debe ser una cadena de texto.',
            'guard_name.in' => 'El guard name debe ser "web".',
            'permissions.array' => 'Los permisos deben ser un array.',
            'permissions.*.exists' => 'El permiso seleccionado no existe.',
            'status.boolean' => 'El estado debe ser verdadero o falso.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        if (!array_key_exists('status', $this->all()) || $this->all()['status'] === null) {
            $this->merge(['status' => true]);
        }

        // Si no se proporciona guard_name, usar 'web' por defecto
        if (!array_key_exists('guard_name', $this->all()) || $this->all()['guard_name'] === null) {
            $this->merge(['guard_name' => 'web']);
        }

        // Limpiar el array de permisos para evitar valores inválidos
        if (array_key_exists('permissions', $this->all()) && is_array($this->all()['permissions'])) {
            $this->merge(['permissions' => array_filter($this->all()['permissions'])]);
        }
    }
}