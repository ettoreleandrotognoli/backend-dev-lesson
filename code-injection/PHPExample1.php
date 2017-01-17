<?php


class ProxyLogger {

    private $obj;

    public function __construct($obj){
        $this->obj = $obj;
    }

    public function __call($method,$args){
        echo sprintf('%s::%s(%s)',get_class($this->obj),$method,implode(';',$args)),"\n";
        $result = call_user_func_array(array($this->obj,$method),$args);
        echo sprintf('%s::%s(%s)',get_class($this->obj),$method,implode(';',$args)),' -> ',$result,"\n";
        return $result;
    }
}

class Calc {

    public function sum($a,$b){
        return $a + $b;
    }

    public function sub($a,$b){
        return $a - $b;
    }

    public function mul($a,$b){
        return $a * $b;
    }

    public function div($a,$b){
        return $a / $b;
    }

}

$c = new ProxyLogger(new Calc());
$c->sum(334,332);
$c->sub(999,333);
$c->mul(7,7);
$c->div(121,11);