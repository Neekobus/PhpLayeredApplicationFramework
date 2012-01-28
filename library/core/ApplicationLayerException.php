<?php
class ApplicationLayerException extends Exception {
	
	protected $layer;
	
	public function __construct(ApplicationLayerInterface $layer, $message = ''){
		$this->layer = $layer;
		$message = empty($message) ? '' : ' with message : ' . $message;
		parent::__construct('Application layer : ' . get_class($layer) . ' has thrown an exception' . $message . '.');
	}
	
	public function getLayer(){
		return $this->layer;
	}
}