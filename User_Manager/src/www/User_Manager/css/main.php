<?php
header("Content-type: text/css");
use MidnightPublishing\User_Manager\conf\cInfo;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

$obj_Config		 = new cInfo();
$obj_IconPath	 = $obj_Config->getParam(cInfo::C_STR_PARAM_ICON_PATH);
?>
@CHARSET "ISO-8859-1";

#loading
{
background-color	: grey;
width				: 300px;
vertical-align		: middle;
}

#loading .title
{
background-color	: blue;
vertical-align		: middle;
padding-left		: 10px;
padding-top			: 3px;
padding-bottom		: 3px;
}

#loading .body
{
padding				: 3px;
height				: 38px;
}

#loading .icon
{
background-image	: url("<?php print($obj_IconPath) ?>/fam/group_gear.gif") !important;
background-position	: center;
background-repeat	: no-repeat;
display				: inline-block;
width				: 32px;
height				: 32px;
}

#loading .msg
{
vertical-align		: top;
display				: inline-block;
height				: 32px;
}

.ux-desktop-shortcut {
cursor: pointer;
text-align: center;
padding: 8px;
margin: 8px;
width: 64px;
}

.ux-desktop-shortcut-icon {
width: 48px;
height: 48px;
background-color: transparent;
background-repeat: no-repeat;
}

.ux-desktop-shortcut-text {
font: normal 10px tahoma,arial,verdana,sans-serif;
text-decoration: none;
padding-top: 5px;
color: white;
}

.x-view-over .ux-desktop-shortcut-text {
text-decoration: underline;
}

.window {
background-color: white;
border-color: gray;
border-size: 2px;
border-style: double;
}

.required-field {
color: red;
text-decoration: underline;
}

.titlebar {
background-color: grey;
border-color: gray;
border-size: 2px;
border-style: double;
padding-left: 10px;
}

.menuOption {
border-color: gray;
border-size: 2px;
border-style: double;
padding: 2px;
cursor: hand;
cursor: pointer;
}

.start-icon
{
background-image: url("<?php print($obj_IconPath) ?>/fam/group_gear.gif") !important;
}

.user-add {
background-image: url("<?php print($obj_IconPath) ?>/fam/user_add.gif") !important;
}

.group-add {
background-image: url("<?php print($obj_IconPath) ?>/fam/group_add.gif") !important;
}

.action-Add-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/key_add.gif") !important;
}

.app-Add {
background-image: url("<?php print($obj_IconPath) ?>/fam/application_add.gif")
!important;
}

.user-delete {
background-image: url("<?php print($obj_IconPath) ?>/fam/user_delete.gif")
!important;
}

.app-Delete-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/application_delete.gif")
!important;
}

.action-Window-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/key.gif") !important;
}

.app-Window-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/application.gif") !important
;
}

.group-Window-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/group.gif") !important;
}

.app-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/application.gif") !important
;
}

.user-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/user.gif") !important;
}

.action-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/key.gif") !important;
}

.group-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/group.gif") !important;
}

.app-Edit-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/application_edit.gif")
!important;
}

.action-Edit-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/key_go.gif") !important;
}

.user-Edit-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/user_edit.gif") !important;
}

.group-Edit-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/group_edit.gif") !important;
}

.user-Delete-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/user_delete.gif") !important
;
}

.action-Delete-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/key_delete.gif") !important;
}

.group-Delete-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/group_delete.gif")
!important;
}

.search-Window-Collapsed-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/zoom.gif") !important;
}

.search-Button-Icon {
background-image: url("<?php print($obj_IconPath) ?>/fam/zoom.gif") !important;
}

.x-collapsed-header-text  {
color: #15428B;
font-family: tahoma, arial, verdana, sans-serif;
font-size: 11px;
font-weight: bold;
position: relative;
top: 4px;
left: 4px;
}

.x-collapsed-header-text-rotated {
overflow: visible;
}

.x-collapsed-header-text-rotated  {
color: #15428b;
white-space: nowrap;
position: relative;
top: 4px;
-webkit-transform: rotate(90deg);
-moz-transform: rotate(90deg);
filter: progid : DXImageTransform.Microsoft.BasicImage ( rotation = 1 );
}

.ext-ie .x-collapsed-header-text-rotated  {
top: 0;
left: 4px;
}

.ext-ie .x-collapsed-header-text-rotated * {
width: 200px;
}