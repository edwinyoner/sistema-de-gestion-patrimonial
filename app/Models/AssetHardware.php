<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetHardware extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'asset_hardwares';

    protected $fillable = [
        'company_asset_id',
        'hardware_name',
        'brand',
        'model',
        'color',
        'serial_number',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    // Relación: un hardware pertenece a un activo de la compañía
    public function companyAsset(): BelongsTo
    {
        return $this->belongsTo(CompanyAsset::class, 'company_asset_id');
    }

    /**
     * Mutador para convertir el nombre del hardware a mayúsculas antes de guardarlo
     */
    public function setHardwareNameAttribute($value)
    {
        $this->attributes['hardware_name'] = strtoupper($value); // Corregido de 'name' a 'hardware_name'
    }
}