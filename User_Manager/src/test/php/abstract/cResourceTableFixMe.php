<?php
require_once dirname(dirname(dirname(__DIR__)))."/main/php/do/darkowl/User_Manager/abstract/abs_ResourceTable.php";
class cREsourceTableTest extends \PHPUnit_Framework_TestCase
{
	// 	private function getResponse()
	// 	{
	// 		$obj_Request = new \Request();
	// 		$obj_Request->accept = array(cTestExtJsResponse::C_STR_ACCEPT_JSON);
	// 		$obj_Response = new cTestExtJsResponse($obj_Request);

	// 		return $obj_Response;
	// 	}

	private $m_obj_ResourceTable ;

	function getRequest()
	{
		$obj_Request = new Request();
		$obj_Request->baseUri = "/User_Manager/rest";

		return $obj_Request;
	}

// 	function getResourceTable()
// 	{
// 		if(!$this->m_obj_ResourceTable)
// 		{
// 			$this->m_obj_ResourceTable = new abs_ResourceTable(null);
// 		}
// 		return $this->m_obj_ResourceTable;
// 	}

// 	function testPostNoAction()
// 	{
// 		$obj_ResourceTable = $this->getResourceTable();
// 		$obj_Response = $obj_ResourceTable->post($this->getRequest());

// 		$this->assertEquals (406,$obj_Response->code);
// 	}

// 	function testPostCreate()
// 	{
// 		$obj_ResourceTable = $this->getResourceTable();
// 		$obj_Request = $this->getRequest();
// 		$obj_Request->data = abs_ResourceTable::C_STR_PARAM_ACTION."=".abs_ResourceTable::C_STR_ACTION_CREATE;


// 		$obj_Response = $obj_ResourceTable->post($obj_Request);

// 		$this->assertEquals (201,$obj_Response->code);
// 	}
}