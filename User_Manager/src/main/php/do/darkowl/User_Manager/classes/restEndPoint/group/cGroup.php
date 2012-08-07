<?php
use darkowl\user_manager\dataObject;

use darkowl\user_manager\resource\cGroupResource;
use darkowl\user_manager\response\cGroupResponse;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname(__DIR__))."/dataObject/cGroup.php";
require_once dirname(dirname(__DIR__))."/response/cGroupResponse.php";
require_once dirname(dirname(__DIR__))."/resource/cGroupResource.php";

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /group
 */
class cGroup extends Resource {
	const C_STR_PARAM_START = "start";
	const C_STR_PARAM_LIMIT = "limit";
	const C_STR_PARAM_PAGE = "page";

	function get($request,$limit) {
		$obj_Response = new cGroupResponse($request);

		$obj_DOGroup = dataObject\cGroup::getAllGroups($_REQUEST[self::C_STR_PARAM_START],$_REQUEST[self::C_STR_PARAM_LIMIT]);

		$arr_Accept = Array();
		foreach($request->accept as $arr_Object)
		{
			$arr_Accept = array_merge($arr_Accept,$arr_Object);
		}

		foreach($obj_DOGroup->toArray()as $arr_Object)
		{
			$obj_Row = new cGroupResource();
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
		$obj_Response->setTotal(dataObject\cGroup::getTotalGroupCount());

		return $obj_Response;
	}
}

