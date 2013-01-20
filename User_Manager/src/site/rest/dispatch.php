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


try {
	$obj_Resource = $obj_App->getResource($obj_Request);

	#echo $resource;
// 	 	print_r($obj_Resource);

	$obj_Response = $obj_Resource->exec();

} catch (Tonic\NotFoundException $e) {
	print("ERROR");
	$obj_Response = new Tonic\Response(404);

} catch (Tonic\UnauthorizedException $e) {
	print("ERROR");
	$obj_Response = new Tonic\Response(401);
	$obj_Response->wwwAuthenticate = 'Basic realm="My Realm"';

} catch (Tonic\Exception $e) {

	print("Error - ".$e);
	die();
	$obj_Response = new Tonic\Response(500);
}

#echo $response;

$obj_Response->output();

