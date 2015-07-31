<?php

// позднее связывание
// интерпретатор ищет вызываемые методы, сначала из класса где они вызываются,
// а потом поднимается вверх до основного родительского класса, пока не найдёт метод

abstract class DomainObject{
    private $group;

    public function __construct(){
        $this->group = static::getGroup();  // обращается к статичному методу дочернего класса
    }

    public static function create(){
        return new static(); // создаёт обьект доченего класса
    }

    static function getGroup(){
        return "default";
    }
}

class User extends DomainObject{

}

class Document extends DomainObject{
    static function getGroup(){
        return "document";
    }
}

class SpreadSheet extends Document{

}

var_dump(User::create());
var_dump(Document::create());
var_dump(SpreadSheet::create());