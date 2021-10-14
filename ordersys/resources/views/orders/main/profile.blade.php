@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content inner-content_bg_gray">
		@include('layouts.flash')
		<div class="row customer-edit-profile-wrapper" style="min-height: 800px; padding-top: 25px;">
			<!-- <div class="customer-edit-profile-wrapper"> -->
				<section class="inner-content inner-content_bg_gray inner-content_profile">
					<div class="row">
						<div class="profile-page">
							<div class="profile-page__section profile-page__section_first">
								<aside class="user-sidebar js_user-sidebar">
									<h2 class="user-sidebar__heading">My Eddusaver Profile</h2>
									<div class="user-sidebar__content">
										<div class="user-sidebar__profile">
											<img src="{{asset('/images/avatarDefault.jpg')}}" alt="avatar" class="user-sidebar__avatar">
											<div class="user-sidebar__sign">
												<div class="user-sidebar__name">{{$user->name}}</div>
												<div class="star-rate">
													<div style="width: 0%;"></div>
												</div>
											</div>
										</div>

										<nav class="user-sidebar__menu">
											<a href="{{url(url_prefix().'/orders')}}" class="user-sidebar__menu-item user-sidebar__menu-item_active">
												My orders                                    
											</a>
											<a class="user-sidebar__menu-item" href="{{url('logout')}}">
												<i class="fa fa-logout"></i>
												Logout                                    
											</a>
										</nav>
									</div>
								</aside>
							</div>
							<div class="profile-page__section profile-page__section_second">

								<h2 class="profile-header">Profile</h2>
								<form action="{{url(url_prefix().'/update-profile')}}" method="post" class="uk-form js_profile_form" id="general_information">
									@csrf
									<div class="background-card background-card_mobile js_functional_block">
										<div class="background-card__heading">
											<div class="background-card__title">General information</div>
											<div class="background-card__subtitle background-card__subtitle_fz_s" style="direction: ltr;">
												Feel free to update your profile below any time. Your privacy is always guaranteed, and your data is protected. This page is visible only to our support team.          
											</div>
										</div>


										<div class="profile-layout">
											<div class="input-group-v2">
												<label class="label-v2">
													Username* <span class="label-v2__fake-input">
														<span>{{$user->email}}</span>
													</span>
												</label>
											</div>
											<div class="input-group-v2">
												<label class="label-v2">
													Email <span class="label-v2__fake-input">
														<span>{{$user->email}}</span>
													</span>
												</label>
											</div>
											<div class="input-group-v2">
												<label class="label-v2">
													Time zone                            
													<div class="timezone-v2">
														<div class="timezone-v2__clock js_tvb_clock">UTC</div>
														<div class="timezone-v2__wrap">
															<div class="timezone-v2__offset js_tvb_timezone_offset">
															</div>
														</div>
													</div>

												</label>
												<div class="input-group-v2__tooltip info-tooltip dropdown-block-wrapper">
													<div data-uk-dropdown="{pos:'right'}" class="info-under-place" aria-haspopup="true" aria-expanded="true">
														<div class="uk-dropdown" style="direction: ltr;">
															<p>Let us know your time zone so that we know when to turn in your paper.</p>
														</div>
													</div>
												</div>
											</div>
											<div class="input-group-v2">
												<label class="label-v2 " data-error="">
													Full Name
													<input type="text" id="customer_name" name="customer_name" class="input-v2 js_check_on_change js_ga_field_first_name" value="{{$user->name}}" required="">
												</label>
											</div>
										</div>

										<div class="profile-layout ">
											<div class="input-group-v2 input-group-v2_phone input-group-v2_pb_35">
												<label class="js_snp_label label-v2
												" data-error=""></label>
												Contact Phone*
												<div class="intl-tel-input">
                                                    <input name="phone_number" class="input-v2 js_snp_number" value="{{$user->phone_number}}" type="tel" autocomplete="off" placeholder="">
                                                </div>
                                            </label>


                                            <div class="input-group-v2__description input-group-v2__description_floating" data-star="*">
                                             Only our customer support manager can request your number in case of emergency.  
                                         </div>
                                     </div>

                                     <div class="input-group-v2 js_verify_input_group input-group-v2_width_2 input-group-v2_verify">
                                      <span class="profile-btn profile-btn_slim js_snp_send_verify_code btn_second_disabled disabled" style="background-color: #a49f9a;cursor: no-drop; display: none;">Verify</span>

                                  </div>
                              </div>

                              <button type="submit" class="profile-btn profile-btn_slim profile-btn_mt_30 profile-btn_w_110 js_general_form_save_btn js_profile_loading_hide js_ga_field_submit">
                               Save        
                           </button>


                       </div>
                   </form>

                   <form action="{{url(url_prefix().'/update-password')}}" method="post" class="uk-form js_profile_password_form">
                     @csrf
                     <div class="background-card background-card_mobile js_functional_block">
                        <div class="background-card__heading">
                           <div class="background-card__title">Change password</div>
                       </div>
                       <div class="profile-layout profile-layout_password">
                           <div class="input-group-v2">
                              <label class="label-v2 label-v2_password " data-error="">
                                 Verify current password
                                 <input type="password" id="current_password" name="current_password" class="input-v2">
                                 <span class="label-v2__toggle js_label-v2__toggle" onclick="myFunction()"></span>
                             </label>

                         </div>
                         <div class="input-group-v2 input-group-v2_row">
                          <label class="label-v2 label-v2_password " data-error="">
                             New password**
                             <input type="password" id="new_password" name="new_password" maxlength="20" class="input-v2">
                             <span onclick="myFunction1()" class="label-v2__toggle js_label-v2__toggle"></span>
                         </label>

                         <div class="input-group-v2__description input-group-v2__description_list" data-star="**">
                             <ul>
                                <li class="js_password_error_1">minimum 6 symbols</li>
                                <li class="js_password_error_2">maximum 20 symbols</li>
                                <li class="js_password_error_3">letters and numbers only</li>
                                <li class="js_password_error_4">passwords do not match</li>
                                <li class="js_password_error_5">at least 1 number required</li>
                                <li class="js_password_error_6">at least 1 letter required</li>
                            </ul>
                        </div>
                    </div>
                    <div class="input-group-v2">
                      <label class="label-v2 label-v2_password " data-error="">
                         Confirm password
                         <input type="password" id="confirm_new_password" name="confirm_new_password" maxlength="20" class="input-v2">
                         <span onclick="myFunction2();" class="label-v2__toggle js_label-v2__toggle"></span>
                     </label>

                     <label class="label-v2 label-v2_password_err" style="color: red;">
                     </label>
                 </div>
             </div>

             <button type="submit" class="profile-btn profile-btn_slim profile-btn_mt_20 js_profile_loading_hide js_ga_field_new_password" value="Update password">
               Update Password
           </button>
           <div class="site_loading background-card__loader js_profile_loading_img" style="display:none;"></div>
           <span style="display:none;"><div><div id="change_password_google_recaptcha"></div></div><input type="hidden" id="change_password__token" name="change_password[_token]" data-js-token-id="change_password" value="c4dd9b3a28d97d4066f993987ae99b4c__34e10f9991d01d010c8f48667144bc4f"></span>

       </div>
   </form>


   <div class="background-card background-card_mobile js_functional_block">
     <div class="profile-layout profile-layout_other">
        <div class="background-card__wrapper">
           <div class="background-card__heading">
              <div class="background-card__title">Profile pic</div>
          </div>

          <form action="/user/photo-run" method="POST" enctype="multipart/form-data" class="profile-img-form js_profile_photo_form">

              <figure class="profile-avatar ">
                 <img class="profile-avatar__img" src="{{asset('images/avatarDefault.jpg')}}" alt="Userpic">


                 <div class="input-group-v2 js_verify_input_group input-group-v2_width_2 input-group-v2_verify">
                    <span class="profile-avatar__btn profile-btn profile-btn_slim profile-btn_w_110 js_profile_loading_hide required disabled" style="background-color: #a49f9a;cursor: no-drop;">Upload</span>

                </div>


            </figure>
        </form>

    </div>


</div>
</div>
</div>
</div>
</div>
</section>
</div>

</div>
</div>
<script type="text/javascript">
	function myFunction() {
		var x = document.getElementById("current_password");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	} 
	function myFunction1() {
		var x = document.getElementById("new_password");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	} 
	function myFunction2() {
		var x = document.getElementById("confirm_new_password");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	} 

	
</script>
@endsection