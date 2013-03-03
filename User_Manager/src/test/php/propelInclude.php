<?php
use \darkowl\user_manager\webpage;
// Include the main Propel script

require_once 'propel/Propel.php';
// Include the main Propel script
//require_once '/path/to/propel/runtime/lib/Propel.php';

//print("\n\n\n\n".dirname(dirname(__DIR__))."main/php/do/darkowl/User_Manager/classes/"."\n\n\n\n");

set_include_path (get_include_path() . PATH_SEPARATOR . dirname(dirname(__DIR__))."/main/php/do/darkowl/User_Manager/classes/");

if(!defined("PROPEL_INIT"))
{
	define("PROPEL_INIT",TRUE);

	// Initialize Propel with the runtime configuration
	Propel::init(__DIR__."/conf/user_manager-conf.php");

	// Add the generated 'classes' directory to the include path
	set_include_path("classes" . PATH_SEPARATOR . get_include_path());
}
