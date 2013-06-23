<?php
use darkowl\user_manager\webpage\cInfo;

use MidnightPublishing\User_Manager\cSession;

header("Content-type: application/x-javascript");
use \darkowl\user_manager\webpage;


/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

/**
 * Include Default Path Info
 */
require_once (dirname(__DIR__)) . "/conf/cInfo.php";

$obj_Config = new cInfo();
?>

var g_obj_Config = new Object(); 
g_obj_Config.m_str_ExtJs4Path = "<?php print($obj_Config->getParam(cInfo::C_STR_PARAM_EXT_4_LIB_PATH)); ?>";
g_obj_Config.m_str_UserName = "<?php print(cSession::getUserName())?>"; 
g_obj_Config.m_str_BaseURL ="/User_Manager";
g_obj_Config.m_str_LogoutURL =g_obj_Config.m_str_BaseURL+"/pages/logoutProcess.php"; 

g_obj_Config.m_bool_Add = true;
g_obj_Config.m_bool_Edit = true;
g_obj_Config.m_bool_Delete = true;

g_obj_Config.m_bool_Action_Add = true;
g_obj_Config.m_bool_Action_Edit = true;
g_obj_Config.m_bool_Action_Delete = true;

g_obj_Config.m_bool_App_Add = true;
g_obj_Config.m_bool_App_Edit = true;
g_obj_Config.m_bool_App_Delete = true;

g_obj_Config.m_bool_Group_Add = true;
g_obj_Config.m_bool_Group_Edit = true;
g_obj_Config.m_bool_Group_Delete = true;

