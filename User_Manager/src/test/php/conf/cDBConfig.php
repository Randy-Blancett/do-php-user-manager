<?php 
namespace  darkowl\user_manager\code;

class cDBConfig
{
	const C_STR_DB_NAME = "user_manager_test";
	const C_STR_DB_HOST = "localhost";
	const C_STR_DB_TYPE = "mysql";
	const C_STR_DB_PORT = "";
	const C_STR_DB_USER_NAME = "propel";
	const C_STR_DB_PASSWORD = "propel";

	static function getDNS()
	{
		$str_DNS = self::C_STR_DB_TYPE;
		$str_DNS .=":";
		$str_DNS .="host=".self::C_STR_DB_HOST.";";
		$str_DNS .="dbname=".self::C_STR_DB_NAME.";";
		return $str_DNS;
	}
	
	static function getDBName()
	{
		return self::C_STR_DB_NAME;
	}

	static function getUserName()
	{
		return self::C_STR_DB_USER_NAME;
	}

	static function getPassword()
	{
		return self::C_STR_DB_PASSWORD;
	}

	static function getType()
	{
		return self::C_STR_DB_TYPE;
	}
}

