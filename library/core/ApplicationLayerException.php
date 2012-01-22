<?php
class ApplicationLayerException extends Exception {
	
	protected $layer;
	
	public function __construct(ApplicationLayerInterface $layer){
		$this->layer = $layer;
		parent::__construct("Application layer : " . get_class($layer) . " has thrown an exception.");
	}
	
	public function getLayer(){
		return $this->layer;
	}
}