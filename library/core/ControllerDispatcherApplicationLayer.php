<?php 

require_once("ApplicationLayerInterface.php");
require_once("ApplicationLayerException.php");
require_once("ControllerDispatcherInterface.php");

class ControllerDispatcherApplicationLayer implements ApplicationLayerInterface, ControllerDispatcherInterface {
	
	protected $basePath;
	
	public function run(DataContainerInterface $applicationData){
		$dataContainerKey = 'request';
		$controllerKey = 'ctrl';
		$actionKey = 'act';
		
		$this->basePath = $applicationData->get('config')->get('controllerDispatcherPath', '.');
		$controller = $applicationData->get($dataContainerKey)->get($controllerKey);
		$action = $applicationData->get($dataContainerKey)->get($actionKey);
		
		if (empty($controller) || empty($action)) {
			throw new ApplicationLayerException($this, "Controller (<$controllerKey>) and/or action (<$action>) is not set in dataContainer (<$dataContainerKey>).");
		}
		
		$this->currentApplicationData = $applicationData;
		$this->getControllerInstance($controller, $action)->run($applicationData);
	}
	
	public function getControllerInstance($controller, $action){
		
		if (! isset($this->basePath)){
			throw new ApplicationLayerException($this, "You cannot build a controller instance outside an application run.");
		}
		
		$className = ucfirst($controller) . ucfirst($action);
		$fileName = $this->basePath . '/' . ucfirst($controller) . '/' . $className . '.php';		
		
		if (! file_exists($fileName)){
			throw new ApplicationLayerException($this, "Cannot find controller file : $fileName");
		}
		
		require_once($fileName);
		$instance = new $className();
		
		if ($instance instanceof AbstractApplicationController) {
			$instance->setDispatcher($this);
			$instance->setApplicationData($this->currentApplicationData);
		}
		
		return $instance;
	}
	
}
