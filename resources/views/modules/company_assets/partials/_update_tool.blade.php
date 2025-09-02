<div class="row">
    <div class="col-md-4">
        <x-adminlte-input name="tool_name" label="Nombre" placeholder="Ej. Taladro Eléctrico" label-class="text-lightblue" 
            value="{{ old('tool_name', $companyAsset->tool->tool_name ?? '') }}" required maxlength="100">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-tag text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="brand" label="Marca" placeholder="Ej. Bosch" label-class="text-lightblue" 
            value="{{ old('brand', $companyAsset->tool->brand ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-certificate text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="model" label="Modelo" placeholder="Ej. GSB 13 RE" label-class="text-lightblue" 
            value="{{ old('model', $companyAsset->tool->model ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-tools text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="color" label="Color" placeholder="Ej. Negro" label-class="text-lightblue" 
            value="{{ old('color', $companyAsset->tool->color ?? '') }}" nullable maxlength="30">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-palette text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-12">
        <x-adminlte-textarea name="description" label="Descripción" placeholder="Escriba una descripción detallada (ej. tipo, uso, características técnicas)..." label-class="text-lightblue" rows="4" 
            value="{{ old('description', $companyAsset->tool->description ?? '') }}" nullable>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-align-left text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>
    </div>
</div>