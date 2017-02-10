<?php

interface Arquivo {

}

class ArquivoPDF implements Arquivo{

    public function gerarPDF(){
        echo 'gerando pdf...',"\n";
    }
}

class ArquivoDOCX implements Arquivo{
    public function gerarDOCX(){
        echo 'gerando docx...',"\n";
    }
}

class ArquivoTXT implements Arquivo{
    public function gerarTXT(){
        echo 'gerando txt...',"\n";
    }
}


class GeradorDeArquivos{
    public function gerarArquivo(Arquivo $arquivo){
        if($arquivo instanceof ArquivoPDF){
            $arquivo->gerarPDF();
        }
        else if($arquivo instanceof ArquivoDOCX){
            $arquivo->gerarDOCX();
        }
        else{
            throw new Exception(sprintf('%s não tem suporte',get_class($arquivo)));
        }
    }
}

$gerador = new GeradorDeArquivos();

try{
    $gerador->gerarArquivo(new ArquivoPDF());
    $gerador->gerarArquivo(new ArquivoDOCX());
    $gerador->gerarArquivo(new ArquivoTXT());
}
catch(Exception $ex){
    echo $ex->getMessage(),"\n";
}

// -------------------------------------------------------------------------

class Retangulo {
 
    private $largura;
    private $altura;
 
    public function setAltura($altura) {
        $this->altura = $altura;
    }
 
    public function getAltura() {
        return $this->altura;
    }
 
    public function setLargura($largura) {
        $this->largura = $largura;
    }
 
    public function getLargura() {
        return $this->largura;
    }

    function area() {
        return $this->largura * $this->altura;
    }
 
}

class Quadrado extends Retangulo {
 
    public function setAltura($valor) {
        $this->largura = $valor;
        $this->altura = $valor;
    }
 
    public function setLargura($valor) {
        $this->largura = $valor;
        $this->altura = $valor;
    }
}


class Cliente {
 
    public function verificarArea(Retangulo $r) {
        $r->setLargura(5);
        $r->setAltura(4);
 
        if($r->area() != 20) {
            throw new Exception('Área errada!');
        }
        return true;
    }
 
}

$c = new Cliente();
try{
    $c->verificarArea(new Quadrado());    
}
catch(Exception $ex){
    echo $ex->getMessage(),"\n";
}
