<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use SoftDeletes;

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const STATUS_FORBIDDEN = -9;
    
    const STATUS_LEVELS = [
        '-9' => 'danger',
        '0' => 'warning',
        '1' => 'success',
    ];

    const STATUS_TEXTS = [
        '-9' => '账户禁用',
        '0' => '未分配权限',
        '1' => '正常',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 获取默认头像
    public static function getDefaultAvatar(){
        return env('APP_URL').'/storage/avatars/male.png';
    }
}
