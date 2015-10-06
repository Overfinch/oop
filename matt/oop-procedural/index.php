<?php

// ООП подход и процедурный подход

//----------------------ООП---------------------------------


abstract class ParamHandler { // абстрактный класс
    protected $source; // источник
    protected $params = []; // массив с параметрами

    function __construct($source){ // конструктор, принимает источник
        $this->source = $source; // и записывает в свойство
    }

    function addParam($key, $val){ // принимаем параметры
        $this->params[$key] = $val; // и записываем в массив
    }

    function getAllParams(){ // выводим все параметры
        return $this->params;
    }

    static function getInstance($filename){ // статическая функция, которая возвращает объект, в зависимости от файла
        if(preg_match("/xml/", $filename)){
            return new XMLParamHandler($filename);
        }else{
            return new TextParamHandler($filename);
        }
    }

    abstract function write();
    abstract function read();
}

class XMLParamHandler extends ParamHandler {
    function write(){
        echo "Запись XML";
    }

    function read(){
        echo "Чтение XML";
    }
}

class TextParamHandler extends ParamHandler {
    function write(){
        echo "Запись текста";
    }

    function read(){
        echo "Чтение текста";
    }
}

$filename = "text.xml"; // файл
$test = ParamHandler::getInstance($filename); // получаем объект в зависимости от имени файла
$test->addParam("Key1", "Val1"); // добавляем параметры
$test->addParam("Key2", "Val2");
$test->write(); // записываем
$test->read();// читаем
var_dump($test);






//-----------------------процедурный подход-------------------------------------------------





function readParams($source){
    $params = [];

    if(preg_match("/xml/", $source)){
        echo "читаем XML";
    }else{
        echo "читаем текст";
    }

    return $params;
}

function writeParams($params, $source){
    if(preg_match("/xml/", $source)){
        echo "записываем XML";
    }else{
        echo "записываем текст";
    }
}

$file = "some.txt";
$array['key1'] = "val1";
$array['key2'] = "val2";
$array['key3'] = "val3";
writeParams($array, $file);
readParams($file);