<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetSoftware extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'asset_softwares'; // Añadir esta línea para especificar el nombre correcto de la tabla

    protected $fillable = [
        'company_asset_id',
        'software_type_id',
        'software_name', // Ajustado a software_name para coincidir con la migración
        'version',
        'license_key',
        'license_expiry',
        'description',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        'license_expiry' => 'date',
        'deleted_at' => 'datetime', // Mover de $dates a $casts
    ];

    // $dates ya no es necesario, se maneja en $casts

    // Relación: un software pertenece a un activo de la compañía
    public function companyAsset(): BelongsTo
    {
        return $this->belongsTo(CompanyAsset::class, 'company_asset_id');
    }

    // Relación: un software pertenece a un tipo de software
    public function softwareType(): BelongsTo
    {
        return $this->belongsTo(SoftwareType::class, 'software_type_id');
    }

    public function setSoftwareNameAttribute($value) // Ajustado a software_name
    {
        $this->attributes['software_name'] = strtoupper($value);
    }
}