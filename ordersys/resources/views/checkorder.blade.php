@extends('layouts.main')

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
				<li class="progress-banner__list-item is-active">
					<span>Check order</span>
				</li>
				<li class="progress-banner__list-item">
					<span>Add funds to my balance</span>
				</li>
			</ul>
		</div>

		<div class="order-form-v2__row">
		</div>
	</div>
</div>
<div class="order-bidding-v2__row js_bidding_process_container">
	<!--  -->
	<!--  -->
	<form id="check_order_payment_form" action="step_3" class="js_po_form" method="post">
		
		<div class="order-pay-v3__heading">
			<h1 class="order-pay-v3__title js_po_page_title">Check your order and add funds to your balance</h1>
		</div>


		<div class="order-pay-v3__card">
			<div class="order-pay-v3__h-limiter js-h-limiter-container is-opened">
				<div class="order-pay-v3__card-row">
					<div class="order-pay-v3__info-wrap">
						<div class="order-pay-v3__info order-pay-v3__info_heading">
							<div class="essay-info essay-info">
								<h3 class="essay-info__title">Topic</h3>
								<p class="essay-info__description essay-info__description_fw_500">{{$order->topic }}</p>
							</div>
							@if($order->writer_pick == 'client')
							<a class="order-pay-v3__link order-pay-v3__link_edit mobile-hidden" href="{{url('/order-bidding/'.$order->order_code)}}" data-atest="atest_order_pay_elem_edit_link">
							Back to Bidding </a>
							@endif
						</div>

						<div class="order-pay-v3__info order-pay-v3__info_mob-ord_4">
							<div class="essay-info">
								<h3 class="essay-info__title">Subject</h3>
								<p class="essay-info__description essay-info__description_fw_500">{{$order->subject }}</p>
							</div>
						</div>

						<div class="order-pay-v3__info">
							<div class="essay-info">
								<h3 class="essay-info__title">Pages</h3>
								<p class="essay-info__description essay-info__description_fw_500" style="direction: ltr;">
									@php
									$words = $order->pages*275;
									@endphp
									{{$order->pages }} pages/
									<span id="order_words_sum">
										~{{$words}}	words 
									</span>
								</p>
							</div>
						</div>

						<div class="order-pay-v3__info">
							<div class="essay-info">
								<h3 class="essay-info__title">Deadline</h3>
								<p class="essay-info__description essay-info__description_fw_500">
									{{$order->deadline }}
								</p>
							</div>
						</div>

						@if($order->writer_pick == 'system')
						<div class="order-pay-v3__info order-pay-v3__info_mob-ord_5">
							<div class="writer-preview writer-preview_v2 writer-preview_best">
								<div class="writer-preview__img writer-preview__img_easy-bidding">
									<img src="{{asset('images/default.png')}}">
								</div>
								<div class="writer-preview__info">
									<h4 class="writer-preview__name writer-preview__name_best">
									Best Writer                                </h4>
									<div class="info-tooltip info-tooltip_ml_3 info-tooltip_order-pay info-tooltip_mob-w_250 dropdown-block-wrapper">
										<div data-uk-dropdown="{pos:'right'}" class="info-under-place js_cta_pay_tooltip" aria-haspopup="true" aria-expanded="true">
											<div class="uk-dropdown">
												<p>Once you add funds to your balance, our system will determine the most suitable writer for you within 5 minutes, among more than 200 experts.</p>
											</div>
										</div>
									</div>
									<p class="writer-preview__description">
										Our system will determine the best writer for you within 5 min.                                
									</p>
								</div>
							</div>
						</div>
						@else
						<div class="order-pay-v3__info order-pay-v3__info_mob-ord_5">
							<div class="writer-preview writer-preview_v2 writer-preview_best">
								<div class="writer-preview__img writer-preview__img_easy-bidding">
									<img src="{{asset('images/default.png')}}">
								</div>
								<div class="writer-preview__info">
									<h4 class="writer-preview__name writer-preview__name_best">
										{{getAssignedWriter($order->assigned_to)['name'] }}                             
									</h4>

									<p class="writer-preview__description">
										{{getAssignedWriter($order->assigned_to)['finished_papers'] }}  completed works </p>
									</div>
								</div>
							</div>
							@endif

						</div>
					</div>
					<button type="button" class="order-pay-v3__h-limiter-btn js-h-limiter-btn is-active"></button>
				</div>
			</div>
			<div class="order-pay-v3__grid">
				<div class="order-pay-v3__additional">

					<div class="order-pay-v3__card">
						<button type="button" class="order-pay-v3__accordion-btn js-op-accordion" id="expand_additional_services">
							<span class="order-pay-v3__card-title">
								Additional Services            
							</span>
						</button>
						<div class="order-pay-v3__accordion-body js-op-accordion-body" id="additional_services_div">
							<div class="order-pay-v3__card-row">
								<div class="order-pay-v3__add-services">


									<div class="order-pay-v3__add-service">
										<div class="additional-service-v2">
											<div class="additional-service-v2__info">
												<div class="additional-service-v2__checkbox">
													<label class="b-checkbox b-checkbox_v2 b-checkbox_fw_500" for="progressive_delivery" >
														<input type="checkbox" id="progressive_delivery" name="progressive_delivery" data-vas-tag="PROGRESSIVE_DELIVERY" data-vas-description="You will receive half-done paper long before the deadline." autocomplete="off" class="js_po_pay_form_vas b-checkbox__control" onchange="addProgressiveDelivery();" {{ $order->progressive_delivery === "Yes" ? "checked" : "" }}>
														<span class="b-checkbox__box"></span><span class="b-checkbox__text">Progressive delivery</span>
													</label>
													<span class="additional-service-v2__amount">
														$8.99
													</span>
												</div>
											</div>
											<p class="additional-service-v2__descr" style="direction: ltr;">
												You will receive half-done paper long before the deadline.
											</p>
										</div>
									</div>

									<div class="order-pay-v3__add-service">
										<div class="additional-service-v2">
											<div class="additional-service-v2__info">
												<div class="additional-service-v2__checkbox">
													<label class="b-checkbox b-checkbox_v2 b-checkbox_fw_500" for="vip_support">
														<input type="checkbox" id="vip_support" name="vip_support" data-js-vas-selector="1" data-vas-id="5" data-vas-tag="VIP_SUPPORT" data-vas-description="You can always follow up with your order by Contacting your Personal Manager 24/7." data-vas-price-with-discount="12.99" data-vas-price-no-discount="12.99" data-vas-price-only-discount="0" autocomplete="off" class="js_po_pay_form_vas b-checkbox__control" onchange="addVipSupport();" {{ $order->vip_support === "Yes" ? "checked" : "" }}>
														<span class="b-checkbox__box"></span><span class="b-checkbox__text">VIP support</span>
													</label>
													<span class="additional-service-v2__amount">
														$12.99
													</span>
												</div>
											</div>
											<p class="additional-service-v2__descr" style="direction: ltr;">
												You can always follow up with your order by Contacting your Personal Manager 24/7.
											</p>
										</div>
									</div>

									<div class="order-pay-v3__add-service">
										<div class="additional-service-v2">
											<div class="additional-service-v2__info">
												<div class="additional-service-v2__checkbox">
													<label class="b-checkbox b-checkbox_v2 b-checkbox_fw_500" for="page_abstract">
														<input type="checkbox" id="page_abstract" name="page_abstract" data-js-vas-selector="1" data-vas-id="4" data-vas-tag="ONE_PAGE_ABSTRACT" data-vas-description="An abstract highlights the key points indicated in the paper." data-vas-price-with-discount="13.9" data-vas-price-no-discount="13.9" data-vas-price-only-discount="0" autocomplete="off" class="js_po_pay_form_vas b-checkbox__control" onchange="addPageAbstract();" {{ $order->page_abstract === "Yes" ? "checked" : "" }}>
														<span class="b-checkbox__box"></span><span class="b-checkbox__text">1-page abstract</span>
													</label>
													<span class="additional-service-v2__amount">
														$13.90
													</span>
												</div>
											</div>
											<p class="additional-service-v2__descr" style="direction: ltr;">
												An abstract highlights the key points indicated in the paper.
											</p>
										</div>
									</div>

									<div class="order-pay-v3__add-service">
										<div class="additional-service-v2">
											<div class="additional-service-v2__info">
												<div class="additional-service-v2__checkbox">
													<label class="b-checkbox b-checkbox_v2 b-checkbox_fw_500" for="essay_outline">
														<input type="checkbox" id="essay_outline" name="essay_outline" data-js-vas-selector="1" data-vas-id="14" data-vas-tag="ESSAY_OUTLINE" data-vas-description="The general plan of the main ideas of the paper." data-vas-price-with-discount="12" data-vas-price-no-discount="12" data-vas-price-only-discount="0" autocomplete="off" class="js_po_pay_form_vas b-checkbox__control" onchange="essayOutline();" {{ $order->essay_outline === "Yes" ? "checked" : "" }}>
														<span class="b-checkbox__box"></span><span class="b-checkbox__text">Essay outline</span>
													</label>
													<span class="additional-service-v2__amount">
														$12.00
													</span>
												</div>
											</div>
											<p class="additional-service-v2__descr" style="direction: ltr;">
												The general plan of the main ideas of the paper.
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="order-pay-v3__advantages mobile-hidden tablet-hidden">
						<div class="b-tiles b-tiles_v2">
							<div class="b-tiles__item">
								<div class="b-advantage b-advantage_v2">
									<div class="b-advantage__img b-advantage__img_ico-1"></div>
									<div class="b-advantage__info" style="direction: ltr;">
										<h3 class="b-advantage__title">100% refund guarantee</h3>
										<p class="b-advantage__text">We will refund you the whole amount if you are not happy.</p>
									</div>
								</div>
							</div>
							<div class="b-tiles__item">
								<div class="b-advantage b-advantage_v2">
									<div class="b-advantage__img b-advantage__img_ico-2"></div>
									<div class="b-advantage__info">
										<h3 class="b-advantage__title">Privacy is #1</h3>
										<p class="b-advantage__text">Your email or name will not appear on the website.</p>
									</div>
								</div>
							</div>
							<div class="b-tiles__item">
								<div class="b-advantage b-advantage_v2">
									<div class="b-advantage__img b-advantage__img_ico-3"></div>
									<div class="b-advantage__info">
										<h3 class="b-advantage__title">Strict level of security</h3>
										<p class="b-advantage__text" style="direction: ltr;">We use 128-bit SSL protection and high levels of security.</p>
									</div>
								</div>
							</div>
						</div>
					</div>                    
				</div>



				<div class="order-pay-v3__total-card">
					<div class="order-pay-v3__card">
						<div class="order-pay-v3__card-row order-pay-v3__card-row_bordered">
							<h2 class="order-pay-v3__card-title">
							Order Summary </h2>
						</div>

						<div class="order-pay-v3__card-row order-pay-v3__card-row_bordered">
							<div class="order-pay-v3__total-price">
								<div class="order-pay-v3__total-price-wrapper">
									<span>Total price</span>
									<div class="info-tooltip info-tooltip_ml_3 info-tooltip_mob-w_250 dropdown-block-wrapper" style="direction: ltr;">
										<div data-uk-dropdown="{pos:'right'}" class="info-under-place js_cta_pay_total_price" aria-haspopup="true" aria-expanded="true">
											<div class="uk-dropdown">
												<h4>Price Calculation:</h4>

												<div class="price-row" style="direction: ltr;">


													<strong>$ {{$order->order_price }}</strong>
													<span>{{$order->order_price }}</span>
												</div>

												<div class="price-row">
													<div class="discount-info">
														<div>
															<span>-$2.80</span>
															(Discount)
														</div>
													</div>
												</div>

												<span class="js_po_ordered_vases_list">

													<span class="js_po_pr_template_one_price_row js_po_vas_list_1">
														<div class="price-row">
															<strong class="js_po_pr_original_price">$9.99</strong>
															<span class="js_po_pr_service_name">(Choose best writer automatically)</span>
															<div class="discount-info js_po_pr_discount_info"></div>
														</div>
													</span></span>
												</div>
											</div>
										</div>
									</div>

									<div class="order-pay-v3__total-price-num">
										<span class="js_po_price_total_with_discount" id="js_po_price_total_with_discount">${{$order->order_price}}</span>
										<input type="hidden" name="order_code_f" id="order_code_f" value="{{$order->order_code }}">
										<del class="js_po_price_total_no_discount" id="js_po_price_total_no_discount" style="">${{$order->order_price + 7 }}</del>
									</div>
								</div>
								<div class="order-pay-v2__promo-code op-promo-code">
									<button class="op-promo-code__button js_po_promo_code_open_container" type="button">
									Add promo code</button>
									<div class="op-promo-code__content js_po_promo_code_field_container" style="display:none;">
										<div class="op-promo-code__field .js_po_promo_code_el">
											<input type="text" id="payment_system_type_promo_code_po_enter_promo_code" name="payment_system_type[promo_code_po][enter_promo_code]" data-js-promo-code-message="Discount code incorrect" data-js-promo-code-is-valid="0" class="js_po_promo_code_field">
											<i></i>
											<button class="js_po_promo_code_button op-promo-code__submit">Apply</button>
										</div>
										<span class="js_po_promo_code_message op-promo-code__message"></span>
									</div>
								</div>

							</div>

							<div class="order-pay-v3__card-row order-pay-v3__card-row_bordered order-pay-v3__card-row_bgc_grey js_po_payment_method" style="1">
								<div class="order-pay-v3__deposit-amount">
									<span>Add funds to balance</span>
									<strong class="js_po_price_need_to_pay" id="js_po_price_need_to_pay" data-atest="atest_order_pay_elem_deposit_amount">$ {{$order->order_price - auth()->user()->account_bal}}</strong>
								</div>
							</div>

							<div class="order-pay-v3__card-row order-pay-v3__card-row_bordered">
								<p class="order-pay-v3__payment-label" style="direction: ltr;">
								The funds will be held in your account until you release them.</p>


								<div class="js-payment-btns">
									<div class="js_po_payment_method js_po_payment_buttons" style="">
										<div class="order-pay-v3__payment-buttons">
											<a href="{{url(url_prefix().'/billing/'.$order->order_code)}}">
												<label class="btn btn_primary-accent btn_payment btn_payment-credit-card js_auto_generated_customer_disable_click" for="payment_system_type_payment_system_0">

													<span>Proceed to checkout</span>
												</label>
											</a>

											<ul class="payment-v2">
												<li class="payment-v2__item payment-v2__item_visa" role="img" aria-label="We accept Visa">	
												</li>
												<li class="payment-v2__item payment-v2__item_mc" role="img" aria-label="We accept Mastercard">
												</li>
											</ul>

										</div>
									</div>

								</div>
								<div class="order-pay-v3__terms">
									<p class="order-pay-v3__terms-text">
										By proceeding to checkout you accept our <a href="/terms" target="_blank">Terms and Conditions</a>
									</p>
								</div>        </div>

								<div class="order-pay-v3__card-row order-pay-v3__card-row_bordered desktop-hidden tablet-hidden">

									<div class="order-pay-v3__link-container">
										<a class="order-pay-v3__link order-pay-v3__link_edit" href="{{url('ordernow/'.$order->order_code)}}" data-atest="atest_order_pay_elem_edit_link">
										Edit Order </a>
									</div>

								</div>
							</div>
						</div>

					</div>


				</form>
		<!-- 	</div>
		</div>
	-->

	<!--  -->
	<!--  -->

</div>
<script type="text/javascript">
	var prgDlry_url = '{{ route("prgDlry", ":oid") }}';
	var order_code = "{{$order->order_code}}";
	prgDlry_url = prgDlry_url.replace(':oid', order_code);

	function addProgressiveDelivery(){
		$.ajax({
			type: "POST",
			url: prgDlry_url,
			data: {
				"feature":'progressive_delivery',
				"order_code":order_code
			},
			headers: {
				'X-CSRF-TOKEN': '{{csrf_token()}}'
			},
			success: function (ready) {
				var obj = ready;
				var new_offer = parseInt(obj.new_price) + 7;
				var new_price = parseInt(obj.new_price);
				var account_bal = parseInt("{{auth()->user()->account_bal}}");
				var topup = new_price - account_bal;

				$("#js_po_price_total_with_discount").html("$"+obj.new_price);
				$("#js_po_price_total_no_discount").html("$"+new_offer);
				$("#js_po_price_need_to_pay").html("$"+topup);
			},
			error: function (e) {
				console.log("ERROR : ", e);
			}
		});
	}

	function addVipSupport(){
		$.ajax({
			type: "POST",
			url: prgDlry_url,
			data: {
				"feature":'vip_support',
				"order_code":order_code
			},
			headers: {
				'X-CSRF-TOKEN': '{{csrf_token()}}'
			},
			success: function (ready) {
				var obj = ready;
				var new_offer = parseInt(obj.new_price) + 7;
				var new_price = parseInt(obj.new_price);
				var account_bal = parseInt("{{auth()->user()->account_bal}}");
				var topup = new_price - account_bal;

				$("#js_po_price_total_with_discount").html("$"+obj.new_price);
				$("#js_po_price_total_no_discount").html("$"+new_offer);
				$("#js_po_price_need_to_pay").html("$"+topup);
			},
			error: function (e) {
				console.log("ERROR : ", e);
			}
		});
	}

	function addPageAbstract(){
		$.ajax({
			type: "POST",
			url: prgDlry_url,
			data: {
				"feature":'page_abstract',
				"order_code":order_code
			},
			headers: {
				'X-CSRF-TOKEN': '{{csrf_token()}}'
			},
			success: function (ready) {
				var obj = ready;
				var new_offer = parseInt(obj.new_price) + 7;
				var new_price = parseInt(obj.new_price);
				var account_bal = parseInt("{{auth()->user()->account_bal}}");
				var topup = new_price - account_bal;

				$("#js_po_price_total_with_discount").html("$"+obj.new_price);
				$("#js_po_price_total_no_discount").html("$"+new_offer);
				$("#js_po_price_need_to_pay").html("$"+topup);
			},
			error: function (e) {
				console.log("ERROR : ", e);
			}
		});
	}
	function essayOutline(){
		$.ajax({
			type: "POST",
			url: prgDlry_url,
			data: {
				"feature":'essay_outline',
				"order_code":order_code
			},
			headers: {
				'X-CSRF-TOKEN': '{{csrf_token()}}'
			},
			success: function (ready) {
				var obj = ready;
				var new_offer = parseInt(obj.new_price) + 7;
				var new_price = parseInt(obj.new_price);
				var account_bal = parseInt("{{auth()->user()->account_bal}}");
				var topup = new_price - account_bal;

				$("#js_po_price_total_with_discount").html("$"+obj.new_price);
				$("#js_po_price_total_no_discount").html("$"+new_offer);
				$("#js_po_price_need_to_pay").html("$"+topup);
			},
			error: function (e) {
				console.log("ERROR : ", e);
			}
		});
	}

	$("#expand_additional_services").click(function(){
		if($("#additional_services_div").show('visible')){
			$("#additional_services_div").hide();
		}else{
			$("#additional_services_div").show();
		}
	});
</script>
@endsection