@extends('layouts.customer')

@section('content')
<div class="container">
	<div class="row justify-content inner-content_bg_gray">

		<div class="customer-orders-table">
			<div class="row custom-row">
				<div class="customer-orders-table__heading">
					<div class="customer-orders-table__title"> My orders</div>
                    <a href="{{url('customer/my-chats')}}" class="btn btn-info btn-sm waves-effect">Chats</a>


                    <a href="{{url('ordernow')}}" class="js_button_order btn btn_customer-orders-heading btn_primary-accent js_crm_order_list_button_click js_button_order_ga">Place order</a>

                </div>
                <div class="customer-orders-table__table-heading">
                   <div class="customer-orders-table__table-heading-left">
                      <div class="customer-orders-table__table-heading-item">Topic &amp; Order ID</div>
                      <div class="customer-orders-table__table-heading-item">Due Date</div>
                      <div class="customer-orders-table__table-heading-item">Price (USD)</div>
                      <div class="customer-orders-table__table-heading-item">Status</div>
                  </div>
                  <div class="customer-orders-table__table-heading-right">
                      <div class="customer-orders-table__table-heading-item">Assigned writer</div>
                      <div class="customer-orders-table__table-heading-item ">Action</div>
                  </div>
              </div>
              <div class="table-orders table-orders_content js_content">

               <!--  -->
               @if(count($orders) < 1)
               <div class="customer-orders-table__row ">
                  <span class="customer-orders-table__col">No orders...<a href="{{url('ordernow')}}" class="js_button_order btn btn_customer-orders-heading btn_primary-accent js_crm_order_list_button_click js_button_order_ga" data-atest="atest_order_create_elem_new_order_btn">Place order</a></span>
              </div>
              <!--  -->
              @else
              @foreach ($orders as $order)
              @if($order->customer)
              <!--  -->
              <div class="customer-orders-table__row ">
                  <a href="{{url(url_prefix().'/view-order/'.$order->order_code)}}" class="customer-orders-table__side_first">
                     <span class="customer-orders-table__col customer-orders-table__col_main">
                        <span class="customer-orders-table__order-name">{{$order->topic}}</span>
                        <span class="customer-orders-table__order-id">Order ID: {{$order->order_code}}</span>
                    </span>
                    <span class="customer-orders-table__col">
                        <span class="customer-orders-table__col-name">Due Date</span>
                        <time class="customer-orders-table__date">
                           @php
                           $deadline = date_create($order->deadline);
                           @endphp
                           <em>{{date_format($deadline,"d")}} {{date_format($deadline,"M")}}</em>
                           {{date_format($deadline,"Y")}}
                       </time>
                   </span>
                   <span class="customer-orders-table__col">
                    <span class="customer-orders-table__col-name">{{$order->order_price}}</span>
                    <span class="customer-orders-table__price">  {{$order->order_price}}              
                    </span>
                </span>
                <span class="customer-orders-table__col">
                    <span class="customer-orders-table__status {{ orderStatus($order->status)['class'] }}">
                       {{ orderStatus($order->status)['status'] }}
                   </span>
               </span>
           </a>
           <div class="customer-orders-table__side_second">
             <div class="customer-orders-table__col">
                <div class="customer-orders-table__col-name">Assigned writer</div>
                <a href="#" class="customer-orders-table__writer">
                   {{getAssignedWriter($order->assigned_to)['name']}}
               </a>
           </div>
           <div class="customer-orders-table__col">
            <ul>

               <li>
                  <span class="customer-orders-table__order-id">
                    @if($order->payment_status != 'completed')
                    <a href="{{url('customer/billing/'.$order->order_code)}}" class="btn btn-info btn-sm waves-effect"> Complete Payment</a>
                    @else
                    <button class="btn btn_chat writer-orders-table-v2__user-info-cell js_order_start_chat" type="button" onclick="javascript:void(Tawk_API.toggle())">
                        <small class="btn__chat-num js_new_messages_count" style="display:none;"></small>
                        <span class="js_order_start_chat_btn_text">Start chat</span>
                    </button>
                    @endif
                </span>
            </li>
        </ul>

    </div>
</div>
</div>
<!--  -->
@endif
@endforeach
@endif

</div>

<div class="">
 <ul class="pagination">
  {{ $orders->links() }}

</ul>

</div>

</div>
</div>

</div>
</div>
@endsection