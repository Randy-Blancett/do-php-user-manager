<?php
namespace darkowl\user_manager\unitTest;

use \darkowl\user_manager\response\cDatabaseResponse;
use \darkowl\user_manager\resource\cTableResource;

require_once dirname(dirname(dirname(dirname(__DIR__))))."/main/php/do/darkowl/User_Manager/classes/response/cDatabaseResponse.php";

class cDatabaseResponseTest extends \PHPUnit_Framework_TestCase
{
	public $m_obj_Request = null;

	public function setup()
	{
		$this->m_obj_Request = new \Request();
		$obj_Request->accept = array(cTestExtJsResponse::C_STR_ACCEPT_JSON);
	}

	function testInstance() {
		$obj_DatabaseResponse = new cDatabaseResponse($this->m_obj_Request);
		$this->assertInstanceOf("\\darkowl\\user_manager\\response\\cDatabaseResponse", $obj_DatabaseResponse);
	}
}