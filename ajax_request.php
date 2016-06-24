<?php
include_once("utility/config.php");
include_once("utility/dbclass.php");
include_once("utility/functions.php");

$customerId = "";
$action = "";
$objDB = new DB();

$action = $_POST['action'];
$customerId = $_POST['customerId'];
$customerDetails = "";
	
if($action == 'getcusdata' && $customerId != ""){
	
	
	
	$customerQuery = "SELECT * FROM customer WHERE id = '".$customerId."'";
	$objDB->setQuery($customerQuery);
	$customerData = $objDB->select();
	
	$customerDetails = $customerData[0]['firstname']."|".$customerData[0]['lastname']."|".$customerData[0]['email']."|".$customerData[0]['companyname']."|".$customerData[0]['housenumber']."|".$customerData[0]['streetname']."|".$customerData[0]['town'];
	
	echo $customerDetails; exit();
} else {
	echo $customerDetails; exit();
}



?>