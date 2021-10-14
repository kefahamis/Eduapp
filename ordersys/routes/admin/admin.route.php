<?php
Route::group(['middleware'=>['web','auth','can:is_admin'],'prefix'=>'main','namespace'=>'Orders\Admin'],function(){
	$controller = "AdminOrdersController@";
	$profile = "AdminProfileController@";
	$userscontroller = "AdminUsersController@";
    $chats = "AdminChatsController@";

    Route::get('orders',$controller.'myOrders')->name('main-orders');
    Route::get('bidding',$controller.'ordersInBidding');
    Route::get('completed',$controller.'completedOrders');
    Route::get('cancelled',$controller.'cancelledOrders');
    Route::get('revision',$controller.'revisionOrders');
    Route::get('disputed',$controller.'disputedOrders');

    Route::get('users',$userscontroller.'myUsers');
    Route::get('client-details',$userscontroller.'clientDetails');
    Route::get('writer-details',$userscontroller.'writerDetails');
    Route::post('create-writer',$userscontroller.'createWriter')->name('main.createWriter');
    Route::get('edit-writer/{writer_code}',$userscontroller.'editWriter')->name('main.editWriter');
    Route::post('save-writer/{writer_code}',$userscontroller.'saveWriter')->name('main.saveWriter');

    Route::get('order/{oid}',$controller.'viewOrder')->name('main.view.order');

    Route::get('profile',$profile.'myProfile')->name('main.profile');
    Route::post('update-profile',$profile.'updateProfile')->name('main.updateProfile');
    Route::post('update-password',$profile.'updatePassword')->name('main.updatePassword');

    Route::post('cancel-order/{oid}',$controller.'cancelOrder')->name('main.cancelOrder');
    Route::post('process-order/{oid}',$controller.'processOrder')->name('main.processOrder');
    Route::post('complete-order/{oid}',$controller.'completeOrder')->name('main.completeOrder');
    Route::post('completed-alert/{oid}',$controller.'OrderCompletedAlert')->name('main.OrderCompletedAlert');
    Route::post('revise-order/{oid}',$controller.'reviseOrder')->name('main.reviseOrder');
    Route::post('assign-writer/{oid}',$controller.'assignWriter')->name('main.assignWriter');
    Route::post('adjust-price/{oid}',$controller.'adjustPrice')->name('main.adjustPrice');
    Route::get('search',$controller.'searchOrders')->name('main.search.orders');
    Route::post('payment-completed/{oid}',$controller.'orderPaymentCompleted')->name('main.orderPaymentCompleted');
    Route::post('payment-pending/{oid}',$controller.'orderPaymentPending')->name('main.orderPaymentPending');
    Route::post('price-adjust/{oid}',$controller.'adjustPrice')->name('main.adjustPrice');

    Route::get('my-chats',$chats.'myChats')->name('admin.myChats');
    Route::get('list/my-chats',$chats.'listMyChats')->name('admin.listMyChats');
    Route::post('my-chats/set-recipient',$chats.'adminSetRecipient')->name('admin.adminSetRecipient');
    Route::post('my-chats/list-recipients',$chats.'adminListRecipients')->name('admin.adminListRecipients');
    Route::post('my-chats/select-recipient',$chats.'adminSelectRecipient')->name('admin.adminSelectRecipient');
    Route::post('my-chats/list-messages',$chats.'adminListMessages')->name('admin.adminListMessages');
    Route::post('my-chats/send-message',$chats.'adminSendMessage')->name('admin.adminSendMessage');
    
});