function validateOrderForm(obj)
{
	//alert("Hello");
	var txt_email=$('#txtEmail').val();
	var txt_firstname=$('#txtFirstname').val();
	var txt_lastname=$('#txtLastname').val();
	var pattern_email = new RegExp(/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/);
	var txt_phone=$('#txt_phone').val();
	var pattern_phone = new RegExp(/(\+*\d{1,})*([ |\(])*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/);
	var orderdate = $("#datepicker").val();
	var town = $("#selTown").val();
	var WasteIn = $("#selWasteIn").val();
	var CompostOut = $("#selCompostOut").val();
	
	if($.trim(orderdate) == "") {
		$( "#formErrorDiv" ).css("display","block");
		$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please enter a date.</i>');
		//alert("Please enter a date.");
		$( "#datepicker" ).focus();
		return false;
	}else if($.trim(txt_firstname)==""){
		$( "#formErrorDiv" ).css("display","block");
		$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please enter your first name.</i>');
		//alert("Please enter an email address.");
		$( "#txtFirstname" ).focus();
		return false;
	} else if($.trim(txt_lastname)==""){
		$( "#formErrorDiv" ).css("display","block");
		$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please enter your last name.</i>');
		//alert("Please enter an email address.");
		$( "#txtLastname" ).focus();
		return false;
	} else if($.trim(txt_email)==""){
		$( "#formErrorDiv" ).css("display","block");
		$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please enter an email address.</i>');
		//alert("Please enter an email address.");
		$( "#txtEmail" ).focus();
		return false;
	} else if(pattern_email.test(txt_email)==false){
		$( "#formErrorDiv" ).css("display","block");
		$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please enter a proper email address.</i>');
		//alert("Please enter a proper email address.</i>');
		$( "#txtEmail" ).focus();
		return false;
	} else if($.trim(town) == "") {
		$( "#formErrorDiv" ).css("display","block");
		$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please Choose a Town.</i>');
		//alert("Please Choose a Town.");
		$( "#selTown" ).focus();
		return false;
	}else if($.trim(WasteIn) == "" && $.trim(CompostOut) == "") {
		$( "#formErrorDiv" ).css("display","block");
		$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please Choose Yard Waste IN OR Compost Out.</i>');
		$("#selWasteIn").focus();
		//$( "#selTown" ).focus();
		return false;
	} else {
		$( "#formErrorDiv" ).css("display","none");
		$( "#formErrorDiv" ).html("");
		$("#form1").submit();
		return true;
	}
	
}

function valid_login(){
	var txtusername=$('#username').val();
	var txtPassword=$('#password').val();
	var pattern_email = new RegExp(/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/);
	
	if($.trim(txtusername)==""){
		$( "#formErrorDiv" ).css("display","block");
		$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please enter username.</i>');
		//alert("Please enter an email address.");
		$( "#username" ).focus();
		return false;
	} else if($.trim(txtPassword)==""){
		$( "#formErrorDiv" ).css("display","block");
		$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please enter password.</i>');
		//alert("Please enter an email address.");
		$( "#password" ).focus();
		return false;
	} else {
		$( "#formErrorDiv" ).css("display","none");
		$( "#formErrorDiv" ).html("");
		$("#frmLogin").submit();
		return true;
	}
}

function showCustomerIdBox(){
	if($("#existingCus").is(':checked')){
		$("#customerIdDiv").css("display", 'block');
	}else{
		$("#customerIdDiv").css("display", 'none');
	}
}

function showCustomerDetails(cusId){
	//alert(cusId);
	var strData = {
					action: 'getcusdata',
					customerId : cusId
				 };
		$.ajax({url: "ajax_request.php",
			type: "POST",
			data: strData,
			success: function (data) {
				var trim_data=$.trim(data);
				//alert(trim_data);
				if(trim_data != "")
				{
					var dataArr = trim_data.split('|');
					$( "#txtFirstname" ).val(dataArr[0]);
					$( "#txtLastname" ).val(dataArr[1]);
					$( "#txtEmail" ).val(dataArr[2]);
					$( "#txtCompanyname" ).val(dataArr[3]);
					$( "#txtHousenumber" ).val(dataArr[4]);
					$( "#txtStreetname" ).val(dataArr[5]);
					//$( "#selTown" ).css('display','block')
					$( "#selTown" ).val(dataArr[6]);
				} else {
					$( "#formErrorDiv" ).css("display","block");
					$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please enter customer id.</i>');
				} 
			},
			  error: function(xhr,err) {
				  	$( "#formErrorDiv" ).css("display","block");
					$( "#formErrorDiv" ).html('<i class="fa fa-exclamation-triangle">Please enter customer id.</i>');
			  }
			
			});
}
