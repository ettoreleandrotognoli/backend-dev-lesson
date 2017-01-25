<?php

use PosUnivem\SomeClass;

function __autoload($className){
    echo '__autoload -> ',$className,"\n";
    $pieces = explode('\\',$className);
    $name = $pieces[count($pieces)-1];
    unset($pieces[count($pieces)-1]);
    if(empty($pieces)){
        $code = sprintf('class %s {}',$name);
    }
    else{
        $code = sprintf(' namespace %s{class %s {}}',implode('\\',$pieces),$name);
    }
    eval($code);
}

$a = new ClassA();
var_dump($a);
$b = new SomeClass();
var_dump($b);