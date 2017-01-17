<?php

class POPO{

    private $name;

    public function __construct($name=null){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function __toString(){
        return $this->name;
    }

}

$obj = new POPO('teste');
echo $obj,"\n";
$obj->setName('outro '.$obj->getName());
$obj->setName('outro '.$obj->{'getName'}());
echo $obj,"\n";