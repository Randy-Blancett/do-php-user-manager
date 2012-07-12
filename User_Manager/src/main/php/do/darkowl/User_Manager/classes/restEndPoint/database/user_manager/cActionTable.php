<?php

use darkowl\user_manager\resource\cTableResource;
use darkowl\user_manager\response\cTableResponse;

require_once dirname(dirname(dirname( __DIR__))).'/response/cTableResponse.php';
require_once dirname(dirname(dirname( __DIR__))).'/resource/cTableResource.php';
/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /database/user_manager/action
 */
class cActionTable extends Resource {

	const C_STR_PARAM_ACTION = "action";
	const C_STR_ACTION_CREATE = "create";

	const C_STR_NAME = "Action";
	const C_STR_URI = "rest/database/user_manager/action";

	private $m_obj_Response = null;

	public 	function post($request)
	{
		$this->m_obj_Response = new cTableResponse($request);

		$arr_Query = split("&",$request->data);
		$arr_Data= Array();
		$arr_Data[self::C_STR_PARAM_ACTION]="";

		foreach ($arr_Query as $str_Data)
		{
			$arr_Temp = split("=",$str_Data);

			if($arr_Temp[0])
			{
				$arr_Data[$arr_Temp[0]] = $arr_Temp[1];
			}
		}

		if(!isset($arr_Data[self::C_STR_PARAM_ACTION]))
		{
			$arr_Data[self::C_STR_PARAM_ACTION] = null;
		}
		if(!$arr_Data[self::C_STR_PARAM_ACTION])
		{
			$this->m_obj_Response->code = 406;
			$this->m_obj_Response->logError("'".self::C_STR_PARAM_ACTION."' is a required parameter.");
		}
		else
		{
			switch ($arr_Data[self::C_STR_PARAM_ACTION])
			{
				case self::C_STR_ACTION_CREATE :
					if($this->createTable())
					{
						$this->m_obj_Response->code = 201;
						$this->m_obj_Response->setSuccess(true);
					}
					else
					{
						$this->m_obj_Response->code = 500;
						$this->m_obj_Response->logError("Failed to create Database.");
						$this->m_obj_Response->setSuccess(false);
					}
					break;
				default:
					$this->m_obj_Response->code = 406;
					$this->m_obj_Response->logError("'".$arr_Data[self::C_STR_PARAM_ACTION]."' is an unknown action.");
			}
		}

		return $this->m_obj_Response;
	}

	private function createTable()
	{
		$str_Statement = $this->getCreateStatement();

		try {
			$obj_Connection = Propel::getConnection(Propel::getDefaultDB());
			$obj_Statement = $obj_Connection->prepare($str_Statement);
		}
		catch (Exception $e) {
			return false;
		}

		try {
			$obj_Statement->execute();
			$this->m_obj_Response->addMsg("Action Table Created.");
		}
		catch (PDOException $e) {
			switch ($e->getCode())
			{
				case 'HY000':
					$this->m_obj_Response->addMsg("Table Already Exists.");
					return true;
				default:
					$this->m_obj_Response->logError("SQL Error\n".$e->getCode()." - ".$e->getMessage());
					return false;
			}

			return false;
		}
		return true;
	}



	protected function getCreateStatement()
	{
		$str_SQL = file_get_contents(dirname(dirname(dirname(dirname(__DIR__))))."/sql/actions_schema.sql");

		$str_SQL = str_ireplace("DROP TABLE IF EXISTS `actions`;","",$str_SQL);

		return $str_SQL;
	}

}

