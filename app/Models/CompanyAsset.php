<?php

namespace App\Models;

use App\Traits\HasQrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAsset extends Model
{
    use HasFactory;     // Factory
    use SoftDeletes;    // Soft deletes
    use HasQrCode;      // Trait para generación de QR

    protected $fillable = [
        'patrimonial_code',
        'office_id',
        'responsible_user_id',
        'final_user_id',
        'asset_type_id',
        'asset_state_id',
        'acquisition_date',
        'inventory_date',
        'photo_path',
        'qr_code_path', 
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'acquisition_date' => 'date',
        'inventory_date' => 'date',
        'deleted_at' => 'datetime',
    ];

    // Relación: un activo pertenece a una oficina
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    // Relación: un activo pertenece a un tipo de activo
    public function assetType(): BelongsTo
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id');
    }

    // Relación: un activo tiene un usuario final (trabajador)
    public function finalUser(): BelongsTo
    {
        return $this->belongsTo(Worker::class, 'final_user_id');
    }

    // Relación: un activo tiene un usuario responsable (jefe)
    public function responsibleUser(): BelongsTo
    {
        return $this->belongsTo(Worker::class, 'responsible_user_id');
    }

    // Relación: un activo pertenece a un estado
    public function assetState(): BelongsTo
    {
        return $this->belongsTo(AssetState::class, 'asset_state_id');
    }

    // Relaciones de uno a uno con los tipos de activos
    public function furniture()
    {
        return $this->hasOne(AssetFurniture::class);
    }

    public function hardware()
    {
        return $this->hasOne(AssetHardware::class);
    }

    public function machinery()
    {
        return $this->hasOne(AssetMachinery::class);
    }

    public function software()
    {
        return $this->hasOne(AssetSoftware::class);
    }

    public function tool()
    {
        return $this->hasOne(AssetTool::class);
    }

    public function other()
    {
        return $this->hasOne(AssetOther::class);
    }

    // Mutators mejorados
    public function setPatrimonialCodeAttribute($value): void
    {
        $this->attributes['patrimonial_code'] = strtoupper(trim($value));
    }

    // Accessors ajustados (sin dependencia de assetable)
    public function getFullDescriptionAttribute(): string
    {
        $details = '';
        if ($this->furniture) {
            $details = $this->furniture->furniture_name;
        } elseif ($this->hardware) {
            $details = $this->hardware;
        } elseif ($this->machinery) {
            $details = $this->machinery;
        } elseif ($this->software) {
            $details = $this->software; 
        } elseif ($this->tool) {
            $details = $this->tool;
        } elseif ($this->other) {
            $details = $this->other;
        }
        return $details ?: 'Sin detalles';
    }

    // Método mejorado para obtener el tipo de activo traducido
    public function getTranslatedAssetTypeAttribute(): string
    {
        $typeMap = [
            1 => 'Hardware', // Asumiendo que 1 es el ID para AssetHardware
            2 => 'Software', // Asumiendo que 2 es el ID para AssetSoftware
            3 => 'Mobiliario', // Asumiendo que 3 es el ID para AssetFurniture
            4 => 'Maquinaria', // Asumiendo que 4 es el ID para AssetMachinery
            5 => 'Herramientas', // Asumiendo que 5 es el ID para AssetTool
            6 => 'Otros', // Asumiendo que 6 es el ID para AssetOther
        ];

        return $typeMap[$this->asset_type_id] ?? 'Sin tipo';
    }

    // Scopes útiles (ajustados sin assetable_type)
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeByOffice($query, $officeId)
    {
        return $query->where('office_id', $officeId);
    }

    public function scopeByAssetType($query, $assetTypeId)
    {
        return $query->where('asset_type_id', $assetTypeId);
    }

    // Método para verificar si el activo está asignado
    public function isAssigned(): bool
    {
        return $this->final_user_id !== null || $this->responsible_user_id !== null;
    }

    // Mejora en el método boot
    public static function boot()
    {
        parent::boot();

        static::creating(function ($asset) {
            // Validar que el código patrimonial no esté vacío
            if (empty($asset->patrimonial_code)) {
                throw new \Exception('El código patrimonial es obligatorio.');
            }
        });

        static::updating(function ($asset) {
            // Validación existente mejorada
            if ($asset->isDirty('status') && !$asset->status && $asset->isAssigned()) {
                throw new \Exception('No se puede desactivar este activo porque tiene usuarios asignados.');
            }
        });

        static::deleting(function ($asset) {
            // Validar que no se pueda eliminar si está asignado
            if ($asset->isAssigned()) {
                throw new \Exception('No se puede eliminar este activo porque tiene usuarios asignados.');
            }
        });
    }
}