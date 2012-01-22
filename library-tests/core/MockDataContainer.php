<?php

require_once("library/core/DataContainerInterface.php");

class MockDataContainer implements DataContainerInterface {
	public $dataArray;
	
	public function __construct(){
		$this->dataArray = array();
	}
	
	public function exists($key){
		return array_key_exists($key, $this->dataArray);
	}
	
	public function get($key, $defaultValue = null){
		if (isset($this->dataArray[$key])) {
			return $this->dataArray[$key];
		}
		
		return $defaultValue;
	}
	
	public function set($key, $value){
		$this->dataArray[$key] = $value;
	}
}