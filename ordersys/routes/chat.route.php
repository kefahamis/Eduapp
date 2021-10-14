<?php
Route::group(['middleware'=>['web'],'prefix'=>'chat'],function(){
    $chat_controller = "ChatController@";

    Route::post('list-recipients',$chat_controller.'customerListRecipients')->name('chat.customerListRecipients');
    Route::post('list-messages',$chat_controller.'customerListMessages')->name('chat.customerListMessages');
    Route::post('send-message',$chat_controller.'customerSendMessage')->name('chat.customerSendMessage');
    Route::post('set-recipient',$chat_controller.'customerSetRecipient')->name('chat.customerSetRecipient');

});