<?php

namespace App\Http\Controllers\Orders\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminProfileController extends Controller
{
    //
	public function __construct()
	{
		$this->folder = 'orders.main.';
	}
    //
	public function myProfile(Request $request){
		$user = auth()->user();
		return view($this->folder.'profile',[
			'user' => $user
		]);
	}

	public function updateProfile(Request $request){
		\request()->validate([
			'customer_name' => 'required',
		]);
		$user = auth()->user();
		$user->name = $request->customer_name;
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
}
