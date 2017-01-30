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

}

interface AccountAction {

    public function execute(Account $account);

}

class Payment implements AccountAction{

    protected $value;
    protected $title;

    public function __construct($value,$title){
        $this->value = $value;
        $this->title = $title;
    }

    public function execute(Account $account){
        $account->alterValue(-$this->value,'Payment of '.$this->title);
    }
}

class Receivement implements AccountAction{

    protected $value;
    protected $title;

    public function __construct($value,$title){
        $this->value = $value;
        $this->title = $title;
    }

    public function execute(Account $account){
        $account->alterValue($this->value,'Receive of '.$this->title);
    }

}

class Transfer implements AccountAction{

    protected $value;
    protected $toAccount;

    public function __construct($value,$toAccount){
        $this->value = $value;
        $this->toAccount = $toAccount;
    }

    public function execute(Account $account){
        $account->alterValue(-$this->value,'Transfer to '.$this->toAccount->getOwner());
        $this->toAccount->alterValue($this->value,'Transfer of '.$account->getOwner());
    }
}

/*
class Block implements AccountAction{
    ...
}

class Freeze implements AccountAction{
    ...
}

class Tax implements AccountAction{
    ...
}
*/

$accountA = new Account('Fulano',1000);
$accountB = new Account('Ciclano',300);

(new Payment(120,'Cable TV'))->execute($accountA);
(new Payment(40,'Phone'))->execute($accountA);
(new Receivement(300,'Bonus'))->execute($accountA);

(new Receivement(900,'Salary'))->execute($accountB);
(new Transfer(400,$accountA))->execute($accountB);

var_dump($accountA->getAudit());
var_dump($accountB->getAudit());
