<div class="row">
    <div class="col-md-4">
        <x-adminlte-input name="furniture_name" label="Nombre" placeholder="Ej. Mesa de Oficina" label-class="text-lightblue" 
            value="{{ old('furniture_name', $companyAsset->furniture->furniture_name ?? '') }}" data-required required maxlength="100">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-tag text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="brand" label="Marca" placeholder="Ej. IKEA" label-class="text-lightblue" 
            value="{{ old('brand', $companyAsset->furniture->brand ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-certificate text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="model" label="Modelo" placeholder="Ej. Modelo A" label-class="text-lightblue" 
            value="{{ old('model', $companyAsset->furniture->model ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-couch text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="color" label="Color" placeholder="Ej. Marrón" label-class="text-lightblue" 
            value="{{ old('color', $companyAsset->furniture->color ?? '') }}" nullable maxlength="30">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-palette text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="material" label="Material" placeholder="Ej. Madera" label-class="text-lightblue" 
            value="{{ old('material', $companyAsset->furniture->material ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-tools text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="dimensions" label="Dimensiones" placeholder="Ej. 120x60x80 cm" label-class="text-lightblue" 
            value="{{ old('dimensions', $companyAsset->furniture->dimensions ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-ruler-combined text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-12">
        <x-adminlte-textarea name="description" label="Descripción" placeholder="Escriba una descripción detallada (ej. atributos específicos)..." label-class="text-lightblue" rows="4" 
            value="{{ old('description', $companyAsset->furniture->description ?? '') }}" nullable>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-align-left text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>
    </div>
</div>