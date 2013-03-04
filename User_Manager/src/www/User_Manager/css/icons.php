<?php
	header("Content-type: text/css");
	use \darkowl\user_manager\webpage\cInfo;
	require_once dirname(__DIR__).'/php/conf/cInfo.php';
?>
@CHARSET "ISO-8859-1";

/*Menu Icons*/
.menu-action-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key.gif") !important;
}

.menu-action-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key_add.gif") !important;
}

.menu-action-view-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key_go.gif") !important;
}

.menu-application-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application.gif") !important;
}

.menu-application-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application_add.gif") !important;
}

.menu-application-view-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application_go.gif") !important;
}

.menu-create-db-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/database_gear.gif") !important;
}

.menu-logout-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/door_in.gif") !important;
}

.menu-group-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group.gif") !important;
}

.menu-group-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_add.gif") !important;
}

.menu-group-view-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_go.gif") !important;
}

.menu-user-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user.gif") !important;
}

.menu-user-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user_add.gif") !important;
}

.menu-user-view-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user_go.gif") !important;
}

/*Toolbar Icons*/
.toolbar-search-config-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application_form_magnify.gif") !important;
}

.toolbar-action-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key_add.gif") !important;
}

.toolbar-action-delete-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key_delete.gif") !important;
}

.toolbar-action-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/script_key.gif") !important;
}

.toolbar-app-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application_add.gif") !important;
}

.toolbar-app-delete-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application_delete.gif") !important;
}

.toolbar-app-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application_edit.gif") !important;
}

.toolbar-group-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_add.gif") !important;
}

.toolbar-group-delete-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_delete.gif") !important;
}

.toolbar-group-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_edit.gif") !important;
}

.toolbar-user-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user_add.gif") !important;
}

.toolbar-user-delete-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user_delete.gif") !important;
}

.toolbar-user-group-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_edit.gif") !important;
}

.toolbar-user-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user_edit.gif") !important; 
}

/*Window Icons*/
.window-action-add-icon { 
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key_add.gif") !important;
}

.window-action-edit-icon { 
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key_edit.gif") !important;
}

.window-action-view-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key_go.gif") !important;
}

.window-application-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application_add.gif") !important;
}

.window-application-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application_edit.gif") !important;
}

.window-application-view-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/application_go.gif") !important;
}

.window-create-db-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/database_gear.gif") !important;
}

.window-login-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key.gif") !important;
}

.window-group-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_add.gif") !important;
}

.window-group-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_edit.gif") !important;
}

.window-group-view-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_go.gif") !important;
}

.window-user-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user.gif") !important;
}

.window-user-group-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/group_edit.gif") !important;
}

.window-user-perm-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/key_go.gif") !important;
}

.window-user-add-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user_add.gif") !important;
}

.window-user-view-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user_go.gif") !important;
}

.window-user-edit-icon 
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/user_edit.gif") !important;
}

/*Quick Start Icons*/

.quickstart_logout_icon
{
	background-image: url("<?php print(cInfo::C_STR_ICON_PATH) ?>/fam/door_in.gif") !important;
}