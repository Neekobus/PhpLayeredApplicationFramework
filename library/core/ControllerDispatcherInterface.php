<?php
interface ControllerDispatcherInterface {
	function getControllerInstance($controller, $action);
}