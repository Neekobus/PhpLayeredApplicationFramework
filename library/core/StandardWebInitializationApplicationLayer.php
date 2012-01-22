<?php 

require_once("ApplicationLayerInterface.php");
require_once("DataContainerArrayAdapter.php");

class StandardWebInitializationApplicationLayer implements ApplicationLayerInterface {
		
	public function run(DataContainerInterface $applicationData){
		
		$applicationData->set("request", new DataContainerArrayAdapter($_REQUEST));
		$applicationData->set("session", new DataContainerArrayAdapter($_SESSION));
		$applicationData->set("vars", new DataContainerArrayAdapter());
		
	}
}
