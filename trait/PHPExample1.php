<?php

interface PropertyChangeListener {

    public function propertyChanged($source,$property,$old,$new);

}
    
interface ObservableProperties {

    public function addPropertyChangeListener(PropertyChangeListener $listener);

    public function removePropertyChangeListener(PropertyChangeListener $listener);

}

trait PropertyChangeSupport {

    protected $listeners = array();

    public function addPropertyChangeListener(PropertyChangeListener $listener){
        $this->listeners[] = $listener;
    }

    public function removePropertyChangeListener(PropertyChangeListener $listener){
        $index = array_search($listener,$this->listeners);
        if($index){
            unset($this->listeners[$index]);
        }
    }

    protected function firePropertyChanged($property,$old,$new){
        foreach ($this->listeners as $listener) {
            $listener->propertyChanged($this,$property,$old,$new);
        }
    }
}

trait Properties {

    public function __set($key,$value){
        $old = $this->{$key};
        $this->{$key} = $value;
        $this->firePropertyChanged($key,$old,$value);
    }

    public function __get($key){
        return $this->{$key};
    }

}


abstract class Model {
    /**
    * Classe de algum framework que não pode ser alterada
    */
}


class MyModel extends Model implements ObservableProperties{

    use PropertyChangeSupport;
    use Properties;

    protected $id;
    protected $name;
    protected $value;

}

class DebugPropertyChangeListener implements PropertyChangeListener{
    public function propertyChanged($source,$property,$old,$new){
        echo get_class($source),'::',$property,' = ',$new,' (',$old,')',"\n";
    }
}

$model = new MyModel();
$model->addPropertyChangeListener(new DebugPropertyChangeListener());
$model->id = 1;
$model->name = 'teste';
$model->value = 10;
$model->id = 2;
$model->name = 'teste 2';
$model->value = 11;
