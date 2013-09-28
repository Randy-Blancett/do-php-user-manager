<?php 
namespace MidnightPublishing\User_Manager\database\om;


use MidnightPublishing\User_Manager\database\cTableUsers2GroupsQuery;

require_once dirname(__DIR__)."/abs/absPropelMock.php";
use MidnightPublishing\User_Manager\database\cTableKeyboxQuery;

abstract class BasecTableUsers2GroupsQuery extends \absPropelMock
{
	const C_STR_DATA_USER_ID = "UserId";

	public static function create($modelAlias = null, $criteria = null)
	{
		// 		print("Mock ".__CLASS__." ".__METHOD__."\n");
		return new cTableUsers2GroupsQuery();
	}

	public  function clear($modelAlias = null, $criteria = null)
	{
		// 		print("Mock ".__CLASS__." ".__METHOD__."\n");
		$this->clearCurSearch();
		return $this;
	}

	public  function offset($int_Offset = null)
	{
		// 		print("Mock ".__CLASS__." ".__METHOD__."\n");
		return $this;
	}

	public function filterByuserId($str_User)
	{
		$obj_Search = $this->getCurSearch();
		$str_Key = self::C_STR_DATA_USER_ID;
		$obj_Search->$str_Key = $str_User;
		return $this;
	}

	public function find()
	{
		$arr_Return = array();
		$obj_Return = $this->findReturn();

		if($obj_Return != null){
			if(is_array($obj_Return))
			{
				return $obj_Return;
			}else
			{
				return array($obj_Return);
			}
		}
		return $arr_Return;
	}
}