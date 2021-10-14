<input type="checkbox" id="check"> <label class="chat-btn" for="check"> <span style="font-size: 19px;margin-right: 10px;">Chat with Writers </span><i class="fa fa-commenting-o comment" style="margin-right: 1px"></i></label>
<div class="wrapper" style="min-height: 486px;">
    <div class="header">
        <h6 id="lets_chat"></h6>

    </div>

    <div class="chat-form"> 
        <div class="form-group" id="selecting">
            <span id="select-recipient-label">Please select recipient to start chat!</span>
            <div id="recipient-div" class="recipient-div">

            </div>
        </div>
        <div class="form-group" id="backtochats">
            <li class='recipient-list' onclick="listRecipients()"><<< Back to chats</li>
        </div>
        <div id="error_div"></div>
        <div class="form-group chats-holder">

        </div>
        <textarea class="form-control" id="your_message" style="display:none;"></textarea>
        <input type="hidden" id="recipient_id" value="0">
        <input type="hidden" id="order_code" value="0">
        <button class="btn btn-success btn-block" id="chat-btn">Send</button> 
    </div>
</div>
<script type="text/javascript">
    $("#your_message").keypress(function(event) { 
        if (event.keyCode === 13) { 
            $("#chat-btn").click(); 
        } 
    }); 
    $(document).ready(function(){
      var recipient = $("#recipient_id").val();
      $("#your_message").hide();
      $("#chat-btn").hide();
      $("#selecting").show();
      $("#backtochats").hide();
      $('#lets_chat').text("Let's Chat - Online");
      initChat(recipient);
      setInterval(function(){
        //var order_code = $("#order_code").val();
       // listMessages(order_code)
   }, 3000);
  });

    $("#chat-btn").click(function(){
        var message = $("#your_message").val();
        if (message == '') {
            return;
        }
        var recipient = $("#recipient_id").val();
        var order_code = $("#order_code").val();
        sendMessage(recipient,message,order_code);
    });

    function initChat(recipient){
     var order_code = $("#order_code").val();
     $("#recipient_id").val(recipient);
     jQuery.ajax({
        url: "{{ url('chat/set-recipient') }}",
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
               $("#selecting").show();
               return;
           }
           $("#recipient_id").val(response.recipient_id);
           $('#lets_chat').text(response.recipient_name+" - Online");
           listMessages(order_code); 
       },
       error: function (err) {
        $("#error_div").html("An error ocurred!Please refresh this page again.");
        $("#chat-btn").prop("disabled", true);
    }
});
     $("#your_message").show();
     $("#chat-btn").show();
     $("#selecting").hide();
     $("#backtochats").show();



 }

 function sendMessage(recipient,message,order_code){
     $("#your_message").val('');
     jQuery.ajax({
        url: "{{ url('chat/send-message') }}",
        method: 'POST',
        data: {
            recipient: recipient,
            your_message: message,
            order_code: order_code
        },
        cache: false,
        timeout: 600000,
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        success: function(response){
         listMessages(order_code);

     },
     error: function (err) {
        $("#error_div").html("An error ocurred!Please refresh this page again.");
        $("#chat-btn").prop("disabled", true);
    }
});
 }

 function listMessages(order_code){
  var recipient = $("#recipient_id").val();
  var sender_id = "{{auth()->user()->id}}";
  var data_str = "list";
  jQuery.ajax({
    url: "{{ url('chat/list-messages') }}",
    method: 'POST',
    data: {
        order_code: order_code,
        recipient: recipient,
    },
    cache: false,
    timeout: 600000,
    headers: {
        'X-CSRF-TOKEN': '{{csrf_token()}}'
    },
    success: function(messages){

        $("#recipient-div").empty();
        $.each(messages, function(index, message){
            if (message.from == sender_id) {
                $(".chats-holder").append("<div class='direct-chat-msg right'><div class='direct-chat-info clearfix'> <span class='direct-chat-name pull-right'>You</span> <span class='direct-chat-timestamp pull-left'>"+message.created_at+"</span> </div> <img class='direct-chat-img' src='{{asset('images/user avatar.png')}}'' alt='message user image'><div class='direct-chat-text sender'>"+message.message+"</div></div>");
            }else if (message.from != sender_id) {
                $(".chats-holder").append("<div class='direct-chat-msg'><div class='direct-chat-info clearfix'><span class='direct-chat-name pull-left'>"+message.recipient_name+"</span> <span class='direct-chat-timestamp pull-right'>"+message.created_at+"</span> </div> <img class='direct-chat-img' src='{{asset('images/user avatar.png')}}' alt='message user image'><div class='direct-chat-text recipient'>"+message.message+"</div></div>");
            }
            else{

            }
            $(".chats-holder").scrollTop($('.chats-holder')[0].scrollHeight);
        });
    },
    error: function (err) {

        $("#error_div").html("An error ocurred!Please refresh this page again.");
        $("#chat-btn").prop("disabled", true);
    }
});
}

function listRecipients(){
    $(".chats-holder").empty();
    $("#recipient_id").val(0);
    $("#your_message").hide();
    $("#chat-btn").hide();
    $("#selecting").show();
    $("#backtochats").hide();
    $('#lets_chat').text("Let's Chat - Online");
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
         $.each(recipients, function(index, element){
            $("#recipient-div").append("<li class='recipient-list' onclick=initChat("+element.id+");>&gt;&gt;&gt;"+element.name+"&lt;&lt;&lt;</li>");
        });


     },
     error: function (err) {

        $("#error_div").html("An error ocurred!Please refresh this page again.");
        $("#chat-btn").prop("disabled", true);
    }
});
}


</script>