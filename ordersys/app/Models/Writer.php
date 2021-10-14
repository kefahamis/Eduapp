<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
	protected $table = 'writers';
    //
	public function user(){
		return $this->hasOne(User::class,'id','user_id');
	}

    public function assigned_orders(){
        return $this->hasMany(Order::class,'assigned_to', 'writer_code');
    }
}
