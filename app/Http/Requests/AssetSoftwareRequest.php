<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetSoftwareRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Reemplaza con tu lógica de autorización (e.g., Gate o Policy) si es necesario
    }

    /**
     * Reglas de validación para crear o actualizar software.
     */
    public function rules(): array
    {
        $softwareTypeId = $this->input('software_type_id'); // Obtener el software_type_id del formulario

        if ($this->isMethod('post')) {
            return [
                'company_asset_id' => 'required|exists:company_assets,id',
                'software_type_id' => 'required|exists:software_types,id',
                'software_name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    'regex:/^[\pL\pN\s\-]+$/u',
                    'unique:asset_softwares,software_name',
                ],
                'version' => 'nullable|string|max:25',
                'license_key' => 'nullable|string|max:255', 
                'license_expiry' => 'nullable|date',
                'description' => 'nullable|string|max:1000',
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $softwareId = $this->route('asset_software') ? $this->route('asset_software')->id : null;
            return [
                'company_asset_id' => 'required|exists:company_assets,id',
                'software_type_id' => 'required|exists:software_types,id',
                'software_name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    'regex:/^[\pL\pN\s\-]+$/u',
                    "unique:asset_softwares,software_name,{$softwareId},id,company_asset_id,{$this->company_asset_id}",
                ],
                'version' => 'nullable|string|max:25',
                'license_key' => 'nullable|string|max:255',
                'license_expiry' => 'nullable|date',
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
            'software_type_id.required' => 'El tipo de software es obligatorio.',
            'software_type_id.exists' => 'El tipo de software seleccionado no existe.',
            'software_name.required' => 'El nombre del software es obligatorio.',
            'software_name.min' => 'El nombre del software debe tener al menos 2 caracteres.',
            'software_name.max' => 'El nombre del software no debe superar los 100 caracteres.',
            'software_name.unique' => 'Este nombre de software ya está en uso para el activo de la compañía.',
            'software_name.regex' => 'El nombre del software solo puede contener letras, números, espacios y guiones.',
            'version.max' => 'La versión no debe superar los 25 caracteres.',
            'license_key.max' => 'La clave de licencia no debe superar los 255 caracteres.', // Ajustado
            'license_expiry.date' => 'La fecha de expiración debe ser una fecha válida.',
            'description.max' => 'La descripción no debe superar los 1000 caracteres.',
            'status.boolean' => 'El estado debe ser un valor booleano.',
        ];
    }
    protected function prepareForValidation()
    {
        if (!array_key_exists('status', $this->all()) || $this->all()['status'] === null) {
            $this->merge(['status' => true]);
        }
    }
}