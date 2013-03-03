<?php
use darkowl\user_manager\response\cDatabaseResponse;
use darkowl\user_manager\resource\cDatabaseResource;
use darkowl\user_manager\cUser;
use \darkowl\user_manager\webpage;

// require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname( __DIR__)).'/response/cDatabaseResponse.php';
require_once dirname(dirname( __DIR__)).'/resource/cDatabaseResource.php';

require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH."/conf/cDBConfig.php";
/**
 * Include User Validation Class
 */
require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH . "/classes/cUser.php";

/**
 * Resource used to Handle setup of User Manager
 * @namespace User_Manager\Setup
 * @uri /setup
 */
class cSetupResource extends \Tonic\Resource {

	const C_STR_PARAM_ACTION = "action";
	const C_STR_ACTION_CREATE = "create";

	private $m_obj_Response = null;
	private static $m_obj_UserValidator = null;

	public function outputCreate()
	{
		$obj_DatabaseResource = new cDatabaseResource();

		$obj_DatabaseResource->setURI("rest/database/user_manager");
		$obj_DatabaseResource->setName("User Manager");

		$this->m_obj_Response->addResource($obj_DatabaseResource);
		$this->m_obj_Response->setSuccess(true);
	}

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
	 * @method GET
	 */
	public function getHTML() {
		// Check Login Status
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);
		return <<<END
<h1>Setup</h1>
<p>This page is used to setup the database</p>

END;

	}
	/**
	 * @method POST
	 * @accepts application/x-www-form-urlencoded
	 * @provides application/json
	 */
	public 	function postJSON()
	{
		$obj_User =  self::getUserValidator();
		$obj_User->require_Login(true);
		$this->m_obj_Response = new cDatabaseResponse();

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
				$this->m_obj_Response->setCode(\Tonic\Response::NOTACCEPTABLE);
				$this->m_obj_Response->logError("'".self::C_STR_PARAM_ACTION."' is a required parameter.");
			}
			else
			{
				switch ($arr_Data[self::C_STR_PARAM_ACTION])
				{
					case self::C_STR_ACTION_CREATE :
						$this->outputCreate();
						break;
					default:
						$this->m_obj_Response->setCode(\Tonic\Response::NOTACCEPTABLE);
						$this->m_obj_Response->logError("'".$arr_Data[self::C_STR_PARAM_ACTION]."' is an unknown action.");
				}
			}
		}else {
			$this->m_obj_Response->setCode(\Tonic\Response::UNAUTHORIZED);
			$this->m_obj_Response->setSuccess(false);
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	function getInfo()
	{
		$str_Output = "";

		$str_Output .="<h1>Setup</h1>";
		$str_Output .="<h2>GET</h2>";

		return $str_Output;
	}

}

