<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLog extends Model
{
    /**
    *    Laravelでは１対多の関係はhasMany、多対１の関係はbelongsTo、１対１の関係はhasOneで設定します。
    *    例えば 店舗と顧客はは１対多の関係になり。（今回顧客は１つの店舗にしか所属しない）
    *    Customerクラスには belongsToを指定し
    **/
    
    use HasFactory;

    protected $guarded = [];

    // 多対１の関係はbelongsTo
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // 多対１の関係はbelongsTo
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
