<?php 
namespace MidnightPublishing\User_Manager\unitTest;


use MidnightPublishing\User_Manager\database\cTableUsersQuery;

use MidnightPublishing\User_Manager\cSession;

use MidnightPublishing\User_Manager\abs\absResourceTable;

require_once dirname(dirname(dirname(__DIR__)))."/mock/loadDBMocks.php";
require_once dirname(dirname(dirname(__DIR__)))."/mock/testObjects/cTestUser.php";

class cTestResourceTable extends absResourceTable
{

}

class absResourceTableTest extends \PHPUnit_Framework_TestCase
{
	protected function setUp()
	{
		$_SESSION = Array();
		cSession::init();
	}
	
	public	function testInstance()
	{
		$obj_Application = new \Tonic\Application();
		$obj_Request = new \Tonic\Request();

		//Check when not logged in

		$ResourceTable = new cTestResourceTable($obj_Application, $obj_Request, Array());
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\unitTest\\cTestResourceTable", $ResourceTable);
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\abs\\absResourceTable", $ResourceTable);
	}
	/**
	 * Test that a when no one is logged in this will return 401
	 */
	function testPostJSONNoLogin()
	{
		$_SERVER["SERVER_PORT"]= 80;
		$_SERVER["SERVER_NAME"]= "Test";
		$_SERVER["REQUEST_URI"]="Test1";

		$obj_Application = new \Tonic\Application();
		$obj_Request = new \Tonic\Request();

		//Check when not logged in

		$ResourceTable = new cTestResourceTable($obj_Application, $obj_Request, Array());

		$obj_Return = $ResourceTable->postJSON();

		$this->assertEquals("text/html",$obj_Return->__get("content-type"));
		$this->assertEquals("401",$obj_Return->code);
		$this->assertEquals("{\"success\":false}",$obj_Return->body);
	}

	/**
	 * Test that a if the logged in user is not god it will return 401
	 */
	function testPostJSONWithLogin()
	{
		$_SERVER["SERVER_PORT"]= 80;
		$_SERVER["SERVER_NAME"]= "Test";
		$_SERVER["REQUEST_URI"]="Test1";

		$obj_Application = new \Tonic\Application();
		$obj_Request = new \Tonic\Request();

		$_SESSION = Array();
		cSession::init();

		\cPropelTestConnector::initPropel();
		$obj_User = new cTestUser();

		cTableUsersQuery::setPasswordReturn("test");
		cTableUsersQuery::setIdReturn("TestID");

		$this->assertTrue($obj_User->login("Test", "test",false));

		$ResourceTable = new cTestResourceTable($obj_Application, $obj_Request, Array());

		$obj_Return = $ResourceTable->postJSON();

		$this->assertEquals("text/html",$obj_Return->__get("content-type"));
		$this->assertEquals("401",$obj_Return->code);
		$this->assertEquals("{\"success\":false}",$obj_Return->body);
	}

	/**
	 * Test that a if the logged in as god it works correctly
	 */
	function testPostJSONGodLogin()
	{
		$_SERVER["SERVER_PORT"]= 80;
		$_SERVER["SERVER_NAME"]= "Test";
		$_SERVER["REQUEST_URI"]="Test1";

		\cPropelTestConnector::initPropel();
		$obj_User = new cTestUser();

		$obj_Application = new \Tonic\Application();
		$obj_Request = new \Tonic\Request();

		$_SESSION = Array();
		cSession::init();

		$this->assertTrue($obj_User->login("DarkOwl", "Is#1",false));

		$ResourceTable = new cTestResourceTable($obj_Application, $obj_Request, Array());
		$obj_Return = $ResourceTable->postJSON();

		$this->assertEquals("text/html",$obj_Return->__get("content-type"));
		$this->assertEquals("406",$obj_Return->code);
		$this->assertEquals("{\"errors\":[\"'action' is a required parameter.\"]}",$obj_Return->body);

		//Pass Action
		$obj_Request->data=cTestResourceTable::C_STR_PARAM_ACTION."=".cTestResourceTable::C_STR_ACTION_CREATE;

		$obj_Return = $ResourceTable->postJSON();

		$this->assertEquals("text/html",$obj_Return->__get("content-type"));
		$this->assertEquals("201",$obj_Return->code);
		$this->assertEquals("{\"success\":true}",$obj_Return->body);

		//Pass no Action
		$obj_Request->data="data=".cTestResourceTable::C_STR_ACTION_CREATE;

		$obj_Return = $ResourceTable->postJSON();

		$this->assertEquals("text/html",$obj_Return->__get("content-type"));
		$this->assertEquals("406",$obj_Return->code);
		$this->assertEquals("{\"errors\":[\"'action' is a required parameter.\"]}",$obj_Return->body);

		//Pass bad Action
		$obj_Request->data=cTestResourceTable::C_STR_PARAM_ACTION."=fail";

		$obj_Return = $ResourceTable->postJSON();

		$this->assertEquals("text/html",$obj_Return->__get("content-type"));
		$this->assertEquals("406",$obj_Return->code);
		$this->assertEquals("{\"errors\":[\"'fail' is an unknown action.\"]}",$obj_Return->body);

	}
}