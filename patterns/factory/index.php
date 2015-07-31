<?php

interface Conveyor {
    public function buildEngine();
    public function attachWheels();
    public function testing();
}

class Lanos implements Conveyor {
    public function buildEngine(){
        echo "<p>Lanos engine built</p>";
    }
    public function attachWheels(){
        echo "<p>Lanos wheels attached</p>";
    }
    public function testing(){
        echo "<p>Lanos tested</p>";
    }
}

class Aveo implements Conveyor {
    public function buildEngine(){
        echo "<p>Aveo engine built</p>";
    }
    public function attachWheels(){
        echo "<p>Aveo wheels attached</p>";
    }
    public function testing(){
        echo "<p>Aveo tested</p>";
    }
}

class CarFactory {
    public static function factory($car){
        $className = $car;
        $object = new $className;
        return $object;
    }
}

$autoList = ['lanos','lanos','aveo'];
foreach($autoList as $auto){
    $obj = CarFactory::factory($auto);
    $obj->buildEngine();
    $obj->attachWheels();
    $obj->testing();
}