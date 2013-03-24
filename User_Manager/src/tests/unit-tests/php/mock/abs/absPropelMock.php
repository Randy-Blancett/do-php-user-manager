<?php 
abstract class absPropelMock{
	private static $m_arr_QueryReturns = Array() ;
	private static $m_mix_DefaultQueryReturn = "";

	private $m_obj_CurSearch ;

	protected function getCurSearch()
	{
		if($this->m_obj_CurSearch == null){
			$this->m_obj_CurSearch = new \stdclass();
		}

		return $this->m_obj_CurSearch;
	}

	protected function clearCurSearch()
	{
		$this->m_obj_CurSearch = null;
	}

	protected function findReturn()
	{
		$str_SearchJson = json_encode($this->getCurSearch());
		foreach(self::$m_arr_QueryReturns as $arr_Return)
		{
			if(json_encode($arr_Return['id']) == $str_SearchJson)
			{
				return $arr_Return['value'];
			}
		}
		return null;
	}

	public static function addQueryReturn(\stdClass $obj_Identifier, $mix_Value)
	{
		$arr_Data = Array();
		$arr_Data['id'] = $obj_Identifier;
		$arr_Data['value'] = $mix_Value;
		self::$m_arr_QueryReturns[] = $arr_Data;
	}
}
