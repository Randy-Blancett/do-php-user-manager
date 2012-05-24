<?php
use \darkowl\user_manager\webpage;
//use \darkowl\user_manager\restEndPoint

require_once (dirname(__DIR__)) . "/php/conf/cInfo.php";
// load Tonic library
require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH .'/tonic/tonic.php';

// base resource
require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH."/classes/restEndPoint/cBaseResource.php";

// handle request
$obj_Request = new Request();
$obj_Request->baseUri = "/User_Manager/rest";
try {
	$obj_Resource = $obj_Request->loadResource();
	$obj_Response = $obj_Resource->exec($obj_Request);

} catch (ResponseException $e) {
	switch ($e->getCode()) {
		case Response::UNAUTHORIZED:
			$obj_Response = $e->$obj_Response($obj_Request);
			$obj_Response->addHeader('WWW-Authenticate', 'Basic realm="User Manager"');
			break;
		default:
			$obj_Response = $e->response($obj_Request);
	}
}
$obj_Response->output();

