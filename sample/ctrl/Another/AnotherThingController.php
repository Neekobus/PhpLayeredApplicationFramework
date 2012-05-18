<?php 

class AnotherThingController implements ApplicationLayerInterface {

	public function run(DataContainerInterface $applicationData){
		$applicationData->get('vars')->append('message', 'hello from the 2nd controller !');
	}
		
}