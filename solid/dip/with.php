<?php

interface Dispositivo {
    public function ligar();
    public function desligar();
}

class Lampada implements Dispositivo{

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

class LampadaMock implements Dispositivo{
    protected $id;
    protected $estado;

    public function __construct($id){
        $this->id = $id;
    }

    public function ligar(){
        echo sprintf('Ligando lampada %d',$this->id),"\n";
        $this->estado = true;
    }

    public function desligar(){
        echo sprintf('Desligando lampada %d',$this->id),"\n";
        $this->estado = false;
    }

    public function estado(){
        return $this->estado;
    }

}

class Dispositivos implements Dispositivo {

    protected $dispositivos;

    public function __construct(Array $dispositivos){
        $this->dispositivos = $dispositivos;
    }

    public function ligar(){
        foreach ($this->dispositivos as $dispositivo) {
            $dispositivo->ligar();
        }
    }

    public function desligar(){
        foreach ($this->dispositivos as $dispositivo) {
            $dispositivo->desligar();
        }
    }

}

class Interruptor {

    protected $dispositivo;

    public function __construct(Dispositivo $dispositivo){
        $this->dispositivo = $dispositivo;
    }

    public function ativar(){
        $this->dispositivo->ligar();
    }

    public function desativar(){
        $this->dispositivo->desligar();
    }

}



$interruptor = new Interruptor(new Dispositivos(array(new Lampada(1),new Lampada(2))));
$interruptor->ativar();
$interruptor->desativar();

$interruptor = new Interruptor(new LampadaMock(1));
$interruptor->ativar();
$interruptor->desativar();

