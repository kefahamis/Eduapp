@extends('layouts.main')

@section('content')
<div class="container">
	<div class="row justify-content">
		
		<div class="progress-banner ">
			<ul class="progress-banner__list">
				<li class="progress-banner__list-item is-passed">
					<span>Place order</span>
				</li>
				<li class="progress-banner__list-item is-active" >
					<span>Select a writer</span>
				</li>
				<li class="progress-banner__list-item ">
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
	<div class="order-bidding-v2__heading">

		<h1 class="order-bidding-v2__title">Find the best writer for your paper below.
			<span class="order-bidding-v2__title-tooltip">
				<div class="info-tooltip info-tooltip_right dropdown-block-wrapper">
					<div data-uk-dropdown="{pos:'right',mode:'click'}" class="info-under-place js_info-under-place" aria-haspopup="true" aria-expanded="true">
						<div class="uk-dropdown" style="display:block;">
							<p>1. Click <strong>“Accept”</strong> to select writer now. </p>
							<p>2. Add funds to balance, pay writer at completion.</p>
							<p>3. Receive paper, approve, release payment to writer.</p>
						</div>
					</div>
				</div>
			</span>
		</h1>

		<div class="order-bidding-v2__edit-link-wrap js_bidding_head_content" style="">
			<a href="{{url('ordernow/'.$order->order_code)}}" class="order-bidding-v2__edit-link order-bidding-v2__edit-link_desktop">
				Edit order
			</a>

		</div>
	</div>

	<div class="js_bidding_head_info_content" style="">
		<div class="order-bidding-v2__info">
			<div class="essay-info essay-info_bidding">
				<p class="essay-info__title">Your paper:</p>
				<h3 class="essay-info__topic">{{$order->topic}}</h3>
				<p class="essay-info__type">{{$order->subject}}</p>
			</div>
		</div>

	</div>


	<div class="errorText">
	</div>


	<div class="order-bidding-v2__container js_bidding_recommended_container" style="">
		<h2 class="order-bidding-v2__s-title order-bidding-v2__s-title_accent">View the writers who best meet your project requirements.</h2>
		<div class="order-bidding-v2__tiles js_bidding_recommended_area">

			@foreach($writers as $writer)
			<!--  -->
			<div class="order-bidding-v2__tiles-item js_user_card" id="js_user_card_{{$writer->writer_code}}">
				<div class="writer-card writer-card_popular" data-hint="">
					<i class="writer-card__close-ico js_bid_block_cta_event_bid_decline" title="Not interested" data-popup-click="" data-atest="atest_order_bid_elem_reject_btn" onclick="dismissWriter('{{$writer->writer_code}}');"></i>
					<div class="writer-card__top">
						<div class="writer-card__writer-preview">
							<div class="writer-preview writer-preview_bidding writer-preview_popular">
								<div class="writer-preview__img-wrap">
									<a href="#" target="_blank" class="writer-preview__img js_bid_block_cta_event_writer_follow">
										<img alt="Img" src="{{asset('images/Writers/'.$writer->user->profile_picture)}}"></a>
										<a href="{{url('writer/public/'.$writer->writer_code)}}" target="_blank" class="writer-preview__profile-link js_bid_block_cta_event_writer_follow" title="View writer’s profile">
											View profile
										</a>
									</div>
									<div class="writer-preview__info">
										<h4 class="writer-preview__name" title="{{$writer->user->name}}"><a href="#" target="_blank" data-writer_extra_fee="3" class="js_bid_block_cta_event_writer_follow"> {{$writer->user->name}}</a></h4>
										<p class="writer-preview__completed" title="# of successful papers"><strong>{{$writer->finished_papers}}</strong> finished papers </p>
										<div class="writer-preview__rate" title="Success rate takes into account student reviews, student retention, paper quality and timely delivery.">
											<div class="writer-preview__rate-percent">{{$writer->rating}}%</div>
											<div class="b-star-rate-inner b-star-rate-inner_size_s ">
												<div class="b-star-rate-inner__stars" style="width:88%"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="writer-card__price " title="Writer’s bid">
								<span class="writer-card__price-sale">{{$order->order_price}} </span>$&nbsp;{{$order->order_price}} 
							</div>
						</div>
						<div class="writer-card__bottom">

							<a class="writer-card__button btn btn_chat writer_chat_btn" title="Discuss details with this writer." onclick="javascript:void(Tawk_API.toggle())"> Chat  <span class="btn-chat-loader"><span class="btn-chat-loader__dot"></span><span class="btn-chat-loader__dot"></span><span class="btn-chat-loader__dot"></span></span>
								<span id="<?php ?>" style="background-color: #e31919;" class="badge badge-danger"></span></a>

								<button class="writer-card__button btn btn_accept-bid js_bid_block_cta_event_bid_approve_recommended_block" title="Select this writer" onclick="acceptWriterMod('{{$writer->writer_code}}','{{$order->order_code}}');">
									<span>Accept</span>
								</button>

							</div>
						</div>
					</div>
					<!--  -->
					@endforeach

					
				</div>
				<p id="select_err" style="color: red;"></p>
			</div>

			<input type="hidden" name="init_chat_order_code" id="init_chat_order_code" value="<?php ?>">
			<div class="order-bidding-v2__container js_bidding_results" style="">
				<h2 class="order-bidding-v2__s-title">Writers currently being bidded on.</h2>
				<div class="order-bidding-v2__tiles js_bidding_general_area js_bids_area">
					<div class="order-bidding-v2__tiles-item js_bids_area_loader">
						<div class="writer-card writer-card_placeholder"></div>
					</div>
				</div>

			</div>
		</div>

		@endsection
		<script>
			function dismissWriter(writer_code) {
				//alert('#js_user_card_'+writer_code);
				$('#js_user_card_'+writer_code).hide();
			}

			function acceptWriterMod(writer_code,order_code){

				var WRdata = new FormData();
				WRdata.append("writer_code", writer_code);
				WRdata.append("order_code", order_code);
				$(".btn_accept-bid").prop("disabled", true);
				$("#select_err").text('');

				$.ajax({
					type: "POST",
					enctype: 'multipart/form-data',
					url: "{{url('/ordernow/accept-writer')}}",
					data: WRdata,
					processData: false,
					contentType: false,
					cache: false,
					timeout: 600000,
					headers: {
						'X-CSRF-TOKEN': '{{csrf_token()}}'
					},
					success: function (response) {
						var chkurl = '{{ route("checkOrder", ":oid") }}';
						
						if(response.status == '343UuutdIk'){
							chkurl = chkurl.replace(':oid', response.oid);
							$(location).attr('href',chkurl);
						}
						else{
							$("#select_err").text('An error occurred! Writer not selected.');
							return;
						}

					},
					error: function (e) {
						console.log("ERROR : ", e);
					}
				});
			}
		</script>