<?php 

require_once('ControllerDispatcherInterface.php');
require_once('DataContainerInterface.php');

abstract class AbstractApplicationController {
	
	private $dispatcher;
	private $applicationData;
	
	public function setDispatcher(ControllerDispatcherInterface $dispatcher){
		$this->dispatcher = $dispatcher;
	}

	public function setApplicationData(DataContainerInterface $applicationData){
		$this->applicationData = $applicationData;
	}

	public function callController($controllerName, $controllerAction){
		$this->dispatcher->getControllerInstance($controllerName, $controllerAction)->run($this->applicationData);
	}
}