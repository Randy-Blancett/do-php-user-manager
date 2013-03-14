<?php
namespace MidnightPublishing\User_Manager\abs;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

if(!class_exists('Tonic\Response'))
{
	require_once (dirname(__DIR__)).'/Tonic/Autoloader.php';
}

abstract class absExtJsResponse
{
	const C_INT_OUTPUT_JSON = 1;

	private $m_obj_Output = null;
	protected $m_str_DataType = "resources";
	protected $m_str_TotalName = "total";
	protected $m_int_ReturnCode = 200;

	public function setCode($int_Code)
	{
		$this->m_int_ReturnCode = $int_Code;
	}

	public function getCode()
	{
		return $this->m_int_ReturnCode;
	}

	private function &getOutput()
	{
		if(!isset($this->m_obj_Output)||($this->m_obj_Output == null))
		{
			$this->m_obj_Output = new \stdClass();
		}

		return $this->m_obj_Output;
	}

	private function &getErrors()
	{
		$obj_Output =& $this->getOutput();
		if(!isset($obj_Output->errors))
		{
			$obj_Outupt->errors = array();
		}

		return $obj_Output->errors;
	}

	private function &getMsgs()
	{
		$obj_Output =& $this->getOutput();
		if(!isset($obj_Output->msgs))
		{
			$obj_Outupt->msgs = array();
		}

		return $obj_Output->msgs;
	}

	private function &getResources()
	{
		$obj_Output =& $this->getOutput();

		$str_DataType = $this->m_str_DataType;

		if(!isset($obj_Output->$str_DataType))
		{
			$obj_Outupt->$str_DataType = array();
		}

		return $obj_Output->$str_DataType;
	}

	public function addResource(absResource $obj_Resource){
		$obj_Resources =& $this->getResources();

		if(!$obj_Resources)
		{
			$obj_Resources = $obj_Resource;
		}
		else
		{
			if(is_array($obj_Resources))
			{
				$obj_Resources[] = $obj_Resource;
			}
			else
			{
				$arr_Temp[] = $obj_Resources;
				$arr_Temp[] = $obj_Resource;
				$obj_Resources = $arr_Temp;
			}
		}
	}

	public function output($int_OutputType)
	{
		switch($int_OutputType)
		{
			case self::C_INT_OUTPUT_JSON :
				return $this->output_JSON();
			default:
				return $this->output_Default();
		}
	}

	public function output_Default()
	{
		print("Default");
	}

	public function output_JSON()
	{
		$obj_Output = $this->getOutput();
		if(!$obj_Output)
		{
			return "";
		}
		return @json_encode($obj_Output);
	}

	public function addMsg($str_Msg)
	{
		$obj_Msgs =& $this->getMsgs();
		$obj_Msgs[] = $str_Msg;
	}

	public function logError($str_Msg)
	{
		$obj_Errors =& $this->getErrors();
		$obj_Errors[] = $str_Msg;
	}

	public function setSuccess($bool_Success)
	{
		$obj_Response =& $this->getOutput();
		$obj_Response->success = $bool_Success;
	}

	public function getSuccess()
	{
		$obj_Response =& $this->getOutput();
		return $obj_Response->success ;
	}

	public function setTotal($int_Total = null)
	{
		$obj_Response =& $this->getOutput();
		$str_Total = $this->m_str_TotalName;
		$obj_Response->$str_Total = $int_Total;
	}
}