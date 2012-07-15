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
 * @uri /user
 */
class cUser extends Resource {
	function get($request) {
		$obj_Response = new cUserResponse($request);

		$obj_DOUser = dataObject\cUser::getAllUsers();

		// 		print_R($obj_DOUser->toArray());

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
				// 				print_r($str_Data);print("\n");

				if($obj_Data){
					$obj_Row->$str_Key = $obj_Data;
				}
			}
			$obj_Response->addResource($obj_Row);
		}

		// 		if(in_array("json",$arr_Accept))
		// 		{
		// 			$obj_Response->body =
		// 			// 			$response->body = "JSON";
		// 		}
		// 		else
		// 		{
		// 			$obj_Response->body = "Not JSON";
		// 		}


		return $obj_Response;
	}
}

