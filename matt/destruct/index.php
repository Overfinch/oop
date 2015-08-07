<?php

class Person {
    public $id;
    public $name;
    public $age;

    function __construct($name, $age){
        $this->name = $name;
        $this->age  = $age;
    }

    function setId($id){
        $this->id = $id;
    }

    function __destruct(){ // вызывается при удалении обьекта
        if(!empty($this->id)){ // если у обьекта есть id, то сохраняет его в БД
            print "Сохранение обьекта Person";
        }
    }
}

$person = new Person("John",33); // создаём обьект
$person->setId(12); // назначаем id
unset($person); // удаляем из памяти (в этот момент вызывается деструктор)