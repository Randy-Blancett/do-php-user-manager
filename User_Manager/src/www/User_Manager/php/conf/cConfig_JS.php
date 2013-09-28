<?php
use MidnightPublishing\User_Manager\cPermission;
use MidnightPublishing\User_Manager\cUser;
use MidnightPublishing\User_Manager\conf\cInfo;
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
//require_once (dirname(__DIR__)) . "/conf/cInfo.php";
$obj_Config			 = new cInfo();

$obj_User = new cUser();
$obj_User->checkPermissions(cPermission::C_STR_USERMANAGER_ADD_ACTIONS)
?>

var g_obj_Config = new Object(); 
g_obj_Config.m_str_ExtJs4Path = "<?php print($obj_Config->getParam(cInfo::C_STR_PARAM_EXT_4_LIB_PATH)); ?>";
g_obj_Config.m_str_UserName = "<?php print(cSession::getUserName()) ?>"; 
g_obj_Config.m_str_BaseURL ="/User_Manager";
g_obj_Config.m_str_LogoutURL =g_obj_Config.m_str_BaseURL+"/pages/logoutProcess.php"; 

g_obj_Config.m_bool_Add = <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_ADD_USERS)); ?>;
g_obj_Config.m_bool_Edit = <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_EDIT_USERS)); ?>;
g_obj_Config.m_bool_Delete = <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_DElETE_USERS)); ?>;

g_obj_Config.m_bool_Action_Add = <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_ADD_ACTIONS)); ?>;
g_obj_Config.m_bool_Action_Edit = <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_EDIT_ACTIONS)); ?>;
g_obj_Config.m_bool_Action_Delete = <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_DElETE_ACTIONS)); ?>;

g_obj_Config.m_bool_App_Add =  <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_ADD_APPS)); ?>;
g_obj_Config.m_bool_App_Edit = <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_EDIT_APPS)); ?>;
g_obj_Config.m_bool_App_Delete =  <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_DElETE_APPS)); ?>;

g_obj_Config.m_bool_Group_Add =  <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_ADD_GROUPS)); ?>;
g_obj_Config.m_bool_Group_Edit =  <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_EDIT_GROUPS)); ?>;
g_obj_Config.m_bool_Group_Delete =  <?php print($obj_User->checkPermissionString(cPermission::C_STR_USERMANAGER_DElETE_GROUPS)); ?>;

