<?php
namespace MidnightPublishing\User_Manager\rest\database\user_manager;


use MidnightPublishing\User_Manager\dataObject\cUser2Groups;

use MidnightPublishing\User_Manager\abs\absResourceTable;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';
/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /database/user_manager/user2group
 */
class cUser2GroupTable extends absResourceTable {
	const C_STR_NAME = "User2Group";
	const C_STR_URI = "rest/database/user_manager/user2group";
	protected function createTable()
	{
		try{
			$str_Return = cUser2Groups::createTable();
			if($str_Return)
			{
				$this->m_obj_Response->addMsg($str_Return);
				cUser2Groups::addDefault();
				$this->m_obj_Response->addMsg("Added default data.");
				return true;
			}
		}
		catch (PDOException $e) {
			$this->m_obj_Response->logError("SQL Error\n".$e->getCode()." - ".$e->getMessage());
		}

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
			$this->m_obj_Response->addMsg("User to Group Table Created.");
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
		$str_SQL = file_get_contents(dirname(dirname(dirname(dirname(__DIR__))))."/sql/users2groups_schema.sql");

		$str_SQL = str_ireplace("DROP TABLE IF EXISTS `users2groups`;","",$str_SQL);

		return $str_SQL;
	}

}

