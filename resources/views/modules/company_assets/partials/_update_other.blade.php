<div class="row">
    <div class="col-md-4">
        <x-adminlte-input name="other_name" label="Nombre" placeholder="Ej. Microondas Genérico" label-class="text-lightblue" 
            value="{{ old('other_name', $companyAsset->other->other_name ?? '') }}" required maxlength="100">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-tag text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="brand" label="Marca" placeholder="Ej. Oster" label-class="text-lightblue" 
            value="{{ old('brand', $companyAsset->other->brand ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-certificate text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="model" label="Modelo" placeholder="Ej. AL123" label-class="text-lightblue" 
            value="{{ old('model', $companyAsset->other->model ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-cube text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="color" label="Color" placeholder="Ej. Negro - Blanco - Gris" label-class="text-lightblue" 
            value="{{ old('color', $companyAsset->other->color ?? '') }}" nullable maxlength="50">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-palette text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-12">
        <x-adminlte-textarea name="description" label="Descripción" placeholder="Escriba una descripción detallada (ej. atributos específicos)..." label-class="text-lightblue" rows="4" 
            value="{{ old('description', $companyAsset->other->description ?? '') }}" nullable>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-info">
                    <i class="fas fa-align-left text-white"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>
    </div>
</div>