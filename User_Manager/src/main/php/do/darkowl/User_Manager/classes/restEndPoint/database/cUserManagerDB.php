<?php

use \darkowl\user_manager\resource\cTableResource;
use \darkowl\user_manager\response\cTableResponse;

require_once dirname(dirname(dirname( __DIR__))).'/propelInclude.php';
require_once dirname(dirname( __DIR__)).'/response/cTableResponse.php';
require_once dirname(dirname( __DIR__)).'/resource/cTableResource.php';
require_once __DIR__.'/user_manager/cActionTable.php';
require_once __DIR__.'/user_manager/cApplicationTable.php';
require_once __DIR__.'/user_manager/cGroupTable.php';
require_once __DIR__.'/user_manager/cKeyboxTable.php';
require_once __DIR__.'/user_manager/cUserTable.php';
require_once __DIR__.'/user_manager/cUser2GroupTable.php';
/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /database/user_manager
 */
class cUserManagerDB extends Resource {

	const C_STR_PARAM_ACTION = "action";
	const C_STR_ACTION_CREATE = "create";
	const C_STR_ACTION_INFO = "info";

	const C_STR_DATABASE_ID = "user_manager";

	const C_STR_SQL_CREATE_MYSQL = "CREATE DATABASE  `user_manager` ;";

	private $m_obj_Response = null;

	protected function getCreateStatement()
	{
		return self::C_STR_SQL_CREATE_MYSQL;
	}

	function get($request) {
		$response = new Response($request);
			
		$str_Resources = '';
		$arr_Dirs = glob(dirname(__FILE__).DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR);

		if ($arr_Dirs) {
			foreach ($arr_Dirs as $path) {
				$arr_Args = Array();
				$str_Location = basename($path);
				$str_Resource = ucfirst($str_Location);
				$str_FileName = $path.DIRECTORY_SEPARATOR."c".$str_Resource.'Resource.php';

				if (file_exists($str_FileName)) {
					preg_match('|/\*\*\s*\*\s*(.+?)\*/|s', file_get_contents($str_FileName), $match);

					$str_Comment = preg_replace('|\s*\*\s*(@.+)?|', "\n", $match[1]);
					$arr_Args =  preg_split ('|\s*\*\s*@|', $match[1]);

					if($arr_Args[0] = $str_Comment)
					{
						unset($arr_Args[0]);
					}


					$str_Name = $str_Resource;
					$str_Description = $str_Comment;
				} else {
					$str_Name = $str_Resource;
					$str_Description = '';
				}
				$str_Resources .=
				'<li>'.
				'<h3><a href="'.$str_Location.'">'.$str_Name.'</a></h3>'.$str_Description;
				$str_Resources .='<ul>';
				foreach($arr_Args as $str_Arg)
				{
					$arr_Temp = split (" ",$str_Arg);
					$str_Resources .='<li>';
					$str_Resources .='<b>'.$arr_Temp[0].'</b> - ';
					unset($arr_Temp[0]);
					$str_Resources .= implode (" ",$arr_Temp);
					$str_Resources .='</li>';
				}
				$str_Resources .='</ul>';

				$str_Resources .='</li>';
			}
		} else {
			$str_Resources .= '<li>No Resources</li>';
		}

		$response->body = <<<END
<h1>User Manager Base</h1>
<p>Base resource for User Manager</p>
<h2>Resources</h2>
END;
		$response->body .= '<ul>'.$str_Resources.'</ul>';

		return $response;

	}

	public 	function post($request)
	{
		$this->m_obj_Response = new cTableResponse($request);

		$arr_Query = split("&",$request->data);
		$arr_Data= Array();
		$arr_Data[self::C_STR_PARAM_ACTION]="";

		foreach ($arr_Query as $str_Data)
		{
			$arr_Temp = split("=",$str_Data);

			if($arr_Temp[0])
			{
				$arr_Data[$arr_Temp[0]] = $arr_Temp[1];
			}
		}

		if(!isset($arr_Data[self::C_STR_PARAM_ACTION]))
		{
			$arr_Data[self::C_STR_PARAM_ACTION] = null;
		}

		if(!$arr_Data[self::C_STR_PARAM_ACTION])
		{
			$this->m_obj_Response->code = 406;
			$this->m_obj_Response->logError("'".self::C_STR_PARAM_ACTION."' is a required parameter.");
		}
		else
		{
			switch ($arr_Data[self::C_STR_PARAM_ACTION])
			{
				case self::C_STR_ACTION_CREATE :
					if($this->createDatabase())
					{
						$this->m_obj_Response->code = 201;
						$this->m_obj_Response->setSuccess(true);
					}
					else
					{
						$this->m_obj_Response->code = 500;
						$this->m_obj_Response->logError("Failed to create Database.");
						$this->m_obj_Response->setSuccess(false);
					}
					break;
				case self::C_STR_ACTION_INFO :
					$this->outputTableInfo();
					break;
				default:
					$this->m_obj_Response->code = 406;
					$this->m_obj_Response->logError("'".$arr_Data[self::C_STR_PARAM_ACTION]."' is an unknown action.");
			}
		}

		return $this->m_obj_Response;
	}

	private function createDatabase()
	{
		$str_Statement = $this->getCreateStatement();

		try {
			$obj_Connection = Propel::getConnection('mysql');
			$obj_Statement = $obj_Connection->prepare($str_Statement);
		}
		catch (Exception $e) {
			return false;
		}

		try {
			$obj_Statement->execute();
			$this->m_obj_Response->addMsg("Table Created.");
		}
		catch (PDOException $e) {
			switch ($e->getCode())
			{
				case 'HY000':
					$this->m_obj_Response->addMsg("Database Already Exists.");
					return true;
				default:
					$this->m_obj_Response->logError("SQL Error\n".$e->getCode()." - ".$e->getMessage());
					return false;
			}

			return false;
		}
		return true;
	}

	private function outputTableInfo()
	{
		$arr_Tables = glob(__DIR__.DIRECTORY_SEPARATOR."user_manager".DIRECTORY_SEPARATOR.'*');

		foreach ($arr_Tables as $str_Table)
		{
			$obj_TableResource = new cTableResource();

			require_once $str_Table;
			$str_Class = basename($str_Table,".php");

			$obj_TableResource->setURI($str_Class::C_STR_URI);
			$obj_TableResource->setName($str_Class::C_STR_NAME);

			$this->m_obj_Response->addResource($obj_TableResource);
		}

	}

}

