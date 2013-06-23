<?php 

use darkowl\user_manager\webpage\cInfo;

require_once WEB_DIR."/User_Manager/php/conf/cInfo.php";

class cInfoTest extends \PHPUnit_Framework_TestCase
{
	public	function testInitalize()
	{
		$testConfig = new cInfo();
	}
}