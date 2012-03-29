<?php
header("Content-type: application/x-javascript");
use \darkowl\user_manager\webpage;
/**
 * Include Default Path Info
 */
require_once (dirname(__DIR__)) . "/conf/cInfo.php";
?>

var g_obj_Config = new Object(); g_obj_Config.m_str_ExtJs4Path = "<?php print(webpage\cInfo::C_STR_EXT4_LIB_PATH); ?>";
