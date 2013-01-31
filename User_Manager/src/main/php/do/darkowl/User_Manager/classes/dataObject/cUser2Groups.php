<?php
namespace darkowl\user_manager\dataObject;

use \darkowl\user_manager\exception\cMissingParam;

require_once dirname(dirname(__DIR__)).'/propelInclude.php';
require_once dirname(__DIR__).'/database/cTableUsers2Groups.php';
require_once dirname(__DIR__).'/exception/cMissingParam.php';

class cUser2Groups extends \cTableUsers2Groups
{
	private static $m_obj_Query;
	private static $m_obj_QueryObj;

	protected static function getQuery()
	{
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableUsers2GroupsQuery();
		}
		return self::$m_obj_Query;
	}

	protected static function getQueryObj()
	{
		if(!self::$m_obj_QueryObj){
			self::$m_obj_QueryObj = \cTableUsers2GroupsQuery::create();
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
	 * Get the groups that a user is assigned to
	 * @param String $str_User
	 * @param Integer $int_Start
	 * @param Integer $int_PerPage
	 */
	public static function getUsersGroups($str_User,$int_Start = 0, $int_PerPage = null)
	{
		$bool_Fail = false;

		if(!$str_User)
		{
			throw new cMissingParam(__FUNCTION__,"str_User","Missing User Name.");
		}

		$obj_Return = self::getQueryObj();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		$obj_Return->offset($int_Start);

		$obj_Return->filterByuserId($str_User);

		return $obj_Return = $obj_Return->find();
	}

	public function __toString()
	{
		foreach($this as $obj_Data)
		{
			print(" - ".$obj_Data);
		}
	}
}