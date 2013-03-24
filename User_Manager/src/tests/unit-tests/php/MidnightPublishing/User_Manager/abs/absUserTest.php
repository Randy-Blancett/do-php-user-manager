<?php 

use MidnightPublishing\User_Manager\database\cTableUsers2GroupsQuery;

use MidnightPublishing\User_Manager\dataObject\cUser2Groups;

use MidnightPublishing\User_Manager\dataObject\cKeybox;

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
	public	function testInstance()
	{
		$obj_User = new cTestUser();
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\abs\\absUser", $obj_User);
	}

	public function testGodLoginLogout()
	{
		cPropelTestConnector::initPropel();
		$obj_User = new cTestUser();

		$obj_User->login("DarkOwl", "Is#1",false);

		$this->assertTrue($obj_User->is_LoggedIn());
		$this->assertTrue($obj_User->isGod());

		$this->assertTrue($obj_User->checkPermissions("permission1"));

		$obj_User->logout();

		$this->assertFalse($obj_User->is_LoggedIn());
		$this->assertFalse($obj_User->isGod());

		$obj_User->updateGod(false);

		$obj_User->login("DarkOwl", "Is#1",false);

		$this->assertFalse($obj_User->is_LoggedIn());
		$this->assertFalse($obj_User->isGod());

		$obj_User->updateGod(true);

		//Fail on bad password
		$obj_User->login("DarkOwl", "Is#2",false);

		$this->assertFalse($obj_User->is_LoggedIn());
		$this->assertFalse($obj_User->isGod());

		//Fail on bad username
		$obj_User->login("Dark0wl", "Is#1",false);

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

		$obj_Data = new \stdClass();

		$str_Key = cTableKeyboxQuery::C_STR_DATA_LINK_ID;
		$obj_Data->$str_Key = "TestID";
		$str_Key = cTableKeyboxQuery::C_STR_DATA_LINK_TYPE;
		$obj_Data->$str_Key = cKeybox::C_INT_LINKTYPE_USER;
		$str_Key = cTableKeyboxQuery::C_STR_DATA_ACTION_ID;
		$obj_Data->$str_Key = "permission1";

		cTableKeyboxQuery::addQueryReturn($obj_Data,"oneValue");

		$this->assertTrue($obj_User->checkPermissions("permission1"));
		//Fail to ensure Non allowed permissions do not pass
		$this->assertFalse($obj_User->checkPermissions("permission2"));

		//Create group to return
		$obj_Group = new cUser2Groups();
		$obj_Group->setgroupId("Group1");

		//Create ID of the search for group
		$obj_Data = new \stdClass();
		$str_Key = cTableUsers2GroupsQuery::C_STR_DATA_USER_ID;
		$obj_Data->$str_Key = "TestID";
		cTableUsers2GroupsQuery::addQueryReturn($obj_Data, array($obj_Group));

		//Set permission for the above group
		$obj_Data = new \stdClass();
		$str_Key = cTableKeyboxQuery::C_STR_DATA_LINK_ID;
		$obj_Data->$str_Key = "Group1";
		$str_Key = cTableKeyboxQuery::C_STR_DATA_LINK_TYPE;
		$obj_Data->$str_Key = cKeybox::C_INT_LINKTYPE_GROUP;
		$str_Key = cTableKeyboxQuery::C_STR_DATA_ACTION_ID;
		$obj_Data->$str_Key = "permission3";
		cTableKeyboxQuery::addQueryReturn($obj_Data,"oneValue");

		$this->assertTrue($obj_User->checkPermissions("permission3"));

	}

	function testGetterSetter(){
		$_SESSION = Array();
		cSession::init();

		cPropelTestConnector::initPropel();
		$obj_User = new cTestUser();

		cTableUsersQuery::setPasswordReturn("test");
		cTableUsersQuery::setIdReturn("TestID");

		$this->assertTrue($obj_User->login("Test", "test",false));

		$this->assertEquals("TestID",$obj_User->getUserID());
		$this->assertEquals("Test",$obj_User->getUserName());

		$obj_User->setLogInUrl("TestLogin.php");
		$this->assertEquals("TestLogin.php",$obj_User->getLogInUrl());

	}

	function testRequireLogin(){
		$_SESSION = Array();
		cSession::init();

		cPropelTestConnector::initPropel();
		$obj_User = new cTestUser();

		cTableUsersQuery::setPasswordReturn("test");
		cTableUsersQuery::setIdReturn("TestID");

		$this->assertTrue($obj_User->login("Test", "test",false));
		$this->assertTrue($obj_User->require_Login());

		$obj_User->logout();
		$obj_User->require_Login();
	}

	protected function setUp()
	{
		ob_start();
	}

	protected function tearDown()
	{
		ob_get_flush();
	}
}