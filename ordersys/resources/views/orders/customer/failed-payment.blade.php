@extends('layouts.customer')

@section('content')
<div class="container">
	<div class="row justify-content inner-content_bg_gray">
		<!-- ?? -->

		<div class="order-view-v2__container">
			
			<div class="order-view-v2__header">
				<h1 class="order-view-v2__title">
					
				</h1>
				@include('layouts.flash')
				<div class="order-view-v2__header-button">
					
				</div>
			</div>

			<!--  -->
			<div class="order-view-v2__body js_order_view_guide_wrapper">
				<div class="order-view-v2__card">

					<h3 style="color: red; font-style: italic;">Payment cancelled.</h3>
					<a href="{{url(url_prefix().'/orders')}}" class="js_button_order js_button_order btn"><span><<</span> Back to all orders</a>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection
