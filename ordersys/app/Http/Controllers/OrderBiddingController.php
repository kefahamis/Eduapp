<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Writer;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderAssignedAlert;
use App\User;

class OrderBiddingController extends Controller
{
    //

	public function acceptWriter(Request $request){
		if (!isset($request->writer_code) || !isset($request->order_code)) {
			return redirect('/');
		}
		$writer_code = $request->writer_code;
		$order_code = $request->order_code;
		$order = Order::where('order_code', $order_code)->first();
		if ($order) {
			$order->assigned_to = $writer_code;
			$order->save();
			$writer = Writer::where('writer_code',$writer_code)->first();
			$user = User::where('id',$writer->user_id)->first();
			Notification::send($user, new OrderAssignedAlert($order,$user));

			return response()->json(['status' => '343UuutdIk','oid' => $order_code]);
		}
		return response()->json(['status' => 'failed','order_code' => $order_code]);

	}

}
