<!-- Begin Signin/signup Modal -->
<div class="modal fade uk-modal modal-allow-user js_popup_all in" id="loginModal_1" tabindex="-1" role="dialog" aria-labelledby="loginModal_1Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content js_popup_content" style="display: contents;">
      <div id="popup_login" style="">
        <div class="uk-modal-dialog">
          <div class="modal-content">
            <div class="uk-modal-header">
              <span>Log in / Sign up</span><p class="uk-modal-header__description js_popup_login_custom_text"></p><a aria-label="Close" data-dismiss="modal" class="uk-modal-close sm-round"></a>
          </div>
          <div data-js_get_login_form_url="#" class="uk-form js_pre_login_form_container">

              <span class="js_login_form_container">     

                <form enctype="multipart/form-data" id="order_login" name="order_login" class="login_form js_pre_login_form">
                  <p class="modal-info-title" id="signup-title">
                    Log in or Sign up to get instant access to chat with writers
                </p>
                <div class="line js_login_sub_action_line" style="display:none;">
                    You need to Log in or Sign up for a new account in order to <span class="js_login_sub_action_text"></span>
                </div>
                <!--  -->
                <div class="line" id="customer-email" style="display: none;">
                    <table class="pre_authorize_user_wrapper" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td class="user_logo_td" rowspan="2"><img src="{{asset('images/user.jpg')}}"></td>
                          <td class="change_btn_td"><a rel="nofollow" href="javascript:void(0);" class="js_login_change_user" data-atest="atest_login_elem_change_user" style="position: relative;
                          z-index: 1;" id="change_user">Change user</a></td>
                      </tr>
                      <tr>
                          <td><div class="user_email js_pre_authorize_user_email" id="usr_email_display">

                          </div></td>
                      </tr>
                  </tbody>
              </table>
              <span style="display:none;"><input type="email" id="_username" name="_username" class="" placeholder="Your email" value=""></span>
          </div>
          <!--  -->
          <div class="line js_login_sub_action_line" style="display:none;">
            <b>Please enter your email to proceed</b>
        </div>


        <div class="line">
            <input type="email" id="llogin_email" name="llogin_email"  class="  js_pre_login_username" placeholder="Enter your email"  required="required">
            <input type="password" id="llogin_passwrd" name="llogin_passwrd"  class="js_pre_login_username" placeholder="Enter your password"  required="required" style="display: none;">
            <span class="v7__toggle" onclick="myFunction()" style="display: none;"></span>
        </div>

        <div id="get_contact_info" style="display: none;">
           <div class="line">
            <label class="b-form-group__text-label">
                Country <font color="red">(Required)*</font>   
            </label>
            @include('countries')
        </div>
        <div class="line">
           <label class="b-form-group__text-label">
            Phone Number <font color="red">(Required)*</font>   
        </label>
        <input type="number" name="phone_number" id="phone_number">
    </div>
</div>

<div class="line js_social_auth_error_block">
    <div class="errorText js_social_auth_error_text js_login_loading_hide" id="error_div">

    </div>
</div>


<div class="line">
    <div class="js_login_loading_hide" style="">
      <button class="uk-button" id="llogin_button" name="llogin_button" type="button">Continue</button>
      <button class="uk-button" id="contacts_button" name="contacts_button" type="button" style="display: none;">Proceed</button>
      <button class="uk-button" id="auth_button" name="auth_button" type="button" style="display: none;">Login</button>
      <button class="uk-button" id="reset_ps_btn" name="reset_ps_btn" type="button" style="display: none;">Reset Password</button>

  </div>
  <div class="uk-text-center js_login_loading_img" style="display: none;">
      <div class="site_loading"></div>
  </div>
</div>

<div class="forgot">
    <a rel="nofollow" class="js_login_open_forgot_popup" data-atest="atest_forgot_pass_elem_popup_open" id="js_login_open_forgot_popup" href="javascript:void(0);">Forgot password?</a>
</div>
<input type="hidden" id="order_session_id" name="order_session_id" class="js_pre_login_user_type_id_for_signup">
<input type="hidden" id="pre_login_user_key" name="pre_login_user_key" class="js_pre_login_user_type_id_for_signup">
<input type="hidden" id="pre_login_username" name="pre_login_username" class="js_pre_login_user_type_id_for_signup">

<div class="uk-clearfix"></div>
<b class="gdpr-notification gdpr-notification_color_dark gdpr-notification_mt_0">
    By clicking “Continue”, you agree to our <a href="{{url('terms-and-conditions')}}" rel="nofollow" target="blank">terms of service</a> and <a href="{{url('privacy-policy-2')}}" rel="nofollow" target="blank">privacy policy</a>. We’ll occasionally send you promo and account related emails.</b>
</form>

</span>
</div>
</div>
</div>
<!-- </div> -->
</div>
</div>
</div>
</div>
<!-- End modal -->



<!-- Begin Attract writers Modal -->
<div class="modal fade uk-modal modal-allow-user js_popup_all in" id="attract_writers" tabindex="-1" role="dialog" aria-labelledby="attract_writersLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content js_popup_content" style="display: contents;">
        <div id="popup_login" style="">
          <div class="uk-modal-dialog">
            <div class="modal-content">
              <div class="uk-modal-header">
                <span>Your order isn't attracting writers.</span><p class="uk-modal-header__description js_popup_login_custom_text"></p><a aria-label="Close" data-dismiss="modal" class="uk-modal-close sm-round"></a>
            </div>
            <div data-js_get_login_form_url="#" class="uk-form js_pre_login_form_container">

                <span class="js_login_form_container">    
                 <div class="trash-popup">
                  <div class="trash-popup__row">
                    <div class="trash-popup__text">
                      <span class="js_etro_text_variant_1" style="display: inline;">
                        Please fill out 'Paper instructions' field<br>
                        as much as you can or<br>
                        attach files to increase interest from writers.
                    </span><span class="js_etro_text_variant_2" style="display: none;">
                        Please attach files for 'Rewriting' to increase<br>
                        interest from writers.
                    </span><span class="js_etro_text_variant_3" style="display: none;">
                        Please attach files for 'Editing' to increase<br>
                        interest from writers.
                    </span>
                </div>
            </div>
            <div class="trash-popup__row">
                <div class="trash-popup__btn-wrap">
                  <a type="button" class="btn btn-success" data-dismiss="modal" onclick="backToOrderForm();"><span>Back To Form</span></a>
                  <a type="button" class="btn btn-primary" onclick="continueWithOrder();"><span>continue</span>
                  </a>
              </div>
          </div>
      </div>
  </span>
</div>
</div>
</div>
</div>
</div>
</div>
</div> 
<!-- End Modal -->

