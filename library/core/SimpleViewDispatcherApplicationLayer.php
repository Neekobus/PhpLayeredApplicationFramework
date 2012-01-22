<?php 

require_once("ApplicationLayerInterface.php");
require_once("ApplicationLayerException.php");

class SimpleViewDispatcherApplicationLayer implements ApplicationLayerInterface {
		
	public function run(DataContainerInterface $applicationData){
		$basePath = $applicationData->get('config')->get('viewDispatcherPath', '.');
		$controller = $applicationData->get('request')->get('ctrl');
		$action = $applicationData->get('request')->get('act');
		
		if (empty($controller) || empty($action)) {
			throw new ApplicationLayerException($this);
		}

		//data for the view
		$data = $applicationData->get('vars'); 

		$scriptName = ucfirst($controller) . ucfirst($action);		
		require_once($basePath . '/' . ucfirst($controller) . '/' . $scriptName . '.php');
	}
}
