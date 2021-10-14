<?php
Route::group(['middleware'=>['web','auth','can:is_writer'],'prefix'=>'writer','namespace'=>'Orders\Writer'],function(){
	$controller = "WriterOrdersController@";
	$profile = "WriterProfileController@";
    $chats = "WriterChatsController@";


    Route::get('orders',$controller.'myOrders')->name('writer-orders');
    Route::get('bidding',$controller.'ordersInBidding');
    Route::get('completed',$controller.'completedOrders');
    Route::get('cancelled',$controller.'cancelledOrders');
    Route::get('revision',$controller.'revisionOrders');
    Route::get('disputed',$controller.'disputedOrders');

    Route::get('order/{oid}',$controller.'viewOrder')->name('writer.view.order');

    Route::get('search',$controller.'searchOrders')->name('writer.search.orders');

    Route::get('profile',$profile.'myProfile')->name('writer.profile');
    Route::post('update-profile',$profile.'updateProfile')->name('writer.updateProfile');
    Route::post('update-password',$profile.'updatePassword')->name('writer.updatePassword');

    Route::post('cancel-order/{oid}',$controller.'cancelOrder')->name('writer.cancelOrder');
    Route::post('process-order/{oid}',$controller.'processOrder')->name('writer.processOrder');
    Route::post('complete-order/{oid}',$controller.'completeOrder')->name('writer.completeOrder');
    Route::post('completed-alert/{oid}',$controller.'OrderCompletedAlert')->name('writer.OrderCompletedAlert');
    Route::post('revise-order/{oid}',$controller.'reviseOrder')->name('writer.reviseOrder');

    Route::get('profile',$profile.'myProfile')->name('writer-profile');

    Route::get('my-chats',$chats.'myChats')->name('writer.myChats');
    Route::get('list/my-chats',$chats.'listMyChats')->name('writer.listMyChats');
    Route::post('my-chats/set-recipient',$chats.'writerSetRecipient')->name('writer.adminSetRecipient');
    Route::post('my-chats/list-recipients',$chats.'writerListRecipients')->name('writer.adminListRecipients');
    Route::post('my-chats/select-recipient',$chats.'writerSelectRecipient')->name('writer.adminSelectRecipient');
    Route::post('my-chats/list-messages',$chats.'writerListMessages')->name('writer.adminListMessages');
    Route::post('my-chats/send-message',$chats.'writerSendMessage')->name('writer.adminSendMessage');

});