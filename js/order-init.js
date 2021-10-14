var global_r = null;
function alterGlobal_r(state){
	global_r = state;
}


function validateOrderInputs() {
	var order_description = $("#order_description").val();
	if (order_description == '' || order_description.length < 10) {
		$("#attract_writers").modal('show');
	}
	continueWithOrder();
}



function backToOrderForm(){
	$("#loginModal_1").modal('hide');
	$("#attract_writers").modal('hide');
}
