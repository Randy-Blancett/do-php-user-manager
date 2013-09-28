<?php

use MidnightPublishing\User_Manager\abs\absConfigClass;

class cTestConfigClass extends absConfigClass
{
	const C_STR_PARAM_STRING = "string";
	const C_STR_PARAM_BOOLEAN = "boolean";

	function __construct() {
		$str_PropPath = dirname(dirname(__DIR__))."/Test.ini";
		$this->setCategory("Test Data");
		$this->initConfig($str_PropPath);
	}

	public function clearData()
	{
		$this->setData();
	}

	public function updateData(array $arr_Data)
	{
		$this->setData($arr_Data);
	}

	protected  function setINIDefailt()
	{
		$arr_DefaultData = array();

		$arr_DefaultData[self::C_STR_PARAM_STRING]="String1";
		$arr_DefaultData[self::C_STR_PARAM_BOOLEAN]="true";

		$this->writeINIFile($arr_DefaultData);
	}
}


class absConfigClassTest extends \PHPUnit_Framework_TestCase
{
	public	function testDefault()
	{
		if(file_exists(dirname(dirname(__DIR__))."/Test.ini"))
		{
			unlink(dirname(dirname(__DIR__))."/Test.ini");
		}
		$obj_Data = new cTestConfigClass();
		$this->assertEquals($obj_Data->getParam(cTestConfigClass::C_STR_PARAM_STRING), "String1");
	}

	public	function testGetData()
	{
		$obj_Data = new cTestConfigClass();
		$obj_Data->clearData();
		$this->assertEquals($obj_Data->getParam(cTestConfigClass::C_STR_PARAM_STRING), "");

		$arr_Data = array();
		// 		$arr_Data["Test Data"]

		$obj_Data->updateData($arr_Data);
		$this->assertEquals($obj_Data->getParam(cTestConfigClass::C_STR_PARAM_STRING), "");
	}
}