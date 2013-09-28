<?php
namespace MidnightPublishing\User_Manager\unitTest;
use \MidnightPublishing\User_Manager\response\cConfigResponse;
use \MidnightPublishing\User_Manager\resource\cConfigResource;

class cConfigResponseTest extends \PHPUnit_Framework_TestCase
{
	public function testConstructor()
	{
		$response = new cConfigResponse();

		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\response\\cConfigResponse", $response);
	}

	public function testToJson()
	{
		$m_obj_Response	 = new cConfigResponse();
		$obj_ConfigItem	 = new cConfigResource();

		$obj_ConfigItem->TestData	 = "Test1";
		$obj_ConfigItem->TestData2	 = "Test2";


		$m_obj_Response->addResource($obj_ConfigItem);

		$m_obj_Response->setSuccess(true);
		//Always one Item
		$m_obj_Response->setTotal(1);

//		print($m_obj_Response->output_JSON());
	}

}