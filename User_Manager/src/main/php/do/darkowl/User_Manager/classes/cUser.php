<?php
namespace darkowl\user_manager;

require_once dirname(__DIR__)."/abstract/abs_User.php";


class cUser extends abs_User
{
	public function __construct($bool_ActiveGod = true)
	{
		parent::__construct($bool_ActiveGod);

		self::setLogInUrl("/User_Manager/pages/login.php");
	}
	
}