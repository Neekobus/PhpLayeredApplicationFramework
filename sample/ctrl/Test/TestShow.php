<?php 

class TestShow implements ApplicationLayerInterface {

	public function run(DataContainerInterface $applicationData){
		$applicationData->get('vars')->set('message', 'hello from the controller !');
	}
		
}