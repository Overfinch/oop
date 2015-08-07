<?php

class Person {
    public $id;
    public $name;
    public $age;
    public $account;

    function __construct($name, $age, Account $account){ // получаем так же объект класса Account
        $this->name = $name;
        $this->age  = $age;
        $this->account = $account;
    }

    function setId($id){
        $this->id = $id;
    }

    function __clone(){ // вызывается при клонировании объекта, и применяется к новому объекту
        $this->id = 0;
        $this->account = clone $this->account;
    }
}

class Account {
    public $balance;

    function __construct($balance){
        $this->balance = $balance;
    }
}

$person = new Person("John",33, new Account(200)); // создаём новый объект
$person->setId(12); // назначаем id
$person2 = clone $person; // клонируем объект
$person->account->balance += 10; // добавляем 10 к балансу объекта $person, и благодаря методу __clone(), оно не добавится к балансу обьекта $person2 так как теперь и сам баланс клонирован (создан новый для объекта $person2)
var_dump($person); // первый объект (с заданным id)
var_dump($person2); // второй объект (с id равным 0, и с не изменённым значением balance благодаря методу __clone())