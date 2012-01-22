<?php

require_once("library/core/ControllerDispatcherApplicationLayer.php");
require_once("MockDataContainer.php");

class ControllerDispatcherApplicationLayerTest extends PHPUnit_Framework_TestCase {
	
	protected $invalidMockApplicationContainer;
	
	protected function setUp(){
		$this->invalidMockApplicationContainer = new MockDataContainer();
		
		//mock CONFIG
		$mockConfigContainer = new MockDataContainer();
		$mockConfigContainer->set('controllerDispatcherPath', '.');
		
		//mock REQUEST
		$mockRequestContainer = new MockDataContainer();
		//missing ctrl and act parameters
		
		$this->invalidMockApplicationContainer->set('config', $mockConfigContainer);
		$this->invalidMockApplicationContainer->set('request', $mockRequestContainer);
	}
	
	public function testLayerImplementInterface(){
		$layer = new ControllerDispatcherApplicationLayer();
		$this->assertTrue($layer instanceof ApplicationLayerInterface);
	}
	
	public function testLayerThrowExceptionWithoutCtrlOrAction(){
		$layer = new ControllerDispatcherApplicationLayer();
		
		try{
			$layer->run($this->invalidMockApplicationContainer);			
			$this->fail("Excepted Exception");
		} catch(ApplicationLayerException $e){
			$this->assertSame($layer, $e->getLayer());
		}

	}
	
}