@extends('layouts.writer')

@section('content')
<div class="container">
	<div class="row justify-content inner-content_bg_gray">

		<div class="row" style="min-height: 800px; padding-top: 25px;">
			<div class="writer-n_orders-table-v2__tabs-content">

				<div class="writer-n_orders-table-v2__tab-content-row">
					<div class="writer-n_orders-table-v2__filters">

					</div>
				</div>
			</div>

			<div class="writer-n_orders-table-v2__tab-content-row">
				<div class="order-view-v2__header-button">
					<h3>Search results</h3>
					
				</div>
				<div class="writer-n_orders-table-v2__table-heading">
					<div class="writer-n_orders-table-v2__colspan writer-n_orders-table-v2__colspan_left writer-n_orders-table-v2__colspan_pv_0">
						<span class="writer-n_orders-table-v2__cell">Topic, Order ID, Customer ID</span>
						<span class="writer-n_orders-table-v2__cell">Paper details</span>

					</div>

					<div class="writer-n_orders-table-v2__colspan writer-n_orders-table-v2__colspan_right writer-n_orders-table-v2__colspan_pv_0">
						<span class="writer-n_orders-table-v2__cell">Academic Level,Status,writer</span>
						<span class="writer-n_orders-table-v2__cell">Due date</span>
						<span class="writer-n_orders-table-v2__cell">Pages</span>

						<span class="writer-n_orders-table-v2__cell" style="width: 20%!important;">Price</span>
						<span class="writer-n_orders-table-v2__cell" style="width: 18%!important;">Actions</span>
					</div>

				</div>
				@if(count($results) > 0)
				@foreach($results as $order)
				<!--  -->
				<div class="js_content">
					<div class="writer-n_orders-table-v2__row">
						<a class="writer-n_orders-table-v2__colspan writer-n_orders-table-v2__colspan_left writer-n_orders-table-v2__colspan_link" href="{{url(url_prefix().'/order/'.$order->order_code)}}">
							<span class="writer-n_orders-table-v2__cell">
								<span class="writer-n_orders-table-v2__order-title">
									{{$order->topic}} 
								</span>
								<span class="writer-n_orders-table-v2__order-id">
									Order ID: {{$order->order_code}} 
								</span>
								<object class="writer-n_orders-table-v2__user-info">
									<div class="writer-n_orders-table-v2__user-info-col">
										<div class="user-status">
											<a class="user-status__name" href="#">
												{{$order->customer->name}} 
											</a>
											<span class="user-status__label" data-js-track-online=313162 data-js-is-online=0></span>
										</div>
									</div>
									<div class="writer-n_orders-table-v2__user-info-col">
										<a class="btn btn_chat writer-n_orders-table-v2__user-info-cell js_order_start_chat" href="#" onclick="">
											<small class="btn__chat-num js_new_messages_count" style="display:none;"></small>
											<span class="js_order_start_chat_btn_text">Start chat</span>
										</a>

									</div>
								</object>
								<span class="writer-n_orders-table-v2__user-info writer-n_orders-table-v2__user-info_ai_fs">
									<span class="writer-n_orders-table-v2__user-info-col">
									</span>
									<span class="writer-n_orders-table-v2__user-info-col">
									</span>
								</span>
							</span>
							<span class="writer-n_orders-table-v2__cell mobile-hide">
								<span class="writer-n_orders-table-v2__info">
									{{$order->type_of_paper}} 
								</span>
								<span class="writer-n_orders-table-v2__info">
									{{$order->subject}} 
								</span>

								<span class="writer-n_orders-table-v2__info">
									{{$order->service}} 
								</span>
							</span>
						</a>
						<!--  -->
						<div class="writer-n_orders-table-v2__colspan writer-n_orders-table-v2__colspan_right">
							<div class="writer-n_orders-table-v2__cell mobile-order-3">
								<div class="writer-n_orders-table-v2__info">
									<div class="writer-n_orders-table-v2__mobile-cell-title"><span>Due date</span></div>
									<div class="writer-n_orders-table-v2__due-date "  id="">

										<span> {{$order->academic_level}} </span>
										<br>
										<span class="customer-orders-table__status {{ orderStatus($order->status)['class'] }}">
											{{ orderStatus($order->status)['status'] }}
										</span>
										<br>
										<span> {{getAssignedWriter($order->assigned_to)['name']}}</span>

									</div>

								</div>
							</div>

							<!--  -->
							<div class="writer-n_orders-table-v2__cell mobile-order-3" style="width: ">
								<div class="writer-n_orders-table-v2__info">
									<div class="writer-n_orders-table-v2__mobile-cell-title"><span>Due date</span></div>
									<div class="writer-n_orders-table-v2__due-date "  id="">
										<time>
											<span> ---- left</span>
											<span>
												{{$order->deadline}}
											</span>
										</time>
									</div>

								</div>
							</div>

							<!--  -->
							<div class="writer-n_orders-table-v2__cell mobile-order-2">
								<div class="writer-n_orders-table-v2__mobile-cell-title"><span>Pages</span></div>
								<div class="writer-n_orders-table-v2__info">
									{{$order->pages}}
								</div>
							</div>
							<!--  -->
							<div class="writer-n_orders-table-v2__cell mobile-order-1" style="width: 20%!important;">
								<div class="writer-n_orders-table-v2__mobile-cell-title"><span>Price</span></div>
								<div class="writer-n_orders-table-v2__info">
									<div class="order-table-price js_order_price_info_wrapper order-table-price_tooltip">
										<span class="js_order_price_info">
											{{$order->order_price}}
										</span>
									</div>
									<span class="order-table-price sub-status ">
										Paid: ${{$order->order_price}}
									</span>
								</div>
							</div>
							<div class="writer-n_orders-table-v2__cell mobile-order-0" style="width: 18%!important;">

								<div class="writer-n_orders-table-v2__info">

									<span class="order-table-price sub-status ">

									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--  -->
				@endforeach
				@else
				<div class="js_content">
					<div class="writer-n_orders-table-v2__row">
						<h4>No orders were found matching the criteria</h4>
					</div>
				</div>
				@endif

			</div>

			<div class="">
				<ul class="pagination">
					
				</ul>
			</div>

		</div>
	</div>
</div>
@endsection