<?php
// =========================================================================
//
// tests/bootstrap.php
//		A helping hand for running our unit tests
//
// Author	Stuart Herbert
//		(stuart@stuartherbert.com)
//
// Copyright	(c) 2011 Stuart Herbert
//		Released under the New BSD license
//
// =========================================================================


// step 1: create the APP_TOPDIR constant that all components require
define('APP_TOPDIR', realpath(__DIR__ . '/../../php'));
define('APP_LIBDIR', realpath(__DIR__ . '/../../../vendor/php'));
define('WEB_DIR', realpath(__DIR__ . '/../../www'));
define('APP_TESTDIR', realpath(__DIR__ . '/php'));

// print( "APP_TOPDIR - ".realpath(__DIR__ . '/../../php')."\n");
// print( "APP_LIBDIR - ".realpath(__DIR__ . '/../../../vendor/php')."\n");
// print( "APP_TESTDIR - ".realpath(__DIR__ . '/php')."\n");

// step 2: find the autoloader, and install it
require_once(APP_TOPDIR."/MP_Autoloader.php");

// step 3: add the additional paths to the include path
PSR0Autoloader::searchFirst(APP_LIBDIR);
PSR0Autoloader::searchFirst(APP_TESTDIR);
PSR0Autoloader::searchFirst(APP_TOPDIR);
PSR0Autoloader::searchFirst(WEB_DIR);


// step 4: enable ContractLib if it is available
if (class_exists('Phix_Project\ContractLib\Contract'))
{
	\Phix_Project\ContractLib\Contract::EnforceWrappedContracts();
}
