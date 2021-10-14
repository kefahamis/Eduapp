<?php
// header('Access-Control-Allow-Origin: https://www.paypal.com');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('index');
});

Auth::routes();
Route::post('login','Auth\\AuthController@login');
Route::post('auth/email','Auth\\AuthController@authEmailOnly');
Route::post('auth/pauth','Auth\\AuthController@authPassword');
Route::post('auth/save-contacts','Auth\\AuthController@setPassAndPhone');
Route::get('logout','Auth\\AuthController@logout');
Route::post('reset-password','Auth\\AuthController@resetPassword');
Route::post('check-auth','Auth\\AuthController@checkAuth');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/ordernow', 'HomeController@orderNow')->name('orderNow');
Route::get('/orders', 'HomeController@ordersPage')->name('ordersPage');

Route::post('/file/post', 'DropZoneController@postFile')->name('postFile');
Route::post('/file/delete', 'DropZoneController@deleteFile')->name('deleteFile');

$ordercontroller = "OrderController@";

Route::get('/ordernow/{order_code}', 'OrderController@editPlaceOrder')->name('editPlaceOrder');
Route::post('/ordernow/save-edit/{order_code}', 'OrderController@saveOrderEdit')->name('saveOrderEdit');

Route::get('/order-bidding/{order_code}', 'OrderController@orderBidding')->middleware('auth','can:is_customer')->name('orderBidding');
Route::get('/ordernow/check-order/{order_code}', 'OrderController@checkOrder')->middleware('auth','can:is_customer')->name('checkOrder');
Route::post('/ordernow/init-order', 'OrderController@initiateOrder')->name('initiateOrder');
Route::post('/ordernow/accept-writer', 'OrderBiddingController@acceptWriter')->middleware('auth','can:is_customer')->name('acceptWriter');
Route::get('/customer/billing/{order_code}', 'OrderCheckoutController@orderBilling')->middleware('auth','can:is_customer')->name('orderBilling');


Route::post('/ordernow/prgDlry/{order_code}', 'OrderController@prgDlry')->middleware('auth','can:is_customer')->name('prgDlry');


Route::post('order/file-dowload',$ordercontroller.'downloadFile')->middleware('auth')->name('downloadFile');
Route::post('order/file-delete/{order_file_id}',$ordercontroller.'deleteFile')->middleware('auth')->name('deleteFile');
Route::post('order/upload-file',$ordercontroller.'uploadFiles')->middleware('auth')->name('uploadFiles');
Route::post('order/edit-paper-instructions',$ordercontroller.'editPaperInstructions')->middleware('auth')->name('editPaperInstructions');



$checkoutcontroller = "OrderCheckoutController@";
Route::post('/order/checkout/{order_code}',$checkoutcontroller.'initiatePayment')->middleware('auth');
Route::get('/customer/payment-success',$checkoutcontroller.'paymentSuccessful')->middleware('auth')->name('successful.paypal');
Route::get('cancel-payment',$checkoutcontroller.'cancelPayment')->name('cancel.paypal');
Route::get('payment-notification',$checkoutcontroller.'notifyPayPal')->name('notify.paypal');

Route::post('paypal/checkout/{order_code}', 'PayPalCheckoutController@payWithPaypal')->name('payWithPaypal');
Route::post('paypal/return/{order_code}', 'PayPalCheckoutController@paypalReturn')->name('paypalReturn');


//New routes
Route::get('/', 'HomeController@index')->name('home');

Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages');

Route::post('/send','MessagesController@postSendMessage');

Route::get('/fetch-old-messages', 'MessagesController@getOldMessages');

Route::get('/emit', function () {
    \App\Events\MessageSent::broadcast(\App\User::find(1));
});
