<?php

// Абстрактные и финальные классы, интерфейсы

abstract class Car{

    public $tire;

    public function startEngine(){
        echo "Двигатель завёлся";
    }

    abstract function stopEngine();
}

class MegaCar extends Car{
    public function stopEngine(){
        echo "Машина остановилась";
    }
}

$car = new MegaCar;
$car->startEngine();
$car->stopEngine();

