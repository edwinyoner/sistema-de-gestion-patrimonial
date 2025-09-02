<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssetToolRequest extends FormRequest
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
     * Reglas de validación para crear o actualizar herramientas.
     *
     * @return array
     */
    public function rules(): array
    {
        $toolId = $this->isMethod('put') && $this->route('asset_tool') ? $this->route('asset_tool')->id : null;

        if ($this->isMethod('post')) {
            return [
                'company_asset_id' => [
                    'required',
                    'exists:company_assets,id',
                ],
                'tool_name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    'regex:/^[\pL\pN\s\-]+$/u',
                    'unique:asset_tools,tool_name',
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
                'tool_name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    'regex:/^[\pL\pN\s\-]+$/u',
                    Rule::unique('asset_tools', 'tool_name')
                        ->ignore($toolId)
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
            'tool_name.required' => 'El nombre de la herramienta es obligatorio.',
            'tool_name.string' => 'El nombre de la herramienta debe ser una cadena de texto.',
            'tool_name.min' => 'El nombre de la herramienta debe tener al menos 2 caracteres.',
            'tool_name.max' => 'El nombre de la herramienta no debe superar los 100 caracteres.',
            'tool_name.unique' => 'Este nombre de herramienta ya está en uso para el activo de la compañía.',
            'tool_name.regex' => 'El nombre de la herramienta solo puede contener letras, números, espacios y guiones.',
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
    protected function prepareForValidation()
    {
        if (!array_key_exists('status', $this->all()) || $this->all()['status'] === null) {
            $this->merge(['status' => true]);
        }
    }
}