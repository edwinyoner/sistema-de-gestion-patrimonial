<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetMachinery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'asset_machineries';

    protected $fillable = [
        'company_asset_id',
        'machinerie_name',
        'brand',
        'model',
        'vin',
        'engine_number',
        'serial_number',
        'year',
        'color',
        'placa',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'year' => 'string', // Mantener como texto de 4 caracteres según la migración
        'deleted_at' => 'datetime', // Usar casts en lugar de $dates
    ];

    // Relación: una maquinaria pertenece a un CompanyAsset
    public function companyAsset(): BelongsTo
    {
        return $this->belongsTo(CompanyAsset::class, 'company_asset_id');
    }

    // Mutadores mejorados con trim()
    public function setMachinerieNameAttribute($value): void
    {
        $this->attributes['machinerie_name'] = strtoupper(trim($value));
    }

    public function setBrandAttribute($value): void
    {
        $this->attributes['brand'] = $value ? strtoupper(trim($value)) : null;
    }

    public function setModelAttribute($value): void
    {
        $this->attributes['model'] = $value ? strtoupper(trim($value)) : null;
    }

    public function setVinAttribute($value): void
    {
        $this->attributes['vin'] = strtoupper(trim($value));
    }

    public function setEngineNumberAttribute($value): void
    {
        $this->attributes['engine_number'] = strtoupper(trim($value));
    }

    public function setSerialNumberAttribute($value): void
    {
        $this->attributes['serial_number'] = strtoupper(trim($value));
    }

    public function setYearAttribute($value): void
    {
        $this->attributes['year'] = trim($value);
    }

    public function setColorAttribute($value): void
    {
        $this->attributes['color'] = $value ? strtoupper(trim($value)) : null;
    }

    public function setPlacaAttribute($value): void
    {
        $this->attributes['placa'] = $value ? strtoupper(trim($value)) : null;
    }

    public function setDescriptionAttribute($value): void
    {
        $this->attributes['description'] = $value ? trim($value) : null;
    }
}