<?php

namespace App\Models;

use App\Models\Core\KycVerification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'password',
        'last_login_at',
        'last_login_ip',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isUser() {
        return $this->role === 'user';
    }
    public function kycVerification($status = 'verified'): HasOne
    {
        return $this->hasOne(KycVerification::class)->where('status', $status);
    }
}
