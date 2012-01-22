<?php

$lib = realpath(__DIR__ . '/..');
require_once("$lib/library/core/DataContainerArrayAdapter.php");
require_once("$lib/library/core/CompositeApplicationLayer.php");

$applicationData = new DataContainerArrayAdapter();
$applicationData->set("request", new DataContainerArrayAdapter($_REQUEST));
$applicationData->set("session", new DataContainerArrayAdapter($_SESSION));
$applicationData->set("vars", new DataContainerArrayAdapter());

$layers = new CompositeApplicationLayer();

$layers->run($applicationData);