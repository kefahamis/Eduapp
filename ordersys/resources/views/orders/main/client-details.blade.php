@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content inner-content_bg_gray">
		
		<div class="writer-n_orders-table-v2__tab-content-row">
			<div class="order-view-v2__header-button">
				<a href="{{url(url_prefix().'/writer-details')}}" class="js_button_order js_button_order btn btn_customer-n_orders-heading btn_primary-accent js_crm_order_list_button_click js_button_order_ga">Writer Details</a>
				<h3>Client Details</h3>

			</div>
			<table id="table_id" class="table">
				<thead>
					<tr>
						<th>Full Name</th>
						<th>Email</th>
						<th>Contact</th>
						<th>Country</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->phone_number}}</td>
						<td>{{$user->country}}</td>
					</tr>
					@endforeach

				</tbody>
			</table>
			<div class="">
				<ul class="pagination">
					{{ $users->links() }}
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection