<?php

namespace MidnightPublishing\User_Manager\rest\database\user_manager;


use MidnightPublishing\User_Manager\dataObject\cGroup;

use MidnightPublishing\User_Manager\abs\absResourceTable;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';
/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /database/user_manager/group
 */
class cGroupTable extends absResourceTable {
	const C_STR_NAME = "Group";
	const C_STR_URI = "rest/database/user_manager/group";


	protected function createTable()
	{
		try {
			$str_Return = cGroup::createTable();
			if($str_Return)
			{
				$this->m_obj_Response->addMsg($str_Return);
				cGroup::addDefault();
				$this->m_obj_Response->addMsg("Added default data.");
				return true;
			}
		}
		catch (Exception $e) {
			print($e);
			die();
			return false;
		}

		return false;
	}

}

