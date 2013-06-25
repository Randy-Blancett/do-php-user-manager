<?php
use MidnightPublishing\User_Manager\cUser;
use\darkowl\user_manager\webpage;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

$obj_User = new cUser();
$obj_User->logout();
?>
Logged Out
