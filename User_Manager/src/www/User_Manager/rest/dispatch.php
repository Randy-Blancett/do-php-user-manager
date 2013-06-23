<?php
// use darkowl\user_manager\webpage\cInfo;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

// require_once (dirname(__DIR__)) . "/php/conf/cInfo.php";

PSR0Autoloader::autoload("MidnightPublishing\\User_Manager\\rest\\cBaseResource");

$obj_App = new Tonic\Application();
$obj_Request = new Tonic\Request();

try {
	$obj_Resource = $obj_App->getResource($obj_Request);

	// 	echo $resource;
	//print_r($obj_Resource);

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
	die("Dispatch line ".__LINE__);
	$obj_Response = new Tonic\Response(500);
}

#echo $response;

$obj_Response->output();

