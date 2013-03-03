<?php
use \darkowl\user_manager\webpage;
Require_once 'conf/cInfo.php';
// Include the main Propel script
require_once 'propel/Propel.php';
// Include the main Propel script
//require_once '/path/to/propel/runtime/lib/Propel.php';

// Initialize Propel with the runtime configuration
Propel::init(webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH."/conf/user_manager-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path(webpage\cInfo::C_STR_USER_MANAGER_CODE_PATH."/classes" . PATH_SEPARATOR . get_include_path());
