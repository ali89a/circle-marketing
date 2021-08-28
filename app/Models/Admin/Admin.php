<?php

namespace App\Models\Admin;

use App\Models\AdminInfo;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Admin\ResetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    public function sendPasswordResetNotification($token)
    {
        $delay = now()->addSeconds(10);
        $this->notify((new ResetPasswordNotification($token))->delay($delay));
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'creator_user_id');
    }
    public function customers()
    {
        return $this->hasMany('App\Models\User', 'creator_user_id');
    }

    public function admininfo()
    {
        return $this->hasOne(AdminInfo::class);
    }
}
