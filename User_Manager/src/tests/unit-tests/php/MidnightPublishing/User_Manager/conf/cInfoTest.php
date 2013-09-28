<?php
namespace MidnightPublishing\User_Manager\unitTest;
use MidnightPublishing\User_Manager\conf\cInfo;

class cInfoTest extends \PHPUnit_Framework_TestCase
{
	public function testConstructor()
	{
		$info = new cInfo;

		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\conf\\cInfo",$info);
	}

}