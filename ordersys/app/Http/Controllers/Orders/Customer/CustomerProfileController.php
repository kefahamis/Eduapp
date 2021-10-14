<?php

namespace App\Http\Controllers\Orders\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use App\User;

class CustomerProfileController extends Controller
{
     //
	public function __construct()
	{
		$this->folder = 'orders.customer.';
	}
    //
	public function myProfile(Request $request){
		$user = auth()->user();
		$cancelled = Order::select('*')
		->where('customer_id', auth()->user()->id)
		->orWhere('status', 4)
		->orWhere('status', 5)
		->orWhere('status', 6)
		->count();

		$completed = Order::where([
			'customer_id' => auth()->user()->id,
			'status' => 7,
		])->count();

		$in_progress = Order::where([
			'customer_id' => auth()->user()->id,
			'status' => 3,
		])->count();

		return view($this->folder.'profile',[
			'user' => $user,
			'cancelled' => $cancelled,
			'completed' => $completed,
			'in_progress' => $in_progress
		]);
	}

	public function updateProfile(Request $request){
		\request()->validate([
            'customer_name' => 'required',
            'countryCode' => 'required',
        ]);
		$user = auth()->user();
        $user->name = $request->customer_name;
        $user->country = $request->countryCode;
        if (isset($request->phone_number)) {
         $user->phone_number = $request->phone_number;
     }
     $user->save();
     return redirect()->back()->with('success','Profile updated successfuly.');
 }

 public function updatePassword(Request $request){
  \request()->validate([
     'current_password' => 'required',
     'new_password' => 'required',
     'confirm_new_password' => 'required',
 ]);
  $user = auth()->user();
  $hasher = app('hash');
  if ($hasher->check($request->current_password, $user->password)) {
			//check if password matches
     if ($request->new_password != $request->confirm_new_password) {
        return redirect()->back()->with('error','New password confirmation does not match!');
    }
    $user->password = Hash::make($request->new_password);
    $user->save();
    return redirect()->back()->with('success','Password updated successfuly.');
}
return redirect()->back()->with('error','Invalid current password.');

}

public function addFunds(Request $request){
  $user = auth()->user();
  $load_amt = $request->add_deposit_amount;
  return view($this->folder.'add-funds',[
     'user' => $user,
     'load_amt' => $load_amt
 ]);
}
}
