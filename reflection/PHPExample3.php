<?php

/**
* Acessando atributos/propriedades
*/

class Controller {

    private $requiredThing;
    private $otherThing;

    public function __construct($requiredThing,$otherThing=null){
        if(is_null($requiredThing)){
            throw new Exception('The param $requiredThing is required');
        }
        $this->requiredThing = $requiredThing;
        $this->otherThing = null;
        echo '$requiredThing is a ', get_class($requiredThing),"\n";
    }
    
    public function get($request,$param){
        var_dump($request);
        return sprintf('Hello %s!!!',$param);
    }

    public function getOtherThing(){
        return $this->otherThing;
    }

    public function setOtherThing($otherThing){
        $this->otherThing = $otherThing;
    }

}

$controllerClassName = 'Controller';
$controllerClass = new ReflectionClass($controllerClassName);

$someThing = new stdClass();
$controllerInstance = $controllerClass->newInstance($someThing);

$getMethodName = 'getOtherThing';
$getMethod = $controllerClass->getMethod($getMethodName);

$setMethodName = 'setOtherThing';
$setMethod = $controllerClass->getMethod($setMethodName);

var_dump($getMethod->invoke($controllerInstance));
$setMethod->invoke($controllerInstance,666);
var_dump($getMethod->invoke($controllerInstance));

$fieldName = $controllerClass->getProperty('otherThing');
try{
    $fieldName->setValue($controllerInstance,777);
}
catch(Exception $ex){
    echo $ex->getMessage(),"\n",$ex->getTraceAsString(),"\n";
}
$fieldName->setAccessible(true);
echo $fieldName->getValue($controllerInstance),"\n";
$fieldName->setValue($controllerInstance,888);
echo $fieldName->getValue($controllerInstance),"\n";
var_dump($getMethod->invoke($controllerInstance));

