<?php 

require_once("ApplicationLayerInterface.php");
require_once("ApplicationLayerException.php");


class LoadDataFromFileApplicationLayer implements ApplicationLayerInterface {
		
	protected $filename;
	protected $key;
	protected $varInFile;
	
	/**
	 * @param string $keyForDataContainer - The key added into the Datacontainer
	 * @param string $filename - The file, to extract the variable
	 * @param string $varInFile - The variable name (without "$") in the file.
	*/
	public function __construct($keyForDataContainer, $filename, $varInFile='config'){
		$this->filename = $filename;
		$this->key = $keyForDataContainer;
		$this->varInFile = $varInFile;
	}
	
	public function run(DataContainerInterface $applicationData){
		
		if (! file_exists($this->filename)) {
			throw new ApplicationLayerException($this, 'Cannot found file ' . $this->filename);
		}
		
		include($this->filename);
		
		if (! isset(${$this->varInFile}) || ! is_array(${$this->varInFile})){
			throw new ApplicationLayerException($this, 'The variable <' . $this->varInFile . '> is null or not an array.');
		}
		
		$applicationData->set($this->key, new DataContainerArrayAdapter(${$this->varInFile}));
	}
	
}
