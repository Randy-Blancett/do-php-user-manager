<?php
namespace MidnightPublishing\User_Manager\response;

use MidnightPublishing\User_Manager\abs\absExtJsResponse;

/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';

class cUserResponse extends absExtJsResponse
{
	protected $m_str_DataType = "users";
}

