<?php
namespace MidnightPublishing\User_Manager\rest\database\user_manager;

use MidnightPublishing\User_Manager\dataObject\cApplication;
use MidnightPublishing\User_Manager\abs\absResourceTable;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /database/user_manager/application
 */
class cApplicationTable extends absResourceTable {

	const C_STR_NAME = "Application";
	const C_STR_URI = "rest/database/user_manager/application";

	protected function createTable()
	{
		try{
			$str_Return = cApplication::createTable();
			if($str_Return)
			{
				$this->m_obj_Response->addMsg($str_Return);
				cApplication::addDefault();
				$this->m_obj_Response->addMsg("Added default data.");
				return true;
			}
		}
		catch (PDOException $e) {
			$this->m_obj_Response->logError("SQL Error\n".$e->getCode()." - ".$e->getMessage());
		}

		return		false;
	}



}

