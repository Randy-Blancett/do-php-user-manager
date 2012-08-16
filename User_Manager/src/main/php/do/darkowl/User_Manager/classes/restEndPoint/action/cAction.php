<?php
use darkowl\user_manager\resource\cActionResource;
use darkowl\user_manager\response\cActionResponse;
use darkowl\user_manager\dataObject;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname(__DIR__))."/dataObject/cAction.php";
require_once dirname(dirname(__DIR__))."/response/cActionResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cActionResource.php";

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /action
 */
class cAction extends Resource {
	const C_STR_PARAM_START = "start";
	const C_STR_PARAM_LIMIT = "limit";
	const C_STR_PARAM_PAGE = "page";
	/**
	 * @method GET
	 * @provides  application/json
	 */

	function getJson($request,$limit) {
		$obj_Response = new cActionResponse($request);

		$obj_DOAction = dataObject\cAction::getAllActions($_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);

		// 		$arr_Accept = Array();
		// 		foreach($request->accept as $arr_Object)
			// 		{
			// 			$arr_Accept = array_merge($arr_Accept,$arr_Object);
			// 		}

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

		return $obj_Response;
	}
}

