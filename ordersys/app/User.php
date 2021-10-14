<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Writer;
use App\Models\Order;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function writer(){
        return $this->hasOne(Writer::class,'user_id','id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'customer_id','id');
    }

    public function writers(){
        $use_id = auth()->user()->id;
        return $this->hasManyThrough(
            Writer::class,
            Order::class,
            'assigned_to',
            'id',
            $use_id,
            'assigned_to'
        )
        ->orwhere('level', 'admin');
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }

}
/*
message: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'level' in 'where clause' (SQL: select `writers`.*, `orders`.`assigned_to` as `laravel_through_key` from `writers` inner join `orders` on `orders`.`id` = `writers`.`writer_code` where `orders`.`assigned_to` = 14 or `level` = admin)

message: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'level' in 'where clause' (SQL: select `writers`.*, `orders`.`assigned_to` as `laravel_through_key` from `writers` inner join `orders` on `orders`.`id` = `writers`.`14` where `orders`.`assigned_to` = 14 or `level` = admin)

message: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'level' in 'where clause' (SQL: select `writers`.*, `orders`.`assigned_to` as `laravel_through_key` from `writers` inner join `orders` on `orders`.`assigned_to` = `writers`.`14` where `orders`.`assigned_to` = 14 or `level` = admin)
*/
