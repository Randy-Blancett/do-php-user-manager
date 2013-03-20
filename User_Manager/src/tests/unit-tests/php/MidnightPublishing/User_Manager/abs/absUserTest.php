<?php 

use MidnightPublishing\User_Manager\database\cTableKeyboxQuery;

use MidnightPublishing\User_Manager\database\cTableUsersQuery;

use MidnightPublishing\User_Manager\database\om\BasecTableUsers;
use MidnightPublishing\User_Manager\cSession;
use MidnightPublishing\User_Manager\abs\absUser;

require_once dirname(dirname(dirname(__DIR__)))."/mock/loadDBMocks.php";

class cTestUser extends absUser
{
	function __construct() {
		self::$m_bool_GodActive = true;
	}

	public function updateGod($bool_God = true)
	{
		self::$m_bool_GodActive = $bool_God;
	}
}


class cUserTest extends \PHPUnit_Framework_TestCase
{
	function testInstance()
	{
		$obj_User = new cTestUser();
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\abs\\absUser", $obj_User);
	}

	function testGodLoginLogout()
	{
		cPropelTestConnector::initPropel();
		$obj_User = new cTestUser();

		$obj_User->login("DarkOwl", "Is#1",false);

		$this->assertTrue($obj_User->is_LoggedIn());
		$this->assertTrue($obj_User->isGod());

		$obj_User->logout();

		$this->assertFalse($obj_User->is_LoggedIn());
		$this->assertFalse($obj_User->isGod());

		$obj_User->updateGod(false);

		$obj_User->login("DarkOwl", "Is#1",false);

		$this->assertFalse($obj_User->is_LoggedIn());
		$this->assertFalse($obj_User->isGod());
	}

	function testLoginLogout()
	{
		$_SESSION = Array();
		cSession::init();

		cPropelTestConnector::initPropel();
		$obj_User = new cTestUser();

		cTableUsersQuery::setPasswordReturn("test");
		cTableUsersQuery::setIdReturn("TestID");

		$this->assertTrue($obj_User->login("Test", "test",false));
	}



	function testCheckPermissions()
	{
		$_SESSION = Array();
		cSession::init();

		cPropelTestConnector::initPropel();
		$obj_User = new cTestUser();

		cTableUsersQuery::setPasswordReturn("test");
		cTableUsersQuery::setIdReturn("TestID");

		$this->assertTrue($obj_User->login("Test", "test",false));

		cTableKeyboxQuery::setCountReturn(1);

		$obj_User->checkPermissions("permission1");
	}
}