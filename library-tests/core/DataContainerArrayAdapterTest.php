<?php

require_once("library/core/DataContainerArrayAdapter.php");

class DataContainerArrayAdapterTest extends PHPUnit_Framework_TestCase {
	
	protected $array;
	
	protected function setUp(){
		$this->array = array(
			"key1" => "value1",
			"key2" => "value2",
			"key3" => "value3",
		);
	}
	
	public function testAdapterImplementInterface(){
		$adapter = new DataContainerArrayAdapter();
		$this->assertTrue($adapter instanceof DataContainerInterface);
	}
	
	public function testAdapterChangeUseAdaptedArray(){
		
		$adapter = new DataContainerArrayAdapter($this->array);
		$this->assertEquals($this->array["key2"], $adapter->get("key2"));
		$this->assertEquals($this->array["key3"], $adapter->get("key3"));
		$this->assertEquals($this->array["key1"], $adapter->get("key1"));
		$this->assertNull($adapter->get("key4"));
		
	}
	
	public function testAdapterReturnDefaultWhenNull(){
		$defaultValue = "this is the default value";
		
		$adapter = new DataContainerArrayAdapter($this->array);
		$this->assertNull($adapter->get("key4"));
		$this->assertEquals($defaultValue, $adapter->get("key4", $defaultValue));
		
	}
	
	public function testAdapterSetValueUpdateOriginalArray(){
		$newValue = "new value";
		
		$adapter = new DataContainerArrayAdapter($this->array);
		
		$originalValue = $this->array["key1"];
		$adapter->set("key1", $newValue);
		
		$this->assertEquals($newValue, $this->array["key1"]);
		$this->assertEquals($newValue, $adapter->get("key1"));
	}
	
	public function testAdapterAppendValuesGetAnArray(){
		
		$adapter = new DataContainerArrayAdapter($this->array);
		$adapter->append("key", 'one');
		$adapter->append("key", 'two');
		$adapter->append("key", 'three');
		$adapter->append("key", 'four');
		
		$this->assertEquals(array('one', 'two', 'three', 'four'), $adapter->get("key"));
		
	}
	
	public function testAdapterAppendValuesSetOverwrite(){
		
		$adapter = new DataContainerArrayAdapter($this->array);
		$adapter->append("key", 'one');
		$adapter->append("key", 'two');
		$adapter->append("key", 'three');
		$adapter->append("key", 'four');
		
		$adapter->set("key", 'only me');
		$this->assertEquals('only me', $adapter->get("key"));
		
	}
	
	public function testAdapterAppendValuesOverSettedArray(){
		
		$adapter = new DataContainerArrayAdapter($this->array);
		
		$adapter->set("key", array('zero', 'one'));

		$adapter->append("key", 'two');
		$adapter->append("key", 'three');
		$adapter->append("key", 'four');
		
		$this->assertEquals(array('zero', 'one', 'two', 'three', 'four'), $adapter->get("key"));
	}
	
	public function testAdapterAppendValuesOverNonArray(){
		
		$adapter = new DataContainerArrayAdapter($this->array);
		
		$adapter->set("key", 'not an array');
		
		$adapter->append("key", 'one');
		$adapter->append("key", 'two');
		
		$this->assertEquals(array('not an array', 'one', 'two'), $adapter->get("key"));
	} 
}