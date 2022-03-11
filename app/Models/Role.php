<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
    *    Laravelでは１対多の関係はhasMany、多対１の関係はbelongsTo、１対１の関係はhasOneで設定します。
    
    *    例えば 店舗と顧客はは１対多の関係になり。（今回顧客は１つの店舗にしか所属しない）
    *    Customerクラスには belongsToを指定し
    **/
    use HasFactory;

    public const SUPER_VISOR_ID = 1;
    public const CLERK_ID = 2;

    protected $guarded = [];

    // １対多の関係はhasMany
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
