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

	public function __toString()
	{
		foreach($this as $obj_Data)
		{
			print(" - ".$obj_Data);
		}
	}
}