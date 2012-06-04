<?php
namespace darkowl\user_manager\integrationTest;

use \darkowl\user_manager\unitTest\cDBConfig;

require_once 'propel/Propel.php';

define("PROPEL_INIT",TRUE);

// Initialize Propel with the runtime configuration
\Propel::init(dirname(__DIR__)."/conf/user_manager-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("classes" . PATH_SEPARATOR . get_include_path());


require_once dirname(__DIR__).'/conf/cDBConfig.php';
// require_once dirname(__DIR__).'/propelInclude.php';
require_once (dirname(dirname(dirname(__DIR__))))."/main/php/do/darkowl/User_Manager/classes/restEndPoint/database/cUserManagerDB.php";



// class cTestConfig extends \abs_DBConfig
// {
// 	const C_STR_DB_NAME = "user_manager_test";
// 	const C_STR_DB_HOST = "localhost";
// 	const C_STR_DB_TYPE = "mysql";
// 	const C_STR_DB_PORT = "3306";
// 	const C_STR_DB_USER_NAME = "propel";
// 	const C_STR_DB_PASSWORD = "propel";

// 	function __construct()
// 	{
// 		$this->setDBName(self::C_STR_DB_NAME);
// 		$this->setHost(self::C_STR_DB_HOST);
// 		$this->setPort(self::C_STR_DB_PORT);
// 		$this->setType(self::C_STR_DB_TYPE);
// 		$this->setUserName(self::C_STR_DB_USER_NAME);
// 		$this->setPassword(self::C_STR_DB_PASSWORD);
// 	}
// }

class cTestUserManagerDB extends \cUserManagerDB
{
	protected function getCreateStatement()
	{
		return "CREATE DATABASE  `user_manager_test` ;";
	}
}

class cSetupIntegrationTest extends \PHPUnit_Framework_TestCase
{
	private  static  $m_obj_PDO = null;
	private static  $m_obj_Config =null;

	private static function getConfig()
	{
		if(!self::$m_obj_Config){
			self::$m_obj_Config = new \darkowl\user_manager\unitTest\cDBConfig();
		}
		return self::$m_obj_Config;
	}

	public static function getMySqlPDO()
	{
		if(!self::$m_obj_PDO)
		{
			$obj_Config = self::getConfig();
			$str_DNS = $obj_Config->getType().":host=".$obj_Config->getHost().";";
			self::$m_obj_PDO = new \PDO($str_DNS,$obj_Config->getUsername(),$obj_Config->getPassword());
		}
		return self::$m_obj_PDO;
	}


	public static function setUpBeforeClass()
	{
		$obj_Config = self::getConfig();
		$obj_PDO = self::getMySqlPDO();

		$obj_Statement = $obj_PDO->prepare("show databases;");
		$obj_Statement->execute();

		while ($obj_Result = $obj_Statement->fetchObject()) {
			print($obj_Config->getDBName()."\n");
			print($obj_Result->Database."\n---\n");
			self::assertNotEquals($obj_Config->getDBName(), $obj_Result->Database);
		}

	}

	public static function tearDownAfterClass()
	{
		self::$m_obj_PDO = NULL;
	}


	public function testCreateDB()
	{
		$obj_UserManagerDB = new cTestUserManagerDB(array());
		$obj_Request = new \Request();

		$obj_Request->data="action=create";

		$obj_UserManagerDB->post($obj_Request);

	}
}