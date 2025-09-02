<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if($this->isMethod('post')){
            return [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:100',
                    'unique:offices,name',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'short_name' => [
                    'nullable',
                    'string',
                    'min:3',
                    'max:10',
                    'unique:offices,short_name',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'description' => 'nullable|string|max:500',
                'status' => 'boolean',
            ];
        }

        if($this->isMethod('put')){
            $officeId = $this->route('office') ? $this->route('office')->id : null;
            return [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:100',
                    "unique:offices,name,{$officeId}",
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'short_name' => [
                    'nullable',
                    'string',
                    'min:3',
                    'max:10',
                    "unique:offices,short_name,{$officeId}",
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'description' => 'nullable|string|max:500',
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
            'name.required' => 'El nombre de la oficina es obligatorio.',
            'name.string' => 'El nombre de la oficina debe ser una cadena de texto.',
            'name.min' => 'El nombre de la oficina debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre de la oficina no puede exceder los 100 caracteres.',
            'name.unique' => 'Ya existe una oficina con este nombre.',
            'name.regex' => 'El nombre de la oficina solo puede contener letras, espacios y guiones.',
            'short_name.string' => 'El nombre corto debe ser una cadena de texto.',
            'short_name.min' => 'El nombre corto debe tener al menos 3 caracteres.',
            'short_name.max' => 'El nombre corto no puede exceder los 10 caracteres.',
            'short_name.unique' => 'Ya existe una oficina con este nombre corto.',
            'short_name.regex' => 'El nombre corto solo puede contener letras, espacios y guiones.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe superar los 500 caracteres.',
            'status.boolean' => 'El estado debe ser verdadero o falso.',
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
