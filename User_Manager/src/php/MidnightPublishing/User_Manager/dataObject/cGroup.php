<?php
namespace MidnightPublishing\User_Manager\dataObject;

use MidnightPublishing\User_Manager\cPropelConnector;

use MidnightPublishing\User_Manager\database\cTableGroupsQuery;
use MidnightPublishing\User_Manager\database\cTableGroups;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

cPropelConnector::initPropel();
class cGroup extends cTableGroups
{
	private static $m_obj_Query;
	private static $m_obj_QueryObj;

	const C_STR_ID_USER_MANAGER_ADMIN = "8C6E7B51-4E09-11DF-BD82-8264710BE148";
	const C_STR_ID_ANONYMOUS = "2847B2B6-4E16-11DF-BD82-8264710BE148";
	const C_STR_ID_KNOWN = "2847B2EE-4E16-11DF-BD82-8264710BE148";

	public static function create_GUID()
	{
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	protected static function getQuery()
	{
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableGroupsQuery();
		}
		self::$m_obj_Query->clear();
		return self::$m_obj_Query;
	}

	protected static function getQueryObj()
	{
		if(!self::$m_obj_QueryObj){
			self::$m_obj_QueryObj = cTableGroupsQuery::create();
		}
		self::$m_obj_QueryObj->clear();
		return self::$m_obj_QueryObj;
	}

	/**
	 * Get the information about the group from an ID
	 * @param string $str_ID
	 * @return number
	 */
	public static function getGroupById($str_ID)
	{
		$obj_Return = self::getQueryObj();

		return $obj_Return->findPk($str_ID);
	}

	public static function getAllGroups($int_Start = 0, $int_PerPage = null)
	{
		$obj_Return = self::getQueryObj();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		return $obj_Return = $obj_Return->offset($int_Start)->find();
	}

	public static function getTotalGroupCount()
	{
		$obj_Return = self::getQueryObj();
		return $obj_Return->count();
	}

	private static function addGroup(cGroup $obj_Group,$bool_Force = false){
		$obj_Return = self::getQueryObj();

		$obj_CurGroup = $obj_Return->findPk($obj_Group->getId());

		if(!$obj_CurGroup||$bool_Force)
		{
			$obj_Group->save();
		}
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

	public static function addDefault()
	{
		$obj_Group = new cGroup();
		$obj_Group->setId(self::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Group->setName("User Manager Admin");
		$obj_Group->setComment("Administrators of the User Manager System.");
		self::addGroup($obj_Group);

		$obj_Group = new cGroup();
		$obj_Group->setId(self::C_STR_ID_KNOWN);
		$obj_Group->setName("Known Users");
		$obj_Group->setComment("Group Of users that have a login to the system. (Are Identified)");
		self::addGroup($obj_Group);

		$obj_Group = new cGroup();
		$obj_Group->setId(self::C_STR_ID_ANONYMOUS);
		$obj_Group->setName("Anonymous Users");
		$obj_Group->setComment("Group of users that are not Identified.");
		self::addGroup($obj_Group);
	}

	public static function createTable()
	{
		cPropelConnector::initPropel();

		$str_Statement = file_get_contents(dirname(__DIR__)."/sql/tables/groups_schema.sql");
		$str_Statement = str_ireplace("DROP TABLE IF EXISTS `groups`;","",$str_Statement);

		try {
			$obj_Connection = \Propel::getConnection(\Propel::getDefaultDB());
			$obj_Statement = $obj_Connection->prepare($str_Statement);
		}
		catch (\Exception $e) {
			return false;
		}

		try {
			$obj_Statement->execute();
			return "Group Table Created.";
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

	public function __toString()
	{
		foreach($this as $obj_Data)
		{
			print(" - ".$obj_Data);
		}
	}
}