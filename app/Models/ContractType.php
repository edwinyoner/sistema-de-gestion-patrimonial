<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Define el espacio de nombres para el modelo, indicando que pertenece al directorio App\Models.
class ContractType extends Model
{
    // Usa el trait HasFactory para permitir la creación de fábricas de datos ficticios (útil para pruebas).
    // Usa el trait SoftDeletes para habilitar la eliminación lógica (soft deletes).
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

    // Define los atributos que deben tratarse como fechas. Incluye 'deleted_at' para la eliminación lógica.
    protected $dates = [
        'deleted_at',
    ];

    // Define una relación de uno a muchos: un tipo de contrato puede tener muchos trabajadores.
    public function workers()
    {
        return $this->hasMany(Worker::class, 'contract_type_id');
    }

    public static function boot()
    {
        parent::boot();

        // Sobrescribe el método boot para agregar lógica personalizada antes de ciertas operaciones.
        // Verifica si el tipo de contrato tiene trabajadores asociados antes de eliminarlo.
        static::deleting(function ($contractType) {
            if ($contractType->workers()->exists()) {
                throw new \Exception('No se puede eliminar este tipo de contrato porque está asignado a uno o más trabajadores.');
            }
        });

        // Verifica si el estado está cambiando y si se intenta desactivar (false) con trabajadores asociados.
        static::updating(function ($contractType) {
            if ($contractType->isDirty('status') && !$contractType->status && $contractType->workers()->exists()) {
                throw new \Exception('No se puede desactivar este tipo de contrato porque hay trabajadores asignados.');
            }
        });
    }

    // Define un mutador (mutator) para convertir el valor del campo 'name' a mayúsculas antes de guardarlo.
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}