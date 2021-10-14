<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NewUserNotification;
use App\Notifications\PasswordResetNotification;
use Illuminate\Support\Str;

class AuthController extends Controller
{
	use Notifiable;
	protected $redirectTo = '/'; 

	public function login(Request $request)
	{
		\request()->validate([
			'email' => 'required',
			'password' => 'required'
		]);
		$login = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)
		? 'email'
		: 'username';

		$request->merge([
			$login => $request->input('email')
		]);
		if (Auth::attempt($request->only($login, 'password'))) {
			$user = Auth::user();
			request()->session()->put('randKey',Hash::make($user->email));
			return $this->loggedInSuccessfully($user);
		}

		return redirect()->back()->with(['errors'=>['email'=>'Wrong email or password']],422);


	}

	protected function loggedInSuccessfully($user)
	{
        $user = auth()->user();
        $user->login_session = 'Online';
        $user->save();
        return Redirect::intended('/');

    }

    public function register()
    {
      return redirect('/');
  }

  public function checkAuth(){
    if (auth()->check()) {
        return response()->json(['status' => '34as2DinDE']);
    }
    return response()->json(['status' => '3cccrQAOpd0']);
}

public function sanitizeUser($user)
{
  $other_users = User::where([
   ['email', 'like', $user->email],
   ['id', '!=', $user->id]
])->get();
  foreach ($other_users as $other_user) {
   Order::where('user_id', $other_user->id)->update([
    'website_id' => $user->website_id,
    'user_id' => $user->id
]);
   $other_user->delete();
}
}

public function logout(Request $request) {
  $user = auth()->user();
  $user->login_session = 'Offline';
  $user->save();
  Auth::logout();
  return redirect('/');
}

public function loginUser(Request $request){
  \request()->validate([
   'email' => 'required',
   'password' => 'required'
]);
  $credentials = $request->only('email', 'password');

  if (Auth::attempt($credentials)) {
     $user = auth()->user();
     $user->login_session = 'Online';
     $user->save();
     return response()->json(['status' => true, 'id' => auth()->user()->id,'name' => auth()->user()->name]);
 }else{
   return response()->json(['status' => false,'name' => "Wrong password or email"]);

}
}

public function authEmailOnly(Request $request){
  \request()->validate([
   'llogin_email' => 'required',
]);
        //check user
  $check_user = User::where('email',$request->llogin_email)->first();
  if ($check_user) {
   request()->session()->put('usr_email',$request->llogin_email);
   return response()->json(['status' => 'old_usr','msg' => $request->llogin_email]);

}else{
         //new user
   $user = new User;
   $user->name="Customer-".rand(231,90002);
   $user->email=$request->llogin_email;

   $password = rand(231,90002);
   $user->password =Hash::make($password);
   $user->level = 'customer';
   $user->url_prefix = 'customer';
   $user->status = 'active';
   $user->login_session = 'Online';
   $user->save();
   $user->notify(new NewUserNotification($user, $password));
   Auth::login($user, true);
   request()->session()->put('usr_email',$request->llogin_email);
   Auth::login($user, true);
   $user = Auth::user();
   request()->session()->put('randKey',Hash::make($user->email));
   return response()->json(['status' => 'new_usr','msg' => "created"]);

}
}

public function setPassAndPhone(Request $request){

    $user = auth()->user();
    $user->country = $request->customer_country;
    $user->phone_number = $request->phone_number;
    $user->save();
    return response()->json(['status' => 'done','msg' => "created"]);

}



public function authPassword(Request $request){
  \request()->validate([
   'email' => 'required',
   'password' => 'required'
]);
  $llogin_email = $request->email;
  $llogin_passwrd = $request->password;

  if (request()->session()->has('llogin_email') == true && request()->session()->get('llogin_email') != '') {
   $llogin_email = request()->session()->get('llogin_email');
}

$credentials = $request->only('email', 'password');

if (Auth::attempt($credentials)) {
    $user = auth()->user();
    $user->login_session = 'Online';
    $user->save();

    return response()->json(['status' => 'a2d3zDXy','msg' => "success"]);

}else{
   return response()->json(['status' => 'wrong_credentials','msg' => "failed"]);
}


}

public function resetPassword(Request $request){
    request()->validate([
       'llogin_email' => 'required'
   ]);
    $user = User::where('email',$request->llogin_email)->first();
    if ($user) {
        $password = Str::random(6);
        $user->password =Hash::make($password);
        $user->save();
        $user->notify(new PasswordResetNotification($user, $password));

        return response()->json(['status' => 'password_reset','msg' => "New password has been sent to your email."]);
    }else{
        return response()->json(['status' => 'failed','msg' => "User does not exist!"]);
    }

}


}
