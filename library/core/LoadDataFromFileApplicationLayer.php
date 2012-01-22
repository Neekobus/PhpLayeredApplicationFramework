<?php 

require_once("ApplicationLayerInterface.php");
require_once("ApplicationLayerException.php");


class LoadDataFromFileApplicationLayer implements ApplicationLayerInterface {
		
	protected $filename;
	protected $key;
	protected $varInFile;
		
	public function __construct($key, $filename, $varInFile='config'){
		$this->filename = $filename;
		$this->key = $key;
		$this->varInFile = $varInFile;
	}
	
	public function run(DataContainerInterface $applicationData){
		
		if (! file_exists($this->filename)) {
			throw new ApplicationLayerException($this);
		}
		
		include($this->filename);
		
		if (empty(${$this->varInFile})){
			${$this->varInFile} = array();
		}
		
		$applicationData->set($this->key, new DataContainerArrayAdapter(${$this->varInFile}));
	}
	
}
