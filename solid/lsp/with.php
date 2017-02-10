<?php

interface Arquivo {

    public function gerar();
}

class ArquivoPDF implements Arquivo{

    public function gerar(){
        echo 'gerando pdf...',"\n";
    }
}

class ArquivoDOCX implements Arquivo{
    public function gerar(){
        echo 'gerando docx...',"\n";
    }
}

class ArquivoTXT implements Arquivo{
    public function gerar(){
        echo 'gerando txt...',"\n";
    }
}


class GeradorDeArquivos{
    public function gerarArquivo(Arquivo $arquivo){
        $arquivo->gerar();
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


