<?php
interface DataContainerInterface {
	public function exists($key);
	public function get($key, $defaultValue = null);
	public function set($key, $value);
}