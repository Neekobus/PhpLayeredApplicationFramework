<?php

require_once("library/core/CompositeApplicationLayer.php");
require_once("MockApplicationLayer.php");
require_once("MockDataContainer.php");

class CompositeApplicationLayerTest extends PHPUnit_Framework_TestCase {
	
	protected $mockLayer1;
	protected $mockLayer2;
	protected $mockLayer3;
	protected $mockDataContainer;
	
	protected function setUp(){
		$this->mockLayer1 = new MockApplicationLayer();
		$this->mockLayer2 = new MockApplicationLayer();
		$this->mockLayer3 = new MockApplicationLayer();	
		
		$this->mockDataContainer = new MockDataContainer();
	}
	
	public function testCompositeImplementInterface(){
		$composite = new CompositeApplicationLayer();
		$this->assertTrue($composite instanceof ApplicationLayerInterface);
	}
	
	public function testCompositeCanAddLayersAndRunThem(){
		
		$composite = new CompositeApplicationLayer();
		$composite->addLayer($this->mockLayer1);
		$composite->addLayer($this->mockLayer2);
		$composite->addLayer($this->mockLayer3);
		
		$this->assertNull($this->mockLayer1->parameterPassedToRunMethod);
		$this->assertNull($this->mockLayer2->parameterPassedToRunMethod);
		$this->assertNull($this->mockLayer3->parameterPassedToRunMethod);
		
		$composite->run($this->mockDataContainer);
		
		$this->assertSame($this->mockDataContainer, $this->mockLayer1->parameterPassedToRunMethod);
		$this->assertSame($this->mockDataContainer, $this->mockLayer2->parameterPassedToRunMethod);
		$this->assertSame($this->mockDataContainer, $this->mockLayer3->parameterPassedToRunMethod);
		
	}
	
	public function testCompositeRunLayersInOrder(){
		
		$composite = new CompositeApplicationLayer();
		$composite->addLayer($this->mockLayer1);
		$composite->addLayer($this->mockLayer2);
		$composite->addLayer($this->mockLayer3);
		
		$index = 1;
		$this->mockLayer1->indexReference =& $index;
		$this->mockLayer2->indexReference =& $index;
		$this->mockLayer3->indexReference =& $index;
		
		$composite->run($this->mockDataContainer);
		
		$this->assertEquals(1, $this->mockLayer1->valueOfIndexWhenRun);
		$this->assertEquals(2, $this->mockLayer2->valueOfIndexWhenRun);
		$this->assertEquals(3, $this->mockLayer3->valueOfIndexWhenRun);
		
		$this->assertEquals(1, $this->mockLayer1->runHasBeenCalled);
		$this->assertEquals(1, $this->mockLayer2->runHasBeenCalled);
		$this->assertEquals(1, $this->mockLayer3->runHasBeenCalled);
		
	}
	
	
}