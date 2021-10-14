<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;

class DpoPaymentController extends Controller
{

	function processDpoPayment(Request $request){

		$CompanyToken = '4B38EDB4-4BFA-409C-9686-E70256BB2EE0';
		$TransID = '';
		$TransactionToken = '';
		$CompanyRef = '';
		if (isset($request->TransactionToken)) {
			$TransactionToken = $request->TransactionToken;
		}
		if (isset($request->TransID)) {
			$TransID = $request->TransID;
		}
		if (isset($request->CompanyRef)) {
			$CompanyRef = $request->CompanyRef;
		}

		/*verify transaction status*/
		$status_url = 'https://secure.3gdirectpay.com/API/v6/';
		$status_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
		<API3G>
		<CompanyToken>".$CompanyToken."</CompanyToken>
		<Request>verifyToken</Request>
		<TransactionToken>".$TransactionToken."</TransactionToken>
		</API3G>";

		$curl2 = curl_init();
		curl_setopt_array($curl2, array(
			CURLOPT_URL => $status_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => $status_xml,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_HTTPHEADER => [
				"Content-type: text/xml",
				"Content-length: " . strlen($status_xml),
				"Connection: close"
			],
		));

		$status_response = curl_exec($curl2);
		$err = curl_error($curl2);
		if($err){
			return redirect(url_prefix().'/order/'.$CompanyRef)->with('error','An error occured!');
		}
		$transaction_status = simplexml_load_string($status_response);
		/*Get the required fields*/
		$TransactionFinalAmount = $transaction_status->TransactionFinalAmount;
		$TransactionFinalCurrency = $transaction_status->TransactionFinalCurrency;
		$ResultExplanation = $transaction_status->ResultExplanation;

		/*save to database */
		$order = Order::where('order_code',$CompanyRef)->first();
		$transaction = new Transaction;
		$transaction->user_id = auth()->user()->id;
		$transaction->transaction_id = $TransID;
		$transaction->order_id = $order->order_code;
		$transaction->amount = $order->order_price;
		if ($ResultExplanation == 'Transaction Paid'){
			$transaction->status = 'successful';
			$order->amount_paid = $TransactionFinalAmount;
			$order->payment_status = 'completed';
			$order->status = 3;
		}else{
			$transaction->status = 'failed';
		}

		$order->save();
		$transaction->save();

		/*
		$admins = User::where('level','ad')->get();
		Notification::send($admins, new PaymentNotification());

		$customer = auth()->user();
		Notification::send($customer, new PaymentNotification());
		*/
		return redirect(url_prefix().'/order/'.$CompanyRef);

	}

}
