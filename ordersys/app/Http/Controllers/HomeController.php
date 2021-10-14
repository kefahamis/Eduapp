<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use App\User;

use App\Models\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        if (auth()->check()) {
            // return redirect(auth()->user()->url_prefix.'/orders');
            $users = User::where('id', '!=', Auth::user()->id)->get();
            return view('home', compact('users'));
        }
        return view('index');
    }

    public function orderNow(){

        return view('index');
    }


    public function ordersPage(Request $request){
        if (auth()->check()) {
            if (auth()->user()->level == 'admin') {
                return redirect('main/orders');
                //  $orders = Order::where('id','>',0)->orderBy('created_at','desc')->paginate(5);
                //  return view('orders.main.orders',[
                //   'orders' => $orders
                // ]);
            }
            elseif (auth()->user()->level == 'writer') {
                return redirect('writer/orders');
            }
            elseif (auth()->user()->level == 'customer') {
                return redirect('customer/orders');
            }
            else{
                return view('index');
            }
        }
        return view('index');
    }

}
