<?php 

require_once("ApplicationLayerInterface.php");
require_once("ApplicationLayerException.php");

class SimpleViewDispatcherApplicationLayer implements ApplicationLayerInterface {
		
	public function run(DataContainerInterface $applicationData){
		$dataContainerKey = 'request';
		$controllerKey = 'ctrl';
		$actionKey = 'act';
		
		$basePath = $applicationData->get('config')->get('viewDispatcherPath', '.');
		$controller = $applicationData->get($dataContainerKey)->get($controllerKey);
		$action = $applicationData->get($dataContainerKey)->get($actionKey);
		
		if (empty($controller) || empty($action)) {
			throw new ApplicationLayerException($this);
		}

		//data for the view
		$data = $applicationData->get('vars'); 

		$scriptName = ucfirst($controller) . ucfirst($action);		
		$fileName = $basePath . '/' . ucfirst($controller) . '/' . $scriptName . '.php';
		
		if (! file_exists($fileName)){
			throw new ApplicationLayerException($this, "Cannot find view file : $fileName");
		}
		
		require($fileName);
	}
}
