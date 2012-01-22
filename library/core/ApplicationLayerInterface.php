<?php
interface ApplicationLayerInterface {

	/**
	* The entry point of the layer. 
	* The layer can use and edit the datas.
	*/
	public function run(DataContainerInterface $applicationData);
	
}