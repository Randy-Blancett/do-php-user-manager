<?php 
namespace MidnightPublishing\User_Manager\unitTest\rest;
use MidnightPublishing\User_Manager\database\cTableUsersQuery;

use MidnightPublishing\User_Manager\rest\cLogin;

use Tonic\Request;

use Tonic\Application;

use MidnightPublishing\User_Manager\cSession;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';


require_once dirname(dirname(dirname(__DIR__)))."/mock/loadDBMocks.php";
require_once APP_TOPDIR."/MidnightPublishing/User_Manager/rest/user/cUser.php";

class absUserTest extends \PHPUnit_Framework_TestCase
{

	public function testUserLoginPost()
	{
		$obj_Application = new Application();
		$obj_Request = new Request();
		$obj_Array = Array();

		//Check with no data passed
		$obj_UserLogin = new cLogin($obj_Application, $obj_Request, $obj_Array);
		$obj_Return = $obj_UserLogin->postJson();
		$this->assertEquals(406,$obj_Return->code);
		$obj_Return = json_decode($obj_Return->body);
		$this->assertEquals(false,$obj_Return->success);
		$this->assertEquals("userName is a required parameter.",$obj_Return->errors[0]);

		//Pass userName
		$_POST[cLogin::C_STR_PARAM_DATA_USER_NAME] = "DarkOwl";

		$obj_Return = $obj_UserLogin->postJson();
		$this->assertEquals(403,$obj_Return->code);
		$obj_Return = json_decode($obj_Return->body);
		$this->assertEquals(false,$obj_Return->success);
		$this->assertEquals("Failed to login, Either Password Or User Name was incorrect",$obj_Return->errors[0]);

		//Pass userName and incorrect password
		$_POST[cLogin::C_STR_PARAM_DATA_USER_NAME] = "DarkOwl";
		$_POST[cLogin::C_STR_PARAM_DATA_PASSWORD] = "Fail";

		$obj_Return = $obj_UserLogin->postJson();
		$this->assertEquals(403,$obj_Return->code);
		$obj_Return = json_decode($obj_Return->body);
		$this->assertEquals(false,$obj_Return->success);
		$this->assertEquals("Failed to login, Either Password Or User Name was incorrect",$obj_Return->errors[0]);

		//Pass userName and correct password
		cTableUsersQuery::setPasswordReturn("test");
		cTableUsersQuery::setIdReturn("TestID");
		$_POST[cLogin::C_STR_PARAM_DATA_USER_NAME] = "TestID";
		$_POST[cLogin::C_STR_PARAM_DATA_PASSWORD] = "test";

		$obj_Return = $obj_UserLogin->postJson();

		$this->assertEquals(200,$obj_Return->code);
		$obj_Return = json_decode($obj_Return->body);
		$this->assertEquals(true,$obj_Return->success);
	}

	protected function setUp()
	{
		$_SESSION = Array();
		cSession::init();
	}
}