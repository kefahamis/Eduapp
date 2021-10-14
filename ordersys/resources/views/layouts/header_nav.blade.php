<header class="page-header js_header__wrapper">
	<div class="row">
		<div class="page-header__inner">
			<div class="page-header__logo">
				<a href="https://www.eddusaver.com">
					<img src="{{asset('images/eddusaver logo.png')}}" width="100%;">
				</a>
			</div>

			@guest

			<div class="page-header__user-controllers">
				<div class="page-header__login-btn">
					<a  data-toggle="modal" data-target="#loginModal_1" onclick="setn_ordersession();" >
						Login
					</a>
				</div>

			</div>
			@else


			@endguest

		</div>
	</div>
</header>