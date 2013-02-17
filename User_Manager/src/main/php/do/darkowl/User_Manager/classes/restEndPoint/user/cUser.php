<?php
use \darkowl\user_manager\resource\cUserResource;
use \darkowl\user_manager\response\cUserResponse;
use \darkowl\user_manager\resource\cGroupResource;
use \darkowl\user_manager\response\cGroupResponse;
use \darkowl\user_manager\resource\cFormResource;
use \darkowl\user_manager\response\cFormResponse;
use \darkowl\user_manager\exception\cMissingParam;
use \darkowl\user_manager\dataObject;
use \darkowl\user_manager\cUser;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname(__DIR__))."/dataObject/cUser.php";
require_once dirname(dirname(__DIR__))."/dataObject/cUser2Groups.php";
require_once dirname(dirname(__DIR__))."/response/cUserResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cUserResource.php";
require_once dirname(dirname(__DIR__))."/response/cFormResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cFormResource.php";
require_once dirname(dirname(__DIR__))."/response/cGroupResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cGroupResource.php";
require_once dirname(dirname(__DIR__))."/dataObject/cAction.php";
require_once dirname(dirname(__DIR__))."/dataObject/cGroup.php";
require_once dirname(dirname(__DIR__))."/dataObject/cUser2Groups.php";


class cUserDataBase extends \Tonic\Resource {
	const C_STR_PARAM_START = "start";
	const C_STR_PARAM_LIMIT = "limit";
	const C_STR_PARAM_PAGE = "page";

	const C_STR_PARAM_DATA_ID = "userID";
	const C_STR_PARAM_DATA_AFFILIATION = "affiliation";
	const C_STR_PARAM_DATA_ACCOUNT_CREATED = "accountCreated";
	const C_STR_PARAM_DATA_USER_NAME = "userName";
	const C_STR_PARAM_DATA_PASSWORD = "password";
	const C_STR_PARAM_DATA_PASSWORD_CONFIRM = "passwordConfirm";
	const C_STR_PARAM_DATA_PERSONAL_TITLE = "perTitle";
	const C_STR_PARAM_DATA_PROFESONAL_TITLE = "profTitle";
	const C_STR_PARAM_DATA_F_NAME = "fName";
	const C_STR_PARAM_DATA_M_NAME = "mName";
	const C_STR_PARAM_DATA_L_NAME = "lName";
	const C_STR_PARAM_DATA_PHONE_1 = "phone1";
	const C_STR_PARAM_DATA_PHONE_2 = "phone2";
	const C_STR_PARAM_DATA_EMAIL_1 = "email1";
	const C_STR_PARAM_DATA_EMAIL_2 = "email2";
	const C_STR_PARAM_DATA_LOCATION = "location";
	const C_STR_PARAM_DATA_SUITE = "suite";
	const C_STR_PARAM_DATA_TYPE = "type";
	const C_STR_PARAM_DATA_COMPANY = "company";
	const C_STR_PARAM_DATA_ASSIGNED_ORG = "assignedOrg";
	const C_STR_PARAM_DATA_ORG = "org";
	const C_STR_PARAM_DATA_LAST_LOGIN = "lastLogin";
	const C_STR_PARAM_DATA_LAST_UPDATE = "lastUpdate";
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
			self::$m_obj_UserValidator = new \darkowl\user_manager\cUser(true,cUser::C_INT_LOGIN_TYPE_HTTP);
		}
		return self::$m_obj_UserValidator;
	}
}

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /user
 * @uri /user/{id}
 */
class cUserData extends cUserDataBase {
	private $m_obj_Response = null;



	/**
	 * Get Users depending on what is passed in
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
	 * Returns one user in the form Ext-JS Form expects
	 *
	 * @param String $str_ID Id of the Action to return
	 * @return \Tonic\Response
	 */
	public function getSingleJson($str_ID)
	{
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_USER_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);

		}
		else
		{
			$obj_DOUser = dataObject\cUser::getUserById($str_ID);

			$obj_Row = new cFormResource();

			$str_Key = self::C_STR_PARAM_DATA_ID;
			$obj_Row->$str_Key = $obj_DOUser->getId();

			$str_Key = self::C_STR_PARAM_DATA_AFFILIATION;
			$obj_Row->$str_Key = $obj_DOUser->getAffiliation();

			$str_Key = self::C_STR_PARAM_DATA_USER_NAME;
			$obj_Row->$str_Key = $obj_DOUser->getuserName();

			$str_Key = self::C_STR_PARAM_DATA_USER_NAME;
			$obj_Row->$str_Key = $obj_DOUser->getuserName();

			$str_Key = self::C_STR_PARAM_DATA_PERSONAL_TITLE;
			$obj_Row->$str_Key = $obj_DOUser->getpersonalTitle();

			$str_Key = self::C_STR_PARAM_DATA_PROFESONAL_TITLE;
			$obj_Row->$str_Key = $obj_DOUser->getprofessionalTitle();

			$str_Key = self::C_STR_PARAM_DATA_F_NAME;
			$obj_Row->$str_Key = $obj_DOUser->getfirstName();

			$str_Key = self::C_STR_PARAM_DATA_M_NAME;
			$obj_Row->$str_Key = $obj_DOUser->getmiddleName();

			$str_Key = self::C_STR_PARAM_DATA_L_NAME;
			$obj_Row->$str_Key = $obj_DOUser->getlastName();

			$str_Key = self::C_STR_PARAM_DATA_PHONE_1;
			$obj_Row->$str_Key = $obj_DOUser->getphoneNum1();

			$str_Key = self::C_STR_PARAM_DATA_PHONE_2;
			$obj_Row->$str_Key = $obj_DOUser->getphoneNum2();

			$str_Key = self::C_STR_PARAM_DATA_EMAIL_1;
			$obj_Row->$str_Key = $obj_DOUser->getEmail1();

			$str_Key = self::C_STR_PARAM_DATA_EMAIL_2;
			$obj_Row->$str_Key = $obj_DOUser->getEmail2();

			$str_Key = self::C_STR_PARAM_DATA_LOCATION;
			$obj_Row->$str_Key = $obj_DOUser->getLocation();

			$str_Key = self::C_STR_PARAM_DATA_SUITE;
			$obj_Row->$str_Key = $obj_DOUser->getSuite();

			$str_Key = self::C_STR_PARAM_DATA_TYPE;
			$obj_Row->$str_Key = $obj_DOUser->getType();

			$str_Key = self::C_STR_PARAM_DATA_COMPANY;
			$obj_Row->$str_Key = $obj_DOUser->getCompany();

			$str_Key = self::C_STR_PARAM_DATA_ASSIGNED_ORG;
			$obj_Row->$str_Key = $obj_DOUser->getassignedOrg();

			$str_Key = self::C_STR_PARAM_DATA_ORG;
			$obj_Row->$str_Key = $obj_DOUser->getOrg();

			$str_Key = self::C_STR_PARAM_DATA_LAST_LOGIN;
			$obj_Row->$str_Key = $obj_DOUser->getlastLogin();

			$str_Key = self::C_STR_PARAM_DATA_LAST_UPDATE;
			$obj_Row->$str_Key = $obj_DOUser->getlastUpdated();

			$str_Key = self::C_STR_PARAM_DATA_ACCOUNT_CREATED;
			$obj_Row->$str_Key = $obj_DOUser->getaccountCreation();

			$str_Key = self::C_STR_PARAM_DATA_COMMENT;
			$obj_Row->$str_Key = dataObject\cUser::getCommentString($obj_DOUser->getComment());


			// 	const C_STR_PARAM_DATA_COMMENT = "comment";
			// 			$obj_Row->comment = dataObject\cAction::getCommentString($obj_DOAction->getComment());

			$this->m_obj_Response->addResource($obj_Row);
			$this->m_obj_Response->setSuccess(true);
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Get a paged List of users
	 * @param integer $int_Start
	 * @param integer $int_Limit
	 * @return \Tonic\Response
	 */
	public function getAllJson($int_Start=0,$int_Limit=20)
	{
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cUserResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_USER_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_DOUsers =dataObject\cUser::getAllUsers($int_Start,$int_Limit);


			foreach($obj_DOUsers->toArray()as $arr_User)
			{
				$obj_Row = new cUserResource();
				foreach($arr_User as $str_Key => $obj_Data)
				{
					$str_Key = lcfirst($str_Key);

					if($obj_Data){
						switch($str_Key)
						{
							case "password":
								if($obj_Data)
								{
									$obj_Row->$str_Key = "true";
								}else
								{
									$obj_Row->$str_Key = "false";
								}
								break;
							case "comment":
								$obj_Data = dataObject\cUser::getCommentString($obj_Data);
								break;
							default:
								$obj_Row->$str_Key = $obj_Data;
								break;
						}
					}
				}
				$this->m_obj_Response->addResource($obj_Row);
			}

			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setTotal(dataObject\cUser::getTotalUserCount());
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Update User Record
	 * @method PUT
	 * @accepts application/x-www-form-urlencoded
	 * @provides application/json
	 * @return \Tonic\Response
	 */
	public function putJson()
	{
		$bool_Fail = false;

		parse_str($this->request->data,$arr_Data);

		$str_UserName = $arr_Data[self::C_STR_PARAM_DATA_USER_NAME];
		$str_Password = $arr_Data[self::C_STR_PARAM_DATA_PASSWORD];
		$str_ID = $arr_Data[self::C_STR_PARAM_DATA_ID];
		$str_PasswordConfirm = $arr_Data[self::C_STR_PARAM_DATA_PASSWORD_CONFIRM];

		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);

		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_USER_EDIT))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		if(!$bool_Fail&&!$str_ID)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError(self::C_STR_PARAM_DATA_ID." must be set for an update.");
			$bool_Fail = true;
		}

		if(!$bool_Fail&&!$str_UserName)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError(self::C_STR_PARAM_DATA_USER_NAME." can not be empty.");
			$bool_Fail = true;
		}

		if(!$bool_Fail && ($str_Password ||$str_PasswordConfirm))
		{
			if(!$bool_Fail && ($str_Password!==$str_PasswordConfirm))
			{
				$this->m_obj_Response->setSuccess(false);
				$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
				$this->m_obj_Response->logError(self::C_STR_PARAM_DATA_PASSWORD." and ".self::C_STR_PARAM_DATA_PASSWORD_CONFIRM." must match.");
				$bool_Fail = true;
			}
		}

		$obj_DOUser = new dataObject\cUser();

		$obj_OrigData = $obj_DOUser->getUserById($str_ID);

		if(!$bool_Fail&&!$obj_OrigData)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError(self::$obj_OrigData." must be an existing record.");
			$bool_Fail = true;
		}

		if(!$bool_Fail)
		{
			$obj_UpdateDate = new DateTime();

			$this->m_obj_Response->addMsg("Updateing Data for User '".$str_ID."'");

			if($obj_OrigData->getuserName() !== $str_UserName){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_USER_NAME." was changed from ".$obj_OrigData->getuserName() ." to ".$str_UserName);
				$obj_OrigData->setuserName($str_UserName);
			}

			if($str_Password)
			{
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PASSWORD." changed.");
				$obj_OrigData->setPassword(sha1($arr_Data[self::C_STR_PARAM_DATA_PASSWORD]));
			}

			if($obj_OrigData->getfirstName() !== $arr_Data[self::C_STR_PARAM_DATA_F_NAME]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_F_NAME." was changed from ".$obj_OrigData->getfirstName() ." to ".$arr_Data[self::C_STR_PARAM_DATA_F_NAME]);
				$obj_OrigData->setfirstName($arr_Data[self::C_STR_PARAM_DATA_F_NAME]);
			}

			if($obj_OrigData->getmiddleName() !== $arr_Data[self::C_STR_PARAM_DATA_M_NAME]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_M_NAME." was changed from ".$obj_OrigData->getmiddleName() ." to ".$arr_Data[self::C_STR_PARAM_DATA_M_NAME]);
				$obj_OrigData->setmiddleName($arr_Data[self::C_STR_PARAM_DATA_M_NAME]);
			}

			if($obj_OrigData->getlastName() !== $arr_Data[self::C_STR_PARAM_DATA_L_NAME]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_L_NAME." was changed from ".$obj_OrigData->getlastName() ." to ".$arr_Data[self::C_STR_PARAM_DATA_L_NAME]);
				$obj_OrigData->setlastName($arr_Data[self::C_STR_PARAM_DATA_L_NAME]);
			}

			if($obj_OrigData->getpersonalTitle() !== $arr_Data[self::C_STR_PARAM_DATA_PERSONAL_TITLE]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PERSONAL_TITLE." was changed from ".$obj_OrigData->getpersonalTitle() ." to ".$arr_Data[self::C_STR_PARAM_DATA_PERSONAL_TITLE]);
				$obj_OrigData->setpersonalTitle($arr_Data[self::C_STR_PARAM_DATA_PERSONAL_TITLE]);
			}

			if($obj_OrigData->getprofessionalTitle() !== $arr_Data[self::C_STR_PARAM_DATA_PROFESONAL_TITLE]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PROFESONAL_TITLE." was changed from ".$obj_OrigData->getprofessionalTitle() ." to ".$arr_Data[self::C_STR_PARAM_DATA_PROFESONAL_TITLE]);
				$obj_OrigData->setprofessionalTitle($arr_Data[self::C_STR_PARAM_DATA_PROFESONAL_TITLE]);
			}

			if($obj_OrigData->getphoneNum1() !== $arr_Data[self::C_STR_PARAM_DATA_PHONE_1]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PHONE_1." was changed from ".$obj_OrigData->getphoneNum1() ." to ".$arr_Data[self::C_STR_PARAM_DATA_PHONE_1]);
				$obj_OrigData->setphoneNum1($arr_Data[self::C_STR_PARAM_DATA_PHONE_1]);
			}

			if($obj_OrigData->getphoneNum2() !== $arr_Data[self::C_STR_PARAM_DATA_PHONE_2]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PHONE_2." was changed from ".$obj_OrigData->getphoneNum2() ." to ".$arr_Data[self::C_STR_PARAM_DATA_PHONE_2]);
				$obj_OrigData->setphoneNum2($arr_Data[self::C_STR_PARAM_DATA_PHONE_2]);
			}

			if($obj_OrigData->getEmail1() !== $arr_Data[self::C_STR_PARAM_DATA_EMAIL_1]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_EMAIL_1." was changed from ".$obj_OrigData->getEmail1() ." to ".$arr_Data[self::C_STR_PARAM_DATA_EMAIL_1]);
				$obj_OrigData->setEmail1($arr_Data[self::C_STR_PARAM_DATA_EMAIL_1]);
			}

			if($obj_OrigData->getEmail2() !== $arr_Data[self::C_STR_PARAM_DATA_EMAIL_2]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_EMAIL_2." was changed from ".$obj_OrigData->getEmail2() ." to ".$arr_Data[self::C_STR_PARAM_DATA_EMAIL_2]);
				$obj_OrigData->setEmail2($arr_Data[self::C_STR_PARAM_DATA_EMAIL_2]);
			}

			if($obj_OrigData->getassignedOrg() !== $arr_Data[self::C_STR_PARAM_DATA_ASSIGNED_ORG]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_ASSIGNED_ORG." was changed from ".$obj_OrigData->getassignedOrg() ." to ".$arr_Data[self::C_STR_PARAM_DATA_ASSIGNED_ORG]);
				$obj_OrigData->setassignedOrg($arr_Data[self::C_STR_PARAM_DATA_ASSIGNED_ORG]);
			}

			if($obj_OrigData->getOrg() !== $arr_Data[self::C_STR_PARAM_DATA_ORG]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_ORG." was changed from ".$obj_OrigData->getOrg() ." to ".$arr_Data[self::C_STR_PARAM_DATA_ORG]);
				$obj_OrigData->setOrg($arr_Data[self::C_STR_PARAM_DATA_ORG]);
			}

			if($obj_OrigData->getCompany() !== $arr_Data[self::C_STR_PARAM_DATA_COMPANY]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_COMPANY." was changed from ".$obj_OrigData->getCompany() ." to ".$arr_Data[self::C_STR_PARAM_DATA_COMPANY]);
				$obj_OrigData->setCompany($arr_Data[self::C_STR_PARAM_DATA_COMPANY]);
			}

			if($obj_OrigData->getAffiliation() !== $arr_Data[self::C_STR_PARAM_DATA_AFFILIATION]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_AFFILIATION." was changed from ".$obj_OrigData->getAffiliation() ." to ".$arr_Data[self::C_STR_PARAM_DATA_AFFILIATION]);
				$obj_OrigData->setAffiliation($arr_Data[self::C_STR_PARAM_DATA_AFFILIATION]);
			}

			if($obj_OrigData->getType() !== $arr_Data[self::C_STR_PARAM_DATA_TYPE]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_TYPE." was changed from ".$obj_OrigData->getType() ." to ".$arr_Data[self::C_STR_PARAM_DATA_TYPE]);
				$obj_OrigData->setType($arr_Data[self::C_STR_PARAM_DATA_TYPE]);
			}

			if($obj_OrigData->getLocation() !== $arr_Data[self::C_STR_PARAM_DATA_LOCATION]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_LOCATION." was changed from ".$obj_OrigData->getLocation() ." to ".$arr_Data[self::C_STR_PARAM_DATA_LOCATION]);
				$obj_OrigData->setLocation($arr_Data[self::C_STR_PARAM_DATA_LOCATION]);
			}

			if($obj_OrigData->getSuite() !== $arr_Data[self::C_STR_PARAM_DATA_SUITE]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_SUITE." was changed from ".$obj_OrigData->getSuite() ." to ".$arr_Data[self::C_STR_PARAM_DATA_SUITE]);
				$obj_OrigData->setSuite($arr_Data[self::C_STR_PARAM_DATA_SUITE]);
			}

			if($obj_OrigData->getComment() !== $arr_Data[self::C_STR_PARAM_DATA_COMMENT]){
				$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_COMMENT." was changed from ".$obj_Data = dataObject\cUser::getCommentString($obj_OrigData->getComment()) ." to ".$arr_Data[self::C_STR_PARAM_DATA_COMMENT]);
				$obj_OrigData->setComment($arr_Data[self::C_STR_PARAM_DATA_COMMENT]);
			}

			$obj_OrigData->setlastUpdated($obj_UpdateDate);
			$this->m_obj_Response->addMsg("Update Date set to ".$obj_UpdateDate->format('Y-m-d H:i:s'));

			$obj_OrigData->save();

			$this->m_obj_Response->setCode(\Tonic\Response::OK);
			$this->m_obj_Response->setSuccess(true);
		}
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Create a new User record
	 * @method POST
	 * @accepts application/x-www-form-urlencoded
	 * @provides application/json
	 * @return \Tonic\Response
	 */
	public function postJson() {
		$bool_Fail = false;
		$str_UserName = $_POST[self::C_STR_PARAM_DATA_USER_NAME];
		$str_Password = $_POST[self::C_STR_PARAM_DATA_PASSWORD];
		$str_PasswordConfirm = $_POST[self::C_STR_PARAM_DATA_PASSWORD_CONFIRM];

		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);


		$obj_DOUser = new dataObject\cUser();

		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_USER_ADD))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		if(!$bool_Fail&&$_POST[self::C_STR_PARAM_DATA_ID])
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError(self::C_STR_PARAM_DATA_ID." can not be set with a post.");
			$bool_Fail = true;
		}

		if(!$bool_Fail&&!$str_UserName)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError(self::C_STR_PARAM_DATA_USER_NAME." can not be empty.");
			$bool_Fail = true;
		}

		if(!$bool_Fail && $str_Password!==$str_PasswordConfirm)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError(self::C_STR_PARAM_DATA_PASSWORD." and ".self::C_STR_PARAM_DATA_PASSWORD_CONFIRM." must match.");
			$bool_Fail = true;
		}

		if($obj_DOUser->loadFromUserName($str_UserName))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError("User Name '".$str_UserName."' already exists.");
			$bool_Fail = true;
		}

		if(!$bool_Fail)
		{
			$obj_CreationDate = new DateTime();

			$obj_DOUser = new dataObject\cUser();
			$str_ID = dataObject\cUser::create_GUID();

			$obj_DOUser->setId($str_ID);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_ID." set to ".$obj_DOUser->getId());

			$obj_DOUser->setuserName($str_UserName);
			$this->m_obj_Response->addMsg($str_UserName." set to ".$obj_DOUser->getuserName());

			$obj_DOUser->setPwd($_POST[self::C_STR_PARAM_DATA_PASSWORD]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PASSWORD." set.");

			$obj_DOUser->setfirstName($_POST[self::C_STR_PARAM_DATA_F_NAME]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_F_NAME." set to ".$obj_DOUser->getfirstName());

			$obj_DOUser->setmiddleName($_POST[self::C_STR_PARAM_DATA_M_NAME]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_M_NAME." set to ".$obj_DOUser->getmiddleName());

			$obj_DOUser->setlastName($_POST[self::C_STR_PARAM_DATA_L_NAME]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_L_NAME." set to ".$obj_DOUser->getlastName());

			$obj_DOUser->setpersonalTitle($_POST[self::C_STR_PARAM_DATA_PERSONAL_TITLE]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PERSONAL_TITLE." set to ".$obj_DOUser->getpersonalTitle());

			$obj_DOUser->setprofessionalTitle($_POST[self::C_STR_PARAM_DATA_PROFESONAL_TITLE]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PROFESONAL_TITLE." set to ".$obj_DOUser->getprofessionalTitle());

			$obj_DOUser->setphoneNum1($_POST[self::C_STR_PARAM_DATA_PHONE_1]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PHONE_1." set to ".$obj_DOUser->getphoneNum1());

			$obj_DOUser->setphoneNum2($_POST[self::C_STR_PARAM_DATA_PHONE_2]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_PHONE_2." set to ".$obj_DOUser->getphoneNum2());

			$obj_DOUser->setEmail1($_POST[self::C_STR_PARAM_DATA_EMAIL_1]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_EMAIL_1." set to ".$obj_DOUser->getEmail1());

			$obj_DOUser->setEmail2($_POST[self::C_STR_PARAM_DATA_EMAIL_2]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_EMAIL_2." set to ".$obj_DOUser->getEmail2());

			$obj_DOUser->setassignedOrg($_POST[self::C_STR_PARAM_DATA_ASSIGNED_ORG]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_ASSIGNED_ORG." set to ".$obj_DOUser->getassignedOrg());

			$obj_DOUser->setOrg($_POST[self::C_STR_PARAM_DATA_ORG]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_ORG." set to ".$obj_DOUser->getOrg());

			$obj_DOUser->setCompany($_POST[self::C_STR_PARAM_DATA_COMPANY]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_COMPANY." set to ".$obj_DOUser->getCompany());

			$obj_DOUser->setAffiliation($_POST[self::C_STR_PARAM_DATA_AFFILIATION]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_AFFILIATION." set to ".$obj_DOUser->getAffiliation());

			$obj_DOUser->setType($_POST[self::C_STR_PARAM_DATA_TYPE]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_TYPE." set to ".$obj_DOUser->getType());

			$obj_DOUser->setLocation($_POST[self::C_STR_PARAM_DATA_LOCATION]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_LOCATION." set to ".$obj_DOUser->getLocation());

			$obj_DOUser->setSuite($_POST[self::C_STR_PARAM_DATA_SUITE]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_SUITE." set to ".$obj_DOUser->getSuite());

			$obj_DOUser->setComment($_POST[self::C_STR_PARAM_DATA_COMMENT]);
			$this->m_obj_Response->addMsg(self::C_STR_PARAM_DATA_COMMENT." set to ".$obj_DOUser->getComment());

			$obj_DOUser->setaccountCreation($obj_CreationDate);
			$this->m_obj_Response->addMsg("Creation Date set to ".$obj_CreationDate->format('Y-m-d H:i:s'));

			$obj_DOUser->save();

			$this->m_obj_Response->setCode(\Tonic\Response::CREATED);
			$this->m_obj_Response->setSuccess(true);

		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Delete User record
	 * @method DELETE
	 * @param String $str_ID
	 */
	public function deleteJson($str_ID = null)
	{
		$bool_Fail = false;
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);

		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_USER_DELETE))
		{
			$bool_Fail = true;
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}

		$obj_DOUser = new dataObject\cUser();

		$obj_OrigData = $obj_DOUser->getUserById($str_ID);

		if(!$bool_Fail&&!$obj_OrigData)
		{
			$this->m_obj_Response->setCode(\Tonic\Response::NOTFOUND);
			$this->m_obj_Response->setSuccess(false);

			$this->m_obj_Response->logError($str_ID." dose not exist therefore it could not be deleted.");
		}

		if(!$bool_Fail)
		{
			try {
				dataObject\cUser2Groups::deleteUsersGroups($str_ID);
			}
			catch (Exception $e)
			{
				$bool_Fail = true;
				$this->m_obj_Response->setCode(\Tonic\Response::INTERNALSERVERERROR);
				$this->m_obj_Response->setSuccess(false);
				$this->m_obj_Response->logError("Failed to remove User's Groups: ".$e->getMessage());
			}
		}

		if(!$bool_Fail)
		{

			$obj_OrigData->delete();

			$this->m_obj_Response->addMsg("Deleted ".$str_ID);
			$this->m_obj_Response->addMsg("Need to Clean out Keybox");
			$this->m_obj_Response->setCode(\Tonic\Response::OK);
			$this->m_obj_Response->setSuccess(true);
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

}


/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /user/{id}/groups/available
 */
class cUserGroupAvail extends cUserDataBase {/**
	* Get available groups for the given user
	* @method GET
	* @provides application/json
	* @param String $str_ID
	* @return \Tonic\Response
	*/
	public function getAvailGroupsJson($str_ID = null)
	{
		$bool_Fail = false;
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cGroupResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_GROUP_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		$obj_DOUser = dataObject\cUser::getUserById($str_ID);

		if(!$bool_Fail&&!$obj_DOUser)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_ID." is invalid.");
			$bool_Fail = true;
		}

		$obj_DOGroupsAvail = null;
		$obj_DOGroupsCur = null;
		if(!$bool_Fail){
			try {
				$obj_DOGroupsAvail=dataObject\cGroup::getAllGroups();
				$obj_DOGroupsCur=dataObject\cUser2Groups::getUsersGroups($str_ID);
			} catch (cMissingParam $e) {
				$this->m_obj_Response->setSuccess(false);
				$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
				$this->m_obj_Response->logError( $e->getMessage());
				$bool_Fail = true;
			}
		}

		if(!$bool_Fail){
			if($obj_DOGroupsAvail)
			{
				foreach($obj_DOGroupsAvail->toArray() as $arr_Object)
				{
					$bool_Found = false;
					foreach($obj_DOGroupsCur as $str_I=> $obj_GroupsCur)
					{
						if($obj_GroupsCur->getgroupId() == $arr_Object["Id"])
						{
							unset($obj_DOGroupsCur[$str_I]);
							$bool_Found = true;
							break;
						}
					}

					if(!$bool_Found)
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
 * @uri /user/{id}/groups/current
 */
class cUserGroupCurrent extends cUserDataBase {
	/**
	 * Get available groups for the given user
	 * @method GET
	 * @provides application/json
	 * @param String $str_ID
	 * @return \Tonic\Response
	 */
	public function getCurGroupsJson($str_ID = null)
	{
		$bool_Fail = false;
		$obj_User =  self::getUserValidator();
		$this->m_obj_Response = new cGroupResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_GROUP_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		$obj_DOUser = dataObject\cUser::getUserById($str_ID);

		if(!$bool_Fail&&!$obj_DOUser)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_ID." is invalid.");
			$bool_Fail = true;
		}

		$obj_DOGroups = null;
		if(!$bool_Fail){
			try {
				$obj_DOGroups=dataObject\cUser2Groups::getUsersGroups($str_ID,$_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);
			} catch (cMissingParam $e) {
				$this->m_obj_Response->setSuccess(false);
				$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
				$this->m_obj_Response->logError( $e->getMessage());
				$bool_Fail = true;
			}
		}

		if(!$bool_Fail){
			if($obj_DOGroups)
			{
				foreach($obj_DOGroups->toArray() as $arr_Groups)
				{
					if(isset($arr_Groups["groupId"]))
					{
						$obj_DOGroup = dataObject\cGroup::getGroupById($arr_Groups["groupId"]);
						$obj_Row = new cGroupResource();

						$obj_Row->id = $obj_DOGroup->getId();
						$obj_Row->comment = dataObject\cGroup::getCommentString($obj_DOGroup->getComment());
						$obj_Row->name = $obj_DOGroup->getName();

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
 * User ID to Group ID
 * @namespace User_Manager
 * @uri /user/{id}/groups/{groupID}
 */
class cUserGroupAdd extends cUserDataBase {
	/**
	 * Add a group id to a user
	 * @method PUT
	 * @provides application/json
	 * @param String $str_UserID
	 * @param String $str_GroupID
	 * @return \Tonic\Response
	 */
	public function putGroup($str_UserID = null,$str_GroupID=null)
	{
		$bool_Fail = false;
		$obj_User =  self::getUserValidator();

		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_USER_GROUP_EDIT))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		$obj_DOUser = dataObject\cUser::getUserById($str_UserID);

		if(!$bool_Fail&&!$obj_DOUser)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_UserID." is invalid.");
			$bool_Fail = true;
		}

		$obj_DOGroup = dataObject\cGroup::getGroupById($str_GroupID);
		if(!$bool_Fail&&!$obj_DOGroup)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_GroupID." is not a valid Group.");
			$bool_Fail = true;
		}

		$obj_DOUser2Groups = dataObject\cUser2Groups::countUser2Group($str_UserID,$str_GroupID);

		if(!$bool_Fail&& $obj_DOUser2Groups>0)
		{
			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setCode(\Tonic\Response::OK);
			$this->m_obj_Response->addMsg( "User: ".$str_UserID);
			$this->m_obj_Response->addMsg( "Group: ".$str_GroupID);
			$this->m_obj_Response->addMsg( "Link already Exists, no action taken.");
			$bool_Fail = true;
		}

		if(!$bool_Fail)
		{
			dataObject\cUser2Groups::linkUser2Group($str_UserID,$str_GroupID);

			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setCode(\Tonic\Response::CREATED);
			$this->m_obj_Response->addMsg( "User: ".$str_UserID);
			$this->m_obj_Response->addMsg( "Group: ".$str_GroupID);
			$this->m_obj_Response->addMsg( "Link created.");
		}
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Remove a Group ID from a User
	 * @method DELETE
	 * @provides application/json
	 * @param String $str_UserID
	 * @param String $str_GroupID
	 * @return \Tonic\Response
	 */
	public function deleteGroup($str_UserID = null,$str_GroupID=null)
	{
		$bool_Fail = false;
		$obj_User =  self::getUserValidator();

		$this->m_obj_Response = new cFormResponse();

		if(!$obj_User->checkPermissions(\darkowl\user_manager\dataObject\cAction::C_STR_USER_MANAGER_USER_GROUP_EDIT))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
			$bool_Fail = true;
		}

		$obj_DOUser = dataObject\cUser::getUserById($str_UserID);

		if(!$bool_Fail&&!$obj_DOUser)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$this->m_obj_Response->logError( $str_UserID." is invalid.");
			$bool_Fail = true;
		}

		$obj_DOUser2Groups = dataObject\cUser2Groups::countUser2Group($str_UserID,$str_GroupID);

		if(!$bool_Fail&& $obj_DOUser2Groups==0)
		{
			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setCode(\Tonic\Response::OK);
			$this->m_obj_Response->addMsg( "User: ".$str_UserID);
			$this->m_obj_Response->addMsg( "Group: ".$str_GroupID);
			$this->m_obj_Response->addMsg( "Dose Not have the group assigned to the user.");
			$bool_Fail = true;
		}

		if(!$bool_Fail)
		{
			dataObject\cUser2Groups::unlinkUser2Group($str_UserID,$str_GroupID);

			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setCode(\Tonic\Response::OK);
			$this->m_obj_Response->addMsg( "User: ".$str_UserID);
			$this->m_obj_Response->addMsg( "Group: ".$str_GroupID);
			$this->m_obj_Response->addMsg( "Link Removed.");
		}
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}
}
