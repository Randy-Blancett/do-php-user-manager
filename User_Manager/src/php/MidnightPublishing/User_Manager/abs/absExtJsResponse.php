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
/**
 * Abstract class to return ExtJS4 Json
 * @author Randy.Blancett
 * @version 0.0.1
 */
abstract class absExtJsResponse
{
	/**
	 * Constant to return JSON
	 * @var integer
	 */
	const C_INT_OUTPUT_JSON = 1;

	private $m_obj_Output = null;
	protected $m_str_DataType = "resources";
	protected $m_str_TotalName = "total";
	protected $m_int_ReturnCode = 200;

	/**
	 * Sets the html return code
	 * @param integer $int_Code html return code
	 */
	public function setCode($int_Code)
	{
		$this->m_int_ReturnCode = $int_Code;
	}

	/**
	 * Gets the HTTP return code
	 * @return integer HTML return code
	 */
	public function getCode()
	{
		return $this->m_int_ReturnCode;
	}

	/**
	 * Get an object to that holds data for data return
	 * @return \stdClass return a Pointer to the output data
	 */
	private function &getOutput()
	{
		if(!isset($this->m_obj_Output)||($this->m_obj_Output == null))
		{
			$this->m_obj_Output = new \stdClass();
		}

		return $this->m_obj_Output;
	}

	/**
	 * Gets the object that holds errors
	 * @return \stdClass returns a pointer to the error object
	 */
	private function &getErrors()
	{
		$obj_Output =& $this->getOutput();
		if(!isset($obj_Output->errors))
		{
			$obj_Outupt->errors = array();
		}

		return $obj_Output->errors;
	}

	/**
	 * Get the Message object
	 * @return \stdClass returns pointer to the message object
	 */
	private function &getMsgs()
	{
		$obj_Output =& $this->getOutput();
		if(!isset($obj_Output->msgs))
		{
			$obj_Outupt->msgs = array();
		}

		return $obj_Output->msgs;
	}

	/**
	 * Get the resource object
	 * @return \stdClass returns a pointer to the resource object
	 */
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

	/**
	 * Add a resource to the return
	 * @param absResource $obj_Resource
	 */
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

	/**
	 * Output a given type of return
	 * @param integer $int_OutputType
	 * @return string returns a string of a given type
	 */
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

	/**
	 * Output the default return
	 * @return string if run from the abstract method it will return default
	 */
	public function output_Default()
	{
		return "default";
	}

	/**
	 * Return JSON
	 * @return string JSON String
	 */
	public function output_JSON()
	{
		$obj_Output = $this->getOutput();
		if(!$obj_Output)
		{
			return "";
		}
		return @json_encode($obj_Output);
	}

	/**
	 * add A message to the return
	 * @param string $str_Msg
	 */
	public function addMsg($str_Msg)
	{
		$obj_Msgs =& $this->getMsgs();
		$obj_Msgs[] = $str_Msg;
	}

	/**
	 * Log an error to the return
	 * @param string $str_Msg Set an error message
	 */
	public function logError($str_Msg)
	{
		$obj_Errors =& $this->getErrors();
		$obj_Errors[] = $str_Msg;
	}

	/**
	 * Set if it was a successful return
	 * @param boolean $bool_Success true the method was successful, false means the function failed
	 */
	public function setSuccess($bool_Success)
	{
		$obj_Response =& $this->getOutput();
		$obj_Response->success = $bool_Success;
	}

	/**
	 * Set the output variable
	 * @param \stdClass $obj_Output
	 */
	public function setOutput($obj_Output)
	{
		$this->m_obj_Output = $obj_Output;
	}

	/**
	 * get weather it was a successful function
	 * @return boolean Return weather the function was successful
	 */
	public function getSuccess()
	{
		$obj_Response =& $this->getOutput();
		return $obj_Response->success ;
	}

	/**
	 * Set the total number of resources available
	 * @param integer $int_Total total number of resources available
	 */
	public function setTotal($int_Total = null)
	{
		$obj_Response =& $this->getOutput();
		$str_Total = $this->m_str_TotalName;
		$obj_Response->$str_Total = $int_Total;
	}
}