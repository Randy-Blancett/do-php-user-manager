<?php
namespace darkowl\user_manager\unitTest;

use darkowl\user_manager\resource\cTableResource;

require_once dirname(dirname(dirname(dirname(__DIR__))))."/main/php/do/darkowl/User_Manager/classes/resource/cTableResource.php";

class cTableResourceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Data Provider that returns a set of Database names
	 * Array of Arrays that holds URI, Name
	 */
	public function providerTable()
	{
		return array(
				array("TestURI", "TestName"),
				array("TestURI2", "TestName2"),
				array("TestURI3", "TestName3")
		);
	}

	/**
	 * @dataProvider providerTable
	 */
	function testSettersGetters($str_URI,$str_Name) {
		$obj_TableResource = new cTableResource();
		$obj_TableResource->setName($str_Name);
		$obj_TableResource->setURI($str_URI);

		$this->assertEquals($str_Name, $obj_TableResource->getName());
		$this->assertEquals($str_URI, $obj_TableResource->getURI());
	}

}