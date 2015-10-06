<?php

class Person {
    public $name;

    function __construct($name){
        $this->name = $name;
    }
}

interface Module {
    function execute();
}

class FtpModule implements Module {
    function setHost($host){
        print "FtpModule::sethost() : $host <br>";
    }

    function setUser($user){
        print "FtpModule::setUser() : $user <br>";
    }

    function execute(){
        // выполнение работы
    }
}

class PersonModule implements Module {
    function setPerson(Person $person){
        print "PersonModule::setPerson() : $person->name <br>";
    }

    function execute(){
        // выполнение работы
    }
}

class ModuleRunner {
    private $configData = [ // содержит массив данных для двух классов типа Module
        "FtpModule"    => ["host" => "exemple.com", "user" => "anon"],
        "PersonModule" => ["person" => "bob"]
    ];

    private $modules = []; // массив в который потом будут пушиться "модули" - потом через этот массив можно будет перебирать "модули" и вызывать для них execute()

    function init(){
        $interface = new ReflectionClass("Module"); // создаём объект класса ReflectionClass для класса Module
        foreach($this->configData as $modulename => $params){ // перебираем массив с данными модулей
            $module_class = new ReflectionClass($modulename); // создаем объекты класса ReflectionClass для каждого из "модулей"
            if(!$module_class->isSubclassOf($interface)){ // проверяет является ли "модуль" подклассом заданного интерфейса
                throw new Exception("Неизвестный тип модуля: $modulename");
            }
            $module = $module_class->newInstance(); // создаёт новый объект каждого "модуля" (в данном случае new FtpModule и new PersonModule)
            foreach($module_class->getMethods() as $method){ // перебираем все методы "модуля"
                $this->handleMethod($module, $method, $params); // метод будет описан позже
            }
            array_push($this->modules, $module); // пушим в массив с "модулям" наши "модули"
        }
    }

    function handleMethod(Module $module, ReflectionMethod $method, $params){
        $name = $method->getName(); // имя метода
        $args = $method->getParameters(); // имя аргумента метода

        //проверка являеется ли метод "установщиком" (set)
        if(count($args) !=1 || substr($name, 0, 3) != "set"){
            return false;
        }

        $property = strtolower(substr($name, 3)); // получаем имя свойства
        if(!isset($params[$property])){ // проверяем есть ли такое свойство в асоциативном массиве с параметрами
            return false;
        }

        $arg_class = $args[0]->getClass(); // узнаём тип аргумента метода установщика

        if(empty($arg_class)){ // если у аргумента нету типа, значит это не объект
            $method->invoke($module, $params[$property]); // если не объект, то передаём нашему "модулю" обычный параметр
        }else{
            $method->invoke($module, $arg_class->newInstance($params[$property]));// если это объект, то передаём тип (класс) аргумента, и его значение, создаём объект и передаем его нашему "модулю"
        }

    }
}

$o = new ModuleRunner();
$o->init();