<?php

namespace App\Http\Controllers\Orders\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Chat;
use App\Models\Writer;
use Illuminate\Support\Facades\DB;

class CustomerChatsController extends Controller
{
    public function __construct()
    {
        $this->folder = 'orders.customer.';
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

public function customerListRecipients(Request $request){
    //
    $recipient_ids = array();
    $customer = auth()->user();
    
    $recipients = User::where('level','writer')
    ->orWhere('level','admin')->get();
    return response()->json($recipients);
}

public function customerSelectRecipient(Request $request){
  $recipient_id = $request->recipient;
  $recipient = User::where('id',$recipient_id)->first();
  //mark recipients texts as read
  // $recipient_chats = Chat::where
  request()->session()->forget('recipient_id');
  request()->session()->put('recipient_id',$recipient_id);
  $response['status'] = 'success';
  $response['recipient_name'] = $recipient->name;
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

public function customerSendMessage(Request $request){
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
