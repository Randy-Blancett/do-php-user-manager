<?php

use \darkowl\user_manager\resource\cTableResource;
use \darkowl\user_manager\response\cTableResponse;
use \darkowl\user_manager\dataObject\cApplication;

require_once dirname(dirname(dirname(dirname( __DIR__)))).'/abstract/abs_ResourceTable.php';
require_once (dirname(dirname(dirname( __DIR__)))).'/dataObject/cApplication.php';
/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /database/user_manager/application
 */
class cApplicationTable extends abs_ResourceTable {

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

