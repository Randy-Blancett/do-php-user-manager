<?php
use darkowl\user_manager\resource\cUserResource;

use darkowl\user_manager\response\cUserResponse;

use darkowl\user_manager\dataObject;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname(__DIR__))."/dataObject/cUser.php";
require_once dirname(dirname(__DIR__))."/response/cUserResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cUserResource.php";

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /application
 */
class cApplication extends Resource {
	const C_STR_PARAM_START = "start";
	const C_STR_PARAM_LIMIT = "limit";
	const C_STR_PARAM_PAGE = "page";

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
}

