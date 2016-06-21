<?php
include_once ("../utility/config.php");
include_once ("../utility/dbclass.php");
include_once ("../utility/functions.php");

ini_set('display_errors', 1);
//echo "OK4"; die();
//pr($_REQUEST['id']);
$objDB = new DB();

$page = "login";
if(isset($_SESSION[ADMIN_SESSION_VAR])) {
	$page = "order_details";
}

$p = loadVariable('p', $page);

checkLogout();
$p = securityCheck($p);

//echo $p; die();

//echo "OK1"; die();
$page = '';
if (!file_exists('includes/' . $p . '.php'))
	$page = 'page_error.php';
else
	$page = $p . '.php';

//echo $page; die();

?>
<?php 
include_once("includes/header.php");
include_once("includes/".$page);
include_once("includes/footer.php");
 
?>