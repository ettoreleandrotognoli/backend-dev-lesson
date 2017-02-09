<?php

namespace Univem\Test;


use Univem\Calculadora;
use \PHPUnit_Framework_TestCase;

class CalculadoraTest  extends PHPUnit_Framework_TestCase {

    public function testSoma(){
        $calculadora = new Calculadora();
        $expected = 4;
        $result = $calculadora->soma(2,2);
        $this->assertEquals($result,$expected);
    }

}