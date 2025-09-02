<div class="row">
    <div class="col-md-4">
        <x-adminlte-input name="machinerie_name" label="Nombre" placeholder="Ej. Volquete" label-class="text-lightblue" 
            value="{{ old('machinerie_name', $companyAsset->machinery->machinerie_name ?? '') }}" required maxlength="100">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-tag text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="brand" label="Marca" placeholder="Ej. Volvo" label-class="text-lightblue" 
            value="{{ old('brand', $companyAsset->machinery->brand ?? '') }}" required maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-certificate text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="model" label="Modelo" placeholder="Ej. PC200" label-class="text-lightblue" 
            value="{{ old('model', $companyAsset->machinery->model ?? '') }}" required maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-cogs text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="vin" label="VIN" placeholder="Ej. 1HGCM82633A123456" label-class="text-lightblue" 
            value="{{ old('vin', $companyAsset->machinery->vin ?? '') }}" required maxlength="17">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-car-side text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="engine_number" label="Número de Motor" placeholder="Ej. 123456" label-class="text-lightblue" 
            value="{{ old('engine_number', $companyAsset->machinery->engine_number ?? '') }}" required maxlength="20">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-tachometer-alt text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="serial_number" label="Número de Serie" placeholder="Ej. 987654321" label-class="text-lightblue" 
            value="{{ old('serial_number', $companyAsset->machinery->serial_number ?? '') }}" required maxlength="20">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-barcode text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="year" label="Año" placeholder="Ej. 2020" label-class="text-lightblue" 
            value="{{ old('year', $companyAsset->machinery->year ?? '') }}" required maxlength="4">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-calendar text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="color" label="Color" placeholder="Ej. Amarillo" label-class="text-lightblue" 
            value="{{ old('color', $companyAsset->machinery->color ?? '') }}" required maxlength="30">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-palette text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="placa" label="Placa" placeholder="Ej. ABC123" label-class="text-lightblue" 
            value="{{ old('placa', $companyAsset->machinery->placa ?? '') }}" nullable maxlength="10">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-id-card text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-12">
        <x-adminlte-textarea name="description" label="Descripción" placeholder="Escriba una descripción detallada (ej. kilometraje, caballos de fuerza)..." label-class="text-lightblue" rows="4" 
            value="{{ old('description', $companyAsset->machinery->description ?? '') }}" nullable>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-align-left text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>
    </div>
</div>