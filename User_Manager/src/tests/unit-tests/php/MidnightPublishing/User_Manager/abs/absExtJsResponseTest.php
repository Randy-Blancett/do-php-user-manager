<?php
namespace MidnightPublishing\User_Manager\unitTest;

use MidnightPublishing\User_Manager\abs\absResource;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

use MidnightPublishing\User_Manager\abs\absResourceTable;
use MidnightPublishing\User_Manager\abs\absExtJsResponse;

class cTestExtJsResponse extends absExtJsResponse
{

}

class cTestResource extends absResource
{

}

class cExtJsResponseTest extends \PHPUnit_Framework_TestCase
{
	function testInstance()
	{
		$obj_Response = new cTestExtJsResponse();
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\abs\\absExtJsResponse", $obj_Response);
	}

	function testGetterSetter()
	{
		$obj_Response = new cTestExtJsResponse();

		$obj_Response->setSuccess(true);
		$this->assertTrue($obj_Response->getSuccess());

		$obj_Response->setSuccess(false);
		$this->assertFalse($obj_Response->getSuccess());

		$obj_Response->setCode(200);
		$this->assertEquals(200, $obj_Response->getCode());
	}

	/**
	 * Output a full JSON file
	 */
	function testOutputFullJSON()
	{
		$obj_Response = new cTestExtJsResponse();

		$obj_Resource = new cTestResource();
		$obj_Resource->test = True;

		$obj_Response->setSuccess(true);
		$obj_Response->setCode(200);
		$obj_Response->setTotal(100);
		$obj_Response->addMsg("Test Message.");
		$obj_Response->addMsg("Test Message 2.");
		$obj_Response->logError("Test Log Message.");
		$obj_Response->logError("Test Log Message 2.");
		$obj_Response->addResource($obj_Resource);
		$obj_Response->addResource($obj_Resource);

		$obj_JSON = \json_decode($obj_Response->output_JSON());

		$this->assertTrue( $obj_JSON->success);
		$this->assertEquals(100, $obj_JSON->total);
		$this->assertEquals("Test Message.", $obj_JSON->msgs[0]);
		$this->assertEquals("Test Message 2.", $obj_JSON->msgs[1]);
		$this->assertEquals("Test Log Message.", $obj_JSON->errors[0]);
		$this->assertEquals("Test Log Message 2.", $obj_JSON->errors[1]);
		$this->assertEquals("1", $obj_JSON->resources[0]->test);
		$this->assertEquals("1", $obj_JSON->resources[1]->test);

		$obj_JSON = null;
	}

}