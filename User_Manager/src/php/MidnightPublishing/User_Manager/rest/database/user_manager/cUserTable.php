<?php
namespace MidnightPublishing\User_Manager\rest\database\user_manager;

use MidnightPublishing\User_Manager\dataObject\cUser;
use MidnightPublishing\User_Manager\abs\absResourceTable;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /database/user_manager/user
 */
class cUserTable extends absResourceTable {
	const C_STR_NAME = "User";
	const C_STR_URI = "rest/database/user_manager/user";

	protected function createTable()
	{
		try{
			$str_Return = cUser::createTable();
			if($str_Return)
			{
				$this->m_obj_Response->addMsg($str_Return);
				cUser::addDefault();
				$this->m_obj_Response->addMsg("Added default data.");
				return true;
			}
		}
		catch (PDOException $e) {
			$this->m_obj_Response->logError("SQL Error\n".$e->getCode()." - ".$e->getMessage());
		}

		return false;
	}
}

