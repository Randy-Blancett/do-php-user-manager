<?php namespace MidnightPublishing\User_Manager\unitTest\rest;

use MidnightPublishing\User_Manager\cSession;
use Tonic\Request;
use Tonic\Application;
use MidnightPublishing\User_Manager\rest\user\cUserLogin;
use MidnightPublishing\User_Manager\rest\user\cUserDataBase;
use MidnightPublishing\User_Manager\database\cTableUsersQuery;


/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';


require_once dirname(dirname(dirname(dirname(__DIR__))))."/mock/loadDBMocks.php";
require_once APP_TOPDIR."/MidnightPublishing/User_Manager/rest/user/cUser.php";

class cUserTest extends \PHPUnit_Framework_TestCase
{

	public function testInstance()
	{
		$obj_Application = new Application();
		$obj_Request = new Request();
		$obj_Array = Array();

		$obj_UserDataBase = new cUserDataBase($obj_Application,$obj_Request,$obj_Array);
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\rest\\user\\cUserDataBase",$obj_UserDataBase);
	}


}