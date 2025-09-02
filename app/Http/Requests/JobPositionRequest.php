<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPositionRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Reemplaza con tu lógica de autorización (e.g., Gate o Policy)
    }

    /**
     * Reglas de validación para crear o actualizar cargos.
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:50',
                    'unique:job_positions,name',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'description' => 'nullable|string|max:500',
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $jobPositionId = $this->route('job_position') ? $this->route('job_position')->id : null;
            return [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:50',
                    "unique:job_positions,name,{$jobPositionId}",
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'description' => 'nullable|string|max:500',
                'status' => 'boolean',
            ];
        }

        return [];
    }

    /**
     * Mensajes personalizados para validaciones.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del cargo es obligatorio.',
            'name.min' => 'El nombre del cargo debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre del cargo no debe superar los 50 caracteres.',
            'name.unique' => 'Este cargo ya existe.',
            'name.regex' => 'El nombre del cargo solo puede contener letras, espacios y guiones.',
            'description.max' => 'La descripción no debe superar los 500 caracteres.',
            'status.boolean' => 'El estado debe ser un valor booleano.',
        ];
    }

    /**
     * Preparar los datos antes de la validación.
     */
    protected function prepareForValidation()
    {
        if (!array_key_exists('status', $this->all()) || $this->all()['status'] === null) {
            $this->merge(['status' => true]);
        }
    }
}