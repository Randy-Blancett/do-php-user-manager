<?php 
namespace  darkowl\user_manager\unitTest;


require_once dirname(dirname(dirname(__DIR__)))."/main/php/do/darkowl/User_Manager/abstract/abs_DBConfig.php";

class cDBConfig extends \abs_DBConfig
{
	const C_STR_DB_NAME = "user_manager";
	const C_STR_DB_HOST = "localhost";
	const C_STR_DB_TYPE = "mysql";
	const C_STR_DB_PORT = "";
	const C_STR_DB_USER_NAME = "root";
	const C_STR_DB_PASSWORD = "midnight";

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

