<?php
namespace darkowl\user_manager\dataObject;

require_once dirname(dirname(__DIR__)).'/propelInclude.php';
require_once dirname(__DIR__).'/database/cTableUsers.php';

class cUser extends \cTableUsers
{
	private static $m_obj_Query;

	protected static function getQuery()
	{
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableUsersQuery();
		}
		return self::$m_obj_Query;
	}

	public static  function loadFromUserName($str_UserName)
	{
		return  \cTableUsersQuery::create()->findOneByuserName($str_UserName);
	}

	public static function getAllUsers($int_Start = 0, $int_PerPage = null)
	{
		$obj_Return = \cTableUsersQuery::create();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		return $obj_Return = $obj_Return->offset($int_Start)->find();
	}


	public static function getTotalUserCount()
	{
		$obj_Return = \cTableUsersQuery::create();
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