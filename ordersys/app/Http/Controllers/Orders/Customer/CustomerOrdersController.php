<?php

namespace App\Http\Controllers\Orders\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminOrderCancelled;
use App\Notifications\AdminOrderDisputed;
use App\Notifications\CustomerOrderCancelled;
use App\Notifications\CustomerOrderDisputed;
use App\User;

class CustomerOrdersController extends Controller
{
	public function __construct()
	{
		$this->folder = 'orders.customer.';
	}
    //
	public function myOrders(Request $request){
		$orders = Order::where('customer_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(4);
		return view($this->folder.'orders',[
			'orders' => $orders
		]);
	}

	public function viewOrder(Request $request){
		if (!isset($request->oid)) {
			return redirect('/');
		}
		
		$order = Order::where('order_code',$request->oid)->first();
       if (!$order) {
        return redirect(url_prefix().'/orders');
    }
    if ($order->customer_id != auth()->user()->id) {
     return redirect(url_prefix().'/orders');
 }

 return view($this->folder.'order',[
     'order' => $order
 ]);


}


public function orderCheckout(Request $request){

    return view($this->folder.'failed-payment',[

    ]);

}

public function cancelOrder(Request $request){
  $order_id = decrypt($request->oid);
  $order = Order::findOrFail($order_id);
  $order->status = 6;
  $order->update();
  $client = $order->customer;
  if ($client) {
     $admins = User::where('level','ad')->get();
     Notification::send($client, new CustomerOrderCancelled($order));
     Notification::send($admins, new AdminOrderCancelled($order));
 }
 return redirect()->back()->with('success','Order status changed to "Cancelled".');

}

public function disputeOrder(Request $request){
  \request()->validate([
     'dispute_reason' => 'required'
 ]);
  $order_id = decrypt($request->oid);
  $order = Order::findOrFail($order_id);
  $order->status = 9;
  $order->dispute_reason = $request->dispute_reason;
  $order->update();
  $client = $order->customer;
  if ($client) {
     $admins = User::where('level','admin')->get();
     Notification::send($client, new CustomerOrderDisputed($order));
     Notification::send($admins, new AdminOrderDisputed($order));
 }
 return redirect()->back()->with('success','Your order dispute has been submitted successfuly.');
}

}
