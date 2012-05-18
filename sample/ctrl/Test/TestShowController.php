<?php 

class TestShowController extends AbstractApplicationController implements ApplicationLayerInterface {

	public function run(DataContainerInterface $applicationData){
		$applicationData->get('vars')->set('title', $applicationData->get('config')->get('application_name'));
		$applicationData->get('vars')->append('message', 'hello from the controller !');
		$this->callController('Another', 'Thing');
	}
		
}