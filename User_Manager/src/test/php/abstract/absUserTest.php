<?php
use darkowl\user_manager\abs_User;

require_once dirname(__DIR__)."/propelInclude.php";

require_once dirname(dirname(dirname(__DIR__)))."/main/php/do/darkowl/User_Manager/abstract/abs_User.php";


class absUserTest extends \PHPUnit_Framework_TestCase
{
	private $m_obj_User;

	function getUser()
	{
		if(!$this->m_obj_User)
		{
			$this->m_obj_User = new abs_User(true);
		}
		return $this->m_obj_User;
	}

	function testvalidate_Login()
	{
		$obj_User = $this->getUser();

		$this->assertTrue($obj_User->validate_Login("DarkOwl","Is#1"));
		// 		$this->assertTrue($obj_User->validate_Login("test","test"));
	}

	function testInstance()
	{
		$obj_User = $this->getUser();
		$this->assertInstanceOf("\\darkowl\\user_manager\\abs_User", $obj_User);
	}
}