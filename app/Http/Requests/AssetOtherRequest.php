<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssetOtherRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Reemplaza con tu lógica de autorización (e.g., Gate o Policy)
    }

    /**
     * Reglas de validación para crear o actualizar activos diversos.
     *
     * @return array
     */
    public function rules(): array
    {
        $otherId = $this->isMethod('put') && $this->route('asset_other') ? $this->route('asset_other')->id : null;

        if ($this->isMethod('post')) {
            return [
                'company_asset_id' => [
                    'required',
                    'exists:company_assets,id',
                ],
                'other_name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    'regex:/^[\pL\pN\s\-]+$/u',
                    'unique:asset_others,other_name',
                ],
                'brand' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'model' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'color' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'description' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            return [
                'company_asset_id' => [
                    'required',
                    'exists:company_assets,id',
                ],
                'other_name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    'regex:/^[\pL\pN\s\-]+$/u',
                    Rule::unique('asset_others', 'other_name')
                        ->ignore($otherId)
                        ->where('company_asset_id', $this->company_asset_id),
                ],
                'brand' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'model' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'color' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'description' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
                'status' => 'boolean',
            ];
        }

        return [];
    }

    /**
     * Obtener los mensajes personalizados para las reglas de validación.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'company_asset_id.required' => 'El ID del activo de la compañía es obligatorio.',
            'company_asset_id.exists' => 'El ID del activo de la compañía no existe.',
            'other_name.required' => 'El nombre del activo es obligatorio.',
            'other_name.string' => 'El nombre del activo debe ser una cadena de texto.',
            'other_name.min' => 'El nombre del activo debe tener al menos 2 caracteres.',
            'other_name.max' => 'El nombre del activo no debe superar los 100 caracteres.',
            'other_name.unique' => 'Este nombre de activo ya está en uso para el activo de la compañía.',
            'other_name.regex' => 'El nombre del activo solo puede contener letras, números, espacios y guiones.',
            'brand.string' => 'La marca debe ser una cadena de texto.',
            'brand.max' => 'La marca no debe superar los 50 caracteres.',
            'model.string' => 'El modelo debe ser una cadena de texto.',
            'model.max' => 'El modelo no debe superar los 50 caracteres.',
            'color.string' => 'El color debe ser una cadena de texto.',
            'color.max' => 'El color no debe superar los 50 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe superar los 1000 caracteres.',
            'status.boolean' => 'El estado debe ser un valor booleano.',
        ];
    }

    /**
     * Preparar los datos antes de la validación.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->mergeIfMissing(['status' => true]);
    }
}