<?php
namespace MidnightPublishing\User_Manager\unitTest;
use \MidnightPublishing\User_Manager\conf\cDesktopInfo;

class cDesktopInfoTest extends \PHPUnit_Framework_TestCase
{
	public function testConstructor()
	{
		$info = new cDesktopInfo();

		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\conf\\cDesktopInfo", $info);
	}

}