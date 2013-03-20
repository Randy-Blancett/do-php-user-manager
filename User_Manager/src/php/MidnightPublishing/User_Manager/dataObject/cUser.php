<?php
namespace MidnightPublishing\User_Manager\dataObject;

use MidnightPublishing\User_Manager\cPropelConnector;
use MidnightPublishing\User_Manager\database\cTableUsersQuery;
use MidnightPublishing\User_Manager\database\cTableUsers;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

class cUser extends cTableUsers
{
	private static $m_obj_Query;
	private static $m_obj_QueryObj;

	public static function addDefault()
	{

	}

	protected static function getQuery()
	{
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableUsersQuery();
		}
		return self::$m_obj_Query;
	}

	protected static function getQueryObj()
	{
		if(!self::$m_obj_QueryObj){
			self::$m_obj_QueryObj = cTableUsersQuery::create();
		}
		return self::$m_obj_QueryObj;
	}

	public static function create_GUID()
	{
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	public static function createTable()
	{
		cPropelConnector::initPropel();

		$str_Statement = file_get_contents(dirname(__DIR__)."/sql/tables/users_schema.sql");
		$str_Statement = str_ireplace("DROP TABLE IF EXISTS `users`;","",$str_Statement);

		try {
			$obj_Connection = \Propel::getConnection(\Propel::getDefaultDB());
			$obj_Statement = $obj_Connection->prepare($str_Statement);
		}
		catch (Exception $e) {
			print("Threw Exceptiion\n");
			return false;
		}

		try {
			$obj_Statement->execute();
			return "User Table Created.";
		}
		catch (PDOException $e) {
			switch ($e->getCode())
			{
				case 'HY000':
					$this->m_obj_Response->addMsg("Table Already Exists.");
					return true;
				default:
					throw $e;
					return false;
			}

			return false;
		}
		return true;
	}

	public static function getCommentString($obj_Resource)
	{
		if (is_resource($obj_Resource)) {
			$str_Content ="";
			while(!feof($obj_Resource)){
				$str_Content.= fread($obj_Resource, 1024);
			}
			rewind($obj_Resource);
			return $str_Content;
		} else {
			return $obj_Resource;
		}
	}

	/**
	 * Load User from UserName
	 * @param string $str_UserName
	 */
	public static  function loadFromUserName($str_UserName)
	{
		$obj_Query = self::getQueryObj();
		return  $obj_Query->findOneByuserName($str_UserName);
	}

	public static function getAllUsers($int_Start = 0, $int_PerPage = null)
	{
		$obj_Return = self::getQueryObj();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		return $obj_Return = $obj_Return->offset($int_Start)->find();
	}

	/**
	 * Get the information about the User from an ID
	 * @param string $str_ID
	 * @return number
	 */
	public static function getUserById($str_ID)
	{
		$obj_Return = self::getQueryObj();

		return $obj_Return->findPk($str_ID);
	}


	/**
	 * This Password will encript the password this should be used.
	 * @param string $str_Password
	 */
	public function setPwd($str_Password)
	{
		$this->setPassword(sha1($str_Password));
	}


	public static function getTotalUserCount()
	{
		$obj_Return = self::getQueryObj();
		return $obj_Return->count();
	}

	public function __toString()
	{
		foreach($this as $obj_Data)
		{
			print(" - ".$obj_Data);
		}
	}
}