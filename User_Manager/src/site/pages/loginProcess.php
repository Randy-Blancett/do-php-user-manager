<?php
use darkowl\user_manager\cSession;

use darkowl\user_manager\cUser;

use\darkowl\user_manager\webpage;
/**
 * Include Default Path Info
 */
require_once (dirname(__DIR__)) . "/php/conf/cInfo.php";

/**
 * Include User Validation Class
 */
require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH . "/classes/cUser.php";

$obj_User = new cUser();

if(cUser::login($_POST["UserName"], $_POST["Password"],false))
{
	output_Success();
}
else
{
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