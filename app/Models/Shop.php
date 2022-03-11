<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    /**
    *    Laravelでは１対多の関係はhasMany、多対１の関係はbelongsTo、１対１の関係はhasOneで設定します。
    *    例えば 店舗と顧客はは１対多の関係になり。（今回顧客は１つの店舗にしか所属しない）
    *    Customerクラスには belongsToを指定し
    **/
    
    use HasFactory;

    const SHOP_ID_TOKYO = 1;
    const SHOP_ID_NAGOYA = 2;
    const SHOP_ID_OSAKA = 3;
    protected $guarded = [];

    // １対多の関係はhasMany
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // １対多の関係はhasMany
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
