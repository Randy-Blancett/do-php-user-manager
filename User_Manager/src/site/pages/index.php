<?php
use darkowl\user_manager\cPermission;

use darkowl\user_manager\cSession;

use darkowl\user_manager\cUser;
use \darkowl\user_manager\webpage;
/**
 * Include Default Path Info
 */
require_once (dirname(__DIR__)) . "/php/conf/cInfo.php";
/**
 * Include User Validation Class
 */
require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH . "/classes/cUser.php";
/**
 * Include Permission Codes
 */
require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH . "/classes/cPermission.php";

$obj_User = new cUser(true,cUser::C_INT_LOGIN_TYPE_CUSTOM);

// Check Login Status
$obj_User->require_Login(true);

if (!$obj_User->checkPermissions(cPermission::C_STR_USERMANAGER_VIEW))
{
	$obj_User->logout();
	die("You do not have permision to view this page");
}

?>
<html>
<head>
<title>User Manager</title>
</head>
<body>
	<div id="loading-mask"></div>
	<div id="loading">
		<div class="title">User Manager</div>
		<div class="body">
			<div class="icon"></div>
			<div class="msg" id="loading-msg">Loading styles and images...</div>
		</div>
	</div>
	<link rel="stylesheet" type="text/css" href="../css/main.php" />
	<link rel="stylesheet" type="text/css" href="../css/icons.php" />

	<?php
	print('<link rel="stylesheet" type="text/css" href="'. webpage\cInfo::C_STR_EXT4_LIB_PATH .'/resources/css/ext-all.css" />');
	?>

	<script type="text/javascript">
	    	document.getElementById('loading-msg').innerHTML = 'Loading Core API...';
	 </script>

	<?php
	print('<script type="text/javascript" src="'. webpage\cInfo::C_STR_EXT4_LIB_PATH .'/ext.js"></script>'.PHP_EOL);
	?>
	<script type="text/javascript" src='../php/conf/cConfig_JS.php'></script>
	<script type="text/javascript" src='../js/util/loaderFix.js'></script>

	<script type="text/javascript">
	    	document.getElementById('loading-msg').innerHTML = 'Setting up User Manager ...';
	    </script>


	<script type="text/javascript" src='../js/user_manager/index.js'></script>
</body>
</html>
