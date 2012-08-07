<?php
use darkowl\user_manager\cSession;

header("Content-type: application/x-javascript");
use \darkowl\user_manager\webpage;
/**
 * Include Default Path Info
 */
require_once (dirname(__DIR__)) . "/conf/cInfo.php";

require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH . "/classes/cSession.php";
?>

var g_obj_Config = new Object(); g_obj_Config.m_str_ExtJs4Path = "<?php print(webpage\cInfo::C_STR_EXT4_LIB_PATH); ?>"; 
g_obj_Config.m_str_UserName = "<?php print(cSession::getUserName())?>"; 
g_obj_Config.m_str_LogoutURL ="/User_Manager/php/Logout_Process.php"; 
g_obj_Config.m_str_BaseURL ="/User_Manager";

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

