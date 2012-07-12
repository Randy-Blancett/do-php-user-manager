<?php
namespace darkowl\user_manager\unitTest;
use darkowl\user_manager\resource\abs_ExtJsResponse;

use darkowl\user_manager\resource\abs_Resource;

require_once dirname(dirname(dirname(__DIR__)))."/main/php/tonic/tonic.php";
require_once dirname(dirname(dirname(__DIR__)))."/main/php/do/darkowl/User_Manager/abstract/abs_ExtJsResponse.php";
require_once dirname(dirname(dirname(__DIR__)))."/main/php/do/darkowl/User_Manager/abstract/abs_Resource.php";

class cTestExtJsResponse extends abs_ExtJsResponse
{

}

class cTestResource extends abs_Resource
{

}

/**
 * @backupGlobals disabled
 */
class cExtJsResponseTest extends \PHPUnit_Framework_TestCase
{
	// 	private $m_obj_Response = null;
	// 	function setUp() {
	// 		$obj_Request = new \Request();
	// 		$obj_Request->accept = array(cTestExtJsResponse::C_STR_ACCEPT_JSON);
	// 		$this->m_obj_Response = new cTestExtJsResponse($obj_Request);
	// 	}

	private function getResponse()
	{
		$obj_Request = new \Request();
		$obj_Request->accept = array(cTestExtJsResponse::C_STR_ACCEPT_JSON);
		$obj_Response = new cTestExtJsResponse($obj_Request);

		return $obj_Response;
	}

	function testInstance()
	{
		$obj_Response = $this->getResponse();
		$this->assertInstanceOf("\\darkowl\\user_manager\\resource\\abs_ExtJsResponse", $obj_Response);
	}

	function testGetterSetter()
	{
		$obj_Response = $this->getResponse();
		$obj_Response->setSuccess(true);
		$this->assertTrue($obj_Response->getSuccess());

		$obj_Response = $this->getResponse();
		$obj_Response->setSuccess(false);
		$this->assertFalse($obj_Response->getSuccess());
	}

	function testLogger() {
		$obj_Response = $this->getResponse();
		$obj_Resource = new \stdClass();

		$obj_Output = null;

		$obj_Response->logError("Test Error");
		$obj_Response->setSuccess(false);

		ob_start();
		$obj_Response->output();
		$obj_Output = \json_decode(ob_get_clean());

		$this->assertEquals(1, sizeof($obj_Output->errors));
		$this->assertEquals("Test Error", $obj_Output->errors[0]);
		$this->assertFalse( $obj_Output->success);
	}

	function testMsgs() {
		$obj_Response = $this->getResponse();
		$obj_Resource = new \stdClass();

		$obj_Output = null;

		$obj_Response->addMsg("Test Msg");
		$obj_Response->setSuccess(true);

		ob_start();
		$obj_Response->output();
		$obj_Output = \json_decode(ob_get_clean());

		$this->assertEquals(1, sizeof($obj_Output->msgs));
		$this->assertEquals("Test Msg", $obj_Output->msgs[0]);
		$this->assertTrue( $obj_Output->success);
	}

	public function testResource()
	{
		$obj_Response = $this->getResponse();
		$obj_Resource = new cTestResource();
		$obj_Resource->test = "test";
		$obj_Resource->test1 = "test1";
		$obj_Response->addResource($obj_Resource);


		$obj_Resource = new cTestResource();
		$obj_Resource->test2 = "test2";
		$obj_Resource->test3 = "test3";
		$obj_Response->addResource($obj_Resource);

		$obj_Response->setSuccess(true);

		ob_start();
		$obj_Response->output();
		$obj_Output = \json_decode(ob_get_clean());

		//print_r($obj_Output);

		$obj_Resources = $obj_Output->resources;

		$this->assertTrue(is_array($obj_Resources),"Resources is not an array");
		$this->assertEquals(2,sizeof($obj_Resources));

		$this->assertEquals("test",$obj_Resources[0]->test);
		$this->assertEquals("test1",$obj_Resources[0]->test1);

		$this->assertEquals("test2",$obj_Resources[1]->test2);
		$this->assertEquals("test3",$obj_Resources[1]->test3);

		$this->assertTrue($obj_Output->success);


		$obj_Output = null;
	}
}