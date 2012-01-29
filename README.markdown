# Php Layered Application Framework

*Php Layered Application Framework* is a very simple PHP framework.
It's based on a main "chain of responsability" composed by all the "application layers".
At the end of the chain, thanks to each layers, the http request will be parsed, the session checked, the controller called, and the view rendered, and more if you need it.

## Components

The framework is builded on 3 basics components :

* *DataContainerInterface*, a dictionnary where all the datas will be encapsulated (session, config, request, vars)
* *ApplicationLayerInterface*, the interface to encapsulate all the application layers (SessionBuilder, SessionChecker, XmlConfigReader, PhpConfigBuilder, ControllerDispatcher, TextViewDispatcher, PdfViewDispatcher, ...). All of them will manipulate the datas of your application abstracted by the dataContainers.
* ApplicationLayerException, thrown by the concrete layers. This will break the normal flow of the chain, and execute the next layers in "error" mode, if they are created for. (comming soon) 

## Installation

You need PhpUnit to run the unit tests (located in library-tests/). Get it from [the official PhpUnit site](https://github.com/sebastianbergmann/phpunit).

## Test

For now, you can only point your browser to <YOUR HOST>/sample/?ctrl=test&act=show
Any other URL will show you errors or exceptions.

## TODO

* Normal/Error flow handling : if an ApplicationLayerException is thrown, the chain has to switch in "error mode". Some layers can run in normal mode only, some in error mode only, and some in the two modes.
* ApplicationLayers to do :
    * XmlConfigBuilder : build the "config" dataContainer from a xml (or ini or whatever)
    * CliRequestBuilder : populate the "request" dataContainer from the argc/argv parameters.
    * TwigViewDispatcher : use Twig for output
* Naming conventions, package... clean directory structure. 
* SimpleViewDispatcher : solution for "layout". Add some functions to help text and HTML output...