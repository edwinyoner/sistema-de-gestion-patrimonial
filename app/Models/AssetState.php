<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Define el espacio de nombres para el modelo, indicando que pertenece al directorio App\Models.
class AssetState extends Model
{
    // Usa el trait HasFactory para permitir la creación de fábricas de datos ficticios (útil para pruebas).
    // Usa el trait SoftDeletes para habilitar la eliminación lógica (soft deletes) en lugar de eliminar físicamente los registros.
    use HasFactory;
    use SoftDeletes;

    // Define los campos que se pueden llenar masivamente (mass assignable) al crear o actualizar un registro.
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    // Especifica los atributos que deben ser convertidos (cast) a tipos específicos al interactuar con ellos.
    // Aquí, 'status' se convierte a booleano para asegurar que siempre sea true o false.
    protected $casts = [
        'status' => 'boolean',
    ];

    // Define los atributos que deben tratarse como fechas. En este caso, 'deleted_at' se usa para la eliminación lógica.
    protected $dates = [
        'deleted_at',
    ];

    // Define una relación de uno a muchos: un estado de activo puede tener muchos activos.
    public function companyAssets()
    {
        return $this->hasMany(CompanyAsset::class, 'asset_state_id');
    }
    

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($assetState) {
            if ($assetState->companyAssets()->exists()) {
                throw new \Exception('No se puede eliminar este estado de activo porque está asignado a uno o más activos.');
            }
        });

        static::updating(function ($assetState) {
            if ($assetState->isDirty('status') && !$assetState->status && $assetState->companyAssets()->exists()) {
                throw new \Exception('No se puede desactivar este estado de activo porque hay activos asignados.');
            }
        });
    }

    // Define un mutador (mutator) para convertir el valor del campo 'name' a mayúsculas antes de guardarlo.
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}