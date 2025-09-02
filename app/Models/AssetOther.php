<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetOther extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'asset_others';

    protected $fillable = [
        'company_asset_id',
        'other_name',
        'brand',
        'model',
        'color',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'deleted_at' => 'datetime', // Mover de $dates a $casts para consistencia
    ];

    // Relación: un activo diverso pertenece a un activo de la compañía
    public function companyAsset(): BelongsTo
    {
        return $this->belongsTo(CompanyAsset::class, 'company_asset_id');
    }

    // Mutadores mejorados con trim() y strtoupper()
    public function setOtherNameAttribute($value): void
    {
        $this->attributes['other_name'] = strtoupper(trim($value));
    }

    public function setBrandAttribute($value): void
    {
        $this->attributes['brand'] = $value ? strtoupper(trim($value)) : null;
    }

    public function setModelAttribute($value): void
    {
        $this->attributes['model'] = $value ? strtoupper(trim($value)) : null;
    }

    public function setColorAttribute($value): void
    {
        $this->attributes['color'] = $value ? strtoupper(trim($value)) : null;
    }

    public function setDescriptionAttribute($value): void
    {
        $this->attributes['description'] = $value ? trim($value) : null;
    }
}