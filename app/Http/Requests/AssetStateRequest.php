<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

// Define el espacio de nombres para la solicitud, indicando que pertenece al directorio App\Http\Requests.
class AssetStateRequest extends FormRequest
{
    // Determina si el usuario está autorizado para realizar esta solicitud.
    public function authorize(): bool
    {
        return true; // Reemplaza con tu lógica de autorización (e.g., Gate o Policy)
    }

    // Reglas de validación para crear o actualizar estados de activos.
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                // El nombre del estado del activo es obligatorio.
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:25',
                    'unique:asset_states,name',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                // La descripción del estado del activo es opcional.
                'description' => 'nullable|string|max:500',
                // El estado del estado del activo debe ser un valor booleano.
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $assetStateId = $this->route('asset_state') ? $this->route('asset_state')->id : null;
            return [
                // El nombre del estado del activo es obligatorio.
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:25',
                    "unique:asset_states,name,{$assetStateId}",
                    'regex:/^[\pL\s\-]+$/u',
                ],
                // La descripción del estado del activo es opcional.
                'description' => 'nullable|string|max:500',
                // El estado del estado del activo debe ser un valor booleano.
                'status' => 'boolean',
            ];
        }

        return [];
    }

    // Mensajes personalizados para validaciones.
    public function messages(): array
    {
        return [
            // Mensaje cuando el nombre del estado del activo es obligatorio.
            'name.required' => 'El nombre del estado del activo es obligatorio.',
            // Mensaje cuando el nombre del estado del activo tiene menos de 3 caracteres.
            'name.min' => 'El nombre del estado del activo debe tener al menos 3 caracteres.',
            // Mensaje cuando el nombre del estado del activo excede los 20 caracteres.
            'name.max' => 'El nombre del estado del activo no debe superar los 25 caracteres.',
            // Mensaje cuando el nombre del estado del activo ya existe.
            'name.unique' => 'Este estado de activo ya existe.',
            // Mensaje cuando el nombre del estado del activo contiene caracteres no permitidos.
            'name.regex' => 'El nombre del estado del activo solo puede contener letras, espacios y guiones.',
            // Mensaje cuando la descripción excede los 250 caracteres.
            'description.max' => 'La descripción no debe superar los 500 caracteres.',
            // Mensaje cuando el estado no es un valor booleano.
            'status.boolean' => 'El estado debe ser un valor booleano.',
        ];
    }

    // Preparar los datos antes de la validación.
    protected function prepareForValidation()
    {
        // Si no se proporciona el estado o es nulo, establece el valor predeterminado como true.
        if (!array_key_exists('status', $this->all()) || $this->all()['status'] === null) {
            $this->merge(['status' => true]);
        }
    }
}