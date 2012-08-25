<?php
use darkowl\user_manager\resource\cActionResource;
use darkowl\user_manager\response\cActionResponse;
use darkowl\user_manager\dataObject;
use \darkowl\user_manager\cUser;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname(__DIR__))."/dataObject/cAction.php";
require_once dirname(dirname(__DIR__))."/response/cActionResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cActionResource.php";

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /action
 */
class cAction extends \Tonic\Resource {
	const C_STR_PARAM_START = "start";
	const C_STR_PARAM_LIMIT = "limit";
	const C_STR_PARAM_PAGE = "page";

	private $m_obj_Response = null;
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


	/**
	 * @method POST
	 * @accepts application/x-www-form-urlencoded
	 * @provides application/json
	 */
	public function postJson() {
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);

		$this->m_obj_Response = new cActionResponse();


		$obj_DOAction = dataObject\cAction::getAllActions($_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);

		// 		$arr_Accept = Array();
		// 		foreach($request->accept as $arr_Object)
		// 		{
		// 			$arr_Accept = array_merge($arr_Accept,$arr_Object);
		// 		}
		if($obj_User->isGod())
		{
			foreach($obj_DOAction->toArray()as $arr_Object)
			{
				$obj_Row = new cActionResource();
				foreach($arr_Object as $str_Key => $obj_Data)
				{
					$str_Key = lcfirst($str_Key);

					if($obj_Data){
						$obj_Row->$str_Key = $obj_Data;
					}
				}
				$obj_Response->addResource($obj_Row);
			}

			$obj_Response->setSuccess(true);
			$obj_Response->setTotal(dataObject\cAction::getTotalActionCount());
		}
		else
		{
			$this->m_obj_Response->setCode(\Tonic\Response::UNAUTHORIZED);
			$this->m_obj_Response->setSuccess(false);
		}
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}
}

