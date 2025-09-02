<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoftwareType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'deleted_at' => 'datetime', // Mover de $dates a $casts para consistencia
    ];

    // Define una relación de uno a muchos: un tipo de software puede tener muchos activos de software.
    public function assetSoftwares()
    {
        return $this->hasMany(AssetSoftware::class, 'software_type_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($softwareType) {
            if ($softwareType->assetSoftwares()->exists()) { // Corregido a assetSoftwares
                throw new \Exception('No se puede eliminar este tipo de software porque está asignado a uno o más activos de software.');
            }
        });

        static::updating(function ($softwareType) {
            if ($softwareType->isDirty('status') && !$softwareType->status && $softwareType->assetSoftwares()->exists()) { // Corregido a assetSoftwares
                throw new \Exception('No se puede desactivar este tipo de software porque hay activos de software asignados.');
            }
        });
    }
}