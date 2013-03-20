<?php 
namespace MidnightPublishing\User_Manager\database\om;

use MidnightPublishing\User_Manager\database\cTableUsersQuery;

abstract class BasecTableUsersQuery
{
	private static $m_str_Password = "";
	private static $m_str_Id = "";

	public static function setPasswordReturn($str_Password)
	{
		// 		print("Mock ".__CLASS__." ".__METHOD__." value : ".self::$m_str_Password."\n");
		self::$m_str_Password = $str_Password;
	}

	public static function setIdReturn($str_Id)
	{
		// 		print("Mock ".__CLASS__." ".__METHOD__." value : ".self::$m_str_Password."\n");
		self::$m_str_Id = $str_Id;
	}

	public function findOneByuserName()
	{
		// 		print("Mock ".__CLASS__." ".__METHOD__."\n");
		return $this;
	}

	public static function create($modelAlias = null, $criteria = null)
	{
		// 		print("Mock ".__CLASS__." ".__METHOD__."\n");
		return new cTableUsersQuery();
	}

	public static function getPassword()
	{
		// 		print("Mock ".__CLASS__." ".__METHOD__." value : ".self::$m_str_Password."\n");
		return sha1(self::$m_str_Password);
	}

	public static function getId()
	{
		return self::$m_str_Id;
	}
}