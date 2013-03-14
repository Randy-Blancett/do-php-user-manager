<?php
namespace darkowl\user_manager\unitTest;

use darkowl\user_manager\response\cTableResponse;

require_once dirname(dirname(dirname(dirname(__DIR__))))."/main/php/Tonic/Autoloader.php";
require_once dirname(dirname(dirname(dirname(__DIR__))))."/main/php/do/darkowl/User_Manager/classes/response/cTableResponse.php";

class cTableResponseTest extends \PHPUnit_Framework_TestCase
{
	public $m_obj_Request = null;

	public function setup()
	{
		$this->m_obj_Request = new \Tonic\Request();
	}

	function testInstance() {
		$obj_TableResponse = new cTableResponse();
		$this->assertInstanceOf("\\darkowl\\user_manager\\response\\cTableResponse", $obj_TableResponse);
	}

}