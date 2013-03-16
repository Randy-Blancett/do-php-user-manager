<?php 
namespace MidnightPublishing\User_Manager\unitTest;

use MidnightPublishing\User_Manager\cUser;

class cUserTest extends \PHPUnit_Framework_TestCase
{
	function testInstance()
	{
		$obj_User = new cUser();
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\abs\\absUser", $obj_User);
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\cUser", $obj_User);

		$this->assertEquals("/User_Manager/pages/login.php", $obj_User->getLogInUrl());
	}
}