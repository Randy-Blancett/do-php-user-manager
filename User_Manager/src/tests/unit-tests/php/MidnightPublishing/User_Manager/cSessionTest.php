<?php 
namespace MidnightPublishing\User_Manager\unitTest;

use MidnightPublishing\User_Manager\cSession;

class cSessionTest extends \PHPUnit_Framework_TestCase
{
	function testInstance()
	{
		$obj_Session = new cSession();
		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\cSession", $obj_Session);
	}

	function testInit()
	{
		$_SESSION = Array();

		cSession::init();

		$this->assertFalse(cSession::isLoggedIn());
		$this->assertEquals("", cSession::getUserName());
		$this->assertEquals("", cSession::getUserId());
		$this->assertEquals("", cSession::getLastUrl());
		$this->assertEquals(0, cSession::getLoginAttemtps());
	}

	function testLogin()
	{
		$_SESSION = Array();

		cSession::init();

		//Setup inital data that will be set by Login
		cSession::increaseLoginAttempt();
		$this->assertEquals(1, cSession::getLoginAttemtps());
		$this->assertFalse(cSession::isLoggedIn());
		$this->assertEquals("", cSession::getUserName());
		$this->assertEquals("", cSession::getUserId());

		//Login as TestUser
		cSession::login("TestUser");
		cSession::setUserId("TestIDGUID");
		//Check that Login has reset Data
		$this->assertEquals("TestIDGUID", cSession::getUserId());
		$this->assertEquals(0, cSession::getLoginAttemtps());
		$this->assertTrue(cSession::isLoggedIn());
		$this->assertEquals("TestUser", cSession::getUserName());
	}

	function testLogout()
	{
		$_SESSION = Array();

		cSession::init();

		//Login as TestUser
		cSession::login("TestUser");
		cSession::setUserId("TestIDGUID");
		//Check that Login has reset Data
		$this->assertEquals("TestIDGUID", cSession::getUserId());
		$this->assertEquals(0, cSession::getLoginAttemtps());
		$this->assertTrue(cSession::isLoggedIn());
		$this->assertEquals("TestUser", cSession::getUserName());

		//Check Logout
		cSession::logOut();
		//Check that Logout Set correctly
		$this->assertEquals("", cSession::getUserId());
		$this->assertEquals(0, cSession::getLoginAttemtps());
		$this->assertFalse(cSession::isLoggedIn());
		$this->assertEquals("TestUser", cSession::getUserName());
	}

	function testGetterSetter()
	{
		$_SESSION = Array();

		cSession::init();

		//Set Get Last URL
		cSession::setLastUrl("Test URL");
		$this->assertEquals("Test URL", cSession::getLastUrl());

		//Set get Login status
		cSession::setLogin(true);
		cSession::setUserId("UserID");
		$this->assertTrue(cSession::isLoggedIn());
		cSession::setLogin(false);
		$this->assertFalse(cSession::isLoggedIn());
		cSession::setLogin(true);
		$this->assertTrue(cSession::isLoggedIn());
		cSession::setUserId("");
		$this->assertFalse(cSession::isLoggedIn());

		cSession::setUserId("UserID");
		$this->assertEquals("UserID", cSession::getUserId());

		cSession::setUserName("UserName");
		$this->assertEquals("UserName", cSession::getUserName());
	}

	function testIsGod()
	{
		$_SESSION = Array();

		cSession::init();

		cSession::setLogin(true);
		$this->assertFalse(cSession::isGod());

		cSession::setUserId("UserID");
		$this->assertFalse(cSession::isGod());

		cSession::setUserId("GOD");
		$this->assertTrue(cSession::isGod());
	}

	function testRegenerateSession()
	{
		$str_FirstID = session_id();

		$this->assertNotEquals($str_FirstID,cSession::regenerate());
	}
}