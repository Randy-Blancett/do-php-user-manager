<?php
namespace MidnightPublishing\User_Manager\www\config;
use MidnightPublishing\User_Manager\abs\absConfigClass;

/**
 * Class holds infomration to setup the application
 * @author Randy Blancett
 * @package PHP_User_Manager
 * @subpackage Classes
 */
/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';
class cInfo extends absConfigClass
{

	const C_STR_FILE_PATH				 = "userManagerProp.ini";
	const C_STR_PARAM_EXT_4_LIB_PATH	 = "ext4LibPath";
	const C_STR_PARAM_ICON_PATH		 = "iconPath";
	const C_STR_PARAM_EXTERNAL_PATH	 = "externalPath";

	function __construct()
	{
		$str_PropPath = dirname(dirname(__DIR__)) . "/" . self::C_STR_FILE_PATH;
		$this->setCategory("UserManager");
		$this->initConfig($str_PropPath);
	}

	protected function setINIDefailt()
	{
		$arr_DefaultData = array(
);

		$arr_DefaultData[self::C_STR_PARAM_EXT_4_LIB_PATH]	 = "/Common/Lib/ext-JS-4";
		$arr_DefaultData[self::C_STR_PARAM_ICON_PATH]		 = "/Common/Img/icons";
		$arr_DefaultData[self::C_STR_PARAM_EXTERNAL_PATH]	 = "external/";

		print("\nSet INI Default\n");
		$this->writeINIFile($arr_DefaultData);
	}

}

?>