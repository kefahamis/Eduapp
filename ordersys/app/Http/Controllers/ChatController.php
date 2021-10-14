<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Chat;
use App\Models\Writer;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function customerListRecipients(Request $request){
       $recipients = User::where('level','writer')
       ->orWhere('level','admin')->get();
       return response()->json($recipients);
   }

   public function customerSetRecipient(Request $request){
       $recipient_id = $request->recipient;
       $response = array();
       request()->session()->forget('recipient_id');
       if ($recipient_id == 0) {
        request()->session()->put('recipient_id', 0);
        $response['status'] = 'none';
        $response['recipient_id'] = 0;
        return response()->json($response);
    }
    $user = User::where('id',$recipient_id)->first();
    if ($user) {
     request()->session()->put('recipient_id',$recipient_id);
     $response['status'] = 'success';
     $response['recipient_id'] = $recipient_id;
     $response['recipient_name'] = $user->name;
     return response()->json($response);
 }
 $response['status'] = 'none';
 $response['recipient_id'] = 0;
 return response()->json($response);
}

public function customerListMessages(Request $request){
   $sender_id = auth()->user()->id;
   $recipient_id = $request->recipient;
   if (request()->session()->has('recipient_id') && request()->session()->get('recipient_id') == $recipient_id) {
      $recipient_id = request()->session()->get('recipient_id');
  }
  else{
      request()->session()->forget('recipient_id');
      request()->session()->put('recipient_id',$recipient_id);
      exit();
  }

  if ($recipient_id == '0') {
    echo $recipient_id; exit();
}

    /* 
    No order selected
    */
    if ($request->order_code == 0) {

       $messages = DB::table('chat_messages')->where([
        ['from', '=', $recipient_id],
        ['to', '=', $sender_id],
    ])
       ->orWhere([
           ['from', '=', $sender_id],
           ['to', '=', $recipient_id],
       ])
       ->get();
       $recipient = User::where('id',$recipient_id)->first();
       $recipient_name = $recipient->name;
       foreach ($messages as $message) {
        $message->recipient_name = $recipient_name;
        $message->sender_name = auth()->user()->name;
    }
    return response()->json($messages);
}

    /* 
    Order selected
    */
    if ($request->order_code != 0) {
       $messages = DB::table('chat_messages')->where([
        ['from', '=', $recipient_id],
        ['to', '=', $sender_id],
        ['order_id', '=', $request->order_code],
    ])
       ->orWhere([
           ['from', '=', $sender_id],
           ['to', '=', $recipient_id],
           ['order_id', '=', $request->order_code],
       ])
       ->get();
       $recipient = User::where('id',$recipient_id)->first();
       $recipient_name = $recipient->name;
       foreach ($messages as $message) {
        $message->recipient_name = $recipient_name;
        $message->sender_name = auth()->user()->name;
    }
    return response()->json($messages);
}
}

public function customerSendMessage(Request $request){
    $sender_id = auth()->user()->id;
    $recipient_id = $request->recipient;
    $message = $request->your_message;

    $chat = new Chat;
    $chat->from = $sender_id;
    $chat->to = $recipient_id;
    $chat->message = $message;
    $chat->save();

    return response()->json('success');

}

public function writerListRecipients(){
   $writer = auth()->user()->writer;
   $assigned_orders = $writer->assigned_orders;
   $users = array();
   foreach ($assigned_orders as $assigned_order) {
    $user = $order->user();
    array_push($users, $user);
}
return response()->json($users);
}

}
