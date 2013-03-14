<?php
namespace MidnightPublishing\User_Manager\abs;

use MidnightPublishing\User_Manager\response\cTableResponse;

use MidnightPublishing\User_Manager\cUser;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

class absResourceTable extends \Tonic\Resource
{
	const C_STR_PARAM_ACTION = "action";
	const C_STR_ACTION_CREATE = "create";

	private static $m_obj_UserValidator = null;

	/**
	 * Singleton of the User Validator object
	 * @return cUser
	 */
	private static function getUserValidator()
	{
		if(!self::$m_obj_UserValidator)
		{
			self::$m_obj_UserValidator = new cUser(true,cUser::C_INT_LOGIN_TYPE_HTTP);
		}
		return self::$m_obj_UserValidator;
	}

	protected $m_obj_Response = null;
	/**
	 * @method POST
	 * @param unknown_type $request
	 */
	public 	function postJSON()
	{
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);

		$this->m_obj_Response = new cTableResponse();
		if($obj_User->isGod())
		{
			$arr_Query = split("&",$this->request->data);
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
		}else
		{
			$this->m_obj_Response->setCode(\Tonic\Response::UNAUTHORIZED);
			$this->m_obj_Response->setSuccess(false);
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	protected function  createTable(){
		return true;
	}

}