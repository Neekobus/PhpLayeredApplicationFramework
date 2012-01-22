<?php 

require_once("ApplicationLayerInterface.php");

class DumpDataApplicationLayer implements ApplicationLayerInterface {
	
	protected $fileDescriptor;
	
	public function __construct($fileName){
		$this->fileDescriptor = fopen($fileName, 'w+');
	}
	
	public function run(DataContainerInterface $applicationData){
		fwrite($this->fileDescriptor, var_dump($applicationData, true));		
	}
}
	