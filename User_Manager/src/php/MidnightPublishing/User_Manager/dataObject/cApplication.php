<?php
namespace MidnightPublishing\User_Manager\dataObject;

use MidnightPublishing\User_Manager\database\cTableApplicationsQuery;

use MidnightPublishing\User_Manager\cPropelConnector;

use MidnightPublishing\User_Manager\database\cTableApplications;

cPropelConnector::initPropel();

class cApplication extends cTableApplications
{
	const C_STR_ID_USER_MANAGER = "5D2B859D-4D61-11DF-BD82-8264710BE149";

	private static $m_obj_Query;
	private static $m_obj_QueryObj;

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

	protected static function getQueryObj()
	{
		cPropelConnector::initPropel();
		if(!self::$m_obj_QueryObj){
			self::$m_obj_QueryObj = cTableApplicationsQuery::create();
		}
		return self::$m_obj_QueryObj;
	}

	protected static function getQuery()
	{
		cPropelConnector::initPropel();
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableApplicationsQuery();
		}
		return self::$m_obj_Query;
	}

	public static function getAllApplications($int_Start = 0, $int_PerPage = null)
	{
		$obj_Return = self::getQueryObj();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		return $obj_Return = $obj_Return->offset($int_Start)->find();
	}

	public static function getTotalApplicationCount()
	{
		$obj_Return = self::getQueryObj();
		return $obj_Return->count();
	}

	/**
	 * Get the information about the application from an ID
	 * @param string $str_ID
	 * @return number
	 */
	public static function getApplicationById($str_ID)
	{
		$obj_Return = self::getQueryObj();

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
		cPropelConnector::initPropel();

		$str_Statement = file_get_contents(dirname(__DIR__)."/sql/tables/applications_schema.sql");
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