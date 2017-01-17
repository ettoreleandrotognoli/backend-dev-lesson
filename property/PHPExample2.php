<?php

class POPO{

    private $name;

    public function __construct($name=null){
        $this->name = $name;
    }

    public function __get($fieldName){
        if($fieldName != 'name'){
            throw new Exception();
        }
        return $this->getName();
    }

    public function __set($fieldName,$fieldValue){
        if($fieldName != 'name'){
            throw new Exception();
        }
        $this->setName($fieldValue);
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