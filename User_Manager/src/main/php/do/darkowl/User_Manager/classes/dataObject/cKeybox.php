<?php
namespace darkowl\user_manager\dataObject;

use \darkowl\user_manager\exception\cMissingParam;

require_once dirname(dirname(__DIR__)).'/propelInclude.php';
require_once dirname(__DIR__).'/database/cTableKeyboxQuery.php';
require_once dirname(__DIR__).'/exception/cMissingParam.php';

class cKeybox extends \cTableKeybox
{
	private static $m_obj_Query;
	private static $m_obj_QueryObj;

	const C_INT_LINKTYPE_GROUP = 0;
	const C_INT_LINKTYPE_USER = 1;

	protected static function getQuery()
	{
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableKeyboxQuery();
		}
		return self::$m_obj_Query;
	}

	public static function countUser2Permission($str_User,$str_Permission)
	{
		if(!$str_User)
		{
			throw new cMissingParam(__FUNCTION__,"str_User","Missing User ID.");
		}

		if(!$str_Permission)
		{
			throw new cMissingParam(__FUNCTION__,"$str_Permission","Missing Permission ID.");
		}

		return self::countPermission($str_User, $str_Permission, self::C_INT_LINKTYPE_USER);
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
	 * Delete all permissions for a given User
	 * @param String $str_User GUID of the User
	 */
	public static function deleteUsersPermissions($str_User)
	{
		if(!$str_User)
		{
			throw new cMissingParam(__FUNCTION__,"str_User","Missing User ID.");
		}
		$obj_Query = self::getQueryObj();
		$obj_Query->filterBylinkId($str_User)->filterBylinkType(self::C_INT_LINKTYPE_USER)->delete();
	}

	/**
	 * Link a user to a Permission
	 * @param String $obj_User
	 * @param String $obj_Group
	 */
	public static function linkUser2Permission($str_User, $str_Permission)
	{
		$obj_Link = new cKeybox();

		$obj_Link->setId(self::create_GUID());

		$obj_Link->setactionId($str_Permission);
		$obj_Link->setlinkId($str_User);
		$obj_Link->setlinkType(self::C_INT_LINKTYPE_USER);

		self::addKey($obj_Link);
	}

	public static function unlinkUser2Permission($str_User, $str_Permission)
	{
		if(!$str_User)
		{
			throw new cMissingParam(__FUNCTION__,"str_User","Missing User ID.");
		}

		if(!$str_Permission)
		{
			throw new cMissingParam(__FUNCTION__,"str_Permission","Missing Permission ID.");
		}

		$obj_Keys = self::getQueryObj();

		$obj_Keys->filterBylinkId($str_User);
		$obj_Keys->filterBylinkType(self::C_INT_LINKTYPE_USER);
		$obj_Keys->filterByactionId($str_Permission);

		$obj_Keys = $obj_Keys->find();

		foreach($obj_Keys as $str_Key=>$obj_Data)
		{
			self::deleteKey($obj_Data);
		}
	}

	public static function deleteKey( $obj_Key)
	{
		$obj_Key->delete();
	}

	/**
	 * Counts the number of times the permission is attatched to the ID
	 * @param string $str_ID
	 * @param string $str_Permission
	 * @param integer $int_LinkType
	 * @throws cMissingParam
	 */
	public static function countPermission($str_ID,$str_Permission,$int_LinkType)
	{
		if(!$str_ID)
		{
			throw new cMissingParam(__FUNCTION__,"str_ID","Missing Link ID.");
		}
		if(!$str_Permission)
		{
			throw new cMissingParam(__FUNCTION__,"str_Permission","Missing Permission ID.");
		}
		if(!$int_LinkType)
		{
			throw new cMissingParam(__FUNCTION__,"int_LinkType","Missing Link Type.");
		}

		$obj_Return = self::getQueryObj();

		$obj_Return->filterBylinkId($str_ID);
		$obj_Return->filterBylinkType($int_LinkType);
		$obj_Return->filterByactionId($str_Permission);

		return  $obj_Return->count();
	}

	protected static function getQueryObj()
	{
		if(!self::$m_obj_QueryObj){
			self::$m_obj_QueryObj = \cTableKeyboxQuery::create();
		}
		return self::$m_obj_QueryObj;
	}

	public static function getAllKeys($int_Start = 0, $int_PerPage = null)
	{
		$obj_Return = self::getQueryObj();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		return $obj_Return = $obj_Return->offset($int_Start)->find();

	}

	public static function getTotalKeyCount()
	{
		$obj_Return = self::getQueryObj();
		return $obj_Return->count();
	}

	private static function addKey(cKeybox $obj_Key,$bool_Force = false){
		$obj_Return = self::getQueryObj();

		$obj_CurKey = $obj_Return->findPk($obj_Key->getId());

		if(!$obj_CurKey||$bool_Force)
		{
			$obj_Key->save();
		}
	}

	/**
	 * Get the group permissions
	 * @param String $str_Group The Group ID
	 * @param Integer $int_Start
	 * @param Integer $int_PerPage
	 */
	public static function getGroupsPermissions($str_Group,$int_Start = 0, $int_PerPage = null)
	{
		$bool_Fail = false;

		if(!$str_Group)
		{
			throw new cMissingParam(__FUNCTION__,"str_Group","Missing Group ID.");
		}
		return self::getPermissions($str_Group, self::C_INT_LINKTYPE_GROUP,$int_Start,$int_PerPage);
	}

	/**
	 * Get the users permissions
	 * @param String $str_User The User ID
	 * @param Integer $int_Start
	 * @param Integer $int_PerPage
	 */
	public static function getUsersPermissions($str_User,$int_Start = 0, $int_PerPage = null)
	{
		$bool_Fail = false;

		if(!$str_User)
		{
			throw new cMissingParam(__FUNCTION__,"str_User","Missing User ID.");
		}
		return self::getPermissions($str_User, self::C_INT_LINKTYPE_USER,$int_Start,$int_PerPage);
	}

	/**
	 * Get List of permissions for a given ID and LinkType
	 * @param string $str_ID Id to look for
	 * @param integer $int_LinkType The type of link
	 * @param number $int_Start
	 * @param string $int_PerPage
	 */
	public static function getPermissions($str_ID,$int_LinkType,$int_Start = 0, $int_PerPage = null)
	{
		if(!$str_ID)
		{
			throw new cMissingParam(__FUNCTION__,"str_ID","Missing Link ID.");
		}
		if($int_LinkType!==0&&!$int_LinkType)
		{
			throw new cMissingParam(__FUNCTION__,"int_LinkType","Missing Link Type.");
		}
		$obj_Return = self::getQueryObj();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		$obj_Return->offset($int_Start);

		$obj_Return->filterBylinkId($str_ID);
		$obj_Return->filterBylinkType($int_LinkType);

		return $obj_Return = $obj_Return->find();
	}

	public static function addDefault()
	{
		$obj_Key = new cKeybox();
		$obj_Key->setId("4F03A939-4E0A-11DF-BD82-8264710BE148");
		$obj_Key->setactionId("7C7445E0-4E08-11DF-BD82-8264710BE148");
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setComment("Gives User Manager Admins the ability to View the GUI");
		self::addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("46ACAABC-A920-4DE9-8F62-194A73579C90");
		$obj_Key->setactionId("D2338B4D-7642-4FCB-9A8D-8A12F179C2BA");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to View Users.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("0B1791C2-28F8-40C6-A812-130472C08177");
		$obj_Key->setactionId("853B6E7D-AE84-4361-B077-F0B55516A6AC");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to Add Users.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("14BF658C-9CCD-4F0D-8ADF-63E9353F180C");
		$obj_Key->setactionId("39AF30C8-9A93-4644-AF91-6632B1794A36");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to Edit Users.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("64E5DBB0-593A-47CC-9C1F-8E95C4601D60");
		$obj_Key->setactionId("E3E84EB2-687B-44B3-AB87-1F073D83C2F0");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to Delete Users.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("50741962-12AC-42D7-8C38-97D57F9ED9C2");
		$obj_Key->setactionId("2DBAD148-44D2-469A-95CD-4B8F8C2957F4");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to view Groups.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("404C8B88-94B2-4DB2-9DE7-B615912D0290");
		$obj_Key->setactionId("62EAD614-944A-49F9-9033-D087E854D784");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to add Groups.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("6829281A-044C-409D-A064-CA106BE37B58");
		$obj_Key->setactionId("76B56DBB-22BF-4F2B-AE89-27C50022F361");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to Edit Groups.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("DAABF4B3-B788-4E44-95B9-74E30C204901");
		$obj_Key->setactionId("B3CA458D-08D5-49C1-BE87-D16DE3D2CB99");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to Delete Groups.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("64EE347A-9A0E-4772-B501-8922CA165C33");
		$obj_Key->setactionId("D173678F-7C65-440C-A8A8-126B7F996CA0");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to view applications.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("77338092-D750-456A-BE71-B2260AE9795D");
		$obj_Key->setactionId("6EF64796-E382-4785-94D2-5FB879F6199C");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to add applications.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("17C704BB-2306-47EE-819B-F3F3F4CBCCB1");
		$obj_Key->setactionId("958B5780-FED0-41BD-8D7A-81E96C9B8FBB");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to edit applications.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("25C94D51-BDA4-40B7-BFB1-A0E2274390ED");
		$obj_Key->setactionId("46AF898C-AA2E-4BB5-BC11-59FCF3DAAF22");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to delete applications.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("ACB39402-BC39-4532-935C-CC26B9266768");
		$obj_Key->setactionId("75079AF6-14E1-42D4-8122-016248106E51");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to view actions.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("D7722D30-273B-49FC-8CBF-1D217143835C");
		$obj_Key->setactionId("55821781-AD26-4D8E-B010-733F4C84FBA2");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to add actions.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("B884A6D8-66A9-4B08-8848-1DA8BCC2BC70");
		$obj_Key->setactionId("CFD2CA6C-52D7-4334-ACDF-5460835A6B0C");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to edit actions.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("7DD9B559-610E-4993-AEF5-C55A4722A7D0");
		$obj_Key->setactionId("F8EF305B-294D-4241-BD5A-A19449AA6CCF");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to delete actions.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("15E0803D-BA0F-4912-9844-5767C88E2328");
		$obj_Key->setactionId("C39D4045-70C4-49B9-A82D-56541762385A");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to view what actions a group has permission to.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("B713828C-587B-439A-ACF5-8E1B384A5CF8");
		$obj_Key->setactionId("AC08ABE8-55E9-4A91-A97B-133E86C83595");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to edit what actions a group has permission to.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("967A2058-3273-44E8-BC36-155BE540F98E");
		$obj_Key->setactionId("A1C1A7A0-E712-4B02-B22A-BAD53FA492BF");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to view what groups a user belongs to.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("5A3DFDD4-6A10-4820-ADBD-D416C1D6D285");
		$obj_Key->setactionId("5290C859-C300-4926-A936-1A0C93226DF8");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to change what groups a user belongs to.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("8EDB5058-5656-4078-9AA8-1C1A6854C551");
		$obj_Key->setactionId("D7C64AAC-87BB-4EEA-A02D-2D0C6E1C6367");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to change what permissions a user has.");
		$obj_Key->addKey($obj_Key);

		$obj_Key = new cKeybox();
		$obj_Key->setId("55D9F746-B6A6-44C0-9007-D810ACDA3B15");
		$obj_Key->setactionId("EDBBC3E6-CF47-464D-A490-19C0C01A6889");
		$obj_Key->setlinkType(self::C_INT_LINKTYPE_GROUP);
		$obj_Key->setlinkId(cGroup::C_STR_ID_USER_MANAGER_ADMIN);
		$obj_Key->setComment("Gives User Manager Admins the ability to view what permissions a user has.");
		$obj_Key->addKey($obj_Key);

		return true;
	}

	public static function createTable()
	{
		$str_Statement = file_get_contents(dirname(dirname(__DIR__))."/sql/keybox_schema.sql");

		$str_Statement = str_ireplace("DROP TABLE IF EXISTS `keybox`;","",$str_Statement);

		try {
			$obj_Connection = \Propel::getConnection(\Propel::getDefaultDB());
			$obj_Statement = $obj_Connection->prepare($str_Statement);
		}
		catch (Exception $e) {
			return false;
		}

		try {
			$obj_Statement->execute();
			return "KeyBox Table Created.";
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