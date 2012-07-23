<?php
namespace darkowl\user_manager\resource;

use darkowl\user_manager\resource\abs_Resource;

if(!class_exists('Response'))
{
	require_once dirname(__DIR__).'/tonic/tonic.php';
}
require_once __DIR__."/abs_Resource.php";

abstract class abs_ExtJsResponse extends \Response
{
	const C_STR_ACCEPT_JSON = "json";

	private $m_obj_Output = null;
	protected $m_str_DataType = "resources";
	protected $m_str_TotalName = "total";

	private function &getOutput()
	{
		if(!isset($this->m_obj_Output))
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

	public function addResource(abs_Resource $obj_Resource){
		$obj_Resources =& $this->getResources();
		$obj_Resources[] = $obj_Resource;
	}

	public function output() {

		if (php_sapi_name() != 'cli' && !headers_sent()) {

			header('HTTP/1.1 '.$this->code);
			foreach ($this->headers as $header => $value) {
				header($header.': '.$value);
			}
		}

		if (strtoupper($this->request->method) !== 'HEAD') {
			if(!$this->checkOutput($this->request->accept))
			{
				print ("Default data output \n");
				$this->output_Default();
			}
		}
	}

	private function checkOutput($mix_Format)
	{
		if(is_array($mix_Format))
		{
			foreach($mix_Format as $mix_FormatPart)
			{
				if($this->checkOutput($mix_FormatPart))
				{
					return true;
				}
			}
		}
		if(is_string($mix_Format))
		{
			switch($mix_Format)
			{
				case self::C_STR_ACCEPT_JSON:$this->output_JSON();
				return true;
			}
		}
		return false;
	}

	private function output_Default()
	{
		print("Default");
	}

	private function output_JSON()
	{
		print json_encode($this->getOutput());
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