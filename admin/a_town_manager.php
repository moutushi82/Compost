<?php
include_once("../utility/config.php");
include_once("../utility/dbclass.php");
include_once("../utility/functions.php");

if (!isset($_SESSION[ADMIN_SESSION_VAR])) {
	header("location: index.php?p=login");
	exit();
}

$action = "";
$objDB = new DB();

if(isset($_REQUEST['action']) && $_REQUEST['action'] != ""){
	$action = $_REQUEST['action'];
}
//echo $action; die();
if($action == "add"){
	$townName = $_REQUEST['town_name'];
	$status = 1;
	
	$insertQuery = "INSERT INTO town SET name = '".$townName."', status = 1";
	$objDB->setQuery($insertQuery);
	$insertId = $objDB->insert();
	
	if($insertId > 0){
		$_SESSION[SUCCESS_MSG] = "Town added successfully.";
		header("location: index.php?p=town_list");
		exit();
	}
}

if($action == "edit"){
	$townId = $_REQUEST['town_id'];
	$townName = $_REQUEST['town_name'];
	$status = $_REQUEST['town_status'];
	
	$updateQuery = "UPDATE town SET name = '".$townName."', status = '".$status."' WHERE id = '".$townId."'";
	$objDB->setQuery($updateQuery);
	$updatedRow = $objDB->update();
	
	if($updatedRow){
		$_SESSION[SUCCESS_MSG] = "Town updated successfully.";
		header("location: index.php?p=town_list");
		exit();
	}
}
?>
