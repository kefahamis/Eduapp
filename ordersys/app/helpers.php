<?php
/*
Helper functions
*/
if (!function_exists('orderStatus')) {
	function orderStatus($order_status){

		$strings = array();
/*
-1 -in_bidding
0 -payment_pending
1-payment_done_partially
2-payment_completed
3-in_progress
4-cancelled_by_system
5-cancelled_by_writer
6-cancelled_by_customer
7-completed_by_writer
8-approved_by_client/order_completed
9-declined_by_client/disputed
10-in_revision

//classes//
status_bidding
status_in_progress
status_completed
status_progress
status_approved
status_cancelled
status_declined
status_pending
status_payment_pending
status_payment_completed
status_in_revision
*/
if ($order_status == -1 ) {
	# in_bidding
	$strings['status'] = 'In Bidding';
	$strings['class'] = 'status_bidding';

}elseif ($order_status == 0) {
	# payment_pending
	$strings['status'] = 'Payment Required';
	$strings['class'] = 'status_pending';

}elseif ($order_status == 1) {
	# payment_done_partially
	$strings['status'] = 'Payment Done Partially';
	$strings['class'] = 'status_pending';

}elseif ($order_status == 2) {
	# payment_completed, order processing not started
	$strings['status'] = 'Payment Completed';
	$strings['class'] = 'status_payment_completed';
}elseif ($order_status == 3) {
	# in_progress
	$strings['status'] = 'In Progress';
	$strings['class'] = 'status_progress';

}elseif ($order_status == 4) {
	# cancelled_by_system
	$strings['status'] = 'Cancelled';
	$strings['class'] = 'status_cancelled';

}elseif ($order_status == 5) {
	# cancelled_by_writer
	$strings['status'] = 'Cancelled';
	$strings['class'] = 'status_cancelled';

}elseif ($order_status == 6) {
	# cancelled_by_customer
	$strings['status'] = 'Cancelled';
	$strings['class'] = 'status_cancelled';

}elseif ($order_status == 7) {
	# completed_by_writer
	$strings['status'] = 'Completed';
	$strings['class'] = 'status_completed';

}elseif ($order_status == 8) {
	# approved_by_client/order_completed
	$strings['status'] = 'Completed';
	$strings['class'] = 'status_completed';

}elseif ($order_status == 9) {
	# declined_by_client/disputed
	$strings['status'] = 'Order Disputed';
	$strings['class'] = 'status_declined';

}elseif ($order_status == 10) {
	# in_revision
	$strings['status'] = 'In Revision';
	$strings['class'] = 'status_in_revision';

}else{
	$strings['status'] = 'Undefined';
	$strings['class'] = 'status_undefined';
}



return $strings;
}
}

if (!function_exists('url_prefix')) {
	function url_prefix(){
		$url_prefix = '';
		if (auth()->check()) {
			$url_prefix = auth()->user()->url_prefix;
		}else{

		}
		return $url_prefix;

	}
}

if (!function_exists('getAssignedWriter')) {
	function getAssignedWriter($writer_code)
	{
		$writer = array();
		$writer_profile = App\Models\Writer::where('writer_code',$writer_code)->first();
		if (!$writer_profile) {
			$writer_profile = App\Models\Writer::where('writer_code',3209)->first();
            $writer['name'] = 'Not assigned';
            $writer['rating'] = '';
            $writer['finished_papers'] = '';
        }else{
           $writer_user = App\User::where('id',$writer_profile->user_id)->first();
           $writer['name'] = $writer_user->name;
           $writer['rating'] = $writer_profile->rating;
           $writer['finished_papers'] = $writer_profile->finished_papers;
       }

       return $writer;

   }
}

if (!function_exists('customerOrderAction')) {
	function customerOrderAction($order)
	{
		$actions = '';
		$order_cancel = 'cancel_'.$order->id;


		if ($order->status == 0 || $order->status == 1){
			$actions .= '<a href="'.url('customer/billing/'.$order->order_code).'" class="btn btn-info btn-sm waves-effect"> Complete Payment</a>';

			$actions .= '
			<form method="post" action="'.url("customer/cancel-order/".encrypt($order->id)).'" id="'.$order_cancel.'">
			<input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
			<input type="hidden" name="cancel_id" value="'.$order->order_code.'">
			<button type="button" class="btn btn-danger btn-sm waves-effect" onclick="confirmCancelOrder(&quot;'.$order_cancel.'&quot;)" style="margin-top:20px">Cancel Order</button>
			</form><hr class="divider">
			';
		}

		elseif ($order->status == 2 || $order->status == 3){
			$actions .= '<p class="form-control">Your order is been processed. Kindly wait for feedback from the writer.</p>';

		}elseif ($order->status == 4 || $order->status == 5 || $order->status == 6) {
			$actions .= '<p class="form-control" style="word-wrap:break-word;">Your order has been cancelled. Kindly place another order or contact <strong><font size="2px">support@eddusaver.com</font></strong></p>';
		}elseif ($order->status == 7 || $order->status == 8) {
			$actions .= '<button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#disputeOrder">Request order revision</button>
			<div class="modal fade" id="disputeOrder" role="dialog" style="display: none;">
			<div class="modal-dialog modals-default">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<div class="modal-body">
			<h2>Dispute Order/Request Revision</h2>
			<form action="'.url('customer/dispute-order/'.encrypt($order->id)).'" method="post">
			<input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
			<div class="nk-form">
			<div class="input-group">
			<div class="nk-int-st">
			<label><i>Please enter your reason for disputing this order below.</i></label>
			<textarea rows="6" name="dispute_reason" class="form-control" required></textarea>
			</div>
			</div>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-info waves-effect">Proceed</button>
			</div>
			</form>
			</div>
			</div>
			</div>
			</div>
			';
		}
		elseif($order->status == 9){
			$actions .= '<p class="form-control" style="word-wrap:break-word;">This order has been marked as disputed. A writer will act on it. Kindly wait or contact <strong><font size="2px">support@eddusaver.com</font></strong></p>';
		}
		elseif($order->status == 10){
			$actions .= '<p class="form-control" style="word-wrap:break-word;">This order is been revised by our writers. Kindly wait or contact <strong><font size="2px">support@eddusaver.com</font></strong></p>';
		}
		else{
			
		}


		return $actions;


	}
}

if (!function_exists('writerOrderAction')) {
	function writerOrderAction($order)
	{
		/*
		-1 -in_bidding
		0 -payment_pending
		1-payment_done_partially
		2-payment_completed
		3-in_progress
		4-cancelled_by_system
		5-cancelled_by_writer
		6-cancelled_by_customer
		7-completed_by_writer
		8-approved_by_client/order_completed
		9-declined_by_client/disputed
		10-in_revision
		*/
		$actions = '';
		$order_cancel = 'cancel_'.$order->id;
		$order_complete = 'complete_'.$order->id;
        $order_completed = 'completed_'.$order->id;
        $order_revise = 'revise_'.$order->id;
        $order_process = 'process_'.$order->id;


        if ($order->status == 0){

         $actions .= '
         <form method="post" action="'.url(url_prefix()."/cancel-order/".encrypt($order->id)).'" id="'.$order_cancel.'">
         <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
         <input type="hidden" name="cancel_id" value="'.$order->order_code.'">
         <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="confirmCancelOrder(&quot;'.$order_cancel.'&quot;)" style="margin-top:20px">Cancel Order</button>
         </form><hr class="divider">
         ';
     }
     elseif ($order->status == 1) {
         $actions .= '
         <form method="post" action="'.url(url_prefix()."/process-order/".encrypt($order->id)).'" id="'.$order_process.'">
         <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
         <button type="button" class="btn btn-info btn-sm waves-effect" onclick="confirmProcessOrder(&quot;'.$order_process.'&quot;)" style="margin-top:20px">Change status to "In-Progress"</button>
         </form><hr class="divider">
         ';
     }
     elseif ($order->status == 2){
         $actions .= '
         <form method="post" action="'.url(url_prefix()."/process-order/".encrypt($order->id)).'" id="'.$order_process.'">
         <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
         <button type="button" class="btn btn-info btn-sm waves-effect" onclick="confirmProcessOrder(&quot;'.$order_process.'&quot;)" style="margin-top:20px">Change status to "In-Progress"</button>
         </form><hr class="divider">
         ';
     }
     elseif ($order->status == 3) {
         $actions .= '
         <form method="post" action="'.url(url_prefix()."/complete-order/".encrypt($order->id)).'" id="'.$order_complete.'">
         <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
         <button type="button" class="btn btn-success btn-sm waves-effect" onclick="confirmCompleteOrder(&quot;'.$order_complete.'&quot;)" style="margin-top:20px">Change status to "Completed"</button>
         </form><hr class="divider">
         ';
     }
     elseif ($order->status == 4 || $order->status == 5 || $order->status == 6) {
         $actions .= '<p class="form-control" style="word-wrap:break-word;">This order has been cancelled. No actions can be perfomed on it.</p>';
     }
     elseif ($order->status == 7 || $order->status == 8) {
         $actions .= '
         <form method="post" action="'.url(url_prefix()."/completed-alert/".encrypt($order->id)).'" id="'.$order_completed.'">
         <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
         <button type="button" class="btn btn-success btn-sm waves-effect" onclick="resendCompleteAlert(&quot;'.$order_completed.'&quot;)" style="margin-top:20px">Resend "Completed" Alert to Client</button>
         </form><hr class="divider">
         ';
         $actions .= '
         <form method="post" action="'.url(url_prefix()."/process-order/".encrypt($order->id)).'" id="'.$order_process.'">
         <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
         <button type="button" class="btn btn-info btn-sm waves-effect" onclick="confirmProcessOrder(&quot;'.$order_process.'&quot;)" style="margin-top:20px">Change status to "In-Progress"</button>
         </form><hr class="divider">
         ';
     }
     elseif($order->status == 9){
         $actions .= '
         <form method="post" action="'.url(url_prefix()."/revise-order/".encrypt($order->id)).'" id="'.$order_revise.'">
         <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
         <button type="button" class="btn btn-info btn-sm waves-effect" onclick="confirmReviseOrder(&quot;'.$order_revise.'&quot;)" style="margin-top:20px">Change status to "In-Revision"</button>
         </form><hr class="divider">
         ';
     }
     elseif($order->status == 10){
         $actions .= '
         <form method="post" action="'.url(url_prefix()."/complete-order/".encrypt($order->id)).'" id="'.$order_complete.'">
         <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
         <button type="button" class="btn btn-success btn-sm waves-effect" onclick="confirmCompleteOrder(&quot;'.$order_complete.'&quot;)" style="margin-top:20px">Change status to "Completed"</button>
         </form><hr class="divider">
         ';

     }
     else{

     }


     return $actions;


 }
}

if (!function_exists('adminOrderActions')) {
    function adminOrderActions($order)
    {
        /*
        -1 -in_bidding
        0 -payment_pending
        1-payment_done_partially
        2-payment_completed
        3-in_progress
        4-cancelled_by_system
        5-cancelled_by_writer
        6-cancelled_by_customer
        7-completed_by_writer
        8-approved_by_client/order_completed
        9-declined_by_client/disputed
        10-in_revision
        */
        $actions = '';
        $order_cancel = 'cancel_'.$order->id;
        $order_complete = 'complete_'.$order->id;
        $order_completed = 'completed_'.$order->id;
        $order_revise = 'revise_'.$order->id;
        $order_process = 'process_'.$order->id;
        $order_payment_completed = 'payment_completed'.$order->id;
        $order_payment_pending = 'payment_pending'.$order->id;

        //cancel
        $actions .= '
        <form method="post" action="'.url(url_prefix()."/cancel-order/".encrypt($order->id)).'" id="'.$order_cancel.'">
        <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
        <input type="hidden" name="cancel_id" value="'.$order->order_code.'">
        <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="confirmCancelOrder(&quot;'.$order_cancel.'&quot;)" style="margin-top:20px">Cancel Order</button>
        </form><hr class="divider">
        ';

        //in-progress
        $actions .= '
        <form method="post" action="'.url(url_prefix()."/process-order/".encrypt($order->id)).'" id="'.$order_process.'">
        <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
        <button type="button" class="btn btn-info btn-sm waves-effect" onclick="confirmProcessOrder(&quot;'.$order_process.'&quot;)" style="margin-top:20px">Change status to "In-Progress"</button>
        </form><hr class="divider">
        ';

        //completed
        $actions .= '
        <form method="post" action="'.url(url_prefix()."/complete-order/".encrypt($order->id)).'" id="'.$order_complete.'">
        <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
        <button type="button" class="btn btn-success btn-sm waves-effect" onclick="confirmCompleteOrder(&quot;'.$order_complete.'&quot;)" style="margin-top:20px">Change status to "Completed"</button>
        </form><hr class="divider">
        ';

        //completed alert
        $actions .= '
        <form method="post" action="'.url(url_prefix()."/completed-alert/".encrypt($order->id)).'" id="'.$order_completed.'">
        <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
        <button type="button" class="btn btn-success btn-sm waves-effect" onclick="resendCompleteAlert(&quot;'.$order_completed.'&quot;)" style="margin-top:20px">Resend "Completed" Alert to Client</button>
        </form><hr class="divider">
        ';

        //revision
        $actions .= '
        <form method="post" action="'.url(url_prefix()."/revise-order/".encrypt($order->id)).'" id="'.$order_revise.'">
        <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
        <button type="button" class="btn btn-warning btn-sm waves-effect" onclick="confirmReviseOrder(&quot;'.$order_revise.'&quot;)" style="margin-top:20px">Change status to "In-Revision"</button>
        </form><hr class="divider">
        ';

         //payment completed
        $actions .= '
        <form method="post" action="'.url(url_prefix()."/payment-completed/".encrypt($order->id)).'" id="'.$order_payment_completed.'">
        <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
        <button type="button" class="btn btn-primary btn-sm waves-effect" onclick="PaymentCompleteOrder(&quot;'.$order_payment_completed.'&quot;)" style="margin-top:20px">Change Payment Status to "Completed"</button>
        </form><hr class="divider">
        ';

           //payment pending
        $actions .= '
        <form method="post" action="'.url(url_prefix()."/payment-pending/".encrypt($order->id)).'" id="'.$order_payment_pending.'">
        <input type="hidden" name="_token" id="csrf-token" value="'.csrf_token().'" />
        <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="PaymentPendingOrder(&quot;'.$order_payment_pending.'&quot;)" style="margin-top:20px">Change Payment Status to "Pending"</button>
        </form><hr class="divider">
        ';

        return $actions;


    }
}

if (!function_exists('paymentStatus')) {
    function paymentStatus($status){
        $classs = '';
        if ($status == 'completed') {
            $classs = 'status_payment_completed';
        }elseif ($status == 'pending') {
            $classs = 'status_pending';
        }
        return $classs;

    }
}