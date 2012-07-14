<?php

namespace darkowl\user_manager;

try
{
	@ini_set('session.use_trans_sid', false);
	@ini_set('session.use_only_cookies', true);
	@session_start();
}
catch (Exception $e)
{
}
cSession::init();


class cSession
{
	const C_STR_SESSION_IS_LOGGED_IN ="LogIN";
	const C_STR_SESSION_CUR_USERNAME = "Username";
	const C_STR_SESSION_CUR_USERID = "UserID";
	const C_STR_SESSION_CUR_LASTURL = "LastURL";
	const C_STR_SESSION_CUR_LOGINATTEMPT = "LoginAttempt";

	public static function init()
	{
		if (!isset($_SESSION[self::C_STR_SESSION_IS_LOGGED_IN]))
		{
			$_SESSION[self::C_STR_SESSION_IS_LOGGED_IN] = "";
		}
		if (!isset($_SESSION[self::C_STR_SESSION_CUR_USERNAME]))
		{
			$_SESSION[self::C_STR_SESSION_CUR_USERNAME] = "";
		}
		if (!isset($_SESSION[self::C_STR_SESSION_CUR_USERID]))
		{
			$_SESSION[self::C_STR_SESSION_CUR_USERID] = "";
		}
		if (!isset($_SESSION[self::C_STR_SESSION_CUR_LASTURL]))
		{
			$_SESSION[self::C_STR_SESSION_CUR_LASTURL] = "";
		}
		if (!isset($_SESSION[self::C_STR_SESSION_CUR_LOGINATTEMPT]))
		{
			$_SESSION[self::C_STR_SESSION_CUR_LOGINATTEMPT] = "";
		}
	}

	public static function regenerate()
	{
		session_regenerate_id();
	}

	public static function setUserId($str_ID)
	{
		$_SESSION[cSession::C_STR_SESSION_CUR_USERID] = $str_ID;
	}

	public static function increaseLoginAttempt()
	{
		$_SESSION[cSession::C_STR_SESSION_CUR_LOGINATTEMPT] ++;
	}

	public static function resetLoginAttempt()
	{
		$_SESSION[cSession::C_STR_SESSION_CUR_LOGINATTEMPT] =0;
	}

	public static function setLogin($bool_Login)
	{
		$_SESSION[cSession::C_STR_SESSION_IS_LOGGED_IN] = $bool_Login;
	}

	public static function setUserName($str_UserName)
	{
		$_SESSION[cSession::C_STR_SESSION_CUR_USERNAME] = $str_UserName;
	}

	public static function getUserName()
	{
		return $_SESSION[cSession::C_STR_SESSION_CUR_USERNAME] ;
	}

	public static function getLastUrl()
	{
		return $_SESSION[cSession::C_STR_SESSION_CUR_LASTURL];
	}

	public static function setLastUrl($str_LastUrl)
	{
		$_SESSION[cSession::C_STR_SESSION_CUR_LASTURL]=$str_LastUrl;
	}

	public static function login($str_UserName = "")
	{
		self::resetLoginAttempt();
		self::setLogin(true);
		self::setUserName($str_UserName);
	}

	public static function logOut()
	{
		self::resetLoginAttempt();
		self::setLogin(false);
		self::setUserId(null);
	}

	public static function isLoggedIn()
	{

		if (($_SESSION[self::C_STR_SESSION_IS_LOGGED_IN]) && ($_SESSION[self::C_STR_SESSION_CUR_USERID]))
		{
			return true;
		}
		return false;
	}
}