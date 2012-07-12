<?php
namespace darkowl\user_manager\unitTest;
use \darkowl\user_manager\resource\cDatabaseResource;

require_once dirname(dirname(dirname(dirname(__DIR__))))."/main/php/do/darkowl/User_Manager/classes/resource/cDatabaseResource.php";

class cDatabaseResourceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Data Provider that returns a set of Database names
	 * Array of Arrays that holds URI, Name
	 */
	public function providerDatabase()
	{
		return array(
				array("TestURI", "TestName"),
				array("TestURI2", "TestName2"),
				array("TestURI3", "TestName3")
		);
	}

	/**
	 * @dataProvider providerDatabase
	 */
	public function testSettersGetters($str_URI,$str_Name) {
		$obj_DatabaseResource = new cDatabaseResource();
		$obj_DatabaseResource->setName($str_Name);
		$obj_DatabaseResource->setURI($str_URI);

		$this->assertEquals($str_Name, $obj_DatabaseResource->getName());
		$this->assertEquals($str_URI, $obj_DatabaseResource->getURI());
	}

}