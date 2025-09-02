<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'force_password_change',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'force_password_change' => 'boolean',
        'status' => 'boolean',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function adminlte_image()
    {
        if ($this->profile_photo_path) {
            return url($this->profile_photo_url);
        }
        return asset('assets/images/profile/user.jpg');
    }

    public function adminlte_desc()
    {
        $role = $this->roles->pluck('name')->first();
        if ($role) {
            return "Rol: $role - $this->name | Winner Systems Member";
        }
        return "Miembro de Winner Systems Corporation - $this->name";
    }

    public function adminlte_profile_url()
    {
        return 'user/profile';
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}
