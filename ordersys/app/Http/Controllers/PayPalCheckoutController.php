<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use App\Repositories\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PaymentNotification;

class PayPalCheckoutController extends Controller
{

  public function payWithPaypal(Request $request){

    $orderId=$request->orderID;
    $order_code = $request->order_code;
    $order=Order::where('order_code',$order_code)->firstOrFail();
    if ($order) {
     $user = $order->customer;

     if (isset($request->customer_name) && $request->customer_name != '') {
        $user->name = $request->customer_name;
    }
    if (isset($request->customer_country) && $request->customer_country != '') {
        $user->country = $request->customer_country;
    }
    if (isset($request->customer_city) && $request->customer_city != '') {
        $user->city = $request->customer_city;
    }
    if (isset($request->customer_state) && $request->customer_state != '') {
        $user->state = $request->customer_state;
    }
    if (isset($request->customer_zip_code) && $request->customer_zip_code != '') {
        $user->zip = $request->customer_zip_code;
    }
    if (isset($request->customer_phone) && $request->customer_phone != '') {
        $user->phone_number = $request->customer_phone;
    }
    if (isset($request->customer_email) && $request->customer_email != '') {
        $chekk = User::where('email',$request->customer_email)->first();
        if ($chekk && $chekk->id != $user->id) {
            return redirect()->back()->with('error','Something went wrong!Email address is already registered with a different user.');

        }
        $user->email = $request->customer_email;
    }
    $user->save();
}else{
 return redirect()->back()->with('error','Something went wrong! Payment not successful');
}

$client = PayPalClient::client();
$response = $client->execute(new OrdersGetRequest($orderId));

$status_code = $response->statusCode;
$status = $response->result->status;
$id = $response->result->id;
$intent = $response->result->intent;
$links = $response->result->links;
$amount = $response->result->purchase_units[0]->amount->value;

if ($status == 'COMPLETED') {
    $transaction_id = $id;
    $order->payment_status = 'completed';
    $order->status = 3;
    $order->save();

    $transaction = new Transaction;
    $transaction->user_id = auth()->user()->id;
    $transaction->transaction_id = $transaction_id;
    $transaction->order_id = $order->order_code;
    $transaction->amount = $order->order_price;
    $transaction->status = 'successful';
    $transaction->save();

    $admins = User::where('level','admin')->get();
    Notification::send($admins, new PaymentNotification());

    $customer = auth()->user();
    Notification::send($customer, new PaymentNotification());
}
return response()->json(['status' => 'COMPLETED']);

}

}
