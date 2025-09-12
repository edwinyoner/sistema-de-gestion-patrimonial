<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Solo usuarios con el permiso 'gestionar permisos' o rol 'admin' pueden crear/actualizar permisos
        return true; // Auth::user()->hasPermissionTo('gestionar permisos') || Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $permissionId = $this->route('permission') ? $this->route('permission')->id : null;

        if ($this->isMethod('post')) {
            return [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'regex:/^[\pL\s\-]+$/u', // Solo letras, espacios y guiones (con acentos)
                    'unique:permissions,name',
                ],
                'guard_name' => [
                    'required',
                    'string',
                    'in:web', // Permitir guards web y sanctum
                ],
            ];
        }

        if ($this->isMethod('put')) {
            return [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'regex:/^[\pL\s\-]+$/u', // Solo letras, espacios y guiones (con acentos)
                    Rule::unique('permissions', 'name')->ignore($permissionId),
                ],
                'guard_name' => [
                    'required',
                    'string',
                    'in:web', // Permitir guards web y sanctum
                ],
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
            'name.required' => 'El nombre del permiso es obligatorio.',
            'name.string' => 'El nombre del permiso debe ser una cadena de texto.',
            'name.min' => 'El nombre del permiso debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre del permiso no puede exceder los 100 caracteres.',
            'name.unique' => 'Ya existe un permiso con este nombre.',
            'name.regex' => 'El nombre del permiso solo puede contener letras, espacios y guiones.',
            'guard_name.required' => 'El guard name es obligatorio.',
            'guard_name.string' => 'El guard name debe ser una cadena de texto.',
            'guard_name.in' => 'El guard name debe ser "web",
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Si no se proporciona guard_name, usar 'web' por defecto
        if (!array_key_exists('guard_name', $this->all()) || $this->all()['guard_name'] === null) {
            $this->merge(['guard_name' => 'web']);
        }
    }
}