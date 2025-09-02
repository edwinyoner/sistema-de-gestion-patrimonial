<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetMachineryRequest extends FormRequest
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
     * Reglas de validación para crear o actualizar maquinaria.
     *
     * @return array
     */
    public function rules(): array
    {
        $machineryId = $this->isMethod('put') && $this->route('asset_machinery') ? $this->route('asset_machinery')->id : null;

        if ($this->isMethod('post')) {
            return [
                'company_asset_id' => [
                    'required',
                    'exists:company_assets,id',
                ],
                'machinerie_name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    'unique:asset_machineries,machinerie_name',
                    'regex:/^[\pL\pN\s\-]+$/u',
                ],
                'brand' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^[\pL\pN\s\-]+$/u',
                ],
                'model' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^[\pL\pN\s\-]+$/u',
                ],
                'vin' => [
                    'required',
                    'string',
                    'max:17',
                    'regex:/^[A-HJ-NPR-Z0-9]{17}$/i',
                    'unique:asset_machineries,vin',
                ],
                'engine_number' => [
                    'required',
                    'string',
                    'max:10',
                    'regex:/^[\pL\pN]+$/u',
                    'unique:asset_machineries,engine_number',
                ],
                'serial_number' => [
                    'required',
                    'string',
                    'max:17',
                    'regex:/^[\pL\pN]+$/u',
                    'unique:asset_machineries,serial_number',
                ],
                'year' => [
                    'required',
                    'string',
                    'max:4',
                    'regex:/^\d{4}$/',
                ],
                'color' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'placa' => [
                    'nullable',
                    'string',
                    'max:6',
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
                'machinerie_name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:100',
                    "unique:asset_machineries,machinerie_name,{$machineryId}",
                    'regex:/^[\pL\pN\s\-]+$/u',
                ],
                'brand' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^[\pL\pN\s\-]+$/u',
                ],
                'model' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^[\pL\pN\s\-]+$/u',
                ],
                'vin' => [
                    'required',
                    'string',
                    'max:17',
                    'regex:/^[A-HJ-NPR-Z0-9]{17}$/i',
                    "unique:asset_machineries,vin,{$machineryId}",
                ],
                'engine_number' => [
                    'required',
                    'string',
                    'max:10',
                    'regex:/^[\pL\pN]+$/u',
                    "unique:asset_machineries,engine_number,{$machineryId}",
                ],
                'serial_number' => [
                    'required',
                    'string',
                    'max:17',
                    'regex:/^[\pL\pN]+$/u',
                    "unique:asset_machineries,serial_number,{$machineryId}",
                ],
                'year' => [
                    'required',
                    'string',
                    'max:4',
                    'regex:/^\d{4}$/',
                ],
                'color' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'placa' => [
                    'nullable',
                    'string',
                    'max:6',
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
            'machinerie_name.required' => 'El nombre de la maquinaria es obligatorio.',
            'machinerie_name.string' => 'El nombre de la maquinaria debe ser una cadena de texto.',
            'machinerie_name.min' => 'El nombre de la maquinaria debe tener al menos 2 caracteres.',
            'machinerie_name.max' => 'El nombre de la maquinaria no puede exceder los 100 caracteres.',
            'machinerie_name.unique' => 'Ya existe una maquinaria con este nombre.',
            'machinerie_name.regex' => 'El nombre de la maquinaria solo puede contener letras, números, espacios y guiones.',
            'brand.required' => 'La marca de la maquinaria es obligatoria.',
            'brand.string' => 'La marca debe ser una cadena de texto.',
            'brand.max' => 'La marca no puede exceder los 50 caracteres.',
            'brand.regex' => 'La marca solo puede contener letras, números, espacios y guiones.',
            'model.required' => 'El modelo de la maquinaria es obligatorio.',
            'model.string' => 'El modelo debe ser una cadena de texto.',
            'model.max' => 'El modelo no puede exceder los 50 caracteres.',
            'model.regex' => 'El modelo solo puede contener letras, números, espacios y guiones.',
            'vin.required' => 'El VIN de la maquinaria es obligatorio.',
            'vin.string' => 'El VIN debe ser una cadena de texto.',
            'vin.max' => 'El VIN no puede exceder los 17 caracteres.',
            'vin.regex' => 'El VIN debe contener solo letras (excepto I, O, Q) y números en un formato de 17 caracteres.',
            'vin.unique' => 'Este VIN ya está registrado.',
            'engine_number.required' => 'El número de motor de la maquinaria es obligatorio.',
            'engine_number.string' => 'El número de motor debe ser una cadena de texto.',
            'engine_number.max' => 'El número de motor no puede exceder los 10 caracteres.',
            'engine_number.regex' => 'El número de motor solo puede contener letras y números.',
            'engine_number.unique' => 'Este número de motor ya está registrado.',
            'serial_number.required' => 'El número de serie de la maquinaria es obligatorio.',
            'serial_number.string' => 'El número de serie debe ser una cadena de texto.',
            'serial_number.max' => 'El número de serie no puede exceder los 17 caracteres.',
            'serial_number.regex' => 'El número de serie solo puede contener letras y números.',
            'serial_number.unique' => 'Este número de serie ya está registrado.',
            'year.required' => 'El año de la maquinaria es obligatorio.',
            'year.string' => 'El año debe ser una cadena de texto.',
            'year.max' => 'El año no puede exceder los 4 caracteres.',
            'year.regex' => 'El año debe ser un número de 4 dígitos.',
            'color.required' => 'El color de la maquinaria es obligatorio.',
            'color.string' => 'El color debe ser una cadena de texto.',
            'color.max' => 'El color no puede exceder los 50 caracteres.',
            'color.regex' => 'El color solo puede contener letras, espacios y guiones.',
            'placa.string' => 'La placa debe ser una cadena de texto.',
            'placa.max' => 'La placa no puede exceder los 6 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede superar los 1000 caracteres.',
            'status.boolean' => 'El estado debe ser verdadero o falso.',
        ];
    }

    /**
     * Preparar los datos antes de la validación.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if (!array_key_exists('status', $this->all()) || $this->all()['status'] === null) {
            $this->merge(['status' => true]);
        }
    }
}