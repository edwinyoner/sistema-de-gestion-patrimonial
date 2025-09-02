<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Autoriza solo a usuarios con rol 'admin' (ajusta según tu lógica de permisos)
        return true;//auth()->check() && auth()->user()->hasRole('admin');
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
                    'min:5',
                    'max:255',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email',
                ],
                'role' => [
                    'required',
                    'string',
                    'exists:roles,name',
                ],
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $userId = $this->route('user') ? $this->route('user')->id : null;
            return [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:255',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email,' . $userId,
                ],
                'role' => [
                    'required',
                    'string',
                    'exists:roles,name',
                ],
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
            'name.required' => 'El nombre del usuario es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.min' => 'El nombre debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, espacios y guiones.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo debe ser una dirección válida.',
            'email.max' => 'El correo no puede exceder los 255 caracteres.',
            'email.unique' => 'Este correo ya está registrado.',
            'role.required' => 'El rol es obligatorio.',
            'role.exists' => 'El rol seleccionado no existe.',
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
    }
}