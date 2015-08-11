<?php

namespace my; // обьявлен нэймспейс my
require_once("useful/outputter3.php"); // подключаем файл с нэймспейсом useful
use useful\Outputter as usefulOutputter; // используем класс Outputter из нэймспейса useful как usefulOutputter

class Outputter {
    static public function hello(){
        return "hello my world";
    }
}

echo Outputter::hello(); // вызываем из локального класса
echo "<br>";
echo \useful\Outputter::hello(); // вызываем из класса в нэймспейсе usrful
echo "<br>";
echo usefulOutputter::hello(); // вызываем из класса в нэймспейсе usrful, но имя класса получило псевдоним usefulOutputter, на строке 5
