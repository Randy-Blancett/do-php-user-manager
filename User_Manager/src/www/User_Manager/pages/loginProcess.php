<?php
use MidnightPublishing\User_Manager\cSession;

use MidnightPublishing\User_Manager\cUser;

use\darkowl\user_manager\webpage;
/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';
/**
 * Include Default Path Info
 */
// require_once (dirname(__DIR__)) . "/php/conf/cInfo.php";


$obj_User = new cUser();

print(__LINE__."\n");

if(cUser::login($_POST["UserName"], $_POST["Password"],false))
{
	print(__LINE__."/n");
	output_Success();
}
else
{
	print(__LINE__."\n");
	output_Error("Failed to login, Either Password Or User Name was incorrect");
}


function output_Success()
{
	$arr_Output = array();
	$arr_Output["success"] = true;
	$arr_Output["url"] = cSession::getLastUrl();

	print(json_encode($arr_Output));
}

function output_Error($str_Message)
{
	$arr_Output = array();

	$arr_Output["success"] = false;
	$arr_Output["errors"] = array();
	$arr_Output["errors"]["msg"] = $str_Message;

	die(json_encode($arr_Output));
}
?>