<?php


class Proxy {

    protected $instance;

    public function __construct($instance){
        $this->instance = $instance;
    }


    public function __call($method,$args){
        return call_user_func_array(array($this->instance,$method),$args);
    }

    public function __get($var){
        return $this->instance->$var;
    }

    public function __set($var,$value){
        $this->instance->$var = $value;
    }

}

