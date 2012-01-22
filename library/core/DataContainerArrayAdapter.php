<?php

require_once("DataContainerInterface.php");

class DataContainerArrayAdapter implements DataContainerInterface {
	
	protected $adaptedArray;
	
	public function __construct(&$arrayToAdapt = array()){
		$this->adaptedArray =& $arrayToAdapt;
	}
	
	public function exists($key){
		return array_key_exists($key, $this->adaptedArray);
	}
	
	public function get($key, $defaultValue = null){
		if (isset($this->adaptedArray[$key])) {
			return $this->adaptedArray[$key];
		}
		
		return $defaultValue;
	}
	
	public function set($key, $value){
		$this->adaptedArray[$key] = $value;
	}
}