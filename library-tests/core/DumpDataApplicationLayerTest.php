<?php

require_once("library/core/DumpDataApplicationLayer.php");
require_once("MockDataContainer.php");

class DumpDataApplicationLayerTest extends PHPUnit_Framework_TestCase {
	
	protected $mockDataContainer;
	protected $mockDataContainer1;
	protected $mockDataContainer2;
	
	protected function setUp(){
		$this->mockDataContainer = new MockDataContainer();
		$this->mockDataContainer1 = new MockDataContainer();
		$this->mockDataContainer2 = new MockDataContainer();
		
		$this->mockDataContainer->set("container 1", $this->mockDataContainer1);
		$this->mockDataContainer->set("container 2", $this->mockDataContainer2);

		$this->mockDataContainer1->set("cont. 1 - key1", "value1");
		$this->mockDataContainer1->set("cont. 1 - key2", "value2");
		$this->mockDataContainer2->set("cont. 2 - key1", "value1");
		$this->mockDataContainer2->set("cont. 2 - key2", "value2");
		
	}
	
	public function testLayerImplementInterface(){
		$layer = new DumpDataApplicationLayer("php://output");
		$this->assertTrue($layer instanceof ApplicationLayerInterface);
	}
	
	
	public function testLayerDumpToFileDescriptor(){
		
		$layer = new DumpDataApplicationLayer("php://output");
		
		ob_start();
		$layer->run($this->mockDataContainer);
		$content = ob_get_contents();
		ob_end_clean();
		
		//just some tests to see if it dump some data where we want. The actual format is not important.
		$this->assertFalse(empty($content));
		$this->assertTrue(strpos($content, "container") !== false);
		
	}
	
}