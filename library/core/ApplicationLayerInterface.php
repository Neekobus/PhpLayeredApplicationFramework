<?php
interface ApplicationLayerInterface {

	/**
	* The entry point of the layer. 
	* The layer can use and edit the datas.
	*/
	public function run(DataContainerInterface $applicationData);
	
	/**
	* Return if the concrete layer run in the given flow (ApplicationLayer::FLOW_NORMAL or ApplicationLayer::FLOW_ERROR)
	* @return boolean True if layer can run in the given flow, false otherwise. 
	*/
	public function static runInFlow($flow);
}