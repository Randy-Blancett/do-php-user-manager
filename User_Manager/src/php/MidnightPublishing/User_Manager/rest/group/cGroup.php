<?php
namespace MidnightPublishing\User_Manager\rest\group;

use MidnightPublishing\User_Manager\resource\cActionResource;

use MidnightPublishing\User_Manager\response\cActionResponse;

use MidnightPublishing\User_Manager\resource\cFormResource;

use MidnightPublishing\User_Manager\dataObject\cKeybox;

use MidnightPublishing\User_Manager\response\cFormResponse;

use MidnightPublishing\User_Manager\dataObject\cAction;

use MidnightPublishing\User_Manager\resource\cGroupResource;

use MidnightPublishing\User_Manager\response\cGroupResponse;
use MidnightPublishing\User_Manager\cUser;
use MidnightPublishing\User_Manager\dataObject;


/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

class cGroupDataBase extends \Tonic\Resource {
	const C_STR_PARAM_START = "start";
	const C_STR_PARAM_LIMIT = "limit";
	const C_STR_PARAM_PAGE = "page";

	const C_STR_PARAM_DATA_ID = "id";
	const C_STR_PARAM_DATA_NAME = "name";
	const C_STR_PARAM_DATA_COMMENT = "comment";

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
}
/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /group
 * @uri /group/{id}
 */
class cGroup extends cGroupDataBase {


	private $m_obj_Response = null;


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

		if(!$obj_User->checkPermissions(cAction::C_STR_USER_MANAGER_GROUP_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_DOGroup = dataObject\cGroup::getGroupById($str_ID);

			$obj_Row = new cFormResource();

			$obj_Row->id = $obj_DOGroup->getId();
			$obj_Row->comment = dataObject\cGroup::getCommentString($obj_DOGroup->getComment());

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

		if(!$obj_User->checkPermissions(dataObject\cAction::C_STR_USER_MANAGER_GROUP_VIEW))
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
			$this->m_obj_Response->setTotal(cAction::getTotalActionCount());
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Update Group record
	 * @method PUT
	 * @param String $str_ID
	 */
	public function putJson($str_ID = null)
	{
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);

		$this->m_obj_Response = new cFormResponse();
		$obj_DOGroup = new dataObject\cGroup();

		if(!$obj_User->checkPermissions(cAction::C_STR_USER_MANAGER_GROUP_EDIT))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_OrigData = $obj_DOGroup->getGroupById($str_ID);
			if(!$obj_OrigData){
				$this->m_obj_Response->setCode(\Tonic\Response::NOTFOUND);
				$this->m_obj_Response->setSuccess(false);

				$this->m_obj_Response->logError($str_ID." dose not exist therefore it could not be updated.");
			}
			else
			{
				parse_str($this->request->data,$arr_Data);

				$this->m_obj_Response->addMsg("Updateing Data for group '".$str_ID."'");

				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_NAME." was changed from ".$obj_OrigData->getName()." to ".$arr_Data[self::C_STR_PARAM_DATA_NAME]);
				$obj_OrigData->setName($arr_Data[self::C_STR_PARAM_DATA_NAME]);

				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_COMMENT." was changed from ".dataObject\cAction::getCommentString($obj_OrigData->getComment())." to ".$arr_Data[self::C_STR_PARAM_DATA_COMMENT]);
				$obj_OrigData->setComment($arr_Data[self::C_STR_PARAM_DATA_COMMENT]);

				$obj_OrigData->save();

				$this->m_obj_Response->setCode(\Tonic\Response::OK);
				$this->m_obj_Response->setSuccess(true);
			}
		}
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}


	/**
	 * Create a new Group record
	 * @method POST
	 * @accepts application/x-www-form-urlencoded
	 * @provides application/json
	 */
	public function postJson() {
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);

		$this->m_obj_Response = new cFormResponse();
		// 		$obj_DOGroup = new dataObject\cGroup();

		if(!$obj_User->checkPermissions(cAction::C_STR_USER_MANAGER_GROUP_ADD))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			if($_POST[self::C_STR_PARAM_DATA_ID])
			{
				$this->m_obj_Response->setSuccess(false);
				$this->m_obj_Response->setCode(\Tonic\Response::EXPECTATIONFAILED);
				$this->m_obj_Response->logError(self::C_STR_PARAM_DATA_ID." can not be set with a post.");

			}else
			{
				$obj_DOGroup = new dataObject\cGroup();
				$str_ID = dataObject\cGroup::create_GUID();

				$obj_DOGroup->setId($str_ID);
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_ID." set to ".$str_ID);

				$obj_DOGroup->setName($_POST[self::C_STR_PARAM_DATA_NAME]);
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_NAME." set to ".$obj_DOGroup->getName());

				$obj_DOGroup->setComment($_POST[self::C_STR_PARAM_DATA_COMMENT]);
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_COMMENT." set to ".$obj_DOGroup->getComment());

				$obj_DOGroup->save();

				$this->m_obj_Response->setCode(\Tonic\Response::CREATED);
				$this->m_obj_Response->setSuccess(true);
			}
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Delete Group record
	 * @method DELETE
	 * @param String $str_ID
	 */
	public function deleteJson($str_ID = null)
	{
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);

		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions(cAction::C_STR_USER_MANAGER_GROUP_DELETE))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_DOGroup = new dataObject\cGroup();
			$obj_OrigData = $obj_DOGroup->getGroupById($str_ID);
			if(!$obj_OrigData){
				$this->m_obj_Response->setCode(\Tonic\Response::NOTFOUND);
				$this->m_obj_Response->setSuccess(false);

				$this->m_obj_Response->logError($str_ID." dose not exist therefore it could not be deleted.");
			}
			else
			{

				try {
					cKeybox::deleteGroupsPermissions($str_ID);
					$obj_OrigData->delete();

					$this->m_obj_Response->addMsg("Deleted ".$str_ID);
					$this->m_obj_Response->setCode(\Tonic\Response::OK);
					$this->m_obj_Response->setSuccess(true);
				}
				catch (Exception $e)
				{
					$bool_Fail = true;
					$this->m_obj_Response->setCode(\Tonic\Response::INTERNALSERVERERROR);
					$this->m_obj_Response->setSuccess(false);
					$this->m_obj_Response->logError("Failed to remove User's Permissions: ".$e->getMessage());
				}
			}
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}
}

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /group/{id}/permissions/current
 */
class cGroupPermissionCurrent extends cGroupDataBase {
	/**
	 * Get available Permissions for the given Group
	 * @method GET
	 * @provides application/json
	 * @param String $str_ID
	 * @return \Tonic\Response
	 */
	public function getCurPermissionsJson($str_ID = null)
	{
		$bool_Fail = false;
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cActionResponse();

		if(!$obj_User->checkPermissions(cAction::C_STR_USER_MANAGER_GROUP_PERMISSION_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		$obj_DOGroup = dataObject\cGroup::getGroupById($str_ID);

		if(!$bool_Fail&&!$obj_DOGroup)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_ID." is invalid.");
			$bool_Fail = true;
		}

		$obj_DOPermissions = null;
		if(!$bool_Fail){
			try {
				$obj_DOPermissions=cKeybox::getGroupsPermissions($str_ID,$_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);
			} catch (cMissingParam $e) {
				$this->m_obj_Response->setSuccess(false);
				$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
				$this->m_obj_Response->logError( $e->getMessage());
				$bool_Fail = true;
			}
		}

		if(!$bool_Fail){
			if($obj_DOPermissions)
			{
				foreach($obj_DOPermissions->toArray() as $arr_Permissions)
				{
					if(isset($arr_Permissions["actionId"]))
					{
						$obj_DOPermission = cAction::getActionById($arr_Permissions["actionId"]);

						$obj_Row = new cActionResource();

						$obj_Row->id = $obj_DOPermission->getId();
						$obj_Row->name = $obj_DOPermission->getName();
						$obj_Row->comment = cAction::getCommentString( $obj_DOPermission->getComment());

						$this->m_obj_Response->addResource($obj_Row);
					}
				}
			}

			$this->m_obj_Response->setSuccess(true);
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}
}

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /group/{id}/permissions/available
 */
class cGroupPermissionAvail extends cGroupDataBase {
	/**
	 * Get available permissions for the given group
	 * @method GET
	 * @provides application/json
	 * @param String $str_ID
	 * @return \Tonic\Response
	 */
	public function getAvailPermissionsJson($str_ID = null)
	{
		$bool_Fail = false;
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response =new cActionResponse();

		if(!$obj_User->checkPermissions(cAction::C_STR_USER_MANAGER_GROUP_PERMISSION_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		$obj_DOGroup = dataObject\cGroup::getGroupById($str_ID);

		if(!$bool_Fail&&!$obj_DOGroup)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_ID." is invalid.");
			$bool_Fail = true;
		}

		$obj_DOPermissionsAvail = null;
		$obj_DOPermissionsCur = null;
		if(!$bool_Fail){
			try {
				$obj_DOPermissionsAvail= cAction::getAllActions();
				$obj_DOPermissionsCur=$obj_DOPermissions= cKeybox::getGroupsPermissions($str_ID);
			} catch (cMissingParam $e) {
				$this->m_obj_Response->setSuccess(false);
				$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
				$this->m_obj_Response->logError( $e->getMessage());
				$bool_Fail = true;
			}
		}

		if(!$bool_Fail){
			if($obj_DOPermissionsAvail)
			{
				foreach($obj_DOPermissionsAvail->toArray() as $arr_Object)
				{
					$bool_Found = false;
					foreach($obj_DOPermissionsCur as $str_I=> $obj_PermissionsCur)
					{
						if($obj_PermissionsCur->getactionId() == $arr_Object["Id"])
						{
							unset($obj_DOPermissionsCur[$str_I]);
							$bool_Found = true;
							break;
						}
					}

					if(!$bool_Found)
					{
						$obj_Row = new cActionResource();
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
				}
			}

			$this->m_obj_Response->setSuccess(true);
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}
}

/**
 * Group ID to Permission ID
 * @namespace User_Manager
 * @uri /group/{id}/permissions/{permissionID}
 */
class cGroupPermissionAdd extends cGroupDataBase {
	/**
	 * Add a Permission id to a user
	 * @method PUT
	 * @provides application/json
	 * @param String $str_GroupID
	 * @param String $str_PermissionID
	 * @return \Tonic\Response
	 */
	public function putPermission($str_GroupID = null,$str_PermissionID=null)
	{
		$bool_Fail = false;
		$obj_User =  self::getUserValidator();

		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions( cAction::C_STR_USER_MANAGER_GROUP_PERMISSION_EDIT))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		$obj_DOGroup = dataObject\cGroup::getGroupById($str_GroupID);

		if(!$bool_Fail&&!$obj_DOGroup)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_GroupID." is invalid.");
			$bool_Fail = true;
		}

		$obj_DOAction = cAction::getActionById($str_PermissionID);
		if(!$bool_Fail&&!$obj_DOAction)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_PermissionID." is not a valid Action.");
			$bool_Fail = true;
		}

		$obj_DOKeybox = cKeybox::countGroup2Permission($str_GroupID,$str_PermissionID);

		if(!$bool_Fail&& $obj_DOKeybox>0)
		{
			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setCode(\Tonic\Response::OK);
			$this->m_obj_Response->addMsg( "Group: ".$str_GroupID);
			$this->m_obj_Response->addMsg( "Permission: ".$str_PermissionID);
			$this->m_obj_Response->addMsg( "Link already Exists, no action taken.");
			$bool_Fail = true;
		}

		if(!$bool_Fail)
		{
			cKeybox::linkGroup2Permission($str_GroupID,$str_PermissionID);

			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setCode(\Tonic\Response::CREATED);
			$this->m_obj_Response->addMsg( "Group: ".$str_GroupID);
			$this->m_obj_Response->addMsg( "Permission: ".$str_PermissionID);
			$this->m_obj_Response->addMsg( "Link created.");
		}
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Remove a Permission ID from a Group
	 * @method DELETE
	 * @provides application/json
	 * @param String $str_GroupID
	 * @param String $str_PermissionID
	 * @return \Tonic\Response
	 */
	public function deleteGroup($str_GroupID = null,$str_PermissionID=null)
	{
		$bool_Fail = false;
		$obj_User =  self::getUserValidator();

		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions( cAction::C_STR_USER_MANAGER_GROUP_PERMISSION_EDIT))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		$obj_DOGroup = dataObject\cGroup::getGroupById($str_GroupID);

		if(!$bool_Fail&&!$obj_DOGroup)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_GroupID." is invalid.");
			$bool_Fail = true;
		}

		$obj_DOKeybox = cKeybox::countGroup2Permission($str_GroupID,$str_PermissionID);

		if(!$bool_Fail&& $obj_DOKeybox==0)
		{
			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setCode(\Tonic\Response::OK);
			$this->m_obj_Response->addMsg( "Group: ".$str_GroupID);
			$this->m_obj_Response->addMsg( "Permission: ".$str_PermissionID);
			$this->m_obj_Response->addMsg( "Dose Not have the Permission assigned to the user.");
			$bool_Fail = true;
		}

		if(!$bool_Fail)
		{
			cKeybox::unlinkGroup2Permission($str_GroupID,$str_PermissionID);

			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setCode(\Tonic\Response::OK);
			$this->m_obj_Response->addMsg( "Group: ".$str_GroupID);
			$this->m_obj_Response->addMsg( "Permission: ".$str_PermissionID);
			$this->m_obj_Response->addMsg( "Link Removed.");
		}
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}
}