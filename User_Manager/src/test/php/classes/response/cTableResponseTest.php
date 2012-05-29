<?php
namespace darkowl\user_manager\unitTest;

use darkowl\user_manager\response\cTableResponse;

require_once dirname(dirname(dirname(dirname(__DIR__))))."/main/php/tonic/tonic.php";
require_once dirname(dirname(dirname(dirname(__DIR__))))."/main/php/do/darkowl/User_Manager/classes/response/cTableResponse.php";

class cTableResponseTest extends \PHPUnit_Framework_TestCase
{
	public $m_obj_Request = null;

	public function setup()
	{
		$this->m_obj_Request = new \Request();
		$obj_Request->accept = array(cTestExtJsResponse::C_STR_ACCEPT_JSON);
	}

	function testInstance() {
		$obj_TableResponse = new cTableResponse($this->m_obj_Request);
		$this->assertInstanceOf("\\darkowl\\user_manager\\response\\cTableResponse", $obj_TableResponse);
	}

}