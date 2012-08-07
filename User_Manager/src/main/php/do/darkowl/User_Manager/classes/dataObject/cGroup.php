<?php
namespace darkowl\user_manager\dataObject;

require_once dirname(dirname(__DIR__)).'/propelInclude.php';
require_once dirname(__DIR__).'/database/cTableGroups.php';

class cGroup extends \cTableGroups
{
	private static $m_obj_Query;

	protected static function getQuery()
	{
		if(!self::$m_obj_Query){
			self::$m_obj_Query = new cTableGroupsQuery();
		}
		return self::$m_obj_Query;
	}

	public static function getAllGroups($int_Start = 0, $int_PerPage = null)
	{
		$obj_Return = \cTableGroupsQuery::create();
		if($int_PerPage)
		{
			$obj_Return = $obj_Return->limit($int_PerPage);
		}
		return $obj_Return = $obj_Return->offset($int_Start)->find();
	}

	public static function getTotalGroupCount()
	{
		$obj_Return = \cTableGroupsQuery::create();
		return $obj_Return->count();
	}

	public function __toString()
	{
		foreach($this as $obj_Data)
		{
			print(" - ".$obj_Data);
		}
	}
}