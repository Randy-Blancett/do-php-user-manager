<?php 
use MidnightPublishing\User_Manager\abs\absUser;

class cTestUser extends absUser
{

}


class cUserTest extends \PHPUnit_Framework_TestCase
{
	function testInstance()
	{
		$obj_User = new cTestUser();
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\abs\\absUser", $obj_User);
	}

	function testLoginLogout()
	{
		$obj_User = new cTestUser();

		$obj_User->login("test", "test",false);

		$this->assertTrue($obj_User->is_LoggedIn());
	}
}