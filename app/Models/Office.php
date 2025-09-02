<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'short_name',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function workers()
    {
        return $this->hasMany(Worker::class, 'office_id');
    }

    public static function boot()
    {
        parent::boot();

        // [Comentario] Sobrescribe el método boot para agregar lógica personalizada antes de ciertas operaciones.
        static::deleting(function ($office) {
            // [Comentario] Verifica si la oficina tiene trabajadores asociados antes de eliminarla.
            // [Comentario] Si existe al menos un trabajador, lanza una excepción para evitar la eliminación.
            if ($office->workers()->exists()) {
                throw new \Exception('No se puede eliminar esta oficina porque está asignada a uno o más trabajadores.');
            }
        });

        static::updating(function ($office) {
            // [Comentario] Verifica si el estado está cambiando y si se intenta desactivar (false) con trabajadores asociados.
            // [Comentario] Si es así, lanza una excepción para evitar la desactivación.
            if ($office->isDirty('status') && !$office->status && $office->workers()->exists()) {
                throw new \Exception('No se puede desactivar esta oficina porque hay trabajadores asignados.');
            }
        });
    }

    /**
     * Mutator to set the name in uppercase.
     *
     * @param string $value
     * @return void
     */
    // Define un mutador (mutator) para convertir el valor del campo 'name' a mayúsculas antes de guardarlo.
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    // Define un mutador (mutator) para convertir el valor del campo 'name' a mayúsculas antes de guardarlo.
    public function setShortNameAttribute($value)
    {
        $this->attributes['short_name'] = strtoupper($value);
    }
}