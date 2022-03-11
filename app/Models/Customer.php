<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerLog;

class Customer extends Model
{
    const KRAMER_FLAG_ON = 1;
    //$customer = (new self())->getTable();
    
   /**
    *    Laravelでは１対多の関係はhasMany、多対１の関係はbelongsTo、１対１の関係はhasOneで設定します。
    *    例えば 店舗と顧客はは１対多の関係になり。（今回顧客は１つの店舗にしか所属しない）
    *    Customerクラスには belongsToを指定し
    **/
    
    use HasFactory;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => \App\Events\KramerInComming::class,
    ];

    // 多対１の関係はbelongsTo
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // １対多の関係はhasMany
    public function customerLogs()
    {
        return $this->hasMany(CustomerLog::class);
    }
   
    public function isKramer(): bool
    {
        return $this->kramer_flag == Customer::KRAMER_FLAG_ON;
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($customer) {
            $customer->customerLogs()->delete();
        });
    }
}
