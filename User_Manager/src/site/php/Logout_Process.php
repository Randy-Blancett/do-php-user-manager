<?php
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
$obj_User->logout();

//	$m_obj_UserValidation->logout();
?>
Logged Out
