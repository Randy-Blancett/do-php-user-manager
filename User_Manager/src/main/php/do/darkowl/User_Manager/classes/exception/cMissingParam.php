<?php
namespace darkowl\user_manager\exception;

class cMissingParam extends \Exception
{
	function __construct($str_Function,$str_Param,$str_Msg){
		parent::__construct($str_Function."::".$str_Param." - ".$str_Msg);
	}
}