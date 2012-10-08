<?php
use darkowl\user_manager\dataObject;
use darkowl\user_manager\resource\cGroupResource;
use darkowl\user_manager\response\cGroupResponse;
use \darkowl\user_manager\resource\cFormResource;
use \darkowl\user_manager\response\cFormResponse;
use \darkowl\user_manager\cUser;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname(__DIR__))."/dataObject/cGroup.php";
require_once dirname(dirname(__DIR__))."/dataObject/cAction.php";
require_once dirname(dirname(__DIR__))."/response/cGroupResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cGroupResource.php";
require_once dirname(dirname(__DIR__))."/response/cFormResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cFormResource.php";

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /group
 * @uri /group/{id}
 */
class cGroup extends \Tonic\Resource {
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
	
		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_GROUP_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_DOGroup = dataObject\cGroup::getGroupById($str_ID);
	
			$obj_Row = new cFormResource();
			
			$obj_Row->id = $obj_DOGroup->getId();
			$obj_Row->comment = $obj_DOGroup->getComment();
			$obj_Row->name = $obj_DOGroup->getName();

			$this->m_obj_Response->addResource($obj_Row);
			$this->m_obj_Response->setSuccess(true);
		}
	
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}
	
	/**
	 * Get a paged List of Groups
	 * @param integer $int_Start
	 * @param integer $int_Limit
	 * @return \Tonic\Response
	 */
	public function getAllJson($int_Start=0,$int_Limit=20) {
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cGroupResponse();
	
		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_GROUP_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_DOGroup = dataObject\cGroup::getAllGroups($_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);
	
			foreach($obj_DOGroup->toArray()as $arr_Object)
			{
				$obj_Row = new cGroupResource();
				foreach($arr_Object as $str_Key => $obj_Data)
				{
					$str_Key = lcfirst($str_Key);
	
					if($obj_Data){
						switch($str_Key)
						{
							case "comment":
								$obj_Data = dataObject\cGroup::getCommentString($obj_Data);
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

// 	function get($request,$limit) {
// 		$obj_Response = new cGroupResponse($request);

// 		$obj_DOGroup = dataObject\cGroup::getAllGroups($_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);

// 		$arr_Accept = Array();
// 		foreach($request->accept as $arr_Object)
// 		{
// 			$arr_Accept = array_merge($arr_Accept,$arr_Object);
// 		}

// 		foreach($obj_DOGroup->toArray()as $arr_Object)
// 		{
// 			$obj_Row = new cGroupResource();
// 			foreach($arr_Object as $str_Key => $obj_Data)
// 			{
// 				$str_Key = lcfirst($str_Key);

// 				if($obj_Data){
// 					$obj_Row->$str_Key = $obj_Data;
// 				}
// 			}
// 			$obj_Response->addResource($obj_Row);
// 		}

// 		$obj_Response->setSuccess(true);
// 		$obj_Response->setTotal(dataObject\cGroup::getTotalGroupCount());

// 		return $obj_Response;
// 	}
}

