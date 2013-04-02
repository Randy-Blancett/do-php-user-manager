<?php 
namespace MidnightPublishing\User_Manager\unitTest;

use MidnightPublishing\User_Manager\abs\absUser;

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