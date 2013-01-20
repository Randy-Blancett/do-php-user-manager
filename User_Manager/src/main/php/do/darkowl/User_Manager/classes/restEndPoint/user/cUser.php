<?php
use \darkowl\user_manager\resource\cUserResource;
use \darkowl\user_manager\response\cUserResponse;
use \darkowl\user_manager\resource\cFormResource;
use \darkowl\user_manager\response\cFormResponse;
use \darkowl\user_manager\dataObject;
use \darkowl\user_manager\cUser;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname(__DIR__))."/dataObject/cUser.php";
require_once dirname(dirname(__DIR__))."/response/cUserResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cUserResource.php";
require_once dirname(dirname(__DIR__))."/response/cFormResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cFormResource.php";
require_once dirname(dirname(__DIR__))."/dataObject/cAction.php";

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /user
 * @uri /user/{id}
 */
class cUserData extends \Tonic\Resource {
	const C_STR_PARAM_START = "start";
	const C_STR_PARAM_LIMIT = "limit";
	const C_STR_PARAM_PAGE = "page";


	const C_STR_PARAM_DATA_ID = "userID";
	const C_STR_PARAM_DATA_AFFILIATION = "affiliation";
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
			self::$m_obj_UserValidator = new \darkowl\user_manager\cUser(true,cUser::C_INT_LOGIN_TYPE_HTTP);
		}
		return self::$m_obj_UserValidator;
	}


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
						// 						switch($str_Key)
						// 						{
						// 							case "application":
						// 								$obj_Row->applicationName = cApplication::convertID($obj_Data);
						// 								break;
						// 							case "comment":
						// 								$obj_Data = dataObject\cAction::getCommentString($obj_Data);
						// 								break;
						// 						}

						$obj_Row->$str_Key = $obj_Data;
					}
				}
				$this->m_obj_Response->addResource($obj_Row);
			}

			$this->m_obj_Response->setSuccess(true);
			$this->m_obj_Response->setTotal(dataObject\cUser::getTotalUserCount());
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}


	function get($request,$limit) {
		$obj_Response = new cUserResponse($request);

		$obj_DOUser = dataObject\cUser::getAllUsers($_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);

		$arr_Accept = Array();
		foreach($request->accept as $arr_Object)
		{
			$arr_Accept = array_merge($arr_Accept,$arr_Object);
		}

		foreach($obj_DOUser->toArray()as $arr_Object)
		{
			$obj_Row = new cUserResource();
			foreach($arr_Object as $str_Key => $obj_Data)
			{
				$str_Key = lcfirst($str_Key);

				if($obj_Data){
					if(strtolower($str_Key) != "password")
					{
						$obj_Row->$str_Key = $obj_Data;
					}
				}
			}
			$obj_Response->addResource($obj_Row);
		}

		$obj_Response->setSuccess(true);
		$obj_Response->setTotal(dataObject\cUser::getTotalUserCount());

		return $obj_Response;
	}

	/**
	 * Create a new User record
	 * @method POST
	 * @accepts application/x-www-form-urlencoded
	 * @provides application/json
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
			$this->m_obj_Response->logError(self::C_STR_PARAM_DATA_ID." can not be set with a post.");
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
}

