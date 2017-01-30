<?php

class Lampada {

    protected static $url = 'https://lampadas.com/%d/';

    protected $id;

    public function __construct($id){
        $this->id = $id;
    }

    public function ligar(){
        echo 'PUT ',sprintf(static::$url,$this->id),"\n";
        echo 'estado=1',"\n";
    }

    public function desligar(){
        echo 'PUT ',sprintf(static::$url,$this->id),"\n";
        echo 'estado=0',"\n";
    }

    public function estado(){
        echo 'GET ',sprintf(static::$url,$this->id),"\n";
        return false;
    }

}

class Interruptor {

    protected $lampada;

    public function __construct(){
        $this->lampada = new Lampada(1);
    }

    public function ativar(){
        $this->lampada->ligar();
    }

    public function desativar(){
        $this->lampada->desligar();
    }

}



$interruptor = new Interruptor();
$interruptor->ativar();
$interruptor->desativar();