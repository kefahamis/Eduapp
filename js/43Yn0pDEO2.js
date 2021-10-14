function setn_ordersession(){
	$("#order_session_id").val("");
	
}
function setn_ordersession2(){
	var randKey = $("#randKey").val();

	$("#order_session_id").val("swd21w2d");
	
	var paper_instructions = $("#order_description").val();
	if(paper_instructions == ''){
		$("#loginModal_1").modal('hide');
		$("#attract_writers").modal('show');
		var order_session = $("#order_session_id").val();
		return;
	}else{
		$("#attract_writers").modal('hide');
		if (randKey != '') {
			$("#js_order_loading_img").show();
			$("#client_pick").hide();
			$("#system_pick").hide();
			placeOrderFunc();
		}else{
			$("#loginModal_1").modal('show');
		}
		
	}

	var order_session = $("#order_session_id").val();
	console.log(order_session);
}


function editTheOrder(){
	$("#loginModal_1").modal('hide');
	$('#attract_n_writers').modal('hide');

}



//state
var state = "on";


function calculatePrice() {
	// body...

	var paper_type = $("paper_type").val();
	var topic = $("#topic").val();
	var subject = $("#subject").val();
	var academic_level = $("#academic_level").val();
	var pages = $("#order_product_pages").val();

	// Date Picker Harmonization variiables
	var deadline_date_2 = $("#order_deadline_date").val();
	var dealine_year = new Date().getFullYear();
	var deadline_date_3 = Date.parse(deadline_date_2+' '+dealine_year);
	deadline_date_3 = new Date(deadline_date_3);
	deadYear = deadline_date_3.getFullYear();
	deadMonth = deadline_date_3.getMonth()+1;
	deadDay = deadline_date_3.getDate();
	var deadline_date_1 = deadYear+'-'+deadMonth+'-'+deadDay;
	var deadline_time = $("#order_deadline_time").val();

	if (deadline_time == "12 AM") {
		deadline_time = "00 AM"
	}else {
		deadline_time = $("#order_deadline_time").val();
	}

	var time = deadline_time.split(' ')
	var hour;
	if (time[1] == "PM") {
		hour = parseInt(time[0])+12;
	}else {
		hour = time[0];
	}

	var deadline_minutes = $("#order_deadline_minutes").val();
	var deadline_date = deadline_date_1+' '+hour+':'+deadline_minutes+':'+'00';
//end

	// var deadline_time = $("#order_deadline_time").val();
	var deadline_time;
	var order_product_service = $("input[name='order_product_service']:checked").val();
	var sources = $("#sources").val();
	var citation_style = $("#citation_style").val();
	var writer_type = $("input[name='order_product_wrlevel']:checked").val();
	var order_urgency;
	var the_urgency;


    //price factors
    var urgency_factor = 0;
    var academic_level_factor = 0;
    var order_product_service_factor = 1;
    var toggle_pick_writer_factor = 0;
	//total price/ cost
	var total_price = 1;
	var form_data = $("#js_order_form").serialize();


	// /writer qualility description
	if (writer_type == 3) {
		$("#platinum_desc").show();
		$("#all_writers_desc").hide();
		$("#premium_desc").hide();

	}else if (writer_type == 2) {
		$("#premium_desc").show();
		$("#all_writers_desc").hide();
		$("#platinum_desc").hide();

	}else if (writer_type == 1) {
		$("#all_writers_desc").show();
		$("#premium_desc").hide();
		$("#platinum_desc").hide();


	}else {
		$("#all_writers_desc").show();
	}


	//deadline calculation
	var today = new Date();
	var today_timestamp = today.getTime();

	if(deadline_date) {
		var deadline_string = deadline_date;
		$("#actual_deadline").val(deadline_string);
	}else{
		deadline_date = new Date();
		var actual_deadline = new Date();
		actual_deadline.setDate(actual_deadline.getDate());
		var actual_dd = actual_deadline.getDate();


		deadline_date.setDate(deadline_date.getDate() + 10);
		var dd = deadline_date.getDate();
		var mm = deadline_date.getMonth() + 1;
		var y = deadline_date.getFullYear();
		var hh = deadline_date.getHours() + 1;



		if(hh < 10){
			deadline_time ='0' + hh + ':00:00';
		}else{
			deadline_time =hh + ':00:00';
		}


		deadline_date = y + '-' + mm + '-' + dd;
		deadline_string = deadline_date + ' '+ deadline_time;
		var actual_deadline_string = y + '-' + mm + '-' + actual_dd + ' '+ deadline_time;
		$("#actual_deadline").val(actual_deadline_string);
	}

	dateTimeParts = deadline_string.split(' ');
	timeParts = dateTimeParts[1].split(':');
	dateParts = dateTimeParts[0].split('-');
	var deadline = new Date(dateParts[0], dateParts[1]-1, dateParts[2],timeParts[0], timeParts[1],timeParts[2]);
	// var deadline = new Date(dateParts[0], dateParts[1]-1, dateParts[2],timeParts[0], timeParts[1],timeParts[2]);
	var deadline_timestamp = deadline.getTime();
	var time_difference = (deadline_timestamp - today_timestamp)/1000;
	var the_hours_left =  (Math.floor(time_difference / 3600));
	var days_left =  (Math.floor(time_difference / 86400));
	time_difference -= days_left * 86400;
	var hours_left =  Math.floor(time_difference / 3600) % 24;


	if(days_left >0  && hours_left ===0){
		//days only
		if (days_left <= 2) {
			order_urgency = 1371;
		}else if(days_left > 2 && days_left <= 3){
			order_urgency = 1372;
		}else if(days_left > 3 && days_left <= 5){
			order_urgency = 1373;
		}else if(days_left > 5 && days_left <= 7){
			order_urgency = 1374;
		}else if(days_left > 7 && days_left <= 10){
			order_urgency = 1375;
		}else if(days_left > 10 && days_left <= 20){
			order_urgency = 1376;
		}else if(days_left > 20 && days_left <= 30){
			order_urgency = 1377;
		}else if(days_left > 30 && days_left <= 31){
			order_urgency = 1447;
		}else{
			order_urgency = 1447;
		}


		$("#order_urgency").val(order_urgency);
		$("#order_deadline_days_left").html(days_left + " days left" );
		//console.log(deadline_string);

	}else if(days_left > 0 && hours_left >0){
		//hours and days
		if (days_left <= 2) {
			order_urgency = 1371;
		}else if(days_left > 2 && days_left <= 3){
			order_urgency = 1372;
		}else if(days_left > 3 && days_left <= 5){
			order_urgency = 1373;
		}else if(days_left > 5 && days_left <= 7){
			order_urgency = 1374;
		}else if(days_left > 7 && days_left <= 10){
			order_urgency = 1375;
		}else if(days_left > 10 && days_left <= 20){
			order_urgency = 1376;
		}else if(days_left > 20 && days_left <= 30){
			order_urgency = 1377;
		}else if(days_left > 30 && days_left <= 31){
			order_urgency = 1447;
		}else{
			order_urgency = 1447;
		}
		$("#order_urgency").val(order_urgency);
		$("#order_deadline_days_left").html(days_left + " day(s)" + " and "+hours_left +" hours left");

	}else if(days_left === 0 && hours_left >0){
		//hours only

		if (hours_left <= 3) {
			order_urgency = 1367;
		}else if(hours_left > 3 && hours_left <= 8){
			order_urgency = 1368;
		}else if(hours_left > 8 && hours_left <= 12){
			order_urgency = 1369;
		}else if(hours_left > 12 && hours_left <= 24){
			order_urgency = 1370;
		}else{
			order_urgency = 1370;
		}
		$("#order_urgency").val(order_urgency);
		$("#order_deadline_days_left").html(hours_left + " hours left");

	}else{

	}
	the_urgency = the_hours_left;
	$("#the_urgency").val(the_urgency);
	if (isNaN(days_left)==false && days_left>=0 && hours_left>=3) {
		$("#order_deadline_fv1_error").html("Please, pay attention to the deadline.Will " + days_left + " day(s), "  + hours_left+ " hour(s) meet your submission date? ");
	}else if (days_left<1 && hours_left<3) {
		$("#order_deadline_fv1_error").html("Please set a deadline atleast 3 hours from now.");
		$("#order_deadline_days_left").html("Invalid. Deadline too close.");
	}else {
		$("#order_deadline_fv1_error").html("Please, pay attention to the deadline. Will the default 10 days meet your submission date?");
		$("#order_deadline_days_left").html("10 days left");
	}



   //END DEADLINE CALC


	//####PRICE CALCULATION######################################################

	//academic_level_factor
	if (academic_level==1) {
		academic_level_factor=0;

	}else if (academic_level==2) {
		academic_level_factor=0.15383;

	}else if (academic_level==3) {
		academic_level_factor=0.15383;

	}else if (academic_level==4) {
		academic_level_factor=0.30766;

	}else if (academic_level==5) {
		academic_level_factor=0.4615;

	}else {
		academic_level_factor=0;
	}




    // urgency_factor
    order_date = new Date();

    if (isNaN(deadline_timestamp) === false){
    	var urgency = deadline_timestamp - order_date.getTime();

    }else{

    }


    if (urgency <=10800000 ) {
    	urgency_factor = 0.4615;

    }else if (urgency > 10800000 && urgency <= 28800000) {
    	urgency_factor = 0.39558;

    }else if (urgency > 28800000 && urgency<= 43200000) {
    	urgency_factor = 0.32965;

    }else if (urgency > 43200000 && urgency<= 86400000) {
    	urgency_factor = 0.26372;

    }else if (urgency > 86400000 && urgency<= 259200000) {
    	urgency_factor = 0.19779;

    }else if (urgency > 259200000 && urgency<= 777600000) {
    	urgency_factor = 0.13186;

    }else if (urgency > 777600000 && urgency<= 1123200000) {
    	urgency_factor = 0.06593;

    }else if (urgency > 1123200000) {
    	urgency_factor = 0;

    }else {

    }


    // order_product_service_factor
    if (order_product_service==1) {
    	order_product_service_factor=1;

    }else if (order_product_service==2) {
    	order_product_service_factor=0.9;

    }else if (order_product_service==3) {
    	order_product_service_factor=0.85;

    }else {
    	order_product_service_factor=1
    }


//writer quality factors
if (writer_type == 2) {
	writer_type_factor = 1.1;
}else if (writer_type == 3) {
	writer_type_factor = 1.2;
}else {
	writer_type_factor = 1;
}


    //toggle_pick_writer_factor
    if (state == "off") {
    	toggle_pick_writer_factor = 9.99
    }else {
    	toggle_pick_writer_factor = 0
    }


    //total price/ cost
    total_price = Math.round(((((13 + 13*(urgency_factor + academic_level_factor))*pages)*order_product_service_factor)*writer_type_factor)+ toggle_pick_writer_factor);

    $("#total_price_field").html(total_price);
    $("#total_price_calculated").val(total_price);
}



var pages = parseInt($("#order_product_pages").val());

function manualPages(){
	pages = parseInt($("#order_product_pages").val());
	var order_form_words;
	order_form_words = pages * 275;
	$("#order_form_words").html(order_form_words +" words.");
}

function addPages(event) {
	pages = pages + 1;
	var order_form_words;
	order_form_words = pages * 275;
	$("#order_form_words").html(order_form_words +" words.");
	$("#order_product_pages").val(pages);
};

function reducePages(event) {
	if(pages > 1){
		pages = pages - 1;
	}else{
		pages = 1;
	}
	var order_form_words;
	order_form_words = pages * 275;
	$("#order_form_words").html(order_form_words +" words.");
	$("#order_product_pages").val(pages);
};



var sources = parseInt($("#order_product_sources").val());

function manualSources() {
	sources = parseInt($("#order_product_sources").val());
}

function addSources(event) {
	sources = sources + 1;
	$("#order_product_sources").val(sources);
};

function reduceSources(event) {
	if(sources > 0){
		sources = sources - 1;
	}else{
		sources = 0;
	}
	$("#order_product_sources").val(sources);
};




$(document).ready(function(){
	$("#writer_pick").val("client");

	calculatePrice();
	//
	//words count
	var order_form_words;
	$("#order_form_words").html("550 words.")
	//
	var today = new Date();
	var default_date_1 = today.getTime()+864000000;
	var default_deadline = new Date(default_date_1)
	var dd;
	var dd_default = default_deadline.getDate();
	var mm = default_deadline.getMonth()+1;
	var yyyy = default_deadline.getFullYear();
	var hhh = default_deadline.getHours();
	var hhh_1 = hhh;
	var mins = default_deadline.getMinutes();
	if (mins < 10) {
		mins = '0'+mins;
	}else {

	}
	var today_timestamp = today.getTime();
	var end_of_today = today.setHours(23,59,59);
	var determinant = end_of_today - today_timestamp;


	if (hhh == 24) {
		hhh=0;
	}if (hhh < 10) {
		hhh='0'+hhh
	}else {

	}


	if (determinant<10800000) {
		dd = today.getDate()+1;

	}else if (determinant>10800000) {
		dd = today.getDate();
	}else {

	}


	if(dd_default<10){
		dd_default='0'+dd_default;
	}
	min_date = yyyy+'-'+mm+'-'+dd;

// // long date string logic
if (mm == 1) {
	mm = "Jan"
}else if (mm == 2) {
	mm = "Feb"
}else if (mm == 3) {
	mm = "Mar"
}else if (mm == 4) {
	mm = "Apr"
}else if (mm == 5) {
	mm = "May"
}else if (mm == 6) {
	mm = "Jun"
}else if (mm == 7) {
	mm = "Jul"
}else if (mm == 8) {
	mm = "Aug"
}else if (mm == 9) {
	mm = "Sep"
}else if (mm == 10) {
	mm = "Oct"
}else if (mm == 11) {
	mm = "Nov"
}else if (mm == 12) {
	mm = "Dec"
}else {

}


// Setting default deadline
default_date = mm+' '+dd_default;
document.getElementById("order_deadline_date").value = default_date;

if (hhh_1<12) {
	document.getElementById("order_deadline_time").value = hhh+' '+'AM';
}else if (hhh_1 >=12 ) {
	document.getElementById("order_deadline_time").value = parseInt(hhh) - 12 +' '+'PM';
}else {
	document.getElementById("order_deadline_time").value = hhh+' '+'Hrs';
}
document.getElementById("order_deadline_minutes").value = mins;
//end of setting default deadline

$("#writer_pick").val("client");

$("#toggle_pick_writer").click(function(){

	if(state == 'off'){
		state = "on";
		alterGlobal_r(state);
		$("#system_pick").css("display", "none");
		$("#client_pick").css("display", "block");
		$("#writer_pick").val("client");
		$("#b-trigger__text").text("Select the best writer for your paper.");
	}else{
		state = "off";
		alterGlobal_r(state);
		$("#system_pick").css("display", "block");
		$("#client_pick").css("display", "none");

		$("#b-trigger__text").text("Let us pick the best writer for your order for an additional payment of $9.99");

		$("#writer_pick").val("system");
	}

});

});