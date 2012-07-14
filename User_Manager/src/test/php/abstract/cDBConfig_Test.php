<?php
namespace darkowl\user_manager\unitTest;

require_once dirname(dirname(dirname(__DIR__)))."/main/php/do/darkowl/User_Manager/abstract/abs_DBConfig.php";

class cTestConfig extends \abs_DBConfig
{
	const C_STR_DB_NAME = "user_manager";
	const C_STR_DB_HOST = "localhost";
	const C_STR_DB_TYPE = "mysql";
	const C_STR_DB_PORT = "3306";
	const C_STR_DB_USER_NAME = "propel";
	const C_STR_DB_PASSWORD = "propel";

	function __construct()
	{
		$this->setDBName(self::C_STR_DB_NAME);
		$this->setHost(self::C_STR_DB_HOST);
		$this->setPort(self::C_STR_DB_PORT);
		$this->setType(self::C_STR_DB_TYPE);
		$this->setUserName(self::C_STR_DB_USER_NAME);
		$this->setPassword(self::C_STR_DB_PASSWORD);
	}
}

/**
 * @backupGlobals disabled
 */
class cDBConfigTest extends \PHPUnit_Framework_TestCase
{
	function setUp() {
	}


	function testGetters() {
		$obj_Config = new cTestConfig();
		$this->assertEquals(cTestConfig::C_STR_DB_NAME, $obj_Config->getDBName());
		$this->assertEquals(cTestConfig::C_STR_DB_HOST, $obj_Config->getHost());
		$this->assertEquals(cTestConfig::C_STR_DB_TYPE, $obj_Config->getType());
		$this->assertEquals(cTestConfig::C_STR_DB_PORT, $obj_Config->getPort());
		$this->assertEquals(cTestConfig::C_STR_DB_USER_NAME, $obj_Config->getUserName());
		$this->assertEquals(cTestConfig::C_STR_DB_PASSWORD, $obj_Config->getPassword());
		$this->assertEquals(cTestConfig::C_STR_DB_TYPE.":host=".cTestConfig::C_STR_DB_HOST.";dbname=".cTestConfig::C_STR_DB_NAME.";", $obj_Config->getDNS());

		$this->assertTrue(true);
	}

}
?>