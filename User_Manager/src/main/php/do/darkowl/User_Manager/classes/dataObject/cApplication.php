<?php
namespace darkowl\user_manager\dataObject;

require_once dirname(dirname(__DIR__)).'/propelInclude.php';
require_once dirname(__DIR__).'/database/cTableApplications.php';

class cApplication extends \cTableApplications
{
	const C_STR_ID_USER_MANAGER = "5D2B859D-4D61-11DF-BD82-8264710BE149";

	private static $m_obj_Query;
	private static $m_obj_QueryObj;

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

	protected static function getQueryObj()
	{
		if(!self::$m_obj_QueryObj){
			self::$m_obj_QueryObj = \cTableApplicationsQuery::create();
		}
		return self::$m_obj_QueryObj;
	}

	protected static function getQuery()
	{
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableApplicationsQuery();
		}
		return self::$m_obj_Query;
	}

	public static function getAllApplications($int_Start = 0, $int_PerPage = null)
	{
		$obj_Return = \cTableApplicationsQuery::create();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		return $obj_Return = $obj_Return->offset($int_Start)->find();
	}

	public static function getTotalApplicationCount()
	{
		$obj_Return = \cTableApplicationsQuery::create();
		return $obj_Return->count();
	}

	/**
	 * Get the information about the application from an ID
	 * @param string $str_ID
	 * @return number
	 */
	public static function getApplicationById($str_ID)
	{
		$obj_Return = \cTableApplicationsQuery::create();

		return $obj_Return->findPk($str_ID);
	}

	/**
	 * Convert an application id into a name.
	 * @param string $str_AppID ID of the application to look up.
	 * @return string Name attatched to the Application ID
	 */
	public static function convertID($str_AppID)
	{
		if(!$str_AppID)
		{
			return "";
		}

		$obj_Data = self::getApplicationById($str_AppID);

		return $obj_Data->getName();
	}

	private static function addApplication(cApplication $obj_Application,$bool_Force = false){
		$obj_Return = self::getQueryObj();

		$obj_CurApp = $obj_Return->findPk($obj_Application->getId());

		if(!$obj_CurApp||$bool_Force)
		{
			$obj_Application->save();
		}
	}

	public static function addDefault()
	{
		$obj_Application = new cApplication();
		$obj_Application->setId(self::C_STR_ID_USER_MANAGER);
		$obj_Application->setName("User Manager");
		$obj_Application->setComment("Application that manages Users.");
		self::addApplication($obj_Application);
	}

	public static function createTable()
	{
		$str_Statement = file_get_contents(dirname(dirname(__DIR__))."/sql/applications_schema.sql");

		$str_Statement = str_ireplace("DROP TABLE IF EXISTS `applications`;","",$str_Statement);

		try {
			$obj_Connection = \Propel::getConnection(\Propel::getDefaultDB());
			$obj_Statement = $obj_Connection->prepare($str_Statement);
		}
		catch (Exception $e) {
			return false;
		}

		try {
			$obj_Statement->execute();
			return "Application Table Created.";
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