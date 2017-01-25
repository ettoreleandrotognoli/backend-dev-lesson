<?php

namespace DI {


    class Container {

        protected $producers = array();

        public function registerProducer($producer, $type = object::class) {
            $class = new \ReflectionClass($type);
            $this->producers[$type] = $producer;
            for ($parent = $class->getParentClass(); $parent != null; $parent = $parent->getParentClass()) {
                $this->producers[$parent->getName()] = $producer;
            }
            foreach ($class->getInterfaces() as $interface) {
                $this->producers[$interface->getName()] = $producer;
            }
        }

        public function registerInstance($instance) {
            $producer = function() use ($instance) {
                return $instance;
            };
            $this->registerProducer($producer, get_class($instance));
        }

        protected function prepareParameters($method) {
            $parametersValues = array();
            foreach ($method->getParameters() as $parameter) {
                $parametersValues[] = $this->produce($parameter->getClass());
            }
            return $parametersValues;
        }

        public function produce($class) {
            $className = ($class instanceof \ReflectionClass) ? $class->getName() : $class;
            if (array_key_exists($className, $this->producers)) {
                $producer = $this->producers[$className];
                return $this->call($producer);
            }
            $class = new \ReflectionClass($className);
            $instance = $class->newInstanceWithoutConstructor();
            $constructor = $class->getConstructor();
            if ($constructor === null) {
                return $instance;
            }
            $parametersValues = $this->prepareParameters($constructor);
            $constructor->invokeArgs($instance, $parametersValues);
            return $instance;
        }

        public function callFunction($function) {
            $function = ($function instanceof \ReflectionFunction) ? $function : new \ReflectionFunction($function);
            $parametersValues = $this->prepareParameters($function);
            return $function->invokeArgs($parametersValues);
        }

        public function callMethod($obj, $method) {
            if (!$method instanceof \ReflectionMethod) {
                $class = new \ReflectionClass($obj);
                $method = $class->getMethod($method);
            }
            $parametersValues = $this->prepareParameters($method);
            return $method->invokeArgs($obj, $parametersValues);
        }

        public function call($function) {
            if (!is_callable($function)) {
                throw new Exception();
            }
            if (is_array($function)) {
                return $this->callMethod($function[0], $function[1]);
            }
            else {
                return $this->callFunction($function);
            }
        }

    }

}

namespace Logging {

    interface Logging {
        
    }

    interface Logger extends Logging {

        function log($message, ...$values);
    }

    class DefaultLogger implements Logger {

        public function log($message, ...$values) {
            echo call_user_func_array('sprintf', array_merge(array($message), $values)), "\n";
        }

    }

}

namespace {

    use DI\Container;
    use Logging\Logger;
    use Logging\DefaultLogger;

    $container = new Container();

    $container->registerInstance(new DefaultLogger());

    class ClassA {

        protected $logger;

        public function __construct(Logger $logger) {
            $this->logger = $logger;
        }

        public function log() {
            $this->logger->log('My class is %s', get_class($this));
        }

    }

    class ClassB {

        public function log(Logger $logger) {
            $logger->log('My class is %s', get_class($this));
        }

    }

    class ClassC {

        protected $a;

        public function __construct(ClassA $a) {
            $this->a = $a;
        }

        public function log() {
            $this->a->log();
        }

    }

    $a = $container->produce(ClassA::class);
    $a->log();

    $container->call(function (Logger $logger) {
        $logger->log('Log something');
    });

    $b = $container->produce(ClassB::class);
    $container->call(array($b, 'log'));

    $c = $container->produce(ClassC::class);
    $c->log();
}