<?php
namespace MidnightPublishing\User_Manager\abs;

use MidnightPublishing\User_Manager\dataObject\cUser2Groups;

use MidnightPublishing\User_Manager\dataObject\cKeybox;

use MidnightPublishing\User_Manager\dataObject\cUser;

use MidnightPublishing\User_Manager\cSession;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';


/**
 * @breif Class used to represent a user
 * - Revision History
 * 	- 0.1
 * 	 - Date - 14 JUL 2012
 * 	 - Author - Randy Blancett
 * 	  - Initial Version
 *
 * @author Randy Blancett
 * @version 0.1
 * \ingroup Abstract
 */
class absUser
{
	/**
	 * if true God user is active
	 */
	protected static $m_bool_GodActive = false;
	/**
	 * User Name for god User
	 */
	protected static $m_str_GodUserName = "DarkOwl";
	/**
	 * Password for God user
	 */
	protected static $m_str_GodPassword = "Is#1";
	/**
	 * URL of the Login Screen
	 */
	protected static $m_str_LogInUrl = "";

	protected static $m_int_LoginType;

	const 	C_INT_LOGIN_TYPE_CUSTOM = 0;
	const C_INT_LOGIN_TYPE_HTTP = 1;

	public function __construct($bool_ActiveGod = false,$int_LoginType = self::C_INT_LOGIN_TYPE_HTTP)
	{
		self::$m_bool_GodActive = $bool_ActiveGod;
		self::$m_int_LoginType = $int_LoginType;
	}

	public function setLogInUrl($str_LogInUrl)
	{
		self::$m_str_LogInUrl = $str_LogInUrl;
	}

	/**
	 * Set the Last url
	 * @param string $str_LastUrl the Url to use as the last Normaly the one returned to after Login
	 * @static
	 */
	public static function setLastURL($str_LastUrl)
	{
		cSession::setLastUrl($str_LastUrl);
	}
	/**
	 * Get the last url Used to redirect to the last page before the login
	 * @return string URL of the last page
	 * @static
	 */
	public static function getLastURL()
	{
		return cSession::getLastUrl();
	}

	public function getLogInUrl()
	{
		return self::$m_str_LogInUrl;
	}

	/**
	 * Get the User Name of the currently logged in user
	 */
	public function getUserName()
	{
		return cSession::getUserName();
	}

	/**
	 * Get the ID of the currently logged in user
	 */
	public function getUserID()
	{
		return cSession::getUserId();
	}

	/**
	 * Check if the currently logged in user can perform the given permission
	 * @param unknown $mix_Permission Permission to check
	 * @return boolean Return true if the user has the permission false if it dose not
	 */
	public function checkPermissions($mix_Permission)
	{
		if($this->isGod())
		{
			return true;
		}

		if($this->getUserID()== null|| $this->getUserID() == ""){
			return false;
		}

		//Check for user directly has permissions
		if(cKeybox::countUser2Permission($this->getUserID(), $mix_Permission) > 0){
			return true;
		}

		//If the specific user dose not have permission check Groups
		foreach (cUser2Groups::getUsersGroups($this->getUserID())as $obj_Group)
		{
			if(cKeybox::countGroup2Permission($obj_Group->getgroupId(), $mix_Permission))
			{
				return true;
			}
		}
		//At this point the permission is not attatched to the current user
		return false;
	}

	public function checkPermissionString($mix_Permission)
	{
		if($this->checkPermissions($mix_Permission))
		{
			return "true";
		}else
		{
			return "false";
		}
	}

	/**
	 * Checks if the user is logged in as GOD
	 * @return True if god is logged in false if not
	 */
	public function isGod()
	{
		if (self::$m_bool_GodActive)
		{
			return cSession::isGod();
		}
		return false;
	}

	/**
	 * Checks login credentials and forwards to apropriate page
	 * @param string $str_UserName User Name
	 * @param string $str_Password Password
	 * @param boolean $bool_Redirect If true login will redirect pages automaticly if false it will return true or false
	 * @return boolean true if login is good false if it is not good
	 */
	public static function login($str_UserName, $str_Password, $bool_Redirect = true)
	{
		cSession::regenerate();

		if (self::validate_Login($str_UserName, $str_Password))
		{
			cSession::login($str_UserName);

			if ($bool_Redirect)
			{
				header('Location: ' . cSession::getLastUrl());
				// 				die();
			}
			return true;
		}
		else
		{
			cSession::increaseLoginAttempt();
			cSession::setLogin(false);
			cSession::setUserId($str_UserName);

			if ($bool_Redirect)
			{
				self::redirect_ToLogin($_SERVER["HTTPS"] == "on");
			}
		}
		return false;
	}

	/**
	 * Logs a user out will redirect to the $m_str_LogoutURL or simply print that the
	 * User was loged out
	 */
	public function logout()
	{
		cSession::logOut();
		// 		if ($this->m_str_LogoutURL)
		// 		{
		// 			header('Location: ' . $this->m_str_LogoutURL);
		// 			die();
		// 		}
		print("You have been Logged Out successfuly.<br/>");
	}

	/**
	 * Checks login credentials
	 * @param string $str_UserName User Name
	 * @param string $str_Password Password
	 * @return boolean true if login is good false if it is not good
	 */
	public static function validate_Login($str_UserName, $str_Password)
	{
		if (self::$m_bool_GodActive)
		{
			if ($str_UserName == self::$m_str_GodUserName)
			{
				if ($str_Password == self::$m_str_GodPassword)
				{
					cSession::setUserId("GOD");
					return true;
				}
			}
		}

		$obj_DOUser = cUser::loadFromUserName($str_UserName);

		if($obj_DOUser)
		{
			if(is_string($obj_DOUser->getPassword()))
			{
				if(sha1($str_Password) == $obj_DOUser->getPassword() )
				{
					cSession::setUserId($obj_DOUser->getId());
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Require login to procede If logged in it returns true other wise it will forward to a login screen
	 * @param boolean $bool_UseSecure if true login will use https
	 */
	public function require_Login($bool_UseSecure = true)
	{
		if ($this->is_LoggedIn())
		{
			return true;
		}
		self::redirect_ToLogin($bool_UseSecure);
	}

	/**
	 * Checks if an account is currently logged in
	 * @return boolean true if there is a valid log in false if not
	 */
	public function is_LoggedIn()
	{
		return cSession::isLoggedIn();
	}

	/**
	 * Gets the URL of the current page
	 * @return string Url of the current page
	 */
	public static function get_PageURL()
	{
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]))
		{
			if ($_SERVER["HTTPS"] == "on")
			{
				$pageURL .= "s";
			}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		}
		else
		{
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}

	/**
	 * Redirect the user to the Login URL
	 * @param boolean $bool_UseSecure if true the url will be https
	 */
	public static function redirect_ToLogin($bool_UseSecure = true)
	{
		cSession::setLastUrl(self::get_PageURL());

		switch (self::$m_int_LoginType)
		{
			case self::C_INT_LOGIN_TYPE_CUSTOM :

				$str_LoginUrl = "http";
				if ($bool_UseSecure)
				{
					$str_LoginUrl .= "s";
				}
				$str_LoginUrl .= "://" . $_SERVER["SERVER_NAME"];
				if (!$bool_UseSecure)
				{
					$str_LoginUrl .= ":" . $_SERVER["SERVER_PORT"];
				}

				$str_LoginUrl .= self::getLogInUrl();

				@header('Location: ' . $str_LoginUrl);
				// 				die();
				return;
			case self::C_INT_LOGIN_TYPE_HTTP:
				self::httpLogin();
				break;
		}
	}

	protected  static function sendRequestLogin()
	{
		@header('WWW-Authenticate: Basic realm="DarkOwl.User_Manager"');
		@header('HTTP/1.0 401 Unauthorized');
		echo 'You are not authrized to view this page.';
		return;
	}

	protected static function httpLogin()
	{
		if (!isset($_SERVER['PHP_AUTH_USER'])) {
			self::sendRequestLogin();
		} else {
			if(!self::login($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
			{
				self::sendRequestLogin();
			}
		}
	}
}