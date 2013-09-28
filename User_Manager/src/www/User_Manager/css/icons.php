<?php
/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';
header("Content-type: text/css");
use MidnightPublishing\User_Manager\conf\cInfo;

$obj_Config			 = new cInfo();
$obj_IconPath		 = $obj_Config->getParam(cInfo::C_STR_PARAM_ICON_PATH);
?>
@CHARSET "ISO-8859-1";

/*Menu Icons*/
.menu-action-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/key.gif") !important;
}

.menu-action-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/key_add.gif") !important;
}

.menu-action-view-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/key_go.gif") !important;
}

.menu-application-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application.gif") !important;
}

.menu-application-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application_add.gif") !important;
}

.menu-application-view-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application_go.gif") !important;
}

.menu-config-icon
{
background-image: url("<?php print($obj_IconPath) ?>/fam/cog_edit.gif") !important;
width: 16;
height: 16;
left: 0;
top: 0;
}

.menu-create-db-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/database_gear.gif") !important;
}

.menu-logout-icon 
{
background-image: 	url("<?php print($obj_IconPath) ?>/fam/door_in.gif") !important;
left			:	0px;
top				:	0px;
width			: 	16px;
height			: 	16px;
}

.menu-group-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group.gif") !important;
}

.menu-group-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_add.gif") !important;
}

.menu-group-view-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_go.gif") !important;
}

.menu-user-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user.gif") !important;
}

.menu-user-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user_add.gif") !important;
}

.menu-user-view-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user_go.gif") !important;
}

/*Toolbar Icons*/
.toolbar-search-config-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application_form_magnify.gif") !important;
}

.toolbar-action-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/key_add.gif") !important;
}

.toolbar-action-delete-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/key_delete.gif") !important;
}

.toolbar-action-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/script_key.gif") !important;
}

.toolbar-app-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application_add.gif") !important;
}

.toolbar-app-delete-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application_delete.gif") !important;
}

.toolbar-app-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application_edit.gif") !important;
}

.toolbar-group-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_add.gif") !important;
}

.toolbar-group-delete-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_delete.gif") !important;
}

.toolbar-group-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_edit.gif") !important;
}

.toolbar-user-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user_add.gif") !important;
}

.toolbar-user-delete-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user_delete.gif") !important;
}

.toolbar-user-group-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_edit.gif") !important;
}

.toolbar-user-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user_edit.gif") !important; 
}

/*Window Icons*/
.window-action-add-icon { 
background-image: url("<?php print($obj_IconPath) ?>/fam/key_add.gif") !important;
}

.window-action-edit-icon { 
background-image: url("<?php print($obj_IconPath) ?>/fam/key_edit.gif") !important;
}

.window-action-view-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/key_go.gif") !important;
}

.window-application-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application_add.gif") !important;
}

.window-application-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application_edit.gif") !important;
}

.window-application-view-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/application_go.gif") !important;
}

.window-config-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/cog_edit.gif") !important;
}

.window-create-db-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/database_gear.gif") !important;
}

.window-login-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/key.gif") !important;
}

.window-group-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_add.gif") !important;
}

.window-group-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_edit.gif") !important;
}

.window-group-view-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_go.gif") !important;
}

.window-user-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user.gif") !important;
}

.window-user-group-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_edit.gif") !important;
}

.window-user-perm-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/key_go.gif") !important;
}

.window-user-add-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user_add.gif") !important;
}

.window-user-view-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user_go.gif") !important;
}

.window-user-edit-icon 
{
background-image: url("<?php print($obj_IconPath) ?>/fam/user_edit.gif") !important;
}

/*Quick Start Icons*/

.quickstart_logout_icon
{
background-image: url("<?php print($obj_IconPath) ?>/fam/door_in.gif") !important;
}