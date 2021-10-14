@if(Request::is('ordernow'))

@else
<link rel="stylesheet" type="text/css" href="{{asset('customer/client-css.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('customer/client-css_2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">	
@endif

<header class="page-header js_header__wrapper">
	<div class="row">
		<div class="page-header__inner" style="padding: 0px 0;">
			<div class="page-header__logo">
				<a href="{{url('/')}}">
					<img src="{{asset('images/eddusaver logo.png')}}" width="100%;">
				</a>
			</div>

			@guest

			<div class="page-header__user-controllers">
				<div class="page-header__login-btn">
					<a href="{{url('login')}}" >
						Login
					</a>
				</div>

			</div>
			@else


			<div class="page-header__user-controllers">
				<div class="desktop-user-logged-block">
					
                    <ul class="desktop-user-logged-block__menu">
                        <li class="desktop-user-logged-block__menu-item">
                            <span style="color: #ffff;">Support: +1 (646) (978) 2866</span>
                        </li>
                    </ul>


                    <div class="desktop-user-logged-block__user-block">
                      <div class="desktop-user-logged-block__pic">
                       <img alt="" src="{{asset('images/avatarDefault.jpg')}}">
                   </div>

                   <a class="desktop-user-logged-block__pic-link" href="{{ url(auth()->user()->url_prefix.'/profile')}}">
                       <span>
                        {{ Auth::user()->name }}
                    </span></a>
                </div>
                <ul class="desktop-user-logged-block__menu">
                   <li class="desktop-user-logged-block__menu-item">
                    <a href="{{ url(auth()->user()->url_prefix.'/orders')}}" class="desktop-user-logged-block__link">My orders</a>
                </li>
                <li class="desktop-user-logged-block__menu-item">

                    <div class="dropdown show">
                     <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      My balance<span class="balance-value">$0.00</span>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#">Available<span class="balance-value">$0.00</span></a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Reserved<span class="balance-value">$0.00</span></a>
                  </div>
              </div>
          </li>
      </ul>

  </div>

  <div class="page-header__add-funds">
      <div class="page-header__add-funds">
       <button class="btn btn_add-funds js_auto_generated_customer_disable_click"  data-toggle="modal" data-target="#add_funds_modal">
        Add funds
    </button>
</div>
</div>
<a class="desktop-user-logged-block__logout" href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
 @csrf
</form>
</div>

@endguest

</div>
</div>
</header>

<div class="modal" tabindex="-1" role="dialog" id="add_funds_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="uk-modal-header">
				Load money to your current balance                            
				<a aria-label="Close" data-dismiss="modal" class="uk-modal-close sm-round"></a>
			</div>
			<div class="modal-body">
				<form action="{{url('customer/add-funds')}}" method="post">
					@csrf
					<div class="uk-clearfix"></div>
					<div class="form-group">
						<div class="form-control-left">
							<label for="amount-load" class="amount-load"><b>Amount to be loaded in USD:</b></label>
						</div>
						<div class="form-control-right">
							<input type="number" id="add_deposit_amount" name="add_deposit_amount" class="input js_deposit_popup_deposit_amount" placeholder="$ 0" min="0" required>
							<div class="errorText fv1_error" id="add_deposit_form_deposit_deposit_amount_fv1_error"></div>
						</div>
						<div class="uk-clearfix"></div>
					</div>
					<p class="submit-note" style="direction: ltr;">
						By clicking "Load" button you agree to the        
						<a href="{{config('global.site_url')}}/terms-and-conditions/" target="_blank">Terms and Conditions</a> and <a href="{{config('global.site_url')}}/privacy-policy-2/" target="_blank">Privacy Policy</a>.
					</p>
					<input type="hidden" name="topup_token" value="3D4sds987DNnjg76gGG5fdHj874487DFe76hjNgY6FF6Klpo9I">
					<div class="uk-text-right">
						<button type="button" class="btn btn-danger uk-button js_customer_deposit_form_loading_hide" data-dismiss="modal">Cancel</button> 
						<button type="submit" class="btn btn-info uk-button js_customer_deposit_form_loading_hide">Load</button>

					</div>

                </form>
            </div>

        </div>
    </div>
</div>