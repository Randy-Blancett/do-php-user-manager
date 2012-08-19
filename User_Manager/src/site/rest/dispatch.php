<?php
use \darkowl\user_manager\webpage;

require_once (dirname(__DIR__)) . "/php/conf/cInfo.php";
// load Tonic library
//
require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH .'/Tonic/Autoloader.php';

// base resource
require_once webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH."/classes/restEndPoint/cBaseResource.php";


$config = array(
		'load' => array('../*.php',  webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH.'/do/darkowl/User_Manager/classes/restEndPoint/*.php')
);

// handle request


$obj_App = new Tonic\Application($config);


$obj_Request = new Tonic\Request();
// $obj_Request->baseUri = "/User_Manager/rest";
// try {

// 	$obj_Resource = $obj_Request->loadResource();
// 	$obj_Response = $obj_Resource->exec($obj_Request);

// } catch (ResponseException $e) {
// 	switch ($e->getCode()) {
// 		case Response::UNAUTHORIZED:
// 			$obj_Response = $e->$obj_Response($obj_Request);
// 			$obj_Response->addHeader('WWW-Authenticate', 'Basic realm="User Manager"');
// 			break;
// 		default:
// 			$obj_Response = $e->response($obj_Request);
// 	}
// }
// $obj_Response->output();


try {

	$obj_Resource = $obj_App->getResource($obj_Request);

	#echo $resource;

	$obj_Response = $obj_Resource->exec();

} catch (Tonic\NotFoundException $e) {
	$obj_Response = new Tonic\Response(404);

} catch (Tonic\UnauthorizedException $e) {
	$obj_Response = new Tonic\Response(401);
	$obj_Response->wwwAuthenticate = 'Basic realm="My Realm"';

} catch (Tonic\Exception $e) {

	print($e);
	$obj_Response = new Tonic\Response(500);
}

#echo $response;

$obj_Response->output();

