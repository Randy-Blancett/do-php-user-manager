<?php
namespace MidnightPublishing\User_Manager\abs;

abstract class absConfigClass
{

	private $m_str_FileLocation;
	private $m_str_Category;
	private $m_arr_Data;

	abstract function __construct();
	abstract protected function ensureDefaultData();
	/**
	 * Get a parameter from the default Category
	 * @param String $str_ParamName Name of the parameter to return
	 * @param String $Str_Category Category to find paramater from if null it will use the default category
	 * @return string Will return "" if the param is not available
	 */
	public function getParam($str_ParamName, $str_Category = null)
	{
		if ($str_Category == null)
		{
			$str_Category = $this->getCategory();
		}
		if (is_array($this->m_arr_Data))
		{
			if (isset($this->m_arr_Data[$str_Category]) && is_array($this->m_arr_Data[$str_Category]))
			{
				return $this->m_arr_Data[$str_Category][$str_ParamName];
			}
		}
		return "";
	}

	/**
	 * Set a parameter name
	 * @param String $str_ParamName Name of the Parameter to set
	 * @param String $str_Category Category to place the parameter in if null it is the default Catagory
	 */
	public function setParam($str_ParamName, $str_Value, $str_Category = null)
	{
		if ($str_Category == null)
		{
			$str_Category = $this->getCategory();
		}

		if (!is_array($this->m_arr_Data))
		{
			$this->m_arr_Data = array(
				);
		}
		if (!is_array($this->m_arr_Data[$str_Category]))
		{
			$this->m_arr_Data[$str_Category] = array(
				);
		}

		$this->m_arr_Data[$str_Category][$str_ParamName] = $str_Value;
	}

	protected function setData(array $arr_Data = null)
	{
		$this->m_arr_Data = $arr_Data;
	}

	public function getCategory()
	{
		return $this->m_str_Category;
	}

	/**
	 * Get all config items under a given category
	 * @param type $str_Category Category of Config Items to find
	 */
	public function getCategoryConfigItems($str_Category)
	{
		if (!is_array($this->m_arr_Data))
		{
			$this->m_arr_Data = array(
				);
		}

		if (!isset($this->m_arr_Data[$str_Category]) || !is_array($this->m_arr_Data[$str_Category]))
		{
			$this->m_arr_Data[$str_Category] = array(
				);
		}
		return $this->m_arr_Data[$str_Category];
	}

	public function setCategory($str_Category)
	{
		$this->m_str_Category = $str_Category;
	}

	public function getFileLocation()
	{
		return $this->m_str_FileLocation;
	}

	public function setFileLocation($str_FileLocation)
	{
		$this->m_str_FileLocation = $str_FileLocation;
	}

	protected function initConfig($str_PropPath)
	{
		$this->setFileLocation($str_PropPath);

		$this->loadINIFile();
		$this->ensureDefaultData();
	}

	protected function loadINIFile()
	{
		$this->m_arr_Data = parse_ini_file($this->getFileLocation(), true);
	}

	/**
	 * Get all the items in the configuration properties.
	 * @return type
	 */
	public function getAllConfigItems()
	{
		return $this->m_arr_Data;
	}

	/**
	 * Save array to file
	 */
	public function save()
	{
		$this->writeINIFile();
	}

	protected function writeINIFile(array $arr_Data = null)
	{
		if ($arr_Data != null)
		{
			if (!is_array($this->m_arr_Data))
			{
				$this->m_arr_Data = array(
					);
			}

			$this->m_arr_Data[$this->m_str_Category] = $arr_Data;
		}

		$tmp = "";
		foreach ($this->m_arr_Data as $section => $values)
		{
			$tmp .= "[$section]\n";
			foreach ($values as $key => $val)
			{
				if (is_array($val))
				{
					foreach ($val as $k => $v)
					{
						$tmp .= "{$key}[$k] = \"$v\"\n";
					}
				}
				else $tmp .= "$key = \"$val\"\n";
			}
			$tmp .= "\n";
		}
		print("tmp txt - " . $tmp . "\n");
		print("File Location - " . $this->getFileLocation() . "\n");
		file_put_contents($this->getFileLocation(), $tmp);
		unset($tmp);
	}

}