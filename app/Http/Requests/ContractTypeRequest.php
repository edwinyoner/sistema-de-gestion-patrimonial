<?php

namespace App\Http\Requests;

// Define el espacio de nombres para la solicitud, indicando que pertenece al directorio App\Http\Requests.
use Illuminate\Foundation\Http\FormRequest;

class ContractTypeRequest extends FormRequest
{
    // Determina si el usuario está autorizado para realizar esta solicitud.
    public function authorize(): bool
    {
        return true; // Reemplaza con tu lógica de autorización (e.g., Gate o Policy)
    }

    // Reglas de validación para crear o actualizar tipos de contrato.
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                // El nombre del tipo de contrato es obligatorio.
                'name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:50',
                    'unique:contract_types,name',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                // La descripción del tipo de contrato es opcional.
                'description' => 'nullable|string|max:500',
                // El estado del tipo de contrato debe ser un valor booleano.
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $contractTypeId = $this->route('contract_type') ? $this->route('contract_type')->id : null;
            return [
                // El nombre del tipo de contrato es obligatorio.
                'name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:50',
                    "unique:contract_types,name,{$contractTypeId}",
                    'regex:/^[\pL\s\-]+$/u',
                ],
                // La descripción del tipo de contrato es opcional.
                'description' => 'nullable|string|max:500',
                // El estado del tipo de contrato debe ser un valor booleano.
                'status' => 'boolean',
            ];
        }

        return [];
    }

    // Mensajes personalizados para validaciones.
    public function messages(): array
    {
        return [
            // Mensaje cuando el nombre del tipo de contrato es obligatorio.
            'name.required' => 'El nombre del tipo de contrato es obligatorio.',
            // Mensaje cuando el nombre del tipo de contrato tiene menos de 2 caracteres.
            'name.min' => 'El nombre del tipo de contrato debe tener al menos 2 caracteres.',
            // Mensaje cuando el nombre del tipo de contrato excede los 50 caracteres.
            'name.max' => 'El nombre del tipo de contrato no debe superar los 50 caracteres.',
            // Mensaje cuando el nombre del tipo de contrato ya existe.
            'name.unique' => 'Este tipo de contrato ya existe.',
            // Mensaje cuando el nombre del tipo de contrato contiene caracteres no permitidos.
            'name.regex' => 'El nombre del tipo de contrato solo puede contener letras, espacios y guiones.',
            // Mensaje cuando la descripción excede los 500 caracteres.
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