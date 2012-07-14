<?php
use darkowl\user_manager\cUser;

require_once dirname(dirname(dirname(__DIR__)))."/main/php/do/darkowl/User_Manager/classes/cUser.php";


class UserTest extends \PHPUnit_Framework_TestCase
{
	private $m_obj_User;

	function getUser()
	{
		if(!$this->m_obj_User)
		{
			$this->m_obj_User = new cUser();
		}

		return $this->m_obj_User;
	}

	function testInstance()
	{
		$obj_User = $this->getUser();
		$this->assertInstanceOf("\\darkowl\\user_manager\\abs_User", $obj_User);
		$this->assertInstanceOf("\\darkowl\\user_manager\\cUser", $obj_User);
	}
}