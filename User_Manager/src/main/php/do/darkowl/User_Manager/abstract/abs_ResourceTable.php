<?php
use darkowl\user_manager\resource\cTableResource;
use darkowl\user_manager\response\cTableResponse;

require_once dirname( __DIR__).'/classes/response/cTableResponse.php';
require_once dirname( __DIR__).'/classes/resource/cTableResource.php';

class abs_ResourceTable extends \Tonic\Resource
{
	const C_STR_PARAM_ACTION = "action";
	const C_STR_ACTION_CREATE = "create";


	protected $m_obj_Response = null;

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

	protected function  createTable(){
		return true;
	}

}