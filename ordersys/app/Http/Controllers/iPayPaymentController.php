<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;

class iPayPaymentController extends Controller
{

	function processIpayPayment(Request $request){
		/* get returned values */
		if (!isset($request->txncd)) {
			return redirect(url_prefix().'/orders');
		}
		$id = $request->id; $txncd = $request->txncd; $status = $request->status;
		$ivm = $request->ivm; $qwh = $request->qwh; $afd = $request->afd; $poi = $request->poi;
		$uyt = $request->uyt; $ifd = $request->ifd; $agt = $request->agt; $mc = $request->mc;
		$p1 = $request->p1; $p2 = $request->p2;  $p3 = $request->p3;   $p4 = $request->p4;  
		$msisdn_id = $request->msisdn_id; $msisdn_idnum = $request->msisdn_idnum;
		
		/*Payment verification*/
		$vendor_id = 'eddusaver';
		$ipnurl = "https://www.ipayafrica.com/ipn/?vendor=".$vendor_id."&id=".$id."&ivm=".
		$ivm."&qwh=".$qwh."&afd=".$afd."&poi=".$poi."&uyt=".$uyt."&ifd=".$ifd;
		$currency = 'USD';
		$order_id = $id;
		$amount = $p1;

		$fp = fopen($ipnurl, "rb");
		$status = stream_get_contents($fp, -1, -1);
		fclose($fp);
		$verdict = '';
		$state = '';

		$order = Order::where('order_code',$order_id)->first();
		$transaction = new Transaction;
		$transaction->user_id = auth()->user()->id;
		$transaction->transaction_id = $txncd;
		$transaction->order_id = $order->order_code;
		$transaction->amount = $order->order_price;
		if ($status == 'aei7p7yrx4ae34') {
			$transaction->status = 'successful';
			$order->amount_paid = $TransactionFinalAmount;
			$order->payment_status = 'completed';
			$order->status = 3;
			$verdict = 'Payment completed successfully. Thank you!';
			$state = 'success';
		}
		elseif ($status == 'bdi6p2yy76etrs') {
			$transaction->status = 'failed';
			$state = 'error';
			$verdict = 'Payment failed. Please try again later.';
		}
		elseif ($status == 'dtfi4p7yty45wq') {
			$transaction->status = 'failed';
			$state = 'error';
			$verdict = 'Payment failed. Please try again later.';
		}
		else{
			$transaction->status = 'failed';
			$state = 'error';
			$verdict = 'Payment failed. Please try again later.';
		}

		$order->save();
		$transaction->save();

		return redirect(url_prefix().'/order/'.$order_id)->with('success',$verdict);

		
	}
}
