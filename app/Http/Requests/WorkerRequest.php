<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
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
                'dni' => [
                    'required',
                    'string',
                    'size:8',
                    'unique:workers,dni',
                    'regex:/^[0-9]+$/',
                ],
                'first_name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'last_name_paternal' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'last_name_maternal' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'email' => 'required|email|max:50|unique:workers,email',
                'phone' => 'nullable|string|size:9|regex:/^[0-9]+$/',
                'office_id' => 'required|exists:offices,id',
                'job_position_id' => 'required|exists:job_positions,id',
                'contract_type_id' => 'required|exists:contract_types,id',
                'status' => 'boolean',
            ];
        }

        if ($this->isMethod('put')) {
            $workerId = $this->route('worker') ? $this->route('worker')->id : null;
            return [
                'dni' => [
                    'required',
                    'string',
                    'size:8',
                    "unique:workers,dni,{$workerId}",
                    'regex:/^[0-9]+$/',
                ],
                'first_name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'last_name_paternal' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'last_name_maternal' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'email' => "required|email|max:50|unique:workers,email,{$workerId}",
                'phone' => 'nullable|string|size:9|regex:/^[0-9]+$/',
                'office_id' => 'required|exists:offices,id',
                'job_position_id' => 'required|exists:job_positions,id',
                'contract_type_id' => 'required|exists:contract_types,id',
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
            'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',
            'dni.size' => 'El DNI debe tener exactamente 8 caracteres.',
            'dni.unique' => 'El DNI ya está registrado.',
            'dni.regex' => 'El DNI solo puede contener números.',
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.string' => 'El nombre debe ser una cadena de texto.',
            'first_name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'first_name.max' => 'El nombre no puede exceder los 100 caracteres.',
            'first_name.regex' => 'El nombre solo puede contener letras, espacios y guiones.',
            'last_name_paternal.required' => 'El apellido paterno es obligatorio.',
            'last_name_paternal.string' => 'El apellido paterno debe ser una cadena de texto.',
            'last_name_paternal.min' => 'El apellido paterno debe tener al menos 3 caracteres.',
            'last_name_paternal.max' => 'El apellido paterno no puede exceder los 100 caracteres.',
            'last_name_paternal.regex' => 'El apellido paterno solo puede contener letras, espacios y guiones.',
            'last_name_maternal.required' => 'El apellido materno es obligatorio.',
            'last_name_maternal.string' => 'El apellido materno debe ser una cadena de texto.',
            'last_name_maternal.min' => 'El apellido materno debe tener al menos 3 caracteres.',
            'last_name_maternal.max' => 'El apellido materno no puede exceder los 100 caracteres.',
            'last_name_maternal.regex' => 'El apellido materno solo puede contener letras, espacios y guiones.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.max' => 'El correo electrónico no puede exceder los 50 caracteres.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'phone.size' => 'El teléfono debe tener exactamente 9 caracteres.',
            'phone.regex' => 'El teléfono solo puede contener números.',
            'office_id.required' => 'Debe seleccionar una oficina para el trabajador.',
            'office_id.exists' => 'La oficina seleccionada no existe.',
            'job_position_id.required' => 'Debe seleccionar un cargo para el trabajador.',
            'job_position_id.exists' => 'El cargo seleccionado no existe.',
            'contract_type_id.required' => 'Debe seleccionar un tipo de contrato para el trabajador.',
            'contract_type_id.exists' => 'El tipo de contrato seleccionado no existe.',
            'status.boolean' => 'El estado debe ser verdadero o falso.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if (!array_key_exists('status', $this->all()) || $this->all()['status'] === null) {
            $this->merge(['status' => true]);
        }
    }
}