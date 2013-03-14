<?php
namespace MidnightPublishing\User_Manager\resource;

use MidnightPublishing\User_Manager\abs\absResource;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

class cTableResource extends absResource
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