<?php
namespace MidnightPublishing\User_Manager;

use MidnightPublishing\User_Manager\abs\absUser;
/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

class cUser extends absUser
{
	public function __construct($bool_ActiveGod = true,$int_LoginType = self::C_INT_LOGIN_TYPE_HTTP)
	{
		parent::__construct($bool_ActiveGod,$int_LoginType);

		self::setLogInUrl("/User_Manager/pages/login.php");
	}

}