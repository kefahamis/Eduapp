<?php

namespace App\Http\Controllers\Orders\Writer;

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
use App\User;

class WriterOrdersController extends Controller
{
    //
	public function __construct()
	{
		$this->folder = 'orders.writer.';
		
	}

	public function myOrders(Request $request){
		$writer_code = $this->getWriterCode();
		
		$orders = Order::select('*')
		->where('assigned_to', $writer_code)
		->where('status','=', 3)
		->orderBy('created_at','desc')
		->paginate(5);
		return view($this->folder.'orders',[
			'orders' => $orders
		]);
	}

	public function ordersInBidding(Request $request){
		$orders = Order::select('*')
		->where(function ($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=', -1);
		})->orWhere(function($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=', 0);
		})->orWhere(function($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=', 1);
		})
		->orderBy('created_at','desc')
		->paginate(5);

		return view($this->folder.'bidding',[
			'orders' => $orders
		]);
	}



	public function completedOrders(Request $request){
		$orders = Order::select('*')
		->where(function ($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=', 7);
		})->orWhere(function($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=', 8);
		})
		->orderBy('created_at','desc')
		->paginate(5);

		return view($this->folder.'completed',[
			'orders' => $orders
		]);
	}

	public function cancelledOrders(Request $request){
		$orders = Order::select('*')
		->where(function ($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=',4);
		})
		->orWhere(function($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=', 5);
		})
		->orWhere(function($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=', 6);
		})
		->orderBy('created_at','desc')
		->paginate(5);

		return view($this->folder.'cancelled',[
			'orders' => $orders
		]);
	}

	public function revisionOrders(Request $request){
		$orders = Order::select('*')
		->where(function ($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=', 10);
		})
		->orderBy('created_at','desc')
		->paginate(5);

		return view($this->folder.'revision',[
			'orders' => $orders
		]);
	}

	public function disputedOrders(Request $request){
		$orders = Order::select('*')
		->where(function ($query) {
			$writer_code = $this->getWriterCode();
			$query->where('assigned_to', $writer_code)
			->where('status', '=', 9);
		})
		->orderBy('created_at','desc')
		->paginate(5);

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
        if ($order->assigned_to != $this->getWriterCode()) {
           return redirect(url_prefix().'/orders');
       }
       if (!$order) {
           return redirect(url_prefix().'/orders');
       }
       return view($this->folder.'order',[
           'order' => $order
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

public function searchOrders(Request $request){
  $q = $request->q;
  $writer_code = $this->getWriterCode();
  $results = Order::select('*')
  ->where([
   ['assigned_to',$writer_code],
   ['order_code', 'LIKE', '%'.$q.'%']
])
  ->paginate(5);
		// print_r($results);exit();
  return view($this->folder.'search',[
   'results' => $results
]);
}
protected function getWriterCode(){
  $writer_code = 0;
  $writer = Writer::select('writer_code')
  ->where('user_id',auth()->user()->id)
  ->first();
  if ($writer) {
   $writer_code = $writer['writer_code'];
}else{
   $writer_code = 0;
}

return $writer_code;
}
}
