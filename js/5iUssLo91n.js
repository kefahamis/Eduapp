$(document).ready(function(){

	var paper_instructions = $("#order_description").val();


	$("#llogin_button").click(function(){

		var valid;
		valid = validateFields();
		if (valid == false) {
			return;
		}
			// var randKey = $("#randKey").val();
			// if (randKey != '') {

			// }
			var form = $('#order_login')[0];
			var usr_email = $("#llogin_email").val();
			
			var loginns = new FormData(form);
			var order_session = $("#order_session_id").val();
		// 
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			// url: "https://localhost/eddusaver_orders/n_orders/step_1.php",
			url: 'http://superordersys.net/auth/email',
			data: loginns,
			headers: {
				'content-type': 'application/json',
				'_token': '{{csrf_token() }}'
			},
			processData: false,
			contentType: false,
			cache: false,
			timeout: 600000,
			success: function (ready) {
				var obj = JSON.parse(ready);
				console.log(obj);return;

				$("#error_div").html(" ");

				if(obj.string == usr_email){
					$("#usr_email_display").html(obj.string);
					$("#customer-email").show();
					$("#signup-title").html("Enter your account password");
					$("#llogin_button").hide(); 
					$("#llogin_email").hide();
					$("#llogin_passwrd").show();
					$("#auth_button").show(); 

				}
				else if(obj.string == 'new_user' && order_session == 'swd21w2d'){
					$("#loginModal_1").modal('hide');
					placeOrderFunc();
    				//return;
    			}
    			else if(obj.string == 'new_user' && order_session == ''){
    				$(location).attr('href',url_cu);
    			}
    			else{
    				console.log("Oops!");
    			}
    			$("#llogin_button").prop("disabled", false);
    		},
    		error: function (e) {
    			//log error
    			console.log("ERROR : ", e);
    			$("#llogin_button").prop("disabled", false);

    		}
    	});

	});


	$("#change_user").click(function(){
		var form = $('#order_login')[0];
		var form_data = new FormData(form);
		var order_session = $("#order_session_id").val();
		// 
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			// url: "https://localhost/eddusaver_orders/n_orders/step_1.php",
			url: "https://localhost/eddusaver_orders/change_user",
			data: form_data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 600000,
			success: function (ready) {
				var obj = JSON.parse(ready);

				$("#error_div").html(" ");
				if(obj.string == "user_changed"){
					$("#customer-email").hide();
					$("#llogin_email").show();
					$("#llogin_passwrd").hide();
					$("#auth_button").hide(); 
					$("#llogin_button").show(); 
					$("p#signup-title").html("Log in or Sign up to get instant access to chat with n_writers");
    				// $(location).attr('href',url2);
    			}

    			$("#llogin_button").prop("disabled", false);
    		},
    		error: function (e) {
    			//log error
    			console.log("ERROR : ", e);
    			$("#llogin_button").prop("disabled", false);

    		}
    	});
		// 
	});

	$("#js_login_open_forgot_popup").click(function(){
		$("#error_div").html(" ");
		$("#customer-email").hide();
		$("#llogin_email").show();
		$("#llogin_passwrd").hide();
		$("#auth_button").hide(); 
		$("#llogin_button").hide(); 
		$("#reset_ps_btn").prop("disabled", false);
		$("#reset_ps_btn").show(); 
		$("p#signup-title").html("Enter your email to reset password");
	});

	$("#auth_button").click(function(){
		var form = $('#order_login')[0];
		var form_data = new FormData(form);
		var order_session = $("#order_session_id").val();

		// 
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: "https://localhost/eddusaver_orders/auth_login",
			data: form_data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 600000,
			success: function (ready) {
				var obj = JSON.parse(ready);

				$("#error_div").html(" ");
				if(obj.string == "a2d3zDXy" && order_session == 'swd21w2d'){
					$("#loginModal_1").hide();
					placeOrderFunc();
				}else if (obj.string == "a2d3zDXy" && order_session == '') {
					$("#loginModal_1").hide();
					$(location).attr('href',url_cu);

				}else if (obj.string == "wrong_credentials") {
					$("#error_div").html("Wrong credentials");

				}else{
					$("#error_div").html("Wrong credentials");
				}

				$("#llogin_button").prop("disabled", false);
			},
			error: function (e) {
    			//log error
    			console.log("ERROR : ", e);
    			$("#llogin_button").prop("disabled", false);

    		}
    	});
		// 
		
		

	});

	$("#reset_ps_btn").click(function(){
		var valid;
		valid = validateFields();
		if (valid == false) {
			return;
		}
		var form = $('#order_login')[0];
		var form_data = new FormData(form);
		$("#reset_ps_btn").prop("disabled", true);
		// 
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: "https://localhost/eddusaver_orders/auth_reset",
			data: form_data,
			processData: false,
			contentType: false,
			cache: false,
			timeout: 600000,
			success: function (ready) {
				var obj = JSON.parse(ready);
				$("#error_div").html("");
				if (obj.string == 'not_found') {
					$("#error_div").html("Email not found. Please signup");
				}
				else if (obj.string == 'password_reset') {
					$("p#signup-title").html("Check your email for new password");
					$("#llogin_email").show();
					$("#auth_button").hide(); 
				}
				else{
					$("#error_div").html("Something went wrong.Please try again");
				}
				$("#reset_ps_btn").prop("disabled", false);

			},
			error: function (e) {
				$("#reset_ps_btn").prop("disabled", false);
				console.log("ERROR : ", e);
			}
		});
		// 
		
		

	});


	function  validateFields(){
		var form = $('#order_login')[0];
		var client_email = $("#llogin_email").val();
		if(client_email == ""){
			$("#error_div").html("Email cannot be empty");
			$("#llogin_button").prop("disabled", false);
			return false;
		}

		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(client_email)) {
			return true;
		}

		$("#error_div").html("Invalid email adress");
		$("#llogin_button").prop("disabled", false);
		return false;
	}
});
