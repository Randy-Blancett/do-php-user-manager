<?php

use darkowl\user_manager\dataObject\cApplication;

use \darkowl\user_manager\resource\cActionResource;
use \darkowl\user_manager\response\cActionResponse;
use \darkowl\user_manager\resource\cFormResource;
use \darkowl\user_manager\response\cFormResponse;
use \darkowl\user_manager\dataObject;
use \darkowl\user_manager\cUser;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname(__DIR__))."/dataObject/cAction.php";
require_once dirname(dirname(__DIR__))."/response/cActionResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cActionResource.php";
require_once dirname(dirname(__DIR__))."/response/cFormResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cFormResource.php";

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /action
 * @uri /action/{id}
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
	 * Get Actions depending on what is passed in
	 * @method GET
	 * @provides application/json
	 * @param String $str_ID
	 * @return \Tonic\Response
	 */
	public function getJson($str_ID = null)
	{
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);
		if($str_ID)
		{
			return $this->getSingleJson($str_ID);
		}
		return $this->getAllJson($_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);
	}

	/**
	 * Returns one action in the form Ext-JS Form expects
	 *
	 * @param String $str_ID Id of the Action to return
	 * @return \Tonic\Response
	 */
	public function getSingleJson($str_ID)
	{
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_ACTION_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_DOAction = dataObject\cAction::getActionById($str_ID);

			$obj_Row = new cFormResource();

			$obj_Row->id = $obj_DOAction->getId();
			$obj_Row->name = $obj_DOAction->getName();
			$obj_Row->application = $obj_DOAction->getApplication();
			$obj_Row->comment = dataObject\cAction::getCommentString($obj_DOAction->getComment());

			$this->m_obj_Response->addResource($obj_Row);
			$this->m_obj_Response->setSuccess(true);
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Get a paged List of actions
	 * @param integer $int_Start
	 * @param integer $int_Limit
	 * @return \Tonic\Response
	 */
	public function getAllJson($int_Start=0,$int_Limit=20)
	{
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cActionResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_ACTION_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_DOActions = dataObject\cAction::getAllActions($int_Start,$int_Limit);


			foreach($obj_DOActions->toArray()as $arr_Action)
			{
				$obj_Row = new cActionResource();
				foreach($arr_Action as $str_Key => $obj_Data)
				{
					$str_Key = lcfirst($str_Key);

					if($obj_Data){
						switch($str_Key)
						{
							case "application":
								$obj_Row->applicationName = cApplication::convertID($obj_Data);
								break;
							case "comment":
								$obj_Data = dataObject\cAction::getCommentString($obj_Data);
								break;
						}

						$obj_Row->$str_Key = $obj_Data;
					}
				}
				$this->m_obj_Response->addResource($obj_Row);
			}

			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setTotal(dataObject\cAction::getTotalActionCount());
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * @method POST
	 * @accepts application/x-www-form-urlencoded
	 * @provides application/json
	 */
	public function postJson() {
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);

		$this->m_obj_Response = new cFormResponse();



		// 		$obj_DOAction = dataObject\cAction::getAllActions($_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);

		// 		// 		$arr_Accept = Array();
		// 		// 		foreach($request->accept as $arr_Object)
		// 		// 		{
		// 		// 			$arr_Accept = array_merge($arr_Accept,$arr_Object);
		// 		// 		}
		// 		if($obj_User->isGod())
		// 		{
		// 			foreach($obj_DOAction->toArray()as $arr_Object)
		// 			{
		// 				$obj_Row = new cActionResource();
		// 				foreach($arr_Object as $str_Key => $obj_Data)
		// 				{
		// 					$str_Key = lcfirst($str_Key);

		// 					if($obj_Data){
		// 						$obj_Row->$str_Key = $obj_Data;
		// 					}
		// 				}
		// 				$obj_Response->addResource($obj_Row);
		// 			}

		// 			$obj_Response->setSuccess(true);
		// 			$obj_Response->setTotal(dataObject\cAction::getTotalActionCount());
		// 		}
		// 		else
		// 		{
		// 			$this->m_obj_Response->setCode(\Tonic\Response::UNAUTHORIZED);
		// 			$this->m_obj_Response->setSuccess(false);
		// 		}

		$this->m_obj_Response->setSuccess(true);
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}
}

