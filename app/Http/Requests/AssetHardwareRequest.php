<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetHardwareRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Reemplaza con tu lógica de autorización (e.g., Gate o Policy)
    }

    /**
     * Reglas de validación para crear o actualizar hardware.
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'company_asset_id' => 'required|exists:company_assets,id',
                'hardware_name' => [ // Corregido de 'name' a 'hardware_name'
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    'regex:/^[\pL\pN\s\-]+$/u',
                ],
                'brand' => 'nullable|string|max:50',
                'model' => 'nullable|string|max:50',
                'color' => 'nullable|string|max:50',
                'serial_number' => 'nullable|string|max:30',
                'description' => 'nullable|string|max:1000',
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $hardwareId = $this->route('asset_hardware') ? $this->route('asset_hardware')->id : null;
            return [
                'company_asset_id' => 'required|exists:company_assets,id',
                'hardware_name' => [ // Corregido de 'name' a 'hardware_name'
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    "unique:asset_hardwares,hardware_name,{$hardwareId},id,company_asset_id,{$this->company_asset_id}", // Ajustado
                    'regex:/^[\pL\pN\s\-]+$/u',
                ],
                'brand' => 'nullable|string|max:50',
                'model' => 'nullable|string|max:50',
                'color' => 'nullable|string|max:50',
                'serial_number' => 'nullable|string|max:30',
                'description' => 'nullable|string|max:1000',
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
            'company_asset_id.required' => 'El ID del activo de la compañía es obligatorio.',
            'company_asset_id.exists' => 'El ID del activo de la compañía no existe.',
            'hardware_name.required' => 'El nombre del hardware es obligatorio.',
            'hardware_name.min' => 'El nombre del hardware debe tener al menos 2 caracteres.',
            'hardware_name.max' => 'El nombre del hardware no debe superar los 100 caracteres.',
            'hardware_name.unique' => 'Este nombre de hardware ya está en uso para el activo de la compañía.',
            'hardware_name.regex' => 'El nombre del hardware solo puede contener letras, números, espacios y guiones.',
            'brand.max' => 'La marca no debe superar los 50 caracteres.',
            'model.max' => 'El modelo no debe superar los 50 caracteres.',
            'color.max' => 'El color no debe superar los 50 caracteres.',
            'serial_number.max' => 'El número de serie no debe superar los 30 caracteres.',
            'description.max' => 'La descripción no debe superar los 1000 caracteres.',
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