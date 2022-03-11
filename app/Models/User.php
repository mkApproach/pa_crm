<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \App\Models\Role;

class User extends Authenticatable
{
     /**
    *    Laravelでは１対多の関係はhasMany、多対１の関係はbelongsTo、１対１の関係はhasOneで設定します。
    *    例えば 店舗と顧客はは１対多の関係になり。（今回顧客は１つの店舗にしか所属しない）
    *    Customerクラスには belongsToを指定し
    **/
    
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_SUPER_VISOR = 1; // スーパーバイザー
    const ROLE_EMPLOYEE = 2; // 社員

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 多対１の関係はbelongsTo
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // 多対１の関係はbelongsTo
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    
    // １対多の関係はhasMany
    public function customers()
    {
        return $this->hasMany(CustomerLog::class);
    }

    /**
     * スーパーバイザーであればtrueを返す
     * @return bool
     */
    public function isSuperVisor(): bool
    {
        return $this['role_id'] === Role::SUPER_VISOR_ID;
    }

    public static function enumSupserVisor()
    {
        return User::where('role_id', '=', Role::SUPER_VISOR_ID)->get();
    }
}
