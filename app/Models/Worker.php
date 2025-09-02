<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'dni',
        'first_name',
        'last_name_paternal',
        'last_name_maternal',
        'email',
        'phone',
        'job_position_id',
        'office_id',
        'contract_type_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    // Relación: un trabajador pertenece a una oficina
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    // Relación: un trabajador pertenece a un cargo
    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class, 'job_position_id');
    }

    // Relación: un trabajador pertenece a un tipo de contrato
    public function contractType(): BelongsTo
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id');
    }

    // Relación: un trabajador puede tener muchos activos asignados
    public function companyAssets()
    {
        return $this->hasMany(CompanyAsset::class, 'final_user_id')->orWhere('responsible_user_id', $this->id);
    }
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtoupper($value);
    }

    public function setLastNamePaternalAttribute($value): void
    {
        $this->attributes['last_name_paternal'] = strtoupper($value);
    }

    public function setLastNameMaternalAttribute($value): void
    {
        $this->attributes['last_name_maternal'] = strtoupper($value);
    }

    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = strtolower($value);
    }

    public static function boot()
    {
        parent::boot();

        //No se puede desactivar un trabajador con bienes asignados
        static::updating(function ($worker) {
            if ($worker->isDirty('status') && !$worker->status && $worker->company_assets()->exists()) {
                throw new \Exception('No se puede desactivar este trabajador porque tiene bienes asignados.');
            }
        });
    }
}
