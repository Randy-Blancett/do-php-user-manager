<?php
namespace darkowl\user_manager\dataObject;

require_once dirname(dirname(__DIR__)).'/propelInclude.php';
require_once dirname(__DIR__).'/database/cTableGroups.php';

class cGroup extends \cTableGroups
{
	private static $m_obj_Query;
	private static $m_obj_QueryObj;

	const C_STR_ID_USER_MANAGER_ADMIN = "8C6E7B51-4E09-11DF-BD82-8264710BE148";
	const C_STR_ID_ANONYMOUS = "2847B2B6-4E16-11DF-BD82-8264710BE148";
	const C_STR_ID_KNOWN = "2847B2EE-4E16-11DF-BD82-8264710BE148";

	protected static function getQuery()
	{
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableGroupsQuery();
		}
		return self::$m_obj_Query;
	}

	protected static function getQueryObj()
	{
		if(!self::$m_obj_QueryObj){
			self::$m_obj_QueryObj = \cTableGroupsQuery::create();
		}
		return self::$m_obj_QueryObj;
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
		$str_Statement = file_get_contents(dirname(dirname(__DIR__))."/sql/groups_schema.sql");

		$str_Statement = str_ireplace("DROP TABLE IF EXISTS `groups`;","",$str_Statement);

		try {
			$obj_Connection = \Propel::getConnection(\Propel::getDefaultDB());
			$obj_Statement = $obj_Connection->prepare($str_Statement);
		}
		catch (Exception $e) {
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