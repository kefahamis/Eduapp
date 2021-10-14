<?php
Route::group(['middleware'=>['web','auth','can:is_customer'],'prefix'=>'customer','namespace'=>'Orders\Customer'],function(){
	$controller = "CustomerOrdersController@";
    $profile = "CustomerProfileController@";
    $chats = "CustomerChatsController@";

    Route::get('orders',$controller.'myOrders')->name('customer.orders');
    Route::get('view-order/{oid}',$controller.'viewOrder')->name('customer.view.order');

    Route::get('profile',$profile.'myProfile')->name('customer-profile');
    Route::post('update-profile',$profile.'updateProfile')->name('customer.updateProfile');
    Route::post('update-password',$profile.'updatePassword')->name('customer.updatePassword');

    Route::post('add-funds',$profile.'addFunds')->name('customer.addFunds');

    Route::get('order-checkout/',$controller.'orderCheckout')->name('orderCheckout');
    Route::post('cancel-order/{oid}',$controller.'cancelOrder')->name('customer.cancelOrder');
    Route::post('dispute-order/{oid}',$controller.'disputeOrder')->name('customer.disputeOrder');

    Route::get('my-chats',$chats.'myChats')->name('customer.myChats');
    Route::get('list/my-chats',$chats.'listMyChats')->name('customer.listMyChats');
    Route::post('my-chats/set-recipient',$chats.'customerSetRecipient')->name('customer.customerSetRecipient');
    Route::post('my-chats/list-recipients',$chats.'customerListRecipients')->name('customer.customerListRecipients');
    Route::post('my-chats/select-recipient',$chats.'customerSelectRecipient')->name('customer.customerSelectRecipient');
    Route::post('my-chats/list-messages',$chats.'customerListMessages')->name('customer.customerListMessages');
    Route::post('my-chats/send-message',$chats.'customerSendMessage')->name('customer.customerSendMessage');

});