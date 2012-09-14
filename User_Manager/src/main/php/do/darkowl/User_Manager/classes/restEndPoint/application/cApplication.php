<?php
use darkowl\user_manager\resource\cApplicationResource;
use darkowl\user_manager\response\cApplicationResponse;
use darkowl\user_manager\dataObject;
use \darkowl\user_manager\cUser;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname(__DIR__))."/dataObject/cApplication.php";
require_once dirname(dirname(__DIR__))."/dataObject/cAction.php";
require_once dirname(dirname(__DIR__))."/response/cApplicationResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cApplicationResource.php";

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /application
 */
class cApplication extends \Tonic\Resource {
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
	 * Get Applications depending on what is passed
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
	 * Return data for the given ID
	 * @param String $str_ID
	 * @return \Tonic\Response
	 */
	public function getSingleJson($str_ID)
	{
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_APPLICATION_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_DOApplication = dataObject\cApplication::getApplicationById($str_ID);

			$obj_Row = new cFormResource();

			$obj_Row->id = $obj_DOApplication->getId();
			$obj_Row->name = $obj_DOApplication->getName();
			$obj_Row->comment = dataObject\cApplication::getCommentString($obj_DOApplication->getComment());

			$this->m_obj_Response->addResource($obj_Row);
			$this->m_obj_Response->setSuccess(true);
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Get a paged List of Applications
	 * @param integer $int_Start
	 * @param integer $int_Limit
	 * @return \Tonic\Response
	 */
	public function getAllJson($int_Start=0,$int_Limit=20) {
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cApplicationResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_APPLICATION_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_DOApplication = dataObject\cApplication::getAllApplications($_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);

			foreach($obj_DOApplication->toArray()as $arr_Object)
			{
				$obj_Row = new cApplicationResource();
				foreach($arr_Object as $str_Key => $obj_Data)
				{
					$str_Key = lcfirst($str_Key);

					if($obj_Data){
						switch($str_Key)
						{
							case "comment":
								$obj_Data = dataObject\cApplication::getCommentString($obj_Data);
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
}

