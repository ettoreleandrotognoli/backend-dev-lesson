<?php

/**
* Utilizando o construtor
*/

class Controller {

    private $requiredThing;

    public function __construct($requiredThing){
        if(is_null($requiredThing)){
            throw new Exception('The param $requiredThing is required');
        }
        $this->requiredThing = $requiredThing;
        echo '$requiredThing is a ', get_class($requiredThing),"\n";
    }
    
    public function get($request,$param){
        var_dump($request);
        return sprintf('Hello %s!!!',$param);
    }

}

$controllerClassName = 'Controller';
$controllerClass = new ReflectionClass($controllerClassName);

$someThing = new stdClass();
$controllerInstance = $controllerClass->newInstance($someThing);
$controllerInstance = new $controllerClassName($someThing);

$constructor = $controllerClass->getConstructor();
$constrollerInstance = $controllerClass->newInstanceWithoutConstructor();
$constructor->invoke($constrollerInstance,$someThing);


$methodName = 'get';
echo $controllerInstance->$methodName(new stdClass(),'World');
echo call_user_func(array($controllerInstance,$methodName),new stdClass(),'World');
echo call_user_func_array(array($controllerInstance,$methodName),array(new stdClass(),'World'));

$method = $controllerClass->getMethod($methodName);
echo $method->invoke($controllerInstance,new stdClass(),'World');
echo $method->invokeArgs($controllerInstance,array(new stdClass(),'World'));
