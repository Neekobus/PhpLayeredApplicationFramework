<?php

$lib = realpath(__DIR__ . '/..');
require_once("$lib/library/core/DataContainerArrayAdapter.php");
require_once("$lib/library/core/StandardWebInitializationApplicationLayer.php");
require_once("$lib/library/core/CompositeApplicationLayer.php");
require_once("$lib/library/core/LoadDataFromFileApplicationLayer.php");
require_once("$lib/library/core/ControllerDispatcherApplicationLayer.php");
require_once("$lib/library/core/SimpleViewDispatcherApplicationLayer.php");
require_once("$lib/library/core/DumpDataApplicationLayer.php");

//The main datacontainer. He will contain others datacontainer, as the following layers will build them.
$applicationData = new DataContainerArrayAdapter();

//CompositeApplicationLayer : a simple list of layers. Calling run() on it will call run() on each item of the list
$layers = new CompositeApplicationLayer();

//StandardWebInitializationApplicationLayer : Put the $_REQUEST, $_SESSION in the applicationData container 
//(respectivly as "request" and "session"). Add also an empty container "vars". 
$layers->addLayer(new StandardWebInitializationApplicationLayer());

//LoadDataFromFileApplicationLayer : Load a file (here: 'configuration.php'), 
//and put the content of the array variable (here: '$config') in the applicationData 
//container as the given key (here: "config")
$layers->addLayer(new LoadDataFromFileApplicationLayer('config', 'configuration.php', 'config'));

//ControllerDispatcherApplicationLayer : Try to load and run an application layer based on 
//the "ctrl" and "act" keys in the applicationData/request. 
$layers->addLayer(new ControllerDispatcherApplicationLayer());

//SimpleViewDispatcherApplicationLayer : Try to load and include a script based on 
//the "ctrl" and "act" keys in the applicationData/request. 
$layers->addLayer(new SimpleViewDispatcherApplicationLayer());

//DumpDataApplicationLayer : Simply dump the application data to the given file (here: ./dump.log). 
//You can also set "php://output", if you want to dump to the screen.
$layers->addLayer(new DumpDataApplicationLayer('./dump.log'));

//Run the list to run all the items.
$layers->run($applicationData);