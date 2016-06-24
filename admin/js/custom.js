function DemoRegistration(obj)
{
	//alert("Hello");
	var txt_fullname=$('#txt_fullname').val();
	var txt_fathername=$('#txt_fathername').val();
	var txt_email=$('#txt_email').val();
	var pattern_email = new RegExp(/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/);
	var txt_phone=$('#txt_phone').val();
	var pattern_phone = new RegExp(/(\+*\d{1,})*([ |\(])*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/);
	var txt_dob=$('#txt_dob').val();
	var txt_address1=$('#txt_address1').val();
	var txt_address2=$('#txt_address2').val();
	var txt_city=$('#txt_city').val();
	var txt_state=$('#txt_state').val();
	var txt_postal=$('#txt_postal').val();
	var txt_country=$('#txt_country').val();
	var sel_accounttype=$('#sel_accounttype').val();
	var txt_leverage=$('#txt_leverage').val();
	var txt_profile_pass=$('#txt_profile_pass').val();
	var txt_profile_re_pass=$('#txt_profile_re_pass').val();
	var txt_trading_pass=$('#txt_trading_pass').val();
	var txt_trading_re_pass=$('#txt_trading_re_pass').val();
	var txt_phone_pass=$('#txt_phone_pass').val();
	var txt_phone_re_pass=$('#txt_phone_re_pass').val();
	var txt_referrer_id=$('#txt_referrer_id').val();
	var txt_registration_type=$('#txt_registration_type').val();
	if($.trim(txt_fullname)=="")
	{
		alert("Your Full Name Missing.");
	}
	else if($.trim(txt_email)=="")
	{
		alert("Your Email Id Missing.");
	}
	else if(pattern_email.test(txt_email)==false)
	{
		alert("Invalid Email Supply");
	}
	else if($.trim(txt_phone)=="")
	{
		alert("Your Phone No Missing.");
	}
	else if(pattern_phone.test(txt_phone)==false)
	{
		alert("Invalid Phone No Supply");
	}
	else if($.trim(sel_accounttype)=="")
	{
		alert("Choose Account Type Missing.");
	}
	else if($.trim(txt_leverage)=="")
	{
		alert("Your Leverage Missing.");
	}
	else if($.trim(txt_profile_pass)!=$.trim(txt_profile_re_pass))
	{
		alert("Your Profile Password and Profile Repeat Password Does Not Match.");
	}
	else if($.trim(txt_trading_pass)!=$.trim(txt_trading_re_pass))
	{
		alert("Your Trading Password and Trading Repeat Password Does Not Match.");
	}
	else if($.trim(txt_phone_pass)!=$.trim(txt_phone_re_pass))
	{
		alert("Your Trading Phone Password and Trading Phone Repeat Password Does Not Match.");
	}
	else if($.trim(txt_trading_pass)=="")
	{
		alert("Your Trading Password Missing.");
	}
	else if($.trim(txt_phone_pass)=="")
	{
		alert("Your Trading Phone No Password Missing.");
	}
	
	else if($.trim(txt_registration_type)=="")
	{
		window.location.href="../home";
	}
	else{
		$(obj).ajaxSubmit({
			
			success:DemoRegistrationSuccess
			
		});
	}
	return false;
}

function DemoRegistrationSuccess(returnData)
{
	if($.trim(returnData)==1)
	{
		alert("Your Registration is Successful");
		$('#Form1')[0].reset();
	}
	else
	{
		alert(returnData);
	}
}


function loginSubmit(obj)
{
	//alert("Hello");
	var txt_email=$('#txt_email').val();
	var pattern_email = new RegExp(/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/);
	var txt_password=$('#txt_password').val();
	if($.trim(txt_email)=="")
	{
		alert("Your Email Id Missing.");
	}
	else if(pattern_email.test(txt_email)==false)
	{
		alert("Invalid Email Supply");
	}
	else if($.trim(txt_password)=="")
	{
		alert("Your Password is Blank.");
	}
	else{
		$(obj).ajaxSubmit({
			success:loginSubmitSuccess
		});
	}
	return false;
}

function loginSubmitSuccess(returnData)
{
	//alert(Data);
	if($.trim(returnData)==1)
	{
		//alert("Login Successfull.");
		window.location.href="index.php?p=after_login";
	}
	else{
		alert(returnData);
	}
}

function registration_details_update(obj)
{
	var txt_fullname=$('#txt_fullname').val();
	var txt_fathername=$('#txt_fathername').val();
	var txt_email=$('#txt_email').val();
	var pattern_email = new RegExp(/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/);
	var txt_phone=$('#txt_phone').val();
	var pattern_phone = new RegExp(/(\+*\d{1,})*([ |\(])*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/);
	var txt_dob=$('#txt_dob').val();
	var txt_address1=$('#txt_address1').val();
	var txt_address2=$('#txt_address2').val();
	var txt_city=$('#txt_city').val();
	var txt_state=$('#txt_state').val();
	var txt_postal=$('#txt_postal').val();
	var txt_country=$('#txt_country').val();
	var sel_accounttype=$('#sel_accounttype').val();
	var txt_referrer_id=$('#txt_referrer_id').val();
	if($.trim(txt_fullname)=="")
	{
		alert("Your Full Name Missing.");
	}
	else if($.trim(txt_email)=="")
	{
		alert("Your Email Id Missing.");
	}
	else if(pattern_email.test(txt_email)==false)
	{
		alert("Invalid Email Supply");
	}
	else if($.trim(txt_phone)=="")
	{
		alert("Your Phone No Missing.");
	}
	else if(pattern_phone.test(txt_phone)==false)
	{
		alert("Invalid Phone No Supply");
	}
	else if($.trim(sel_accounttype)=="")
	{
		alert("Choose Account Type Missing.");
	}
	
	else{
		$(obj).ajaxSubmit({
			success:registration_details_update_success
		});
	}
	
	return false;
}

function registration_details_update_success(return_data)
{
	if($.trim(return_data)==1)
	{
		$('#showMsg').text("Profile Updated Successfully updated.");
		location.reload();
	}
	else{
		alert(return_data);
		$('#showMsg').text(return_data);
	}
}


$('.add_topup').click(function(){
	$.post("add_topup.php",function(result){
		//alert(result);
		if($.trim(result)==1)
		{
			alert("TopUp Added Successfully");
			window.location.href="index.php?p=after_login";
		}
		else
		{
			alert("Unable To Add TopUp");
		}
		
	});
});

$('.submit_topup').click(function(){
	var top_up=$('#top_up').val();
	$.post("add_topup.php",{top_up:top_up},function(result){
		if($.trim(result)==1)
		{
			alert(top_up+" topup added successfully");
			window.location.href="index.php?p=after_login";
		}
	});
});



function internal_transfer(obj)
{
	var from_account=$.trim($('#from_account').val());
	var to_account=$.trim($('#to_account').val());
	var amount=$.trim($('#amount').val());
	if(from_account=="")
	{
		alert("Choose Your From Account");
	}
	else if(to_account=="")
	{
		alert("Choose Your To Account");
	}
	else if(amount=="")
	{
		alert("Transfer Amout is Blank");
	}
	else{
		$(obj).ajaxSubmit({
			success:internal_transfer_success
		});
	}
	return false;
}

function internal_transfer_success(returnData)
{
	if($.trim(returnData)==1)
	{
		alert("Internal Transfer successfully done");
		window.location.href="index.php?p=internal_transfer";
	}
	else if($.trim(returnData)==0)
	{
		window.location.href="index.php?p=internal_transfer";
	}
	else{
		alert(returnData);
	}
}

$('.account_details').on('change', function() {

	//alert($(this).val());
	var account_details=$.trim($(this).val());
	var explode=account_details.split(":");
	if(explode[1]=="trading_account_details")
	{
		window.location.href="index.php?p=trading_account_details&trading_id="+explode[0];
	}
	else if(explode[1]=="change_trading_password")
	{
		window.location.href="index.php?p=change_trading_password&trading_id="+explode[0];
	}
	else if(explode[1]=="change_leverage")
	{
		window.location.href="index.php?p=change_leverage&trading_id="+explode[0];
	}
	else if(explode[1]=="close_trading_account")
	{
		//window.location.href="index.php?p=close_trading_account&trading_id="+explode[0];
		var trading_id=explode[0];
		var account_status=explode[2];
		$.post("close_trading_account.php",{trading_id:trading_id,account_status:account_status},function(result){
		
			if($.trim(result)==1)
			{
				alert("Your Trading Account Closeed Successfully");
				window.location.href="index.php?p=account_overview";
			}
			else if($.trim(result)==2)
			{
				alert("Your Trading Account Activated Successfully");
				window.location.href="index.php?p=account_overview";
			}
			else if($.trim(result)==0)
			{
				window.location.href="index.php?p=account_overview";
			}
			else{
				alert(result);
			}
		
		});
		
	}
	else{
		alert("Invalid data supply");
	}
	
});


$('.change_trading_account_pass').click(function(){

	var new_password=$.trim($('#new_password').val());
	var confirm_password=$.trim($('#confirm_password').val());
	var trading_account_id=$.trim($('#trading_account_id').val());
	
	if(new_password=="")
	{
		alert("Don't forget to put New Password");
	}
	else if(confirm_password=="")
	{
		alert("Don't forget to put Confirm Password");
	}
	else if(new_password!=confirm_password)
	{
		alert("New Password and Confirm Password not match");
	}
	else{
		$.post("change_trading_password.php",{new_password:new_password,trading_account_id:trading_account_id},function(result){
		
			if($.trim(result)==1)
			{
				alert("Your Trading Password Change Successfully");
				window.location.href="index.php?p=account_overview";
			}
			else if($.trim(result)==0)
			{
				window.location.href="index.php?p=account_overview";
			}
			else{
				alert(result);
			}
		});
	}
	return false;
	
});


function leverage_change(obj)
{
	var amount=$.trim($('#amount').val());
	var trading_id_for_leverage=$.trim($('#trading_id_for_leverage').val());
	if(amount=="")
	{
		alert("Don't forget to give Leverage Amount");
	}
	else if(trading_id_for_leverage==""){
		alert("Invalid Trading ID");
	}
	else{
		$(obj).ajaxSubmit({
			success:leverage_change_success
		});
	}
	return false;
}

function leverage_change_success(returnData)
{
	if($.trim(returnData)==1)
	{
		alert("Your Account Leverage Change Successfully");
		window.location.href="index.php?p=account_overview";
	}
	else if($.trim(returnData)==0)
	{
		window.location.href="index.php?p=account_overview";
	}
	else{
		alert(returnData);
	}
}



function validateDepositForm(obj)
{
	var townName = $.trim($('#town_name').val());
	
	if(townName=="")
	{
		alert("Please add a town name.");
		return false;
	}
	
	return true;
}

function validateDepositFormSuccess(returnData)
{
	if($.trim(returnData)==1)
	{
		alert("You Deposit Successfully");
		window.location.href="index.php?p=deposits";
	}
	else
	{
		window.location.href="index.php?p=deposits";
	}
}

function validateWithdrawalForm(obj)
{
	var tradingAccounts=$.trim($('#tradingAccounts').val());
	var currency=$.trim($('#currency').val());
	var deposit_method=$.trim($('#deposit_method').val());
	var amount=$.trim($('#amount').val());
	if(tradingAccounts=="")
	{
		alert("Don't forget to choose Trading Account");
	}
	else if(currency=="")
	{
		alert("Don't forget to give Currency");
	}
	else if(deposit_method=="")
	{
		alert("Don't forget to choose Deposit Method");
	}
	else if(amount=="")
	{
		alert("Don't forget to give Transfer Amount");
	}
	else{
		$(obj).ajaxSubmit({
			success:validateWithdrawalFormSuccess
		});
	}
	return false;
}

function validateWithdrawalFormSuccess(returnData)
{
	if($.trim(returnData)=="")
	{
		alert("You Withdrawal Successfully");
		window.location.href="index.php?p=withdrawals";
	}
	else
	{
		window.location.href="index.php?p=withdrawals";
	}
}

function validateFileUploadForm(){
	
	var documentType=$.trim($('#documentType').val());
	var document=$.trim($('#document').val());
	
	if(documentType=="")
	{
		alert("Please select a document type.");
		return false;
	}
	else if(document=="")
	{
		alert("Please upload a file.");
		return false;
	}
	
	return true;

	
	//return validate;
}


$('.submit_deposit_to_mt4').click(function(){

	var deposit_to_mt4=$.trim($('#deposit_to_mt4').val());
	//var tradingAccounts=$.trim($('#tradingAccounts').val());
	var transaction_type="MT4";
	if(deposit_to_mt4=="")
	{
		alert("Deposit To MT4 Transfer Amount Can't be Blank");
	}
	else if(deposit_to_mt4==0)
	{
		alert("Deposit To MT4 Transfer Amount Can't be 0");
	}
	else
	{
		$.post("deposit_to_mt4.php",{deposit_to_mt4:deposit_to_mt4,transaction_type:transaction_type, transfer_from:'deposit'},function(result){
			//alert(result);
			if($.trim(result)==1)
			{
				alert("Successfully Transfer");
				window.location.href="index.php?p=after_login";
			}
			else if($.trim(result)==1)
			{
				alert("Unable to Transfer");
			}
		});
	}

});


$('.submit_loss_after_trading').click(function(){
	var loss_after_trading=$.trim($('#loss_after_trading').val());
	var trading_amount = $.trim($('#trading_amount').val());
	if(trading_amount == ""){
		
		alert("Don't Forget To Add Some Trading Amount");
		
	} else if(loss_after_trading=="")
	{
		alert("Don't Forget To Give Loss Amount");
	}
	else if(loss_after_trading==0)
	{
		alert("Loss Amount Can't be 0");
	}
	else
	{
		$.post("loss_after_trading.php",{loss_after_trading:loss_after_trading,trading_amount:trading_amount},function(result){
		
			if($.trim(result)==1)
			{
				alert("Loss Amount Added Successfully");
				window.location.href="index.php?p=after_login";
			}
			else if($.trim(result)==2)
			{
				alert("You does not have enough balance for trading.");
			} else {
				alert("Unable to complete your transaction.");
			}
		});
	}
});

$('.get_lone').click(function(){
	$.post('get_loan.php',function(result){
		//alert(result);
		if($.trim(result)==1)
		{
			alert("Loan Successfully Done");
			window.location.href="index.php?p=after_login";
		}
		else if($.trim(result)==0)
		{
			alert('Unable to complete transaction.');
		} else {
			alert($.trim(result));
		}
	});
});



$('.mt4_balance_repair').click(function(){

$.post('add_repair.php',function(result){
	//alert(result);
		if($.trim(result)==1)
		{
			alert("Repair Complete Successfully");
			window.location.href="index.php?p=after_login";
		}
		else
		{
			alert("Unable to complete Repair");
		}
});

});


$('.submit_profit_after_trading').click(function(){

	var profit_after_trading=$.trim($('#profit_after_trading').val());
	var trading_amount = $.trim($('#trading_amount').val());
	
	if(trading_amount == ""){
		alert("Don't Forget To Add Some Trading Amount");
	} else if(profit_after_trading=="")
	{
		alert("Don't Forget To Give Profit Amount");
	}
	else if(profit_after_trading==0)
	{
		alert("Profit Amount Can't be 0");
	}
	else{
		$.post('profit_after_trading.php',{profit_after_trading:profit_after_trading, trading_amount:trading_amount},function(result){
			//alert(result);
			if($.trim(result)==1)
			{
				alert("Profit Amount Added Successfully");
				window.location.href="index.php?p=after_login";
			}
			else if($.trim(result)==2)
			{
				alert("You does not have enough balance for trading.");
			} else {
				alert("Unable to complete your trading details");
			}
		});
	}
	
});




function screensize() {
    var pg_height = $( ".sidebar" ).height();
 $('body>div.content').css("min-height",pg_height);
};
$( document ).ready(function() {
 screensize(); 
});
$( window ).resize(function() {
  screensize();
});

function add_external_transfer(obj)
{
	var external_transfer_method=$.trim($('#external_transfer_method').val());
	var amount=$.trim($('#amount').val());
	if(external_transfer_method=="")
	{
		alert("Please Choose Transfer Method Type");
	}
	else if(amount=="")
	{
		alert("Transfer Amount is Blank.");
	}
	else{
		//alert("hello");
		$(obj).ajaxSubmit({
			
			success:add_external_transfer_success
			
		});
	}
	return false;
}

function add_external_transfer_success(data)
{
	//alert("Hello");
	if($.trim(data)==1)
	{
		alert("Transfer Amount Added Successfully");
		window.location.href="index.php?p=external_transfer";
	}
	else
	{
		alert(data);
	}
}

$('.transfer_to_deposit').click(function(){
	var mt4_to_deposit = $.trim($('#mt4_to_deposit').val());
	$.post("transfer_to_deposit.php",{mt4_to_deposit:mt4_to_deposit},function(result){
		
		//alert(result);
		if($.trim(result)==1)
		{
			alert("Profit Balance Transfer Successfully");
			location.reload();
		}
		else
		{
			alert("Unable to Transfer Profit Balance");
		}
		
	});
	
	
	
});

$('.reset_all_table').click(function(){
	
	$.post("reset_data.php",function(result){
		
		if($.trim(result)==1)
		{
			location.reload();
		}
		
	});
	
});

$("#submitInternalTransferMT4").click(function(){
	var transferType = "";
	var validateForm = true;
	var validateTotalDepositamount = true;
	var validateTotalTradableAmount = true;
	var depositAmount = "";
	var fromDeposit = $("#totalDepositamount").val();
	var fromTradableCredit = $("#totalTradableAmount").val();
	var maxTransferAmount  = "";
	var totalTradableCredit = $("#totalTradableCredit").val();
	var totalDepositBalance = $("#totalDepositBalance").val();
	
	alert(fromTradableCredit); alert(totalTradableCredit);
	
	
	transferType = 'deposit';
	if($("#depositamount").val() == ""){
		validateForm = false;
		alert("Please enter deposit amount.");
	} else {
		depositAmount = $("#depositamount").val();
	}
	
	if($("#totalDepositamount").val() == ""){
		validateTotalDepositamount = false;
		alert("Please enter amount for From Deposit section.");
	} else if(parseInt(fromDeposit) > parseInt(totalDepositBalance)){
		validateForm = false;
		alert("You does not have enough balance in deposit to transfer.");
	}
	
	if($("#totalTradableAmount").val() == ""){
		validateTotalTradableAmount = false;
		alert("Please enter amount for From Tradable Credit section.");
	} else if(parseInt(fromTradableCredit) > parseInt(totalTradableCredit)){
		validateForm = false;
		alert("You does not have enough balance in tradable credit to transfer.");
	} else {
		maxTransferAmount = $('#depositamount').attr('max');
		if(parseInt(fromTradableCredit) > parseInt(maxTransferAmount)){
			validateForm = false;
			alert("You can only transfer 50% of your tradable credit.");
		}
	}
	
	if(!validateTotalDepositamount && !validateTotalTradableAmount){
		validateForm = false;
	}
	
	if(validateForm){
		$.post("internal_transfer_amount.php",{transferType:transferType,depositAmount:depositAmount,fromDeposit:fromDeposit,fromTradableCredit:fromTradableCredit},function(result){
			//alert(result);
			if($.trim(result)==1)
			{
				alert("Tradable Credit Transferred Successfully");
				location.reload();
			} else if($.trim(result) == 2) {
				alert("Please enter all required data.");
			} else if($.trim(result) == 3) {
				alert("Total of From Deposit & From Tradable Credit should be equal to Transfer Amount.");
			} else {
				alert("Unable to Transfer Tradable Credit.");
			}
			
		});
	} else {
		alert("Please enter all required data.");
	}
});

$("#submitInternalTransferMember").click(function(){
	var transferType = "";
	var validateForm = true;
	var depositAmount = "";
	var memberAccount = "";
	var maxTransferAmount  = "";
	
	transferType = 'member';
	if($("#depositAmountMember").val() == ""){
		validateForm = false;
		alert("Please enter deposit amount.");
	} else if($("#to_account").val() == ""){
		validateForm = false;
		alert("Please select a member account.");
	}
	depositAmount = $("#depositAmountMember").val();
	memberAccount = $("#to_account").val();
	
	if(validateForm){
		$.post("internal_transfer_amount.php",{transferType:transferType,depositAmount:depositAmount,memberAccount:memberAccount},function(result){
			//alert(result);
			if($.trim(result)==1)
			{
				alert("Tradable Credit Transferred Successfully");
				location.reload();
			} else if($.trim(result)==2)
			{
				alert("Please enter all required data.");
			} else
			{
				alert("Unable to Transfer Tradable Credit.");
			}
			
		});
	} else {
		alert("Please enter all required data.");
	}
});
