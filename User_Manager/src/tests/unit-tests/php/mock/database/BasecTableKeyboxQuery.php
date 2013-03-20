<?php 
namespace MidnightPublishing\User_Manager\database\om;

use MidnightPublishing\User_Manager\database\cTableKeyboxQuery;

abstract class BasecTableKeyboxQuery
{
	private static $m_int_Count = 0;

	public static function create($modelAlias = null, $criteria = null)
	{
		return  new cTableKeyboxQuery();
	}

	public function filterBylinkId($str_ID){
		return $this;
	}

	public function filterBylinkType($str_ID){
		return $this;
	}

	public function filterByactionId($str_ID){
		return $this;
	}

	public static function setCountReturn($int_Count)
	{
// 		print("Mock ".__CLASS__." ".__METHOD__." value : ".self::$m_int_Count."\n");
		self::$m_int_Count =(int) $int_Count;
	}

	public function count()
	{
		return self::$m_int_Count;
	}
}