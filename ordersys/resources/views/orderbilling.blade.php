@extends('layouts.main_2')

@section('content')


<div class="container">
    <div class="row justify-content">
        
        <div class="progress-banner ">
            <ul class="progress-banner__list">
                <li class="progress-banner__list-item is-passed">
                    <span>Place order</span>
                </li>
                <li class="progress-banner__list-item is-passed" >
                    <span>Select a writer</span>
                </li>
                <li class="progress-banner__list-item is-passed">
                    <span>Check order</span>
                </li>
                <li class="progress-banner__list-item is-active">
                    <span>Add funds to my balance</span>
                </li>
            </ul>
        </div>
        @include('layouts.flash')
        <div class="order-form-v2__row">
            <form method="post" action="{{url('order/checkout/'.$order->order_code)}}" class="js_pay_form">
                @csrf
                <div class="container">
                    <div class="order-pay__summary">
                        <div class="order-pay__summary-heading">
                            <h2 class="order-pay__title">Order Summary</h2>
                        </div>
                        <div class="order-pay__body">
                            <div class="order-pay__summary-topic">
                                <div class="essay-info essay-info_topic">
                                    <h3 class="essay-info__title">Topic</h3>
                                    <p class="essay-info__description">{{$order->topic}}</p>
                                </div>
                            </div>

                            <div class="order-pay__summary-flex">
                                <div class="order-pay__summary-container">
                                    <div class="essay-info">
                                        <h3 class="essay-info__title">Subject</h3>
                                        <p class="essay-info__description">{{$order->subject}}</p>
                                    </div>
                                </div>

                                <div class="order-pay__summary-container">
                                    <div class="essay-info">
                                        <h3 class="essay-info__title">Pages</h3>
                                        <p class="essay-info__description">{{$order->pages}} pages / {{$order->pages*275}} words</p>
                                    </div>
                                </div>

                                <div class="order-pay__summary-container">
                                    <div class="essay-info">
                                        <h3 class="essay-info__title">Deadline</h3>
                                        <p class="essay-info__description">
                                            {{$order->deadline}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </d iv>
                    <div class="order-pay__content">
                        <div class="order-pay__billing">
                            <div class="order-pay__billing-heading">
                                <h2 class="order-pay__title">Billing Information</h2>
                                <p class="order-pay__required-text">All fields are required</p>
                            </div>
                            <div class="order-pay__body">
                                <div class="order-pay__flex-wrap">
                                    <div class="order-pay__col">
                                        <div class="order-pay__row">
                                            <div class="b-form-group">
                                                <label class="b-form-group__text-label">
                                                    Full Name <font color="red">(Required)*</font>
                                                </label>

                                                <input type="text" id="customer_name" name="custom_name" id="customer_name" placeholder="{{$order->customer->name}}" maxlength="32" class="b-form-group__input js_customer_first_name js_pay_form_field" value="{{$order->customer->name}}" required="">
                                                <p class="b-form-group__error-text js_elem_error js_elem_error_payment_form_customer_name"></p>

                                            </div>
                                        </div>


                                        <div class="order-pay__row">
                                            <div class="b-form-group">
                                                <label class="b-form-group__text-label">
                                                    Contact Phone <font color="red">(Required)*</font>
                                                </label>

                                                <input type="tel" id="customer_phone" name="customer_phone" id="customer_phone" maxlength="20" class="b-form-group__input js_pay_form_field" placeholder="Enter your phone number" value="{{$order->customer->phone_number}}" required="">

                                                <p class="b-form-group__error-text js_elem_error js_elem_error_payment_form_billing_address_phone"></p>
                                                <p class="b-form-group__note">Phone number required for verification purposes</p>
                                            </div>
                                        </div>

                                        <div class="order-pay__row">
                                            <div class="b-form-group">
                                                <label class="b-form-group__text-label">
                                                    Email <font color="red">(Required)*</font>
                                                </label>

                                                <input type="email" id="customer_email" name="customer_email" id="customer_email" placeholder="example@gmail.com" maxlength="255" class="b-form-group__input js_pay_form_field" value="{{$order->customer->email}}" required>

                                                <p class="b-form-group__error-text js_elem_error js_elem_error_payment_form_customer_email"></p>

                                            </div>
                                        </div>                       
                                    </div>
                                    <div class="order-pay__col">
                                        <div class="order-pay__row">
                                            <div class="b-form-group">
                                                <label class="b-form-group__text-label">
                                                    Country <font color="red">(Required)*</font>   
                                                </label>
                                                @include('countries')
                                                <p class="b-form-group__error-text js_elem_error js_elem_error_payment_form_billing_address_country"></p>

                                            </div>
                                        </div>

                                        <div class="order-pay__row js_country_state_div">
                                           <div class="b-form-group">
                                            <label class="b-form-group__text-label" for="customer_state">
                                             State (Optional)
                                         </label>
                                         <input type="text" id="customer_state" name="customer_state" placeholder="Enter State" maxlength="32" class="b-form-group__input js_pay_form_field" value="{{auth()->user()->state}}">
                                         <p class="b-form-group__error-text js_elem_error js_elem_error_payment_form_billing_address_country_state"></p>
                                     </div>
                                 </div>

                                 <div class="order-pay__row order-pay__row_mb-30">
                                   <div class="b-form-group b-form-group_city">
                                    <div class="b-form-group__flex-wrap">
                                     <div class="b-form-group__col">
                                      <label class="b-form-group__text-label">
                                       City <font color="red">(Required)*</font>           
                                   </label>
                                   <input type="text" id="customer_city" name="customer_city" placeholder="New York" maxlength="32" class="b-form-group__input js_pay_form_field" value="{{auth()->user()->city}}" required>
                               </div>
                               <div class="b-form-group__col">
                                  <label class="b-form-group__text-label">
                                   ZIP code               
                               </label>
                               <input type="text" id="customer_zip_code" name="customer_zip_code" maxlength="10" class="b-form-group__input js_pay_form_field" value="{{auth()->user()->zip}}">
                           </div>
                       </div>
                       <p class="b-form-group__error-text js_elem_error js_elem_error_payment_form_billing_address_city js_elem_error_payment_form_billing_address_zip_code"></p>
                   </div>
               </div>              
           </div>
       </div>
   </div>
</div>

<div class="order-pay__credit-card">
   <div class="order-pay__credit-card-heading">
    <h2 class="order-pay__title">Accepted payments</h2>
    <div class="order-pay__heading-img">
     <img src="{{asset('images/secure-icon.png')}}" srcset="{{asset('bundles/paygateway/images/pay_form/payment_protect/secure-icon@2x.png 2x')}}" title="This payment form is secured by PayPal. Your data is encrypted and and can't be accessed by third-parties.">
 </div>
</div>
<div class="order-pay__body">
    <div class="order-pay__paycore-wrap">
     <img src="{{asset('images/paypal tray.png')}}">
 </div>                

 <div class="order-pay__deposit">
     <span class="order-pay__deposit-label">
      Order Amount:                      
  </span>
  <span class="order-pay__deposit-price">
      ${{$order->order_price}}
  </span>
</div>
<div class="order-pay__deposit">
 <span class="order-pay__deposit-label">
  Account Balance:                      
</span>
<span class="order-pay__deposit-price">
  ${{auth()->user()->account_bal}}
</span>
</div>
<div class="order-pay__deposit">
 <span class="order-pay__deposit-label">
  Amount to Pay:                      
</span>
<span class="order-pay__deposit-price">
  ${{number_format($order->order_price - auth()->user()->account_bal,2)}}
</span>
</div>


<input type="hidden" name="option_pay" id="option_pay" value="paypal">
<div class="order-pay__proceed-btn">

   <!--  <button type="submit" name="proceedToPay" class="btn btn_pay js_submit_butt">
      Proceed to payment
  </button> -->

  <span class="spinner js_submit_loading" style="display:none;"></span>
</div>

<div id="paypal-button-container"></div>

</div>
</div>
</div>

</div>

</form>

<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="paymentModal">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="uk-modal-header">
       Select your preferred payment option:                         
       <a aria-label="Close" data-dismiss="modal" class="uk-modal-close sm-round"></a>
   </div>
   <div class="modal-body">
       <div class="uk-clearfix"></div>
       <div class="form-group">
        <!-- <input type="radio" value="true"  name="payment_option" id="dpo_payment" checked=""><label for="dpo_payment">&nbsp;DPO (Credit/Debit Card, PayPal)</label><br> -->
        @if(count(auth()->user()->orders) > 1 || auth()->user()->id == 161)
        @else
        <input type="radio" value="false" name="payment_option" id="paypal_payment"><label for="paypal_payment">&nbsp;PayPal (Credit/Debit Card)</label><br>
        @endif
        <input type="radio" value="false" name="payment_option" id="ipay_payment" checked=""><label for="ipay_payment">&nbsp;Credit/Debit Card</label><br>
        <div class="uk-clearfix"></div>
    </div>
    <p class="submit-note" style="direction: ltr;">
        By clicking "Proceed" button you agree to the        
        <a href="{{config('global.site_url')}}/terms-and-conditions/" target="_blank">Terms and Conditions</a> and <a href="{{config('global.site_url')}}/privacy-policy-2/" target="_blank">Privacy Policy</a>.
    </p>
    <input type="hidden" name="topup_token" value="3D4sds987DNnjg76gGG5fdHj874487DFe76hjNgY6FF6Klpo9I">
    <div class="uk-text-right">
        <button class="btn btn-danger" data-dismiss="modal">Cancel</button> 
        <button class="btn btn-info" onclick="">Proceed</button>

    </div>
</div>
</div>
</div>
</div>
<!--  -->
</div>
</div>
</div>
@if(count(auth()->user()->orders) > 1)
<script type="text/javascript">
   $(document).ready(function(){
    $('#option_pay').val("ipay");
});
</script>
@else
<script type="text/javascript">
   $(document).ready(function(){
    $('#option_pay').val("paypal");
});
</script>
@endif

<script type="text/javascript">
   $(document).ready(function(){
    var countryCode = "{{auth()->user()->country}}";
    $(".countryCode").val(countryCode);
    var Country = "{{auth()->user()->country}}";
    if(Country == ''){

    }else{
     $("#customer_country").val(Country);
 }

 $("#ipay_payment").click(function(){
     $('#option_pay').val("ipay");
     $('#remitly_instructions').hide();

 })

 $("#paypal_payment").click(function(){
     $('#option_pay').val("paypal");
     $('#remitly_instructions').hide();
 })

 $("#dpo_payment").click(function(){
     $('#option_pay').val("dpo");
     $('#remitly_instructions').hide();
 })

 $("#payment_option_btn").click(function(){
     if($('#dpo_payment').is(':checked')) { 
        $('#proceedToPay').click();

    }else{
        $('#proceedToPay').click();
    }

});
});
</script>
<script src="https://www.paypal.com/sdk/js?client-id=Adl7w3C5oegQRKft3V9ocI-9__dYmVxkFOMBUFcmgVInliiFjRjXYUXEIomg5F63F_aCo5AClX7Zybiz&currency=USD&disable-funding=credit">
</script>
<style type="text/css">
.paypal-button-number-0 {
    display: none!important;
}
.paypal-button.paypal-button-color-blue, .paypal-button-row.paypal-button-color-blue .menu-button{
    display:none!important;
}
</style>
<script>
    var customer_name = $("#customer_name").val();
    var customer_phone = $("#customer_phone").val();
    var customer_email = $("#customer_email").val();
    var customer_country = $("#customer_country").val();
    var customer_state = $("#customer_state").val();
    var customer_city = $("#customer_city").val();
    var customer_zip_code = $("#customer_zip_code").val();

    var the_order_code='{{$order->order_code}}';
    var the_order_id='{{encrypt($order->id)}}';
    var the_url = "{{url('paypal/checkout')}}";
    var the_return_url = "{{url('customer/view-order/'.$order->order_code)}}";
    var PAYPAL_CLIENT = 'Adl7w3C5oegQRKft3V9ocI-9__dYmVxkFOMBUFcmgVInliiFjRjXYUXEIomg5F63F_aCo5AClX7Zybiz';
    var PAYPAL_SECRET = 'EKpVcn3eDGF7PX-j_AcrSoCTuh1hF6Vt2c2vamrxP62GHGMo0r8DgYX3j87tV7lp7VhkeP3eljLzOwIr';
    // var PAYPAL_ORDER_API = 'https://api-m.sandbox.paypal.com/v2/checkout/orders/';
    var PAYPAL_ORDER_API = 'https://api.paypal.com/v2/checkout/orders/';
    paypal.Buttons({
        style: {
            color:  'blue',
            size: 'small',
            label:  'pay',
            height: 40,
            width:40
        },
        funding: {
            //disallowed: [ paypal.FUNDING.CREDIT ]
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value:  '{{number_format($order->order_price, 2)}}',
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                return fetch(the_url +'/'+the_order_id, {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID,
                        order_code: the_order_code,
                        customer_name: customer_name,
                        customer_phone: customer_phone,
                        customer_email: customer_email,
                        customer_country: customer_country,
                        customer_state: customer_state,
                        customer_city: customer_city,
                        customer_zip_code: customer_zip_code,
                        _token: "{{ csrf_token() }}"
                    })
                }).then(function(res) {
                    location.reload();
                });
                //location.reload(); 
                // Simulate an HTTP redirect:
                // console.log(the_return_url);
                // window.location.replace(the_return_url);
                // window.location.href = the_return_url;
            });
        }
    }).render('#paypal-button-container');
</script>
@endsection