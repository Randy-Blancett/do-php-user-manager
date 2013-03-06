<?php
namespace MidnightPublishing\User_Manager\rest;
/**
 * Include the MidnightPublishing Autoloader
 */
require_once 'MP_Autoloader.php';


// require_once 'setup/cSetupResource.php';
// require_once 'database/cUserManagerDB.php';
// require_once 'user/cUser.php';
// require_once 'application/cApplication.php';
// require_once 'action/cAction.php';
// require_once 'group/cGroup.php';

\PSR0Autoloader::autoload("MidnightPublishing\\User_Manager\\rest\\setup\\cSetupResource");
\PSR0Autoloader::autoload("MidnightPublishing\\User_Manager\\rest\\action\\cAction");
\PSR0Autoloader::autoload("MidnightPublishing\\User_Manager\\rest\\application\\cApplication");
\PSR0Autoloader::autoload("MidnightPublishing\\User_Manager\\rest\\database\\cUserManagerDB");

/**
 * Basic Resource List
 * @namespace User_Manager
 * @uri /
 */
class cBaseResource extends \Tonic\Resource {

	// 	function get($request) {
	/**
	*
	* @method GET
	* @return Response
	*/
	function getHTML() {

		// 		$response = new \Tonic\Response($request);
			
		$str_Resources = '';
		$arr_Dirs = glob(dirname(__FILE__).DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR);

		if ($arr_Dirs) {
			foreach ($arr_Dirs as $path) {
				$arr_Args = Array();
				$str_Location = basename($path);
				$str_Resource = ucfirst($str_Location);
				$str_FileName = $path.DIRECTORY_SEPARATOR."c".$str_Resource.'Resource.php';

				if (file_exists($str_FileName)) {
					preg_match('|/\*\*\s*\*\s*(.+?)\*/|s', file_get_contents($str_FileName), $match);

					$str_Comment = preg_replace('|\s*\*\s*(@.+)?|', "\n", $match[1]);
					$arr_Args =  preg_split ('|\s*\*\s*@|', $match[1]);

					if($arr_Args[0] = $str_Comment)
					{
						unset($arr_Args[0]);
					}


					$str_Name = $str_Resource;
					$str_Description = $str_Comment;
				} else {
					$str_Name = $str_Resource;
					$str_Description = '';
				}
				$str_Resources .=
				'<li>'.
				'<h3><a href="'.$str_Location.'">'.$str_Name.'</a></h3>'.$str_Description;
				$str_Resources .='<ul>';
				foreach($arr_Args as $str_Arg)
				{
					$arr_Temp = split (" ",$str_Arg);
					$str_Resources .='<li>';
					$str_Resources .='<b>'.$arr_Temp[0].'</b> - ';
					unset($arr_Temp[0]);
					$str_Resources .= implode (" ",$arr_Temp);
					$str_Resources .='</li>';
				}
				$str_Resources .='</ul>';

				$str_Resources .='</li>';
			}
		} else {
			$str_Resources .= '<li>No Resources</li>';
		}


		return $str_Resources;

	}

}

