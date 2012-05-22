<?php
use \darkowl\user_manager\webpage;
// Include the main Propel script
require_once 'propel/Propel.php';
// Include the main Propel script
//require_once '/path/to/propel/runtime/lib/Propel.php';

// Initialize Propel with the runtime configuration
Propel::init(__DIR__."/conf/user_manager-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("classes" . PATH_SEPARATOR . get_include_path());
