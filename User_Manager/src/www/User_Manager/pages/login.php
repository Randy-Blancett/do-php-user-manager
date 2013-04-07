<?php
use MidnightPublishing\User_Manager\cUser;

use\darkowl\user_manager\webpage;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';
/**
 * Include Default Path Info
 */
require_once (dirname(__DIR__)) . "/php/conf/cInfo.php";

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
</body>
</html>
