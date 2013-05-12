<?php
namespace darkowl\user_manager\webpage;
/**
 * Class holds infomration to setup the application
 * @author Randy Blancett
 * @package PHP_User_Manager
 * @subpackage Classes
 */
class cInfo
{
	public static $m_bool_setup = false;
	const C_STR_EXT4_LIB_PATH			= "/Common/Lib/ext-JS-4";
	const C_STR_ICON_PATH				= "/Common/Img/icons";
	const C_STR_EXTERNAL_PATH			= "external/";

	const C_STR_FILE_PATH = "userManagerProp.ini";

	public static function initializeConfig()
	{
		$str_PropPath = dirname(dirname(__DIR__))."/".self::C_STR_FILE_PATH;
		self::$m_bool_setup= true;

		if(file_exists($str_PropPath))
		{
			self::loadINIFile($str_PropPath);
		}
		else {
			self::setINIDefailt($str_PropPath)	;
		}

	}

	private static function setINIDefailt($str_FilePath)
	{
		$arr_DefaultData = array();

		$arr_DefaultData["UserManager"]=array();
		$arr_DefaultData["UserManager"]["ext4LibPath"]="/Common/Lib/ext-JS-4";
		$arr_DefaultData["UserManager"]["iconPath"]="/Common/Img/icons";
		$arr_DefaultData["UserManager"]["externalPath"]="external/";

		// 		$file = \fopen($str_FilePath, 'w');
		self::write_ini_file($str_FilePath,$arr_DefaultData);
		print("\nSet INI Default\n");
	}

	private static function  loadINIFile($str_FilePath)
	{
		print("\n$str_FilePath\n");
		print ("\nLoad INI File\n");
	}

	private static function write_ini_file($file, array $options){
		$tmp = ";<?php die()?>\n";
		foreach($options as $section => $values){
			$tmp .= "[$section]\n";
			foreach($values as $key => $val){
				if(is_array($val)){
					foreach($val as $k =>$v){
						$tmp .= "{$key}[$k] = \"$v\"\n";
					}
				}
				else
					$tmp .= "$key = \"$val\"\n";
			}
			$tmp .= "\n";
		}
		print_r($tmp);
		file_put_contents($file, $tmp);
		unset($tmp);
	}
}

if(!cInfo::$m_bool_setup)
{
	cInfo::initializeConfig();
}

?>