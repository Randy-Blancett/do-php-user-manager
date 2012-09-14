<?php
namespace darkowl\user_manager\dataObject;

require_once dirname(dirname(__DIR__)).'/propelInclude.php';
require_once dirname(__DIR__).'/database/cTableActions.php';
require_once 'cApplication.php';

class cAction extends \cTableActions
{
	const C_STR_USER_MANAGER_ACTION_VIEW = "75079AF6-14E1-42D4-8122-016248106E51";
	const C_STR_USER_MANAGER_APPLICATION_VIEW = "D173678F-7C65-440C-A8A8-126B7F996CA0";

	private static $m_obj_Query;
	private static $m_obj_QueryObj;

	protected static function getQueryObj()
	{
		if(!self::$m_obj_QueryObj){
			self::$m_obj_QueryObj = \cTableActionsQuery::create();
		}
		return self::$m_obj_QueryObj;
	}

	protected static function getQuery()
	{
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableActionsQuery();
		}
		return self::$m_obj_Query;
	}

	public static function getActionById($str_ID)
	{
		$obj_Return = self::getQueryObj();
		return  $obj_Return->findPk($str_ID);
	}

	public static function getAllActions($int_Start = 0, $int_PerPage = null)
	{
		$obj_Return = self::getQueryObj();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		return  $obj_Return->offset($int_Start)->find();
	}

	public static function getTotalActionCount()
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


	private static function addAction(cAction $obj_Action,$bool_Force = false){
		$obj_Return = self::getQueryObj();

		$obj_CurAction = $obj_Return->findPk($obj_Action->getId());

		if(!$obj_CurAction||$bool_Force)
		{
			$obj_Action->save();
		}
	}

	public static function addDefault()
	{
		$obj_Action = new cAction();

		$obj_Action->setId("7C7445E0-4E08-11DF-BD82-8264710BE148");
		$obj_Action->setName("Access User Manager GUI");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment  ("Allows users to access the User Manager Web Based GUI.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("D2338B4D-7642-4FCB-9A8D-8A12F179C2BA");
		$obj_Action->setName("View Users");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment  ("Allows users to view users in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();

		$obj_Action->setId("853B6E7D-AE84-4361-B077-F0B55516A6AC");
		$obj_Action->setName("Add Users");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment  ("Allows users to add users to the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("39AF30C8-9A93-4644-AF91-6632B1794A36");
		$obj_Action->setName("Edit Users");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment  ("Allows users to Edit a user already in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("E3E84EB2-687B-44B3-AB87-1F073D83C2F0");
		$obj_Action->setName("Delete Users");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment  ("Allows users to Delete a user from the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("2DBAD148-44D2-469A-95CD-4B8F8C2957F4");
		$obj_Action->setName("View Groups");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to view groups in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("62EAD614-944A-49F9-9033-D087E854D784");
		$obj_Action->setName("Add Groups");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to add groups to the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("76B56DBB-22BF-4F2B-AE89-27C50022F361");
		$obj_Action->setName("Edit Groups");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to edit groups in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("B3CA458D-08D5-49C1-BE87-D16DE3D2CB99");
		$obj_Action->setName("Delete Groups");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to delete groups from the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId(self::C_STR_USER_MANAGER_APPLICATION_VIEW);
		$obj_Action->setName("View Application");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to view applications in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("6EF64796-E382-4785-94D2-5FB879F6199C");
		$obj_Action->setName("Add Application");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to add applications in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("958B5780-FED0-41BD-8D7A-81E96C9B8FBB");
		$obj_Action->setName("Edit Application");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to edit applications in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("46AF898C-AA2E-4BB5-BC11-59FCF3DAAF22");
		$obj_Action->setName("Delete Application");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to delete applications in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("75079AF6-14E1-42D4-8122-016248106E51");
		$obj_Action->setName("View Actions");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to view actions in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("55821781-AD26-4D8E-B010-733F4C84FBA2");
		$obj_Action->setName("Add Actions");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to add actions to the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("CFD2CA6C-52D7-4334-ACDF-5460835A6B0C");
		$obj_Action->setName("Edit Actions");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to edit actions in the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("F8EF305B-294D-4241-BD5A-A19449AA6CCF");
		$obj_Action->setName("Delete Actions");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to delete actions from the system.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("C39D4045-70C4-49B9-A82D-56541762385A");
		$obj_Action->setName("View Group Permissions");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to view permissions assigned to a group.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("AC08ABE8-55E9-4A91-A97B-133E86C83595");
		$obj_Action->setName("Edit Group Permissions");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to edit permissions assigned to a group.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("A1C1A7A0-E712-4B02-B22A-BAD53FA492BF");
		$obj_Action->setName("View User's Groups");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to view what groups a user belongs to.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("5290C859-C300-4926-A936-1A0C93226DF8");
		$obj_Action->setName("Edit User's Groups");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to change what groups a user belongs to.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("D7C64AAC-87BB-4EEA-A02D-2D0C6E1C6367");
		$obj_Action->setName("Edit User's Permissions");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to change what permissions a user has.");
		self::addAction($obj_Action);

		$obj_Action = new cAction();
		$obj_Action->setId("EDBBC3E6-CF47-464D-A490-19C0C01A6889");
		$obj_Action->setName("Edit User's Permissions");
		$obj_Action->setApplication (cApplication::C_STR_ID_USER_MANAGER);
		$obj_Action->setComment("Allows users to view what permissions a user has.");
		self::addAction($obj_Action);
	}



	public static function createTable()
	{
		$str_Statement = file_get_contents(dirname(dirname(__DIR__))."/sql/actions_schema.sql");

		$str_Statement = str_ireplace("DROP TABLE IF EXISTS `actions`;","",$str_Statement);

		try {
			$obj_Connection = \Propel::getConnection(\Propel::getDefaultDB());
			$obj_Statement = $obj_Connection->prepare($str_Statement);
		}
		catch (Exception $e) {
			return false;
		}

		try {
			$obj_Statement->execute();
			return "Action Table Created.";
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
}