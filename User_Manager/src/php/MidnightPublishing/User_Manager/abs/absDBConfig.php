<?php
namespace MidnightPublishing\User_Manager\abs;
/**
 * Abstract Database Configuration class
 * This class allows you to pass Database configuration data
 * @author Randy Blancett
 * @package MidnightPublishing\User Manager\abs
 */
abstract class absDBConfig
{

	private $m_str_DBName = "";
	private $m_str_Host = "";
	private $m_str_Type = "";
	private $m_str_Port = "";
	private $m_str_UserName = "";
	private $m_str_Password = "";

	/**
	 * Get the DNS
	 * @return string ('type':host='host';dbname='dbname';)
	 */
	public function getDNS()
	{
		$str_DNS =$this->m_str_Type;
		$str_DNS .=":";
		$str_DNS .="host=".$this->m_str_Host.";";
		$str_DNS .="dbname=".$this->m_str_DBName.";";
		return $str_DNS;
	}

	/**
	 * Get the host name
	 * @return string
	 */
	public function getHost()
	{
		return $this->m_str_Host ;
	}

	/**
	 * Set the port for the Database configuration
	 * @param string $str_Port
	 */
	public function setPort($str_Port)
	{
		$this->m_str_Port = $str_Port;
	}

	/**
	 * Get the port of the database
	 * @return string
	 */
	public function getPort()
	{
		return $this->m_str_Port;
	}

	/**
	 * Set the host of the database
	 * @param string $str_Host
	 */
	public function setHost($str_Host)
	{
		$this->m_str_Host = $str_Host;
	}

	/**
	 * Return the Database name
	 * @return string
	 */
	public function getDBName()
	{
		return $this->m_str_DBName;
	}

	/**
	 * Set the Database name
	 * @param string $str_DBName
	 */
	public function setDBName($str_DBName)
	{
		$this->m_str_DBName = $str_DBName;
	}

	/**
	 * Get the Username used to login to the database
	 * @return string
	 */
	public function getUserName()
	{
		return $this->m_str_UserName;
	}

	/**
	 * Set the UserName to connect to the database
	 * @param string $str_UserName
	 */
	public function setUserName($str_UserName)
	{
		$this->m_str_UserName = $str_UserName;
	}

	/**
	 * Get the password used to connect to the database
	 * @return string
	 */
	public function getPassword()
	{
		return $this->m_str_Password;
	}

	/**
	 * Set the password used to connect to the database
	 * @param string $str_Password
	 */
	public function setPassword($str_Password)
	{
		$this->m_str_Password = $str_Password;
	}

	/**
	 * Set the type of database you are connecting to
	 * @param string $str_Type
	 */
	public function setType($str_Type)
	{
		$this->m_str_Type = $str_Type;
	}

	/**
	 * get the database type
	 * @return string
	 */
	public function getType()
	{
		return $this->m_str_Type;
	}
}