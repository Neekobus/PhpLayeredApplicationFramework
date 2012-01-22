<?php 

require_once("ApplicationLayerInterface.php");
require_once("ApplicationLayerException.php");

class ControllerDispatcherApplicationLayer implements ApplicationLayerInterface {
		
	public function run(DataContainerInterface $applicationData){
		$basePath = $applicationData->get('config')->get('controllerDispatcherPath', '.');
		$controller = $applicationData->get('request')->get('ctrl');
		$action = $applicationData->get('request')->get('act');
		
		if (empty($controller) || empty($action)) {
			throw new ApplicationLayerException($this);
		}

		$className = ucfirst($controller) . ucfirst($action);		
		require_once($basePath . '/' . ucfirst($controller) . '/' . $className . '.php');

		$instance = new $className();
		$instance->run($applicationData);
	}
}
