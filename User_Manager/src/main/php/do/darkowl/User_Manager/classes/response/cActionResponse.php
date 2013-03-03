<?php
namespace darkowl\user_manager\response;
use darkowl\user_manager\resource\abs_ExtJsResponse;


require_once dirname( dirname(__DIR__)).'/abstract/abs_ExtJsResponse.php';

class cActionResponse extends abs_ExtJsResponse
{

	protected $m_str_DataType = "actions";
}

