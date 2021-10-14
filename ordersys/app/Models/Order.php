<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderFile;
use App\User;

class Order extends Model
{
    //
	protected $table = 'orders';

	public function order_files(){
		return $this->hasMany(OrderFile::class,'order_code','order_code');
	}

	public function customer(){
		return $this->belongsTo(User::class,'customer_id','id');
	}

}
