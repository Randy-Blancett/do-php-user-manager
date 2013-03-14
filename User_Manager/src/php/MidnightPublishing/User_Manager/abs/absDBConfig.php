<?php
namespace MidnightPublishing\User_Manager\abs;
abstract class absDBConfig
{

	private $m_str_DBName = "";
	private $m_str_Host = "";
	private $m_str_Type = "";
	private $m_str_Port = "";
	private $m_str_UserName = "";
	private $m_str_Password = "";

	public function getDNS()
	{
		$str_DNS =$this->m_str_Type;
		$str_DNS .=":";
		$str_DNS .="host=".$this->m_str_Host.";";
		$str_DNS .="dbname=".$this->m_str_DBName.";";
		return $str_DNS;
	}

	public function getHost()
	{
		return $this->m_str_Host ;
	}

	public function setPort($str_Port)
	{
		$this->m_str_Port = $str_Port;
	}

	public function getPort()
	{
		return $this->m_str_Port;
	}

	public function setHost($str_Host)
	{
		$this->m_str_Host = $str_Host;
	}

	public function getDBName()
	{
		return $this->m_str_DBName;
	}

	public function setDBName($str_DBName)
	{
		$this->m_str_DBName = $str_DBName;
	}

	public function getUserName()
	{
		return $this->m_str_UserName;
	}

	public function setUserName($str_UserName)
	{
		$this->m_str_UserName = $str_UserName;
	}

	public function getPassword()
	{
		return $this->m_str_Password;
	}

	public function setPassword($str_Password)
	{
		$this->m_str_Password = $str_Password;
	}

	public function setType($str_Type)
	{
		$this->m_str_Type = $str_Type;
	}

	public function getType()
	{
		return $this->m_str_Type;
	}
}