<?php
include_once("utility/config.php");
include_once("utility/dbclass.php");
include_once("utility/functions.php");

$action = "";
$objDB = new DB();
$date = "";
$month = "";
$day = "";
$year = "";
//pr($_REQUEST,0);
if(isset($_POST['frmSubmit']) && $_POST['frmSubmit'] == 1){
	
	if(isset($_REQUEST['date']) && $_REQUEST['date'] != ""){
		$dateArr = explode("-", $_REQUEST['date']);
		$month = $dateArr[1];
		$day = $dateArr[0];
		$year = $dateArr[2];
		
		$date = $year."-".$month."-".$day;
	}
	
	//echo $month."---".$day."---".$year; die();
	
	
	$firstname = $_REQUEST['txtFirstname'];
	$lastname = $_REQUEST['txtLastname'];
	$email = $_REQUEST['txtEmail'];
	$companyname = $_REQUEST['txtCompanyname'];
	$housenumber = $_REQUEST['txtHousenumber'];
	$streetname = $_REQUEST['txtStreetname'];
	$town = $_REQUEST['selTown'];
	$wastein = $_REQUEST['selWasteIn'];
	$compostout = $_REQUEST['selCompostOut'];
	//$comment = $_REQUEST['comment'];
	
	$isValidate = true;
	$errorMsg = "";
	if($_REQUEST['date'] == ""){
		$errorMsg .= "Please select a date.\n";
		$isValidate = false;
	} else if($email == "") {
		$errorMsg .= "Please select an email.\n";
		$isValidate = false;
	}else if($email != ""){
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errorMsg .= "Please select a proper email address.\n";
			$isValidate = false;
		}
	}else if($town == ""){
		$errorMsg .= "Please select a town.\n";
		$isValidate = false;
	}
	
	if(!$isValidate){
		$_SESSION[ERROR_MSG] = $errorMsg;
		header("location: index.php?p=order");
		exit();
	} else {
		$insertCustomer = "INSERT INTO customer SET
											firstname 	= '".$firstname."',
											lastname 	= '".$lastname."',
											companyname	= '".$companyname."',
											housenumber	= '".$housenumber."',
											streetname	= '".$streetname."',
											town		= '".$town."',
											email		= '".$email."',
											status		= 1";
		
		$objDB->setQuery($insertCustomer);
		$customerId = $objDB->insert();
		
		if($customerId > 0){
			$insertOrder = "INSERT INTO order_details SET
													customer_id = '".$customerId."',
													yardwastein	= '".$wastein."',
													compostout	= '".$compostout."',
													date		= '".$date."',
													month		= '".$month."',
													year		= '".$year."',
													status		= 1";
													
			//echo $insertQuery; die();
														
			$objDB->setQuery($insertOrder);
			$insertId = $objDB->insert();
			
			if($insertId > 0 && $email != ""){
				$townSql = "SELECT name FROM town WHERE id = '".$town."'";
				$objDB->setQuery($townSql);
				$town = $objDB->select();	
				
				$to = $email;
				$subject = "Order Details at UPT Compost";
				
				$contentMain = "";
				$contentMain .="Thank you for your order. Please check your order details. ";
				$contentMain .= "<br/><br/>";
				$contentMain .= "Customer ID: ".$customerId."<br>";
				$contentMain .= "Date: ".$_REQUEST['date']."<br>";
				$contentMain .= "Name: ".$firstname." ".$lastname."<br>";
				$contentMain .= "Email: ".$email."<br>";
				$contentMain .= "Company Name: ".$companyname."<br>";
				$contentMain .= "House Number: ".$housenumber."<br>";
				$contentMain .= "Street Name: ".$streetname."<br>";
				$contentMain .= "Town: ".$town[0]['name']."<br>";
				$contentMain .= "Yard Waste In: ".$wastein."<br>";
				$contentMain .= "Compost Out: ".$compostout."<br>";
				
				$contentRight = "";
				$contentRight .= "Welcome to UP Compost, Here you’ll find all you need to know about getting started as well as maintaining the process no matter which composting method you’ve chosen.";
	                
				$mailContent = file_get_contents("http://www.thethinkerz.co/compost/email_template/ordermail.html");
				$replaceFromArr = array('{USERNAME}', '{CONTENTMAIN}','{CONTENTRIGHT}');
				$replaceToArr = array($firstname." ".$lastname, $contentMain, $contentRight);
				$content = str_replace($replaceFromArr, $replaceToArr, $mailContent);
				
				$headers  = "From: UPT COMPOST <test@thethinkerz.com> \r\n";
				$headers .= 'MIME-Version: 1.0' . "\n";
				$headers .= 'Content-type: text/html; charset=utf-8';
				
				//echo $content."<br/>"; die();
				mail($to, $subject, $content, $headers);	
					
				$_SESSION[SUCCESS_MSG] = "Order is added successfully.";
				header("location: index.php?p=order");
				exit();
			}
		}
	}
} else {
	header("location: index.php?p=order");
 	exit();
}
?>