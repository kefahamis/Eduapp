	<header class="page-header page-header_writer js_header__wrapper logged-page inner-page header_in">
		<div class="row-v2">
			<div class="page-header__content">
				<div class="page-header__logo">
					<a href="{{url('/')}}">
						<img src="{{asset('images/eddusaver logo.png')}}" salt="Eddusaver">
					</a>
				</div>

				<div class="page-header__user-controllers">

					<div class="desktop-user-logged-block">
						<a href="{{url('logout')}}" class="desktop-user-logged-block__link js_ga_logout"><span>Log out</span></a>
						<div class="desktop-user-logged-block__wrap">
							<a href="{{url(url_prefix().'/profile')}}" class="desktop-user-logged-block__user"
							id="">
							<div class="desktop-user-logged-block__user-col">
								<span class="desktop-user-logged-block__user-img">
									<img alt="{{auth()->user()->name}}" src="{{asset('images/avatarDefault.jpg')}}">
								</span>
							</div>
							<div class="desktop-user-logged-block__user-col">
								<span class="desktop-user-logged-block__user-name">{{auth()->user()->name}}</span>
								<span class="desktop-user-logged-block__user-rating">System Admin</span>
							</div>
						</a>

						<div class="desktop-user-logged-block__item">
							<a class="btn btn-secondary" href="{{url(url_prefix().'/my-chats')}}">
								Messages <span id="unread_chats_ad">0</span>
							</a>
							
						</div>
						<div class="desktop-user-logged-block__item">
							
						</div>
					</div>
				</div>


				<div class="mobile-user-logged-block  js_user_logged">
					<div class="mobile-user-logged-block__img js_user_img"><img src="../assets/images/avatarDefault.jpg" alt="Dr Ben"></div>
					<ul class="mobile-user-logged-block__menu js_user_menu">
						<li class="mobile-user-logged-block__item"><a class="mobile-user-logged-block__link" href="#">My Account</a></li>
						<li class="mobile-user-logged-block__item"><a class="mobile-user-logged-block__link" href="#">My balance <span class="mobile-user-logged-block__balance">$><?php  ?></span></a></li>
						<li class="mobile-user-logged-block__item"><a class="mobile-user-logged-block__link" href="n_orders">My orders</a></li>
						<li class="mobile-user-logged-block__item"><a class="mobile-user-logged-block__link" href="#" class="js_ga_logout">Log out</a></li>
						<li class="mobile-user-logged-block__item mobile-user-logged-block__item_ta_c">    </li>
					</ul>
				</div>

				<div class="page-header__order-btn-wrap" id="">
					


				</div>

			</div>
		</div>
	</div>
</header>

<div class="layout-content ">
	<div class="n_orders-list-writer-wrapper">
		<section class="inner-content inner-content_bg_gray" style="margin-top: 18px;">
			<div class="writer-n_orders-table-v2">

				<div class="writer-n_orders-table-v2__heading">
					<div class="row">
						<nav>
							<ul class="writer-n_orders-table-v2__tabs">
								<li class="writer-n_orders-table-v2__tabs-item">
									<a class="writer-n_orders-table-v2__tabs-link {{ Request::is('main/bidding') ? 'is-active' : '' }}" href="{{url(url_prefix().'/bidding')}}">
										Bidding
									</a>
								</li>
								<li class="writer-n_orders-table-v2__tabs-item">
									<a class="writer-n_orders-table-v2__tabs-link {{ Request::is('main/orders') ? 'is-active' : '' }}" href="{{url(url_prefix().'/orders')}}" id='js_writer_current_n_orders_base_tour_step_1'>
										In-Progress
									</a>
								</li>
								<li class="writer-n_orders-table-v2__tabs-item">
									<a class="writer-n_orders-table-v2__tabs-link {{ Request::is('main/completed') ? 'is-active' : '' }}" href="{{url(url_prefix().'/completed')}}">
										Completed
									</a>
								</li>
								<li class="writer-n_orders-table-v2__tabs-item">
									<a class="writer-n_orders-table-v2__tabs-link {{ Request::is('main/cancelled') ? 'is-active' : '' }}" href="{{url(url_prefix().'/cancelled')}}">
										Cancelled
									</a>
								</li>
								<li class="writer-n_orders-table-v2__tabs-item">
									<a class="writer-n_orders-table-v2__tabs-link {{ Request::is('main/revision') ? 'is-active' : '' }}" href="{{url(url_prefix().'/revision')}}">
										Revision
									</a>
								</li>
								<li class="writer-n_orders-table-v2__tabs-item">
									<a class="writer-n_orders-table-v2__tabs-link {{ Request::is('main/disputed') ? 'is-active' : '' }}" href="{{url(url_prefix().'/disputed')}}">
										Disputed orders
									</a>
								</li>
								<li class="writer-n_orders-table-v2__tabs-item">
									<a class="writer-n_orders-table-v2__tabs-link {{ Request::is('main/client-details') ? 'is-active' : '' }}{{ Request::is('main/users') ? 'is-active' : '' }}" href="{{url(url_prefix().'/users')}}">
										Clients & Writers
									</a>
								</li>

								<li class="writer-n_orders-table-v2__tabs-item writer-n_orders-table-v2__tabs-item_search">
									<form action="{{url(url_prefix().'/search')}}" method="get">
										<div class="b-search">
											<input name="q" class="b-search__input js_order_search_input" type="text" placeholder="Enter order ID" required="required" />
											<button class="b-search__button js_order_search_btn" type="submit"></button>
										</div> 
									</form>

								</li>
							</ul>
						</nav>                   
					</div>
				</div>
			</div>
