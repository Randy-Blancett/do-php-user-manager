<?php
/**
 * Copied from psr0.autoloader.php found in Pear directory and modified for pupous of loading Midnight Publishing Files
 * @author Randy.Blancett
 *
 */


//Only worry about Autoloader if it is not already Initalized
if(!defined("MP_AUTOLOADER_SET")) {
	define("MP_AUTOLOADER_SET", true);

	class PSR0Autoloader
	{
		private static $m_arr_LoadedNamespaces = array();
		// autoloader support
		public static function  normalisePath($str_ClassName)
		{
// 			print("PSR0 Normalise Path '$str_ClassName'\n");
			$str_FileName  = '';
			$int_LastNsPos = strripos($str_ClassName, '\\');

			if ($int_LastNsPos !== false)
			{
				$str_Namespace = substr($str_ClassName, 0, $int_LastNsPos);
				$str_ClassName = substr($str_ClassName, $int_LastNsPos + 1);
				$str_FileName  = str_replace('\\', DIRECTORY_SEPARATOR, $str_Namespace) . DIRECTORY_SEPARATOR;
			}

			return $str_FileName . str_replace('_', DIRECTORY_SEPARATOR, $str_ClassName);

		}

		public static function initNamespace($str_Namespace, $str_FileExt = '.init.php')
		{

			// have we loaded this namespace before?
			if (isset(self::$m_arr_LoadedNamespaces[$str_Namespace]))
			{
				// yes we have - bail
				return;
			}

			$str_Path = self::normalisePath($str_Namespace);
			$str_FileName = $str_Path . '/_init/' . end(explode('/', $str_Path)) . $str_FileExt;

			self::includeFile($str_FileName);
		}

		public static function autoload($str_ClassName)
		{
// 			print("PSR0 AutoLoad '$str_ClassName'\n");
			if (class_exists($str_ClassName) || interface_exists($str_ClassName))
			{
				print($str_ClassName." Is already loaded.\n");
				return FALSE;
			}

			// convert the classname into a filename on disk
			$str_ClassFile = self::normalisePath($str_ClassName) . '.php';


// 			print("PSR0 AutoLoad Class File '$str_ClassFile'\n");

			return self::includeFile($str_ClassFile);
		}

		public static function includeFile($str_FileName)
		{
// 			print("PSR0 includeFile '$str_FileName'\n");
			$arr_PathToSearch = explode(PATH_SEPARATOR, get_include_path());

			// keep track of what we have tried; this info may help other
			// devs debug their code
			$arr_FailedFiles = array();

			foreach ($arr_PathToSearch as $str_SearchPath)
			{
// 				print("Searching Path '$str_SearchPath'\n");
				$str_File2Load = $str_SearchPath . '/' . $str_FileName;
				// var_dump($str_File2Load);
				if (!file_exists($str_File2Load))
				{

// 					print(" - File Not found in '$str_SearchPath'\n");
					$arr_FailedFiles[] = $str_File2Load;
					continue;
				}

				require($str_File2Load);
				return TRUE;
			}
				
			print_r($arr_FailedFiles);

			// if we get here, we could not find the requested file
			// we do not die() or throw an exception, because there may
			// be other autoload functions also registered
			return FALSE;
		}

		public static function searchFirst($str_Dir)
		{
			$str_Dir = realpath($str_Dir);

			self::dontSearchIn($str_Dir);

			// add the new directory to the front of the path
			set_include_path($str_Dir . PATH_SEPARATOR . get_include_path());
		}

		public static 	function searchLast($str_Dir)
		{
			$str_Dir = realpath($str_Dir);

			self::dontSearchIn($str_Dir);

			// add the new directory to the end of the path
			set_include_path(get_include_path() . PATH_SEPARATOR . $str_Dir);
		}

		public static function dontSearchIn($str_Dir)
		{
			// check to make sure that $str_Dir is not already in the path
			$arr_PathToSearch = explode(PATH_SEPARATOR, get_include_path());

			foreach ($arr_PathToSearch as $str_DirToSearch)
			{
				$str_DirToSearch = realpath($str_DirToSearch);
				if ($str_DirToSearch == $str_Dir)
				{
					// we have found it
					// remove it from the list
					// $key points to the *next* entry in the list,
					// not the current entry
					$key = key($arr_PathToSearch);
					$key -= 1;
					unset($arr_PathToSearch[$key]);
				}
			}

			// set the revised search path
			set_include_path(implode(PATH_SEPARATOR, $arr_PathToSearch));
		}
	}

	function mpAutoLoader($str_ClassName)
	{
// 		print("In Autoloader for $str_ClassName\n");
		PSR0Autoloader::autoload($str_ClassName);
	}

// 	print("Setting UP Autoload\n");

	spl_autoload_register('mpAutoLoader');
	// assume that we are at the top of a vendor tree to load from
	PSR0Autoloader::searchFirst(__DIR__);
}
