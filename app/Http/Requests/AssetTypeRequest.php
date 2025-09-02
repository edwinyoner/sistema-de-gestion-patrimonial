<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

// Define el espacio de nombres para la solicitud, indicando que pertenece al directorio App\Http\Requests.
class AssetTypeRequest extends FormRequest
{
    // Determina si el usuario está autorizado para realizar esta solicitud.
    public function authorize(): bool
    {
        return true; // Reemplaza con tu lógica de autorización (e.g., Gate o Policy)
    }

    // Reglas de validación para crear o actualizar tipos de activos.
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                // El nombre del tipo de activo es obligatorio.
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:50',
                    'unique:asset_types,name',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                // La descripción del tipo de activo es opcional.
                'description' => 'nullable|string|max:250',
                // El estado del tipo de activo debe ser un valor booleano.
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $assetTypeId = $this->route('asset_type') ? $this->route('asset_type')->id : null;
            return [
                // El nombre del tipo de activo es obligatorio.
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:50',
                    "unique:asset_types,name,{$assetTypeId}",
                    'regex:/^[\pL\s\-]+$/u',
                ],
                // La descripción del tipo de activo es opcional.
                'description' => 'nullable|string|max:250',
                // El estado del tipo de activo debe ser un valor booleano.
                'status' => 'boolean',
            ];
        }

        return [];
    }

    // Mensajes personalizados para validaciones.
    public function messages(): array
    {
        return [
            // Mensaje cuando el nombre del tipo de activo es obligatorio.
            'name.required' => 'El nombre del tipo de activo es obligatorio.',
            // Mensaje cuando el nombre del tipo de activo tiene menos de 5 caracteres.
            'name.min' => 'El nombre del tipo de activo debe tener al menos 5 caracteres.',
            // Mensaje cuando el nombre del tipo de activo excede los 50 caracteres.
            'name.max' => 'El nombre del tipo de activo no debe superar los 50 caracteres.',
            // Mensaje cuando el nombre del tipo de activo ya existe.
            'name.unique' => 'Este tipo de activo ya existe.',
            // Mensaje cuando el nombre del tipo de activo contiene caracteres no permitidos.
            'name.regex' => 'El nombre del tipo de activo solo puede contener letras, espacios y guiones.',
            // Mensaje cuando la descripción excede los 250 caracteres.
            'description.max' => 'La descripción no debe superar los 250 caracteres.',
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