<?php

use darkowl\user_manager\resource\cTableResource;
use darkowl\user_manager\response\cTableResponse;
use \darkowl\user_manager\dataObject\cKeybox;

require_once dirname(dirname(dirname(dirname( __DIR__)))).'/abstract/abs_ResourceTable.php';
require_once (dirname(dirname(dirname( __DIR__)))).'/dataObject/cKeybox.php';
/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /database/user_manager/keybox
 */
class cKeyboxTable extends abs_ResourceTable {
	const C_STR_NAME = "Keybox";
	const C_STR_URI = "rest/database/user_manager/keybox";


	protected function createTable()
	{
		try{
			$str_Return = cKeybox::createTable();
			if($str_Return)
			{
				$this->m_obj_Response->addMsg($str_Return);
				cKeybox::addDefault();
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

