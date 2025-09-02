<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ajusta según tu lógica de autorización
    }

    public function rules(): array
    {
        $assetId = $this->route('company_asset') ? $this->route('company_asset')->id : null;

        if ($this->isMethod('post')) {
            $rules = [
                'patrimonial_code' => [
                    'required',
                    'string',
                    'max:10',
                    'unique:company_assets,patrimonial_code',
                    'regex:/^[A-Z0-9\-]+$/u',
                ],
                'office_id' => 'required|exists:offices,id',
                'final_user_id' => 'required|exists:workers,id',
                'responsible_user_id' => 'required|exists:workers,id',
                'asset_type_id' => 'required|exists:asset_types,id',
                'asset_state_id' => 'required|exists:asset_states,id',
                'acquisition_date' => 'nullable|date|before_or_equal:today',
                'inventory_date' => 'required|date|before_or_equal:today',
                'photo_path' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
                'status' => 'boolean',
            ];
        } elseif ($this->isMethod('put')) {
            $rules = [
                'patrimonial_code' => [
                    'required',
                    'string',
                    'max:10',
                    Rule::unique('company_assets', 'patrimonial_code')->ignore($assetId),
                    'regex:/^[A-Z0-9\-]+$/u',
                ],
                'office_id' => 'required|exists:offices,id',
                'final_user_id' => 'required|exists:workers,id',
                'responsible_user_id' => 'required|exists:workers,id',
                'asset_type_id' => 'required|exists:asset_types,id',
                'asset_state_id' => 'required|exists:asset_states,id',
                'acquisition_date' => 'nullable|date|before_or_equal:today',
                'inventory_date' => 'required|date|before_or_equal:today',
                'photo_path' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
                'status' => 'boolean',
            ];
        } else {
            return [];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'patrimonial_code.required' => 'El código patrimonial es obligatorio.',
            'patrimonial_code.max' => 'El código patrimonial no debe superar los 10 caracteres.',
            'patrimonial_code.unique' => 'Este código patrimonial ya está en uso.',
            'patrimonial_code.regex' => 'El código patrimonial solo puede contener letras mayúsculas, números y guiones.',
            'office_id.required' => 'La oficina es obligatoria.',
            'office_id.exists' => 'La oficina seleccionada no existe.',
            'final_user_id.required' => 'El usuario final es obligatorio.',
            'final_user_id.exists' => 'El usuario final seleccionado no existe.',
            'responsible_user_id.required' => 'El usuario responsable es obligatorio.',
            'responsible_user_id.exists' => 'El usuario responsable seleccionado no existe.',
            'asset_type_id.required' => 'El tipo de activo es obligatorio.',
            'asset_type_id.exists' => 'El tipo de activo seleccionado no existe.',
            'asset_state_id.required' => 'El estado del activo es obligatorio.',
            'asset_state_id.exists' => 'El estado del activo seleccionado no existe.',
            'acquisition_date.date' => 'La fecha de adquisición debe ser una fecha válida.',
            'acquisition_date.before_or_equal' => 'La fecha de adquisición no puede ser futura.',
            'inventory_date.required' => 'La fecha de inventario es obligatoria.',
            'inventory_date.date' => 'La fecha de inventario debe ser una fecha válida.',
            'inventory_date.before_or_equal' => 'La fecha de inventario no puede ser futura.',
            'photo_path.image' => 'El archivo debe ser una imagen.',
            'photo_path.mimes' => 'La imagen debe ser de tipo: jpeg, jpg, png o webp.',
            'photo_path.max' => 'La imagen no debe superar los 5MB.',
            'status.boolean' => 'El estado debe ser un valor booleano.',
        ];
    }

    public function attributes(): array
    {
        return [
            'patrimonial_code' => 'código patrimonial',
            'office_id' => 'oficina',
            'final_user_id' => 'usuario final',
            'responsible_user_id' => 'usuario responsable',
            'asset_type_id' => 'tipo de activo',
            'asset_state_id' => 'estado del activo',
            'acquisition_date' => 'fecha de adquisición',
            'inventory_date' => 'fecha de inventario',
            'photo_path' => 'foto',
            'status' => 'estado',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('patrimonial_code')) {
            $this->merge(['patrimonial_code' => strtoupper(trim($this->patrimonial_code))]);
        }
        if (!$this->has('status') || $this->status === null) {
            $this->merge(['status' => true]);
        }
        $nullableFields = ['final_user_id', 'responsible_user_id', 'acquisition_date', 'photo_path'];
        foreach ($nullableFields as $field) {
            if ($this->filled($field) && $this->$field === '') {
                $this->merge([$field => null]);
            }
        }
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->filled('acquisition_date') && $this->filled('inventory_date')) {
                $acquisitionDate = \Carbon\Carbon::parse($this->acquisition_date);
                $inventoryDate = \Carbon\Carbon::parse($this->inventory_date);
                if ($acquisitionDate->gt($inventoryDate)) {
                    $validator->errors()->add('acquisition_date', 'La fecha de adquisición no puede ser posterior a la fecha de inventario.');
                }
            }
        });
    }
}