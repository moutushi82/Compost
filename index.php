<?php
include_once("utility/config.php");
include_once("utility/dbclass.php");
include_once("utility/functions.php");


//pr($_REQUEST);
ini_set('display_errors', 1);
error_reporting(E_ALL);
$objDB = new DB();

$p=loadVariable('p','order');
//echo "OK2"; die();
checkLogout();
//echo "OK3"; 
$p = securityCheck($p);

//echo "OK4"; die();
//echo $p; die();
$page = '';
if(!file_exists('includes/'.$p.'.php'))
	$page = 'page_error.php';	 
else
	$page = $p.'.php';

?>
<?php include_once("includes/header.php"); ?>
<?php include_once('includes/'.$page); ?>
<?php include_once("includes/footer.php"); ?>
