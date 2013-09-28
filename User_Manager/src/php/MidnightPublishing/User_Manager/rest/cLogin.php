<?php 
namespace MidnightPublishing\User_Manager\rest;

use MidnightPublishing\User_Manager\resource\cFormResource;

use MidnightPublishing\User_Manager\response\cFormResponse;

use MidnightPublishing\User_Manager\cUser;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

/**
 * Rest service to Login
 * @uri /login
 * @namespace User_Manager
 */
class cLogin extends \Tonic\Resource  {
	const C_STR_PARAM_DATA_USER_NAME = "userName";
	const C_STR_PARAM_DATA_PASSWORD = "password";

	private static $m_obj_UserValidator = null;
	/**
	 * Singleton of the User Validator object
	 * @return cUser
	 */
	protected static function getUserValidator()
	{
		if(!self::$m_obj_UserValidator)
		{
			self::$m_obj_UserValidator = new cUser(true,cUser::C_INT_LOGIN_TYPE_HTTP);
		}
		return self::$m_obj_UserValidator;
	}

	/**
	 * Post login information
	 * @method POST
	 * @provides application/json
	 * @return \Tonic\Response
	 */
	public function postJson()
	{
		$obj_User =  self::getUserValidator();

		$bool_Fail = false;
		$this->m_obj_Response = new cFormResponse();

		if(!isset($_POST[self::C_STR_PARAM_DATA_USER_NAME]))
		{
			$this->m_obj_Response->setCode(\Tonic\Response::NOTACCEPTABLE);
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->logError(self::C_STR_PARAM_DATA_USER_NAME." is a required parameter.");
			$bool_Fail = true;
		}
		else{
			$str_UserName = $_POST[self::C_STR_PARAM_DATA_USER_NAME];
		}

		if(!$bool_Fail){
			if(isset($_POST[self::C_STR_PARAM_DATA_PASSWORD])){
				$str_Password = $_POST[self::C_STR_PARAM_DATA_PASSWORD];
			}
			else
			{
				$str_Password = "";
			}

			if(cUser::login($str_UserName, $str_Password,false))
			{
				$obj_Return = new cFormResource();

				$obj_Return->url = cUser::getLastURL();
				$this->m_obj_Response->setCode(\Tonic\Response::OK);
				$this->m_obj_Response->setSuccess(true);
				$this->m_obj_Response->addResource($obj_Return);
			}
			else
			{
				$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
				$this->m_obj_Response->setSuccess(false);
				$this->m_obj_Response->logError("Failed to login, Either Password Or User Name was incorrect");
			}
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}
}