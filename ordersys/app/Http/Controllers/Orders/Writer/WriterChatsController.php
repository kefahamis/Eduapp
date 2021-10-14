<?php

namespace App\Http\Controllers\Orders\Writer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Chat;
use App\Models\Writer;
use Illuminate\Support\Facades\DB;

class WriterChatsController extends Controller
{
    //
    public function __construct()
    {
        $this->folder = 'orders.writer.';
    }

    public function myChats(Request $request){
        return view($this->folder.'my-chats',[

        ]);
    }

    public function listMyChats(Request $request){
     $user_id = auth()->user()->id;

     $my_chats = DB::table('chat_messages')
     ->join('users', function ($join) {
        $join->on('users.id', '=', 'chat_messages.from')->orOn('users.id', '=', 'chat_messages.to');
    })
     ->select('chat_messages.*', 'users.name')
     ->get();
     return response()->json($messages);

 }

 public function writerSetRecipient(Request $request){
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
     return response()->json($response);
 }
 $response['status'] = 'none';
 $response['recipient_id'] = 0;
 return response()->json($response);

}

public function writerListRecipients(Request $request){
    //
    $recipient_ids = array();
    $writer = auth()->user()->writer;

    $assigned_orders = $writer->assigned_orders;
    $customer_ids = array();
    foreach ($assigned_orders as $assigned_order) {
        $customer_id = $assigned_order->customer_id;
        if (!in_array($customer_id, $customer_ids)) {
           array_push($customer_ids, $customer_id);
       }
   }
   $recipients = DB::table('users')
   ->whereIn('id', $customer_ids)
   ->get();
   return response()->json($recipients);

}

public function writerSelectRecipient(Request $request){
  $recipient_id = $request->recipient;
  $recipient = User::where('id',$recipient_id)->first();
  request()->session()->forget('recipient_id');
  request()->session()->put('recipient_id',$recipient_id);
  $response['status'] = 'success';
  $response['recipient_name'] = $recipient->name;
  return response()->json($response);
}

public function writerListMessages(Request $request){
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

public function writerSendMessage(Request $request){
 $sender_id = auth()->user()->id;
 $recipient_id = $request->recipient;
 if (request()->session()->has('recipient_id')) {
    $recipient_id = request()->session()->get('recipient_id');
}
$message = $request->your_message;

$chat = new Chat;
$chat->from = $sender_id;
$chat->to = $recipient_id;
$chat->message = $message;
$chat->save();

return response()->json('success');
}

}
