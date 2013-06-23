<?php 
namespace MidnightPublishing\User_Manager\abs;

abstract class absConfigClass
{
	private  $m_str_FileLocation ;
	private $m_str_Category;
	private $m_arr_Data;

	abstract function __construct();
	abstract  protected function setINIDefailt();

	public function getParam($str_ParamName)
	{
		if(is_array($this->m_arr_Data))
		{
			if(isset($this->m_arr_Data[$this->getCategory()]) && is_array($this->m_arr_Data[$this->getCategory()]))
			{
				return $this->m_arr_Data[$this->getCategory()][$str_ParamName];
			}
		}
		return "";
	}

	protected function setData(array $arr_Data = null)
	{
		$this->m_arr_Data = $arr_Data;
	}

	public function getCategory()
	{
		return $this->m_str_Category;
	}

	public function setCategory($str_Category)
	{
		$this->m_str_Category = $str_Category;
	}

	public  function getFileLocation()
	{
		return $this->m_str_FileLocation;
	}

	public  function setFileLocation($str_FileLocation)
	{
		$this->m_str_FileLocation = $str_FileLocation;
	}

	protected  function initConfig($str_PropPath)
	{
		$this->setFileLocation($str_PropPath);

		if(!file_exists($str_PropPath))
		{
			$this->setINIDefailt()	;
		}

		$this->loadINIFile();

	}

	protected  function  loadINIFile()
	{
		$this->m_arr_Data = parse_ini_file($this->getFileLocation(),true);
	}

	protected  function writeINIFile(array $arr_Data = null)
	{
		if($arr_Data != null)
		{
			if(! is_array($this->m_arr_Data) )
			{
				$this->m_arr_Data = array();
			}

			$this->m_arr_Data[$this->m_str_Category] = $arr_Data;
		}

		$tmp = "";
		foreach($this->m_arr_Data as $section => $values){
			$tmp .= "[$section]\n";
			foreach($values as $key => $val){
				if(is_array($val)){
					foreach($val as $k =>$v){
						$tmp .= "{$key}[$k] = \"$v\"\n";
					}
				}
				else
					$tmp .= "$key = \"$val\"\n";
			}
			$tmp .= "\n";
		}
		file_put_contents($this->getFileLocation(), $tmp);
		unset($tmp);
	}
}