<?php
use MidnightPublishing\User_Manager\conf\cDBConfig;


$obj_DBConfig = new cDBConfig();
$conf = array (
		'datasources' =>
		array (
				'user_manager' =>
				array (
						'adapter' => $obj_DBConfig->getType(),
						'connection' =>
						array (
								'dsn' => $obj_DBConfig->getDNS(),
								'user' => $obj_DBConfig->getUserName(),
								'password' => $obj_DBConfig->getPassword(),
						),
				),'mysql' =>
				array (
						'adapter' => $obj_DBConfig->getType(),
						'connection' =>
						array (
								'dsn' => $obj_DBConfig->getType().":"."host=".$obj_DBConfig->getHost().";dbname=mysql;",
								'user' => $obj_DBConfig->getUserName(),
								'password' => $obj_DBConfig->getPassword(),
						),
				),
				'default' => 'user_manager',
		),
		'generator_version' => '1.6.8',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classmap-user_manager-conf.php');
return $conf;