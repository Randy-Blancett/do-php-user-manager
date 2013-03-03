<?php

use darkowl\user_manager\resource\cTableResource;
use darkowl\user_manager\response\cTableResponse;

require_once dirname(dirname(dirname(dirname( __DIR__)))).'/abstract/abs_ResourceTable.php';
/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /database/user_manager/user
 */
class cUserTable extends abs_ResourceTable {
	const C_STR_NAME = "User";
	const C_STR_URI = "rest/database/user_manager/user";

	protected function createTable()
	{
		$str_Statement = $this->getCreateStatement();

		try {
			$obj_Connection = Propel::getConnection(Propel::getDefaultDB());
			$obj_Statement = $obj_Connection->prepare($str_Statement);
		}
		catch (Exception $e) {
			return false;
		}

		try {
			$obj_Statement->execute();
			$this->m_obj_Response->addMsg("User Table Created.");
		}
		catch (PDOException $e) {
			switch ($e->getCode())
			{
				case 'HY000':
					$this->m_obj_Response->addMsg("Table Already Exists.");
					return true;
				default:
					$this->m_obj_Response->logError("SQL Error\n".$e->getCode()." - ".$e->getMessage());
					return false;
			}

			return false;
		}
		return true;
	}



	protected function getCreateStatement()
	{
		$str_SQL = file_get_contents(dirname(dirname(dirname(dirname(__DIR__))))."/sql/users_schema.sql");

		$str_SQL = str_ireplace("DROP TABLE IF EXISTS `users`;","",$str_SQL);

		return $str_SQL;
	}

}

