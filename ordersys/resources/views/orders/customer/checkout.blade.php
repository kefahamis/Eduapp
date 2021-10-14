@extends('layouts.customer')

@section('content')
<div class="container">
	<div class="row justify-content inner-content_bg_gray">
		<!-- ?? -->

		<div class="order-view-v2__container">
			<div>
				<a href="{{url(url_prefix().'/orders')}}" class="js_button_order js_button_order btn"><span><<</span> Back</a>
			</div>
			<div class="order-view-v2__header">
				<h1 class="order-view-v2__title">
					Order ID: {{$order->order_code}}
				</h1>
				@include('layouts.flash')
				<div class="order-view-v2__header-button">
					<button class="btn btn_chat writer-n_orders-table-v2__user-info-cell js_order_start_chat" type="button">
						<small class="btn__chat-num js_new_messages_count" style="display:none;"></small>
						<span class="js_order_start_chat_btn_text">Start chat</span>
					</button>
					<a href="{{url('ordernow')}}" class="js_button_order js_button_order btn btn_customer-n_orders-heading btn_primary-accent js_crm_order_list_button_click js_button_order_ga">Place new order</a>
				</div>
			</div>

			<!--  -->
			<div class="order-view-v2__body js_order_view_guide_wrapper">
				<div class="order-view-v2__card">


				</div>
			</div>

		</div>
	</div>
</div>
@endsection