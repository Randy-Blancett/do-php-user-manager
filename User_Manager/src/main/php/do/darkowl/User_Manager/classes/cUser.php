<?php
namespace darkowl\user_manager;

require_once dirname(__DIR__)."/abstract/abs_User.php";


class cUser extends abs_User
{
	public function __construct($bool_ActiveGod = true,$int_LoginType = self::C_INT_LOGIN_TYPE_HTTP)
	{
		parent::__construct($bool_ActiveGod,$int_LoginType);

		self::setLogInUrl("/UserManager/pages/login.php");
	}

}