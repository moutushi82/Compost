function validateOrderForm(obj)
{
	//alert("Hello");
	var txt_email=$('#txtEmail').val();
	var pattern_email = new RegExp(/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/);
	var txt_phone=$('#txt_phone').val();
	var pattern_phone = new RegExp(/(\+*\d{1,})*([ |\(])*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/);
	var orderdate = $("#datepicker").val();
	var town = $("#selTown").val();
	
	if($.trim(orderdate) == "") {
		alert("Please enter a date.");
		$( "#datepicker" ).focus();
		return false;
	}else if($.trim(txt_email)==""){
		alert("Please enter an email address.");
		$( "#txtEmail" ).focus();
		return false;
	} else if(pattern_email.test(txt_email)==false){
		alert("Please enter a proper email address.");
		$( "#txtEmail" ).focus();
		return false;
	} else if($.trim(town) == "") {
		alert("Please Choose a Town.");
		$( "#selTown" ).focus();
		return false;
	} else {
		$("#form1").submit();
		return true;
	}
	
}

$("#orderSubmit").click(function(){
	
	
});
