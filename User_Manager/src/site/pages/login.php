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
?>
<html>
<head>
<title>User Manager - Login</title>


<link rel="stylesheet" type="text/css" href="../css/main.php" />
<link rel="stylesheet" type="text/css" href="../css/icons.php" />
<?php
print('<link rel="stylesheet" type="text/css" href="'. webpage\cInfo::C_STR_EXT4_LIB_PATH .'/resources/css/ext-all.css" />');
?>

<?php
print('<script type="text/javascript" src="'. webpage\cInfo::C_STR_EXT4_LIB_PATH .'/ext.js"></script>'.PHP_EOL);
?>
<script type="text/javascript" src='../php/conf/cConfig_JS.php'></script>
<script type="text/javascript" src='../js/util/loaderFix.js'></script>



<script type="text/javascript" src='../js/user_manager/login.js'></script>

<script type="text/javascript">
var G_STR_FORM_DATA_USERNAME = "<?php print($obj_User->getUserName()); ?>";

</script>
</head>
<body>
	<?php
	// 	if (cUserValidation::get_LoginAttempt() > 0)
	// 	{
	// 		print("<h2>");
	// 		print("Login Attempt Failed incorrect User Name or Password");
	// 		print("</h2>");
	// 	}
	?>
</body>
</html>
