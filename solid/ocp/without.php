<?php

date_default_timezone_set('America/Sao_Paulo');
    
class Account {

    protected $owner;
    protected $value;
    protected $audit;

    public function __construct($owner,$value=0,$audit=array()){
        $this->owner = $owner;
        $this->value = $value;
        $this->audit = $audit;
    }

    public function getOwner(){
        return $this->owner;
    }

    public function getValue(){
        return $this->value;
    }

    public function getAudit(){
        return array_values($this->audit);
    }

    public function setValue($newValue,$description='set value'){
        $diff = $this->getValue() - $newValue;
        $this->alterValue($diff,$description);
    }

    public function alterValue($diff,$description='alter value'){
        $oldValue = $this->value;
        $this->value += $diff;
        $log = sprintf('%s: (%s) %.2f, %.2f -> %.2f # %s',
            (new \DateTime())->format(\DateTime::ISO8601),
            $diff >=0 ? '+' : '-',
            abs($diff),
            $oldValue,
            $this->value,
            $description
        );
        $this->audit[] = $log;
    }

    public function pay($value,$title){
        $this->alterValue(-$value,'Payment of '.$title);
    }

    public function receive($value,$title){
        $this->alterValue($value,'Receive of '.$title);
    }

    public function transfer($value,Account $account){
        $this->alterValue(-$value,'Transfer to '.$account->getOwner());
        $account->alterValue($value,'Transfer of '.$this->getOwner());
    }

    public function block(){
        #...
    }

    public function freeze(){
        #...
    }

    public function tax($constValue,$percentValue){
        #...
    }

    #...

}


$accountA = new Account('Fulano',1000);
$accountB = new Account('Ciclano',300);

$accountA->pay(120,'Cable TV');
$accountA->pay(40,'Phone');
$accountA->receive(300,'Bonus');

$accountB->receive(900,'Salary');
$accountB->transfer(400,$accountA);

var_dump($accountA->getAudit());
var_dump($accountB->getAudit());
