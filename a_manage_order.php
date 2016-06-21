<?php
include_once("utility/config.php");
include_once("utility/dbclass.php");
include_once("utility/functions.php");

$action = "";
$objDB = new DB();

$month = "";
$day = "";
$year = "";
//pr($_REQUEST,0);
if(isset($_POST['frmSubmit']) && $_POST['frmSubmit'] == 1){
	
	
	if(isset($_REQUEST['date']) && $_REQUEST['date'] != ""){
		$dateArr = explode("-", $_REQUEST['date']);
		$month = $dateArr[1];
		$day = $dateArr[2];
		$year = $dateArr[0];
	}
	
	//echo $month."---".$day."---".$year; die();
	
	//$date = $_REQUEST['month']."/".$_REQUEST['day']."/".$_REQUEST['year'];
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
		$insertQuery = "INSERT INTO order_details SET
													firstname 	= '".$firstname."',
													lastname 	= '".$lastname."',
													companyname	= '".$companyname."',
													housenumber	= '".$housenumber."',
													streetname	= '".$streetname."',
													town		= '".$town."',
													yardwastein	= '".$wastein."',
													compostout	= '".$compostout."',
													email		= '".$email."',
													date		= '".$_REQUEST['date']."',
													month		= '".$month."',
													year		= '".$year."',
													status		= 1";
													
		//echo $insertQuery; die();
													
		$objDB->setQuery($insertQuery);
		$insertId = $objDB->insert();
		
		if($insertId > 0){
			$townSql = "SELECT name FROM town WHERE id = '".$town."'";
			$objDB->setQuery($townSql);
			$town = $objDB->select();	
			
			$to = $email;
			$subject = "Order Details at UPT Compost";
			
			$mailContent = file_get_contents("http://www.thethinkerz.co/compost/email_template/ordermail.html");
			$replaceFromArr = array('{DATE}', '{NAME}','{EMAIL}', '{COMPANYNAME}', '{HOUSENUMBER}', '{STREETNAME}', '{TOWN}', '{WASTEIN}', '{WASTEOUT}');
			$replaceToArr = array($_REQUEST['date'], $firstname." ".$lastname, $email, $companyname, $housenumber, $streetname, $town[0]['name'], $wastein, $compostout);
			$content = str_replace($replaceFromArr, $replaceToArr, $mailContent);
			
			$msg = "";
			
			$headers  = "From: Vision Physique Fitness <test@thethinkerz.com> \r\n";
			$headers .= 'MIME-Version: 1.0' . "\n";
			$headers .= 'Content-type: text/html; charset=utf-8';
			
			//echo $content."<br/>"; die();
			
			mail($to, $subject, $content, $headers);	
				
			$_SESSION[SUCCESS_MSG] = "Order added successfully.";
			header("location: index.php?p=order");
			exit();
		}
	}
} else {
	header("location: index.php?p=order");
 	exit();
}
?>