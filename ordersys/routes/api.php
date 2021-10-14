<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});


Route::group(['middleware'=>['api'],'prefix'=>'api'],function(){
	$dpo_controller = "DpoPaymentController@";
	$ipay_controller = "iPayPaymentController@";

	Route::get('handle-dpo',$dpo_controller.'processDpoPayment')->name('api.processDpoPayment');

	Route::get('handle-ipay',$ipay_controller.'processIpayPayment')->name('api.processIpayPayment');
});
