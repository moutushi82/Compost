<?php
include_once("../utility/config.php");
include_once("../utility/dbclass.php");
include_once("../utility/functions.php");

$objDB = new DB();

$username=loadVariable('username','');
$password=loadVariable('password','');

$Query = "SELECT * FROM user WHERE username ='".$username."' AND password ='".$password."' AND status = 1";
$objDB->setQuery($Query);
$rs = $objDB->select();
//echo "<pre>"; var_dump($rs); die();

if(count($rs) == 1 )
{

	$objDB->close();
	$_SESSION[ADMIN_SESSION_VAR] = $rs[0]['id'];
	//$_SESSION[ADMIN_TYPE] = 1;
	header("location: index.php?p=order_details");
	exit();
}
else
{
	$objDB->close();
	header("location: index.php?p=login");
	exit();
}


?>