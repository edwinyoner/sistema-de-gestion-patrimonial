<div class="row">
    <div class="col-md-4">
        <x-adminlte-select name="software_type_id" label="Tipo de Software" label-class="text-lightblue" required>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-list text-white"></i>
                </div>
            </x-slot>
            <option value="" disabled>Seleccione un tipo de software</option>
            @foreach ($softwareTypes as $type)
                <option value="{{ $type->id }}" {{ old('software_type_id') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </x-adminlte-select>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="software_name" label="Nombre" placeholder="Ej. Microsoft Office" label-class="text-lightblue" value="{{ old('software_name') }}" required>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-tag text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="version" label="Versión" placeholder="Ej. 2021" label-class="text-lightblue" value="{{ old('version') }}" nullable>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-code-branch text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    
    <div class="col-md-4 license-field" style="display: none;">
        <x-adminlte-input name="license_key" label="Clave de Licencia" placeholder="Ej. XXXXX-XXXXX-XXXXX" label-class="text-lightblue" value="{{ old('license_key') }}" nullable>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-key text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4 license-field" style="display: none;">
        <x-adminlte-input name="license_expiry" label="Fecha de Expiración de Licencia" type="date" label-class="text-lightblue" value="{{ old('license_expiry') }}" nullable>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-calendar-alt text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-12">
        <x-adminlte-textarea name="description" label="Descripción" placeholder="Escriba una descripción detallada (ej. notas adicionales)..." label-class="text-lightblue" rows="4" value="{{ old('description') }}" nullable>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-align-left text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const softwareTypeSelect = document.getElementById('software_type_id');
        const licenseFields = document.querySelectorAll('.license-field');

        // Función para actualizar la visibilidad
        function toggleLicenseFields() {
            const isProprietary = softwareTypeSelect.value == 1;
            licenseFields.forEach(field => {
                field.style.display = isProprietary ? 'block' : 'none';
            });
        }

        // Establecer visibilidad inicial basada en el valor actual
        toggleLicenseFields();

        // Escuchar cambios
        softwareTypeSelect.addEventListener('change', toggleLicenseFields);
    });
</script>
@endpush