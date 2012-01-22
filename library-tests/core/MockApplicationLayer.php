<?php 

require_once("library/core/ApplicationLayerInterface.php");

class MockApplicationLayer implements ApplicationLayerInterface {

	public $parameterPassedToRunMethod=null;
	public $indexReference;
	public $valueOfIndexWhenRun=-1;
	public $runHasBeenCalled = 0;
	
	public function run(DataContainerInterface $applicationData){
		$this->parameterPassedToRunMethod = $applicationData;
		
		$this->runHasBeenCalled ++;
		
		$this->valueOfIndexWhenRun = $this->indexReference;
		$this->indexReference ++;
	}
		
}