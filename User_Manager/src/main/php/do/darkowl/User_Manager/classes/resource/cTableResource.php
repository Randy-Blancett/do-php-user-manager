<?php
namespace darkowl\user_manager\resource;

require_once dirname(dirname(__DIR__))."/abstract/abs_Resource.php";

class cTableResource extends abs_Resource
{
	public  $uri = "";
	public $name="";

	public function setName($str_Name)
	{
		$this->name = $str_Name;
	}

	public function setURI($str_URI)
	{
		$this->uri = $str_URI;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getURI()
	{
		return $this->uri ;
	}
}