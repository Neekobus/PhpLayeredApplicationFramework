<?php

require_once("library/core/LoadDataFromFileApplicationLayer.php");
require_once("library/core/ApplicationLayerException.php");

require_once("MockDataContainer.php");

class LoadDataFromFileApplicationLayerTest extends PHPUnit_Framework_TestCase {
	
	protected $expectedDataInFile;
	protected $expectedDataContainer;
	protected $createdFileName;
	
	protected function createValidFile(){
		$this->createdFileName = "unfichiertemporaire.php";
		$this->expectedDataInFile = array(
			"a" => "A",
			"b" => "B",
			"c" => "C",
			"z" => array(
				"q" => "Q",
				"s" => "S",
				"d" => "D",
			),
		);
		
		$this->expectedDataContainer = new DataContainerArrayAdapter($this->expectedDataInFile);
		file_put_contents($this->createdFileName, '<?php $configuration=' . var_export($this->expectedDataInFile, 1) . ';');
	}
	
	protected function createInvalidFile(){
		$this->createdFileName = "unfichiertemporaire.php";
		$this->expectedDataInFile = "I am not an array...";
		
		file_put_contents($this->createdFileName, '<?php $configuration=' . var_export($this->expectedDataInFile, 1) . ';');
	}
	
	protected function tearDown(){
		@unlink($this->createdFileName);
	}
	
	public function testLayerImplementInterface(){
		$layer = new LoadDataFromFileApplicationLayer("conf", "onefile.php");
		$this->assertTrue($layer instanceof ApplicationLayerInterface);
	}
	
	public function testLayerLoadArrayFromTheFileIntoAsDataContainer(){
		$this->createValidFile();
		
		$keyForDataContainer = "conf";
		$varInFile = "configuration";
		
		$layer = new LoadDataFromFileApplicationLayer($keyForDataContainer, $this->createdFileName, $varInFile);
		$dataContainer = new DataContainerArrayAdapter();
		
		$this->assertNull($dataContainer->get($keyForDataContainer));
		$layer->run($dataContainer);
		$this->assertEquals($this->expectedDataContainer, $dataContainer->get($keyForDataContainer));	
	}
	
	public function testLayerFailToLoadArrayFromTheFileInexistantVar(){
		$this->createValidFile();
		
		$keyForDataContainer = "conf";
		$varInFile = "inexistantvar";
		$expectedEmptyDataContainer = new DataContainerArrayAdapter();
		
		$layer = new LoadDataFromFileApplicationLayer($keyForDataContainer, $this->createdFileName, $varInFile);
		$dataContainer = new DataContainerArrayAdapter();
		
		try{
			$layer->run($dataContainer);
			$this->fail("expected exception");			
		} catch(ApplicationLayerException $e){
			$this->assertSame($layer, $e->getLayer());
		}
			
	}
	
	public function testLayerFailToLoadInexistantFile(){
		$this->createValidFile();
		
		$keyForDataContainer = "conf";
		$varInFile = "var";
		
		$layer = new LoadDataFromFileApplicationLayer($keyForDataContainer, 'inexistant.php', $varInFile);
		$dataContainer = new DataContainerArrayAdapter();
		
		try{
			$layer->run($dataContainer);
			$this->fail("expected exception");			
		} catch(ApplicationLayerException $e){
			$this->assertSame($layer, $e->getLayer());
		}


	}
	
	public function testLayerThrowExceptionIfVarIsNotAnArray(){
		$this->createInvalidFile();

		$keyForDataContainer = "conf";
		$varInFile = "configuration";
		
		$layer = new LoadDataFromFileApplicationLayer($keyForDataContainer, $this->createdFileName, $varInFile);
		$dataContainer = new DataContainerArrayAdapter();
		
		try{
			$layer->run($dataContainer);
			$this->fail("expected exception");			
		} catch(ApplicationLayerException $e){
			$this->assertSame($layer, $e->getLayer());
		}	
	}
}