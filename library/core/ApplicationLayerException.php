<?php
class ApplicationLayerException extends Exception{
	public function __construct(ApplicationLayerInterface $layer){
		parent::__construct("Application layer : " . get_class($layer) . " has thrown an exception.");
	}
}