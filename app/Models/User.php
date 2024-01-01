<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles as HasRolesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_code',
        'otp_verified',
        'profile_image', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
{
    return $this->belongsToMany(Role::class, 'role_user');
}

public function permissions()
    {
        return $this->roles->flatMap->permissions->pluck('name')->unique();
    }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }

    public function hasPermission($permission)
    {
        return $this->permissions()->contains($permission);
    }
    

    public static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->notify(new \App\Notifications\UserCreatedNotification($user));
        });

        static::deleted(function ($user) {
            $user->notify(new \App\Notifications\UserDeletedNotification($user));
        });
    }


}
