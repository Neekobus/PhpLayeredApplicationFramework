<?php

require_once("ApplicationLayerInterface.php");

class CompositeApplicationLayer implements ApplicationLayerInterface {
	
	protected $layers=array();
	
	public function run(DataContainerInterface $applicationData){
		foreach($this->layers as $layer){
			$layer->run($applicationData);
		}
	}
	
	public function addLayer(ApplicationLayerInterface $layer){
		$this->layers[] = $layer;
	}
	
}