Php Layered Application Framework
=================================

Php Layered Application Framework is a very simple PHP framework.
It's based on a main "chain of responsability" composed by all the "application layers".
At the end of the chain, thanks to each layers, the http request will be parsed, the session checked, the controller called, and the view rendered, and more if you need it.

Components
----------

The framework is builded on 3 basics components :
* DataContainerInterface, a dictionnary were all the datas will be encapsulated (session, config, request, vars)
* ApplicationLayerInterface, the interface to encapsulate all the application layers (SessionBuilder, SessionChecker, XmlConfigReader, PhpConfigBuilder, ControllerDispatcher, TextViewDispatcher, PdfViewDispatcher, ...). All of them will manipulate the data abstracted by the dataContainers.
* ApplicationLayerException, thrown by the concrete layers. This will break the normal flow of the chain, and execute the next layers in "error" mode. 