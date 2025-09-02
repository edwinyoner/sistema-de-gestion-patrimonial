<div class="row">
    <div class="col-md-4">
        <x-adminlte-input name="hardware_name" label="Nombre" placeholder="Ej. Computadora Dell" label-class="text-lightblue" 
            value="{{ old('hardware_name', $companyAsset->hardware->hardware_name ?? '') }}" data-required required maxlength="100">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-tag text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="brand" label="Marca" placeholder="Ej. Dell" label-class="text-lightblue" 
            value="{{ old('brand', $companyAsset->hardware->brand ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-certificate text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="model" label="Modelo" placeholder="Ej. Latitude 5520" label-class="text-lightblue" 
            value="{{ old('model', $companyAsset->hardware->model ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-laptop text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="color" label="Color" placeholder="Ej. Negro" label-class="text-lightblue" 
            value="{{ old('color', $companyAsset->hardware->color ?? '') }}" nullable maxlength="30">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-palette text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="serial_number" label="Número de Serie" placeholder="Ej. 123456789" label-class="text-lightblue" 
            value="{{ old('serial_number', $companyAsset->hardware->serial_number ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-barcode text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-12">
        <x-adminlte-textarea name="description" label="Descripción" placeholder="Escriba una descripción detallada (ej. procesador, memoria, puertos)..." label-class="text-lightblue" rows="4" 
            value="{{ old('description', $companyAsset->hardware->description ?? '') }}" nullable>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-align-left text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>
    </div>
</div>