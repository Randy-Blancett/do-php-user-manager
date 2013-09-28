<?php
namespace MidnightPublishing\User_Manager\rest\config;
use MidnightPublishing\User_Manager\response\cConfigResponse;
use MidnightPublishing\User_Manager\resource\cConfigResource;
use MidnightPublishing\User_Manager\response\cFormResponse;
use MidnightPublishing\User_Manager\dataObject\cAction;
use MidnightPublishing\User_Manager;
use MidnightPublishing\User_Manager\conf\cInfo;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';
class cConfigDataBase extends \Tonic\Resource
{

	private static $m_obj_UserValidator = null;

	/**
	 * Singleton of the User Validator object
	 * @return cUser
	 */
	protected static function getUserValidator()
	{
		if (!self::$m_obj_UserValidator)
		{
			self::$m_obj_UserValidator = new User_Manager\cUser(true, User_Manager\cUser::C_INT_LOGIN_TYPE_HTTP);
		}
		return self::$m_obj_UserValidator;
	}

}

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /config
 * @uri /config/{category}
 */
class cConfigData extends cConfigDataBase
{

	private $m_obj_Response = null;

	/**
	 * Get all config data
	 * @method GET
	 * @provides application/json
	 * @param String $str_Category
	 * @return \Tonic\Response
	 */
	public function getAllJson($str_Category)
	{
		$obj_User				 = self::getUserValidator();
		$this->m_obj_Response	 = new cConfigResponse();


		if (!$obj_User->checkPermissions(cAction::C_STR_USER_MANAGER_CONFIG_VIEW))
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
		}
		else
		{
			$obj_Config		 = new cInfo();
			$obj_ConfigItem	 = new cConfigResource();

			foreach ($obj_Config->getCategoryConfigItems($str_Category) as $str_Key => $str_Data)
			{
				$obj_ConfigItem->$str_Key = $str_Data;
			}
			$this->m_obj_Response->addResource($obj_ConfigItem);

			$this->m_obj_Response->setSuccess(true);
			//Always one Item
			$this->m_obj_Response->setTotal(1);
		}
		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

	/**
	 * Update Configuration Data
	 * @method POST
	 * @param String $str_Category
	 * @return \Tonic\Response
	 */
	public function postJson($str_Category = null)
	{
		$this->m_obj_Response	 = new cFormResponse();
		$bool_Fail				 = false;
		$arr_Data				 = array(
			);
		if ($str_Category == null)
		{
			$this->m_obj_Response->setSuccess(false);
			$this->m_obj_Response->setCode(\Tonic\Response::BADREQUEST);
			$bool_Fail = true;
		}

		if (!$bool_Fail)
		{

			parse_str($this->request->data, $arr_Data);

			$obj_User = self::getUserValidator();
			$obj_User->require_Login(true);


			if (!$obj_User->checkPermissions(cAction::C_STR_USER_MANAGER_USER_EDIT))
			{
				$this->m_obj_Response->setSuccess(false);
				$this->m_obj_Response->setCode(\Tonic\Response::FORBIDDEN);
				$bool_Fail = true;
			}
		}

		if (!$bool_Fail)
		{
			$obj_Config		 = new cInfo();
			$bool_Updated	 = false;

			foreach ($arr_Data as $str_Key => $str_Value)
			{
				$bool_Updated = true;
				$obj_Config->setParam($str_Key, $str_Value, $str_Category);
			}

			if ($bool_Updated)
			{
				$obj_Config->save();
			}

			$this->m_obj_Response->setCode(\Tonic\Response::OK);
			$this->m_obj_Response->setSuccess(true);
		}

		return new \Tonic\Response($this->m_obj_Response->getCode(), $this->m_obj_Response->output_JSON());
	}

}