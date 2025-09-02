<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosition extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'deleted_at',
    ];

    // Relación: una oficina tiene muchos trabajadores
    public function workers()
    {
        return $this->hasMany(Worker::class, 'job_position_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($jobPosition) {
            if ($jobPosition->workers()->exists()) {
                throw new \Exception('No se puede eliminar este cargo porque está asignado a uno o más trabajadores.');
            }
        });

        static::updating(function ($jobPosition) {
            if ($jobPosition->isDirty('status') && !$jobPosition->status && $jobPosition->workers()->exists()) {
                throw new \Exception('No se puede desactivar este cargo porque hay trabajadores asignados.');
            }
        });
    }

    /**
     * Mutator to set the name in uppercase.
     *
     * @param string $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}
