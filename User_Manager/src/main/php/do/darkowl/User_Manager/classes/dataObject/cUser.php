<?php
namespace darkowl\user_manager\dataObject;

require_once dirname(dirname(__DIR__)).'/propelInclude.php';
require_once dirname(__DIR__).'/database/cTableUsers.php';

class cUser extends \cTableUsers
{
	private static $m_obj_Query;
	private static $m_obj_QueryObj;

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
			self::$m_obj_QueryObj = \cTableUsersQuery::create();
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

	/**
	 * @param unknown_type $str_UserName
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