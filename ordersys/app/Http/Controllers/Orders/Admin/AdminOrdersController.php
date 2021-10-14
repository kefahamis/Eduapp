<?php

namespace App\Http\Controllers\Orders\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Writer;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminOrderCancelled;
use App\Notifications\AdminOrderDisputed;
use App\Notifications\CustomerOrderCancelled;
use App\Notifications\CustomerOrderDisputed;
use App\Notifications\CustomerOrderInProgress;
use App\Notifications\CustomerOrderCompleted;
use App\Notifications\CustomerOrderInRevision;
use App\Notifications\PaymentNotification;
use App\User;

class AdminOrdersController extends Controller
{
    //
	public function __construct()
	{
		$this->folder = 'orders.main.';
	}
    //
	public function myOrders(Request $request){
		$orders = Order::where('status','=',3)->orderBy('created_at','desc')->paginate(5);
		return view($this->folder.'orders',[
			'orders' => $orders
		]);
	}

	public function ordersInBidding(Request $request){
		$orders = Order::select('*')
		->where('status', '=', -1)
		->orWhere('status','=', 0)
		->orderBy('created_at','desc')
		->paginate(5);
		return view($this->folder.'bidding',[
			'orders' => $orders
		]);
	}

	public function completedOrders(Request $request){
		$orders = Order::where('status','=',7)->orderBy('created_at','desc')->paginate(5);
		return view($this->folder.'completed',[
			'orders' => $orders
		]);
	}

	public function cancelledOrders(Request $request){
		$orders = Order::where('status','=',6)->orderBy('created_at','desc')->paginate(5);
		return view($this->folder.'cancelled',[
			'orders' => $orders
		]);
	}

	public function revisionOrders(Request $request){
		$orders = Order::where('status','=',10)->orderBy('created_at','desc')->paginate(5);
		return view($this->folder.'revision',[
			'orders' => $orders
		]);
	}

	public function disputedOrders(Request $request){
		$orders = Order::where('status','=',9)->orderBy('created_at','desc')->paginate(5);
		return view($this->folder.'disputed',[
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
        $writers = Writer::all();
        return view($this->folder.'order',[
            'order' => $order,
            'writers' => $writers
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

public function processOrder(Request $request){
  $order_id = decrypt($request->oid);
  $order = Order::findOrFail($order_id);
  $order->status = 3;
  $order->update();
  $client = $order->customer;
  if ($client) {
   Notification::send($client, new CustomerOrderInProgress($order));
}
return redirect()->back()->with('success','Order status changed to "In-Progress".');

}

public function completeOrder(Request $request){
  $order_id = decrypt($request->oid);
  $order = Order::findOrFail($order_id);
  $order->status = 7;
  $order->update();
  $client = $order->customer;
  if ($client) {
   Notification::send($client, new CustomerOrderCompleted($order));
}
return redirect()->back()->with('success','Order status changed to "Completed".');

}

function OrderCompletedAlert(Request $request){
  $order_id = decrypt($request->oid);
  $order = Order::findOrFail($order_id);
  $client = $order->customer;
  if ($client) {
   Notification::send($client, new CustomerOrderCompleted($order));
}
return redirect()->back()->with('success','Order status changed to "Completed".');
}

public function reviseOrder(Request $request){
  $order_id = decrypt($request->oid);
  $order = Order::findOrFail($order_id);
  $order->status = 10;
  $order->update();
  $client = $order->customer;
  if ($client) {
   Notification::send($client, new CustomerOrderInRevision($order));
}
return redirect()->back()->with('success','Order status changed to "In-Revision".');
}

function orderPaymentCompleted(Request $request){
  $order_id = decrypt($request->oid);
  $order = Order::findOrFail($order_id);
  $order->payment_status = 'completed';
  $order->update();
  $client = $order->customer;
  if ($client) {
    Notification::send($client, new PaymentNotification());
}
return redirect()->back()->with('success','Order status changed to "Completed".');
}

function orderPaymentPending(Request $request){
  $order_id = decrypt($request->oid);
  $order = Order::findOrFail($order_id);
  $order->payment_status = 'pending';
  $order->update();
//   $client = $order->customer;
//   if ($client) {
//     Notification::send($client, new PaymentNotification());
// }
  return redirect()->back()->with('success','Order status changed to "Pending".');
}

public function adjustPrice(Request $request){
    $order_id = decrypt($request->oid);
    $order = Order::findOrFail($order_id);
    $n_order_price = 0;
    if ($request->n_order_price == 0 || $request->n_order_price == '') {
     $n_order_price = 0;
 }else{
    $n_order_price = $request->n_order_price;
}
$order->order_price = $n_order_price;
$order->update();

return redirect()->back()->with('success','Order price changed to USD '.$order->order_price);
}

public function assignWriter(Request $request){
    $order_id = decrypt($request->oid);
    $order = Order::findOrFail($order_id);
    $order->assigned_to = $request->assigned_to_id;
    $order->status = 3;
    $order->update();

    return redirect()->back()->with('success','Order has been assigned to writer successfully.');
}

public function searchOrders(Request $request){
  $q = $request->q;
  $results = Order::select('*')
  ->where([
   ['order_code', 'LIKE', '%'.$q.'%']
])
  ->paginate(5);
		// print_r($results);exit();
  return view($this->folder.'search',[
   'results' => $results
]);
}

}
