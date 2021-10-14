@extends('layouts.main_2')

@section('content')
<div class="container">
	<div class="row justify-content inner-content_bg_gray">
		<!-- ?? -->

		<div class="order-view-v2__container">
			<div>
				<a href="{{url(url_prefix().'/orders')}}" class="js_button_order js_button_order btn"><span><<</span> Back</a>
			</div>
			<div class="order-view-v2__header">
				<h1 class="order-view-v2__title" style="font-size: 24px;">
					Add funds to your wallet:
				</h1>
				@include('layouts.flash')
				<div class="order-view-v2__header-button">
					<button class="btn btn_chat writer-n_orders-table-v2__user-info-cell js_order_start_chat" type="button" onclick="javascript:void(Tawk_API.toggle())">
						<small class="btn__chat-num js_new_messages_count" style="display:none;"></small>
						<span class="js_order_start_chat_btn_text">Start chat</span>
					</button>
					
				</div>
			</div>

			<!--  -->
			<div class="order-view-v2__body js_order_view_guide_wrapper">
				<div class="order-view-v2__card">

					<div class="order-pay__content">

						<div class="order-pay__billing">
							<h1 class="order-view-v2__title" style="font-size: 24px;">
								Current Balance: USD {{$user->account_bal}}
							</h1>
							<hr>
							<h1 class="order-view-v2__title" style="font-size: 24px;">
								Amount to load: USD {{number_format($load_amt,2)}}
							</h1>
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
									
								</div>

								<input type="hidden" name="option_pay" id="option_pay" value="paypal">
								<div class="order-pay__proceed-btn">
									@if(count(auth()->user()->orders) > 1)
									<button type="button" class="btn btn_pay js_submit_butt" data-toggle="modal" data-target="#paymentModal">
										Proceed to payment
									</button>
									<button type="submit" style="display: none;" name="proceedToPay" class="btn btn_pay js_submit_butt">
									</button>
									@else
									<button type="submit" name="proceedToPay" class="btn btn_pay js_submit_butt">
										Proceed to payment
									</button>
									@endif
									<span class="spinner js_submit_loading" style="display:none;"></span>
								</div>

							</div>
						</div>
					</div>




				</div>
			</div>

		</div>
	</div>
</div>

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
					<input type="radio" value="false" name="payment_option" id="paypal_payment"><label for="paypal_payment">&nbsp;PayPal (Credit/Debit Card)</label><br>
					<!-- <input type="radio" value="false" name="payment_option" id="ipay_payment"><label for="ipay_payment">&nbsp;Credit/Debit Card</label><br>
                 -->
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

<script type="text/javascript">
	$(document).ready(function(){
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
@endsection