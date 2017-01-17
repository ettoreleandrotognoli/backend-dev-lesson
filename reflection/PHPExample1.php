<?php
/**
* Invocando metodos e instanciando objetos com reflection
*/

class Controller {
    
    public function get($request,$param){
        var_dump($request);
        return sprintf('Hello %s!!!',$param);
    }

}

$controllerClassName = 'Controller';
$controllerClass = new ReflectionClass($controllerClassName);

//ReflectionClass::newInstance ( mixed $args [, mixed $... ] )
//ReflectionClass::newInstanceArgs ([ array $args ] )
//ReflectionClass::newInstanceWithoutConstructor
$controllerInstance = $controllerClass->newInstance();
$controllerInstance = new $controllerClassName();


$methodName = 'get';
echo $controllerInstance->$methodName(new stdClass(),'World');
echo call_user_func(array($controllerInstance,$methodName),new stdClass(),'World');
echo call_user_func_array(array($controllerInstance,$methodName),array(new stdClass(),'World'));

$method = $controllerClass->getMethod($methodName);
echo $method->invoke($controllerInstance,new stdClass(),'World');
echo $method->invokeArgs($controllerInstance,array(new stdClass(),'World'));
