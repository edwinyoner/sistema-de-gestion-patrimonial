<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetFurniture extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'asset_furnitures';

    protected $fillable = [
        'company_asset_id',
        'furniture_name',
        'brand',
        'model',
        'color',
        'material',
        'dimensions',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    // Relación: un mobiliario pertenece a un CompanyAsset
    public function companyAsset(): BelongsTo
    {
        return $this->belongsTo(CompanyAsset::class, 'company_asset_id');
    }

    // Mutators mejorados
    public function setFurnitureNameAttribute($value): void
    {
        $this->attributes['furniture_name'] = strtoupper(trim($value));
    }

    public function setBrandAttribute($value): void
    {
        $this->attributes['brand'] = $value ? strtoupper(trim($value)) : null;
    }

    public function setModelAttribute($value): void
    {
        $this->attributes['model'] = $value ? strtoupper(trim($value)) : null;
    }
}