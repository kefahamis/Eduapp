$(document).ready(function(){
	

});
$('#order_description').click(function(e){
	$('.js_co_description_wrapper').addClass('is-active');
	$(".order-form-v2__popup-bg").show();
});
$('.order-form-v2__popup-bg').click(function(e){
	$('.js_co_description_wrapper').removeClass('is-active');
	$(".order-form-v2__popup-bg").hide();
});
$('.js_co_description_close').click(function(e){
	$('.js_co_description_wrapper').removeClass('is-active');
	$(".order-form-v2__popup-bg").hide();
});