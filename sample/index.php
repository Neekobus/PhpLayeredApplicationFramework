<?php

$lib = realpath(__DIR__ . '/..');
require_once("$lib/library/core/DataContainerArrayAdapter.php");
require_once("$lib/library/core/StandardWebInitializationApplicationLayer.php");
require_once("$lib/library/core/CompositeApplicationLayer.php");
require_once("$lib/library/core/LoadDataFromFileApplicationLayer.php");
require_once("$lib/library/core/ControllerDispatcherApplicationLayer.php");
require_once("$lib/library/core/SimpleViewDispatcherApplicationLayer.php");
require_once("$lib/library/core/DumpDataApplicationLayer.php");

$applicationData = new DataContainerArrayAdapter();

$layers = new CompositeApplicationLayer();
$layers->addLayer(new StandardWebInitializationApplicationLayer());
$layers->addLayer(new LoadDataFromFileApplicationLayer('config', 'configuration.php', 'config'));
$layers->addLayer(new ControllerDispatcherApplicationLayer());
$layers->addLayer(new SimpleViewDispatcherApplicationLayer());
$layers->addLayer(new DumpDataApplicationLayer('./dump.log'));

$layers->run($applicationData);