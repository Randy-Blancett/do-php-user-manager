<?php 
namespace MidnightPublishing\User_Manager\database\om;

require_once dirname(__DIR__)."/abs/absPropelMock.php";

use MidnightPublishing\User_Manager\database\cTableKeyboxQuery;

abstract class BasecTableKeyboxQuery extends \absPropelMock
{
	private static $m_int_Count = 0;

	const C_STR_DATA_LINK_ID = "LinkId";
	const C_STR_DATA_LINK_TYPE = "LinkType";
	const C_STR_DATA_ACTION_ID = "ActionId";

	public static function create($modelAlias = null, $criteria = null)
	{
		return  new cTableKeyboxQuery();
	}

	public function filterBylinkId($str_ID){
		$obj_Search = $this->getCurSearch();
		$str_Key = self::C_STR_DATA_LINK_ID;
		$obj_Search->$str_Key = $str_ID;
		return $this;
	}

	public function filterBylinkType($str_ID){
		$obj_Search = $this->getCurSearch();
		$str_Key = self::C_STR_DATA_LINK_TYPE;
		$obj_Search->$str_Key = $str_ID;
		return $this;
	}

	public  function clear($modelAlias = null, $criteria = null)
	{
		// 		print("Mock ".__CLASS__." ".__METHOD__."\n");
		$this->clearCurSearch();
		return $this;
	}

	public function filterByactionId($str_ID){
		$obj_Search = $this->getCurSearch();
		$str_Key = self::C_STR_DATA_ACTION_ID;
		$obj_Search->$str_Key = $str_ID;
		return $this;
	}

	public function count()
	{
		$obj_Return = $this->findReturn();

		if($obj_Return != null){
			if(is_array($obj_Return))
			{
				return \count($obj_Return);
			}else
			{
				return 1;
			}
		}
		return 0;
	}
}