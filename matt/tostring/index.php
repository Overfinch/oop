<?php

class Person {
    function getName(){
        return "John";
    }

    function getAge(){
        return 33;
    }

    function __toString(){ // вызывается когда объект пытаются вывести как строку (print, echo)
        $desc = $this->getName()." Возраст: ".$this->getAge();
        return $desc;
    }
}

$person = new Person();
print $person;