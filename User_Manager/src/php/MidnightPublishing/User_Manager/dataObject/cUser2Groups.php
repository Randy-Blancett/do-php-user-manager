<?php
namespace MidnightPublishing\User_Manager\dataObject;

use MidnightPublishing\User_Manager\database\cTableUsers2GroupsQuery;
use MidnightPublishing\User_Manager\database\cTableUsers2Groups;
use MidnightPublishing\User_Manager\cPropelConnector;


class cUser2Groups extends cTableUsers2Groups
{
	private static $m_obj_Query;
	private static $m_obj_QueryObj;

	public static function addDefault()
	{

	}

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
			self::$m_obj_QueryObj = cTableUsers2GroupsQuery::create();
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

		$str_Statement = file_get_contents(dirname(__DIR__)."/sql/tables/users2groups_schema.sql");
		$str_Statement = str_ireplace("DROP TABLE IF EXISTS `users2groups`;","",$str_Statement);

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
			return "Users2Groups Table Created.";
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
	 * Delete all groups for a given User
	 * @param String $str_User GUID of the User
	 */
	public static function deleteUsersGroups($str_User)
	{
		if(!$str_User)
		{
			throw new cMissingParam(__FUNCTION__,"str_User","Missing User ID.");
		}
		$obj_Query = self::getQueryObj();
		$obj_Query->filterByuserId($str_User)->delete();
	}

	/**
	 * Get the groups that a user is assigned to
	 * @param String $str_User The User ID
	 * @param Integer $int_Start
	 * @param Integer $int_PerPage
	 */
	public static function getUsersGroups($str_User,$int_Start = 0, $int_PerPage = null)
	{
		$bool_Fail = false;

		if(!$str_User)
		{
			throw new cMissingParam(__FUNCTION__,"str_User","Missing User ID.");
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

	public static function countUser2Group($str_User,$str_Group)
	{
		if(!$str_User)
		{
			throw new cMissingParam(__FUNCTION__,"str_User","Missing User ID.");
		}

		if(!$str_Group)
		{
			throw new cMissingParam(__FUNCTION__,"str_Group","Missing Group ID.");
		}

		$obj_Return = self::getQueryObj();

		$obj_Return->filterByuserId($str_User);
		$obj_Return->filterBygroupId($str_Group);

		return  $obj_Return->count();
	}

	private static function addUser2Groups(cUser2Groups $obj_User2Group,$bool_Force = false){
		$obj_Return = self::getQueryObj();

		$obj_CurUser2Group = $obj_Return->findPk($obj_User2Group->getId());

		if(!$obj_CurUser2Group||$bool_Force)
		{
			$obj_User2Group->save();
		}
	}
	/**
	 * Link a user to a group
	 * @param String $obj_User
	 * @param String $obj_Group
	 */
	public static function linkUser2Group($str_User, $str_Group)
	{
		$obj_Link = new cUser2Groups();

		$obj_Link->setId(self::create_GUID());

		$obj_Link->setuserId($str_User);
		$obj_Link->setgroupId($str_Group);

		self::addUser2Groups($obj_Link);
	}

	public static function getLinkById($str_ID)
	{
		$obj_Return = self::getQueryObj();
		return  $obj_Return->findPk($str_ID);
	}

	public static function deleteUser2Group( $obj_User2Group)
	{
		$obj_User2Group->delete();
	}

	public static function unlinkUser2Group($str_User, $str_Group)
	{
		if(!$str_User)
		{
			throw new cMissingParam(__FUNCTION__,"str_User","Missing User ID.");
		}

		if(!$str_Group)
		{
			throw new cMissingParam(__FUNCTION__,"str_Group","Missing Group ID.");
		}

		$obj_Links = self::getQueryObj();

		$obj_Links = $obj_Links->filterByuserId($str_User);
		$obj_Links = $obj_Links->filterBygroupId($str_Group);

		$obj_Links = $obj_Links->find();

		foreach($obj_Links as $str_Key=>$obj_Data)
		{
			self::deleteUser2Group($obj_Data);
		}
	}

	public function __toString()
	{
		foreach($this as $obj_Data)
		{
			print(" - ".$obj_Data);
		}
	}
}