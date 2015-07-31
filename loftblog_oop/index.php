<?php

class Person {
    public $name = "John";
    public $age = 25;
    public $job = "web-developer";

    public function greeting(){
        return "Hello ".$this->name;
    }
}

$john = new Person();

echo $john->greeting();