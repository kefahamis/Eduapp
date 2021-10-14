@extends('layouts.customer')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/chatcss.css')}}">
<div class="container">
	<div class="row inner-content_bg_gray">

        <div class="row custom-row">
            <div class="customer-orders-table__heading">
                <div class="customer-orders-table__title"> My chats</div>
                <a href="{{url('ordernow')}}" class="js_button_order btn btn_customer-orders-heading btn_primary-accent js_crm_order_list_button_click js_button_order_ga">Place order</a>
            </div>

            <main class="content">
                <div class="container p-0">

                    <div class="card">
                        <div class="row g-0">

                            <!-- start of list -->
                            <div class="col-lg-5 col-xl-3 border-right" style="float:left; max-height: 400px;min-height: 400px;overflow-y: scroll;" id="recipient-div">

                                <div class="px-4 d-none d-md-block">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                        </div>
                                    </div>
                                </div>


                                <hr class="d-block d-lg-none mt-1 mb-0">
                            </div>
                            <!-- end of list -->


                            <!-- start messages -->
                            <div class="col-12 col-lg-7 col-xl-9" style="float:right;">
                               <center>
                                <div id="chatting_with">

                                </div>
                            </center>
                            <div class="position-relative">
                                <div class="chat-messages p-4">
                                    <div id="error_div"></div>
                                </div>
                            </div>
                            <input type="hidden" id="recipient_id" value="0">
                            <div class="flex-grow-0 py-3 px-4 border-top" id="textarea-div">
                                <div class="input-group">
                                    <textarea class="form-control" id="your_message"></textarea>
                                    <button class="btn btn-primary" id="chat-btn">Send</button>
                                </div>
                            </div>
                        </div>
                        <!-- end messages -->

                    </div>
                </div>
            </div>
        </main>

    </div>

</div>
</div>
<script type="text/javascript">
    $("#your_message").keypress(function(event) { 
        if (event.keyCode === 13) { 
            $("#chat-btn").click(); 
        } 
    }); 
    $(document).ready(function(){
        $("#textarea-div").hide();
        $("#chatting_with").append('<h5>Please select a writer to initiate chat.</h5>');
        var recipient = $("#recipient_id").val();
        initChat(recipient);
        
        setInterval(function(){
         var recipient = $("#recipient_id").val();
         listMessages(recipient);
     }, 5000);  

        setInterval(function(){
          listRecipients();
      }, 15000);   



    });

    $("#chat-btn").click(function(){
        var message = $("#your_message").val();
        if (message == '') {
            return;
        }
        var recipient = $("#recipient_id").val();
        sendMessage(recipient,message);
    });

    function initChat(recipient){
       $("#recipient_id").val(recipient);
       jQuery.ajax({
        url: "{{ url('customer/my-chats/set-recipient') }}",
        method: 'POST',
        data: {
            recipient: recipient,
        },
        cache: false,
        timeout: 600000,
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        success: function(response){
            if (response.status == 'none') {
              $("#recipient_id").val(response.recipient_id);
              listRecipients();
          }else{
            $("#recipient_id").val(response.recipient_id);
            listRecipients();
            listMessages(recipient); 
        }

    },
    error: function (err) {
        $("#error_div").html("An error ocurred!Please refresh this page.");
        $("#chat-btn").prop("disabled", true);
    }
});
   }

   function listRecipients(){
    var data_str = 'list-recipients';
    jQuery.ajax({
        url: "{{ url('customer/my-chats/list-recipients') }}",
        method: 'POST',
        data: {
            data_str: data_str,
        },
        cache: false,
        timeout: 600000,
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        success: function(recipients){
           $("#recipient-div").empty();
           $.each(recipients, function(index, recipient){
            $("#recipient-div").append("<span class='list-group-item list-group-item-action border-0' onclick=selectRecipient("+recipient.id+")><div class='d-flex align-items-start'><img src='{{asset('images/default.png')}}' class='rounded-circle mr-1' alt='"+recipient.name+"' width='40' height='40'><div class='flex-grow-1 ml-3'>"+recipient.name+"<div class='small'><span class='fas fa-circle chat-online'></span>"+recipient.login_session+"</div></div></div></span>");
        });
       },
       error: function (err) {
        $(".chat-messages").empty();
        $("#your_message").hide();
        $("#recipient-div").empty();
        $("#chat-btn").hide();
        $("#error_div").html("An error ocurred!Please refresh this page again.");
        $("#chat-btn").prop("disabled", true);
    }
});
}

function selectRecipient(recipient){
 $("#chatting_with").empty();
 $("#recipient_id").val(recipient);
 $("#textarea-div").show();
 jQuery.ajax({
    url: "{{ url('customer/my-chats/select-recipient') }}",
    method: 'POST',
    data: {
        recipient: recipient,
    },
    cache: false,
    timeout: 600000,
    headers: {
        'X-CSRF-TOKEN': '{{csrf_token()}}'
    },
    success: function(response){
        $("#chat-btn").prop("disabled", false);
        if (response.status == 'success') {
           $(".chat-messages").empty();
           $("#chatting_with").append("<h5>You are now chatting with:"+response.recipient_name+"</h5>");
           listMessages(recipient);
       }else{
        $("#recipient_id").val(response.recipient_id);
        listMessages(recipient); 
    }

},
error: function (err) {
    $("#error_div").html("An error ocurred!Please refresh this page.");
    $("#chat-btn").prop("disabled", true);
}
});
}


function sendMessage(recipient,message){
   $("#your_message").val('');
   jQuery.ajax({
    url: "{{ url('customer/my-chats/send-message') }}",
    method: 'POST',
    data: {
        recipient: recipient,
        your_message: message,
    },
    cache: false,
    timeout: 600000,
    headers: {
        'X-CSRF-TOKEN': '{{csrf_token()}}'
    },
    success: function(response){
        listMessages(recipient);
    },
    error: function (err) {
        $("#error_div").html("An error ocurred!Please refresh this page again.");
        $("#chat-btn").prop("disabled", true);
    }
});
}

function listMessages(recipient){
    var sender_id = "{{auth()->user()->id}}";
    var data_str = "list";
    jQuery.ajax({
        url: "{{ url('customer/my-chats/list-messages') }}",
        method: 'POST',
        data: {
            recipient: recipient,
        },
        cache: false,
        timeout: 600000,
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        success: function(messages){
            $(".chat-messages").empty();


            $.each(messages, function(index, message){
                if (message.from == sender_id) {
                    $(".chat-messages").append("<div class='chat-message-right pb-4'><div><img src='{{asset('images/user avatar.png')}}'' class='rounded-circle mr-1' alt='You' width='40' height='40'><div class='text-muted small text-nowrap mt-2'>"+message.created_at+"</div></div><div class='flex-shrink-1 bg-light rounded py-2 px-3 mr-3'><div class='font-weight-bold mb-1'>You</div>"+message.message+"</div></div>");
                }
                if (message.from != sender_id ) {
                    $(".chat-messages").append("<div class='chat-message-left pb-4'><div><img src='{{asset('images/default.png')}}'' class='rounded-circle mr-1' alt='Sharon Lessman' width='40' height='40'><div class='text-muted small text-nowrap mt-2'>"+message.created_at+"</div></div><div class='flex-shrink-1 bg-light rounded py-2 px-3 ml-3'><div class='font-weight-bold mb-1'>"+message.recipient_name+"</div>"+message.message+"</div></div>");
                }
            });
            $(".chat-messages").scrollTop($('.chat-messages')[0].scrollHeight);

        },
        error: function (err) {
            $("#error_div").html("An error ocurred!Please refresh this page again.");
            $("#chat-btn").prop("disabled", true);
        }
    });
}


</script>
@endsection