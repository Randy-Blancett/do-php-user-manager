<?php 

namespace MidnightPublishing\User_Manager\unitTest;

use MidnightPublishing\User_Manager\abs\absDBConfig;

class cTestDBConfig extends absDBConfig
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

class absDBConfigTest extends \PHPUnit_Framework_TestCase
{
	public	function testInstance()
	{
		$obj_DBConfig = new cTestDBConfig();
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\abs\\absDBConfig", $obj_DBConfig);
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\unitTest\\cTestDBConfig", $obj_DBConfig);

		$this->assertEquals(cTestDBConfig::C_STR_DB_NAME,$obj_DBConfig->getDBName());
		$this->assertEquals(cTestDBConfig::C_STR_DB_HOST,$obj_DBConfig->getHost());
		$this->assertEquals(cTestDBConfig::C_STR_DB_TYPE,$obj_DBConfig->getType());
		$this->assertEquals(cTestDBConfig::C_STR_DB_PORT,$obj_DBConfig->getPort());
		$this->assertEquals(cTestDBConfig::C_STR_DB_USER_NAME,$obj_DBConfig->getUserName());
		$this->assertEquals(cTestDBConfig::C_STR_DB_PASSWORD,$obj_DBConfig->getPassword());
	}

	public function testGetterSetter()
	{
		$obj_DBConfig = new cTestDBConfig();

		$obj_DBConfig->setDBName("DB1");
		$obj_DBConfig->setHost("Host1");
		$obj_DBConfig->setPassword("Password1");
		$obj_DBConfig->setPort(3000);
		$obj_DBConfig->setType("type1");
		$obj_DBConfig->setUserName("Username1");


		$this->assertEquals("DB1",$obj_DBConfig->getDBName());
		$this->assertEquals("Host1",$obj_DBConfig->getHost());
		$this->assertEquals("type1",$obj_DBConfig->getType());
		$this->assertEquals(3000,$obj_DBConfig->getPort());
		$this->assertEquals("Username1",$obj_DBConfig->getUserName());
		$this->assertEquals("Password1",$obj_DBConfig->getPassword());

		$this->assertEquals("type1:host=Host1;dbname=DB1;",$obj_DBConfig->getDNS());

	}
}