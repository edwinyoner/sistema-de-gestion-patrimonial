<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoftwareTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
                    'max:50',
                    'unique:software_types,name',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'description' => 'nullable|string|max:500',
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $softwareTypeId = $this->route('software_type') ? $this->route('software_type')->id : null;
            return [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:50',
                    "unique:software_types,name,{$softwareTypeId}",
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'description' => 'nullable|string|max:500',
                'status' => 'boolean',
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del tipo de software es obligatorio.',
            'name.string' => 'El nombre del tipo de software debe ser una cadena de texto.',
            'name.min' => 'El nombre del tipo de software debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre del tipo de software no puede exceder los 50 caracteres.',
            'name.unique' => 'Ya existe un tipo de software con este nombre.',
            'name.regex' => 'El nombre del tipo de software solo puede contener letras, espacios y guiones.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede exceder los 500 caracteres.',
            'status.boolean' => 'El estado debe ser verdadero o falso.',
        ];
    }

    protected function prepareForValidation()
    {
        if (!array_key_exists('status', $this->all()) || $this->all()['status'] === null) {
            $this->merge(['status' => true]);
        }
    }
}