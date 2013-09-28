<?php
namespace MidnightPublishing\User_Manager\unitTest;
use \MidnightPublishing\User_Manager\resource\cConfigResource;

class cConfigResourceTest extends \PHPUnit_Framework_TestCase
{
	public function testConstructor()
	{
		$resource = new cConfigResource();

		$this->assertInstanceOf("\\MidnightPublishing\\User_Manager\\resource\\cConfigResource", $resource);
	}
}