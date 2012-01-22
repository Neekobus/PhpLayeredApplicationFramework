<?php 

require_once("ApplicationLayerInterface.php");

class DumpDataApplicationLayer implements ApplicationLayerInterface {
	
	protected $fileDescriptor;
	
	public function __construct($fileName){
		$this->fileDescriptor = fopen($fileName, 'w+');
	}
	
	public function run(DataContainerInterface $applicationData){
		fwrite($this->fileDescriptor, print_r($applicationData, true));	
	}
}
	