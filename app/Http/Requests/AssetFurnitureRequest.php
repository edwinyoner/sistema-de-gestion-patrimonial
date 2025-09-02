<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssetFurnitureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Implementar lógica de autorización según necesidades
    }

    public function rules(): array
    {
        $rules = $this->getBaseRules();

        return $rules;
    }

    private function getBaseRules(): array
    {
        return [
            'furniture_name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[\pL\pN\s\-\.]+$/u', // Letras, números, espacios, guiones y puntos
            ],
            'brand' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[\pL\pN\s\-\.]+$/u',
            ],
            'model' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[\pL\pN\s\-\.]+$/u',
            ],
            'color' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[\pL\s\-]+$/u', // Solo letras, espacios y guiones para colores
            ],
            'material' => [
                'nullable',
                'string',
                'max:50',
            ],
            'dimensions' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[\d\s\.\,x×cmm]+$/i', // Formato: 120x80x75 cm o similares
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000', // Solo máximo, sin mínimo
            ],
            'status' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'furniture_name.required' => 'El nombre del mobiliario es obligatorio.',
            'furniture_name.min' => 'El nombre del mobiliario debe tener al menos 2 caracteres.',
            'furniture_name.max' => 'El nombre del mobiliario no debe superar los 100 caracteres.',
            'furniture_name.regex' => 'El nombre del mobiliario solo puede contener letras, números, espacios, guiones y puntos.',
            
            'brand.max' => 'La marca no debe superar los 50 caracteres.',
            'brand.regex' => 'La marca solo puede contener letras, números, espacios, guiones y puntos.',
            
            'model.max' => 'El modelo no debe superar los 50 caracteres.',
            'model.regex' => 'El modelo solo puede contener letras, números, espacios, guiones y puntos.',
            
            'color.max' => 'El color no debe superar los 50 caracteres.',
            'color.regex' => 'El color solo puede contener letras, espacios y guiones.',
            
            'material.max' => 'El material no debe superar los 50 caracteres.',
            'material.in' => 'El material seleccionado no es válido.',
            
            'dimensions.max' => 'Las dimensiones no deben superar los 50 caracteres.',
            'dimensions.regex' => 'Las dimensiones deben tener un formato válido (ej: 120x80x75 cm).',
            
            'description.max' => 'La descripción no debe superar los 1000 caracteres.',
            
            'status.required' => 'El estado es obligatorio.',
            'status.boolean' => 'El estado debe ser un valor booleano.',
        ];
    }

    public function attributes(): array
    {
        return [
            'furniture_name' => 'nombre del mobiliario',
            'brand' => 'marca',
            'model' => 'modelo',
            'color' => 'color',
            'material' => 'material',
            'dimensions' => 'dimensiones',
            'description' => 'descripción',
            'status' => 'estado'
        ];
    }

    protected function prepareForValidation(): void
    {
        // Establecer valor por defecto para status
        if (!array_key_exists('status', $this->all()) || $this->status === null) {
            $this->merge(['status' => true]);
        }

        // Normalizar campos de texto
        $fieldsToNormalize = ['furniture_name', 'brand', 'model', 'color', 'material'];
        $normalizedData = [];

        foreach ($fieldsToNormalize as $field) {
            if ($this->$field) {
                $normalizedData[$field] = ucwords(strtolower(trim($this->$field)));
            }
        }

        if (!empty($normalizedData)) {
            $this->merge($normalizedData);
        }

        // Normalizar dimensions
        if ($this->dimensions) {
            $dimensions = strtolower(trim($this->dimensions));
            $dimensions = str_replace(['×', 'x'], 'x', $dimensions);
            $this->merge(['dimensions' => $dimensions]);
        }
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validar que si hay marca, debería haber modelo
            if ($this->brand && !$this->model) {
                $validator->errors()->add('model', 'Se recomienda especificar el modelo cuando se proporciona la marca.');
            }

            // Validar formato de dimensiones más específico
            if ($this->dimensions) {
                $pattern = '/^\d+(\.\d+)?x\d+(\.\d+)?(x\d+(\.\d+)?)?\s*(cm|mm)?$/i';
                if (!preg_match($pattern, $this->dimensions)) {
                    $validator->errors()->add('dimensions', 'Las dimensiones deben tener el formato: LargoxAnchoxAlto (ej: 120x80x75 cm).');
                }
            }
        });
    }

    // Métodos auxiliares para obtener datos limpios
    public function getCleanedData(): array
    {
        return [
            'furniture_name' => $this->furniture_name,
            'brand' => $this->brand,
            'model' => $this->model,
            'color' => $this->color,
            'material' => $this->material,
            'dimensions' => $this->dimensions,
            'description' => $this->description ? trim($this->description) : null,
            'status' => $this->status
        ];
    }
}