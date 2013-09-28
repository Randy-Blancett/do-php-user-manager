<?php
use MidnightPublishing\User_Manager\conf\cInfo;
use MidnightPublishing\User_Manager\cUser;

// use\darkowl\user_manager\webpage;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

$obj_User		 = new cUser();
$obj_Config		 = new cInfo();
$obj_Ext4LibPath = $obj_Config->getParam(cInfo::C_STR_PARAM_EXT_4_LIB_PATH);
?>
<html>
	<head>
		<title>User Manager - Login</title>


		<link rel="stylesheet" type="text/css" href="../css/main.php" />
		<link rel="stylesheet" type="text/css" href="../css/icons.php" />
		<?php
		print('<link rel="stylesheet" type="text/css" href="' . $obj_Ext4LibPath . '/resources/css/ext-all.css" />');
		?>

		<?php
		print('<script type="text/javascript" src="' . $obj_Ext4LibPath . '/ext.js"></script>' . PHP_EOL);
		?>
		<script type="text/javascript" src='../php/conf/cConfig_JS.php'></script>
		<script type="text/javascript" src='../js/util/loaderFix.js'></script>



		<script type="text/javascript" src='../js/user_manager/login.js'></script>

		<script type="text/javascript">
			var G_STR_FORM_DATA_USERNAME = "<?php print($obj_User->getUserName()); ?>";

		</script>
	</head>
	<body>
	</body>
</html>
