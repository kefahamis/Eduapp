<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\PayPal;
use App\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Http;

class OrderCheckoutController extends Controller
{
    function __construct(){
       $this->folder = 'orders.customer.';
   }

   public function orderBilling(Request $request){
      if ($request->order_code == '' || !isset($request->order_code)) {
         return redirect('/');
     }
     $order = Order::where('order_code',$request->order_code)->first();
     if (!$order) {
         return redirect('/');
     }
     if ($order->payment_status == 'completed') {
         return redirect(url_prefix().'/view-order/'.$order->order_code);
     }
     return view('orderbilling',[
         'order' => $order
     ]);
 }

 public function initiatePayment(Request $request){
  $order_code = $request->order_code;
  $order = Order::where('order_code',$order_code)->first();

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

request()->session()->put('order_pay',$order);
$method = $request->option_pay;
if ($method == 'paypal') {
 return $this->handlePayment($order);
}elseif ($method == 'dpo') {
 return $this->handleDPO($order);
}elseif ($method == 'ipay') {
 return $this->ipayPaymentOption($order);

}else{

}

}


protected function handlePayment($order){
  $order_code = $order->order_code;
  $cancelUrl = route('cancel.paypal');
  $returnUrl = route('successful.paypal');
  $paypal = new PayPal;
  $response = $paypal->purchase([
     'amount' => $paypal->formatAmount($order->order_price),
     'transactionId' => $order->order_code,
     'currency' => 'USD',
     'cancelUrl' => $cancelUrl,
     'returnUrl' => $returnUrl,
 ]); 

  if ($response->isRedirect()) {
     $response->redirect();
 }

 return redirect()->back()->with('error','An error occured! The payment has failed. Please try again later or contact support via support@eddusaver.com');

}

public function cancelPayment(Request $request){
        #
  $order = collect();
  if (request()->session()->has('order_pay')) {
     $order = request()->session()->get('order_pay');
 }else{
     return view($this->folder.'failed-payment',[
        'message' => 'Something went wrong! Payment not successful.'
    ]);
 }

 $transaction = new Transaction;
 $transaction->user_id = auth()->user()->id;
 $transaction->transaction_id = '501';
 $transaction->order_id = $order->order_code;
 $transaction->amount = $order->order_price;
 $transaction->status = 'failed';
 $transaction->save();

 return view($this->folder.'failed-payment',[
     'order' => $order,
     'message' => 'Something went wrong! Payment not successful.'
 ]);
}


public function paymentSuccessful(Request $request)
{
        # order stored in a session
  $order = collect();
  if (request()->session()->has('order_pay')) {
     $order = request()->session()->get('order_pay');
 }else{  
     return view($this->folder.'failed-payment',[
        'message' => 'An error occured!'
    ]);
 }
 $cancelUrl = route('cancel.paypal');
 $returnUrl = route('successful.paypal');
 $notifyUrl = route('notify.paypal');
 $paypal = new PayPal;

 $response = $paypal->complete([
     'amount' => $paypal->formatAmount($order->order_price),
     'transactionId' => $order->order_code,
     'currency' => 'USD',
     'cancelUrl' => $cancelUrl,
     'returnUrl' => $returnUrl,
     'notifyUrl' => $notifyUrl
 ]);

 if ($response->isSuccessful()) {
     $transaction_id = $response->getTransactionReference();
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

 return redirect('customer/order/'.$order->order_code)->with([
    'message' => $response->getMessage(),
    'success' => 'Payment successful. Thank you!'
]);
}

public function notifyPayPal(Request $request){

}

protected function handleDPO($order){
    $PaymentAmount = number_format($order->order_price,2);
    $PaymentCurrency = 'USD';
    $CompanyRef = $order->order_code;
    $CompanyRefUnique = '0';
    $PTL = '';
    $PTLtype = '';
    $full_name = $order->customer->name;
    $parts = explode(' ', $full_name);
    $customerFirstName = trim($parts[0]);
    $customerLastName = '';
    if(isset($parts[1])){
        $customerLastName = trim($parts[1]);
    }

    $customerZip = '';
    $customerCity = '';
    $customerCountry = '';
    $customerEmail = $order->customer->email;

    $CompanyToken = '4B38EDB4-4BFA-409C-9686-E70256BB2EE0';
    $RedirectURL = url('api/handle-dpo');
    $BackURL = url(url_prefix().'/order/'.$order->order_code);
    $ServiceDate = date('Y/m/d');
    $url = 'https://secure.3gdirectpay.com/API/v6/';


    $post_xml   = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
    <API3G>
    <CompanyToken>".$CompanyToken."</CompanyToken>
    <Request>createToken</Request>
    <Transaction>
    <PaymentAmount>".$PaymentAmount."</PaymentAmount>
    <PaymentCurrency>".$PaymentCurrency."</PaymentCurrency>
    <CompanyRef>".$CompanyRef."</CompanyRef>`
    <RedirectURL>".$RedirectURL."</RedirectURL>
    <BackURL>".$BackURL."</BackURL>
    <CompanyRefUnique>".$CompanyRefUnique."</CompanyRefUnique>
    <PTL>15</PTL>
    <PTLtype>hours</PTLtype>
    <customerFirstName>".$customerFirstName."</customerFirstName>
    <customerLastName>".$customerLastName."</customerLastName>
    <customerZip>".$customerZip."</customerZip>
    <customerCity>".$customerCity."</customerCity>
    <customerCountry>".$customerCountry."</customerCountry>
    <customerEmail>".$customerEmail."</customerEmail>
    </Transaction>
    <Services>
    <Service>
    <ServiceType>33458</ServiceType>
    <ServiceDescription>Education</ServiceDescription>
    <ServiceDate>".$ServiceDate."</ServiceDate>
    </Service>
    </Services>
    </API3G>";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => $post_xml,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTPHEADER => [
            "Content-type: text/xml",
            "Content-length: " . strlen($post_xml),
            "Connection: close"
        ],
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    if($err){
        /*there was an error contacting the DPO API*/
        die('Curl returned error: ' . $err);
    }

    /*load the response to variables*/
    $transaction = simplexml_load_string($response);
    $Result = $transaction->Result;
    $ResultExplanation = $transaction->ResultExplanation;
    $TransToken = $transaction->TransToken;
    $TransRef = $transaction->TransRef;

    /*Redirect customer to make payment*/
    return redirect('https://secure.3gdirectpay.com/pay.asp?ID='.$TransToken);
}

protected function ipayPaymentOption($order){
    $total = number_format($order->order_price,2);
    $currency = 'USD';
    $order_id = $order->order_code;
    $invoice = $order_id;
    $full_name = $order->customer->name;
    $parts = explode(' ', $full_name);
    $customerFirstName = trim($parts[0]);
    $customerLastName = '';
    if(isset($parts[1])){
        $customerLastName = trim($parts[1]);
    }
    $email = $order->customer->email;
    $phone = $order->customer->phone_number;
    $datastring = '';
    $live = '0';
    $vid = 'eddusaver';
    $curr = 'USD';
    $p1 = '';
    $p2 = '';
    $p3 = '';
    $p4 = '';
    $cbk = url('api/handle-ipay');
    $cst = '1';
    $crl = '2';
    $url = 'https://payments.ipayafrica.com/v3/ke';

    $fields = array(
        "live"=> "1",
        "oid"=> $order_id,
        "inv"=> $order_id,
        "ttl"=> $total,
        "tel"=> $phone,
        "eml"=> $email,
        "vid"=> "eddusaver",
        "curr"=> "USD",
        "p1"=> "none",
        "p2"=> "none",
        "p3"=> "none",
        "p4"=> "none",
        "cbk"=> $cbk,
        "cst"=> "1",
        "crl"=> "2",
        "mpesa" =>'0',
        "bonga"=>'0',
        "airtel"=>'0',
        "equity"=>'0',
        "mobilebanking"=>'0',
        "debitcard"=>'1',
        "creditcard"=>'1',
        "mkoporahisi"=>'0',
        "saida"=>'0',
        "elipa"=>'0',
        "unionpay"=>'0',
        "mvisa"=>'0'
    );

    $datastring = $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];

    $hashkey ="Tenkjg96jf7vl09eddusaver";
    $hashid = hash_hmac("sha1", $datastring, $hashkey);
    $fields += ["hsh" => $hashid];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_POSTFIELDS => $fields,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTPHEADER => [
            "Connection: close"
        ],
    ));

    curl_exec($curl);
    $curl_info = curl_getinfo($curl);
    $url_returned = $curl_info['url'];

    return redirect($url_returned);

}


}
