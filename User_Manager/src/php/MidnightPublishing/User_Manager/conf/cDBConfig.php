<?php 
namespace MidnightPublishing\User_Manager\conf;

use MidnightPublishing\User_Manager\abs\absDBConfig;

require_once dirname(__DIR__)."/abstract/abs_DBConfig.php";


class cDBConfig extends absDBConfig
{
	const C_STR_DB_NAME = "user_manager";
	const C_STR_DB_HOST = "localhost";
	const C_STR_DB_TYPE = "mysql";
	const C_STR_DB_PORT = "";
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

