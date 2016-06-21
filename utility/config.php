<?php
ob_start();
session_start();
//date_default_timezone_set('');

//ini_set('allow_call_time_pass_reference','On');

ini_set('display_error','On');
error_reporting(E_ALL);


ini_set('memory_limit','64M');
ini_set('post_max_size','20M');
ini_set('max_execution_time',0);
ini_set('max_input_time',120);

define('__CONFIG__','__CONFIG__');


if($_SERVER['HTTP_HOST'] == 'localhost')
{
	/*define('DBHOST','localhost');
	define('DBNAME','wayshine_live');
	define('DBUSER','');
	define('DBPASSWORD','');*/
	
	define('DBHOST','localhost');
	define('DBNAME','compost');
	define('DBUSER','root');
	define('DBPASSWORD','root');
	
}
else
{
	define('DBHOST','198.71.225.56:3306');
	define('DBNAME','thethinkerzteam_compost');
	define('DBUSER','thinkerzcompost');
	define('DBPASSWORD','eGw226b~');
	

}

define('INVOICE_PREFIX' , 'WSB');

define('SITE_TABLE_PREFIX','');

define('USER_SESSION_VAR','userId');
define('ADMIN_SESSION_VAR','adminId');
define('ADMIN_TYPE','adminType');  //type = 1 super admin , type = 2 subadmin


define('USER_TYPE','userType');
define('DSC_CODE','dscCode');

define('SUCCESS_MSG','successMsg');
define('ERROR_MSG','errorMsg');

define('USER_UNSECURED_PAGES', "order");

define('ADMIN_UNSECURED_PAGES', "login,forgot_pass,town_list,add_edit_town,order_details");

define('COMPANY_NAME','Compost');

define('TOTAL_PREMIUM_YEARS',3);

?>