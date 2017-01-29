<?php

class CodeFunction {

    protected $code;

    public function __construct($code){
        $this->code = 'return '.$code.';';
    }

    public function __invoke(...$args){
        $code = call_user_func_array('sprintf',array_merge(array($this->code),$args));
        return eval($code);
    }

    public function __toString(){
        return sprintf('function(){%s}',$this->code);
    }

    public function __sleep(){
        echo '__sleep',"\n";
        return array('code');
    }

    public function __wakeup(){
        echo '__wakeup',"\n";
    }

    public function __debugInfo(){
        echo '__debugInfo',"\n";
        return (array)$this;
    }

}


$func = new CodeFunction('%f ** 2');
var_dump($func(5.0));
echo $func,"\n";

$serialized = serialize($func);
var_dump($serialized);
$func = unserialize($serialized);
var_dump($func);