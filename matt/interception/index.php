<?php

class Person {
    private $_name;
    private $_age;
    private $writer;

    function __construct(PersonWriter $writer){ // при создании обьекта, так же создаёт обьект класса PersonWriter
        $this->writer = $writer; // и записывает этот обьект в свойство $this->writer
    }

    function __call($methodname, $args){ // вызывается при вызове несуществующих методов
        if(method_exists($this->writer, $methodname)){ // проверяет существование этого метода в обьекте класса PersonWriter
            return $this->writer->$methodname($this); // возвращает метод из из класса PersonWriter, с переданым ему обьектом класса Person
        }
    }

    function __get($property){ // вызывается когда обращаются к несуществующему свойству, принимает имя свойства
        $method = "get{$property}"; // генерируем имя метода
        if(method_exists($this, $method)){ // проверка существует ли метод
            return $this->$method(); // возвращаем метод
        }
    }

    function __set($property, $value){
        $method = "set{$property}";
        if(method_exists($this,$method)){
            return $this->$method($value);
        }
    }

    function __unset($property){
        $method = "set{$property}";
        if(method_exists($this,$method)){
            return $this->$method(null);
        }
    }

    function __isset($property){ // вызывается когда свойство проверяется на isset()
        $method = "get{$property}"; // генерируем имя метода
        return (method_exists($this,$method)); // если есть такой метод, возвращает TRUE
    }

    function getName(){
        return "Иван";
    }


    function getAge(){
        return 44;
    }

    function setName($name){
        $this->_name = $name;
        if(!is_null($name)){
            $this->_name = strtoupper($this->_name);
        }
    }

    function setAge($age){
        $this->_age = strtoupper($age);
    }
}

class PersonWriter{
    function writeName(Person $p){ // получает обьект класса Person
        print $p->getName(); // выводит функцию обьекта класса Person
    }

    function writeAge(Person $p){
        print $p->getAge();
    }
}

$p = new Person(new PersonWriter());

$p->writeName(); // вызываем несуществующий метод

if(isset($p->name)){
    print $p->name; // вызываем несуществующее свойство
}
