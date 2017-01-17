<?php

trait PropertySupport {

    protected static $getters = null;
    protected static $setters = null;

    private function init(){
        if(!is_null(static::$getters) && !is_null(static::$setters)){
            return;
        }
        $reflectionClass = new ReflectionClass(get_class($this));
        $methods = $reflectionClass->getMethods();
        static::$getters = array();
        static::$setters = array();
        foreach ($methods as $method) {
            $methodName = $method->getName();
            if(strpos($methodName,'set') === 0){
                list($_,$fieldName) = split('set',$methodName,2);
                static::$setters[lcfirst($fieldName)] = $method;
            }
            if(strpos($methodName,'get') === 0){
                list($_,$fieldName) = split('get',$methodName,2);
                static::$getters[lcfirst($fieldName)] = $method;
            }
            if(strpos($methodName,'is') === 0){
                list($_,$fieldName) = split('is',$methodName,2);
                static::$getters[lcfirst($fieldName)] = $method;
            }
        }
    }

    public function __construct(){
        $this->init();
    }

    public function __get($fieldName){
        return static::$getters[$fieldName]->invoke($this);
    }

    public function __set($fieldName,$fieldValue){
        static::$setters[$fieldName]->invoke($this,$fieldValue);
    }

}

class POPO{

    use PropertySupport;

    private $name;

    public function __construct($name=null){
        $this->init();
        $this->name = $name;
    }

    public function getName(){
        echo get_class($this), sprintf('::getName() -> "%s"',$this->name),"\n";
        return $this->name;
    }

    public function setName($name){
        echo get_class($this), sprintf('::setName("%s")',$name),"\n";
        $this->name = $name;
    }

    public function __toString(){
        return $this->name;
    }

}

$obj = new POPO('teste');
echo $obj,"\n";
$obj->name = 'outro '. $obj->name;
$obj->name = 'outro '. $obj->{'name'};
echo $obj,"\n";