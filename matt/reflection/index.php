<?php
// Reflection API
require_once('../index.php');

echo "<hr>";
echo "<pre>";

$prod_class = new ReflectionClass("CDProduct"); // создаём объект класса ReflectionClass и передаём ему имя нужного класса
Reflection::export($prod_class); // после создания объекта класса ReflectionClass, можно использовать вспомогательный класс Reflection

echo "<hr>";

function classData(ReflectionClass $class){ // получаем объект типа ReflectionClass
    $details = "";
    $name = $class->getName();

    if($class->isUserDefined()){
        $details .= "$name -- класс определён пользователем<br>";
    }

    if($class->isInterface()){
        $details .= "$name -- это интерфейс";
    }

    if($class->isAbstract()){
        $details .= "$name -- это абстрактный класс";
    }

    if($class->isFinal()){
        $details .= "$name -- это финальный класс";
    }

    if($class->isInstantiable()){
        $details .= "$name -- можно создать экземпляр класса";
    }else{
        $details .= "$name -- нельзя создать экземпляр класса";
    }

    return $details;

}

echo classData($prod_class); // выводим информацию

echo "<hr>";

//---------------------------------------------------------------------------------
// выводим код класса

class ReflectionUtil {
    static function getClassSource(ReflectionClass $class) { // принимаем объект класса ReflectionClass
        $path  = $class->getFileName(); // получаем путь к файлу
        $lines = @file($path); // получаем массив с кодом
        $from  = $class->getStartLine(); // получаем строку где начинается нужный код
        $to    = $class->getEndLine(); //получаем строку где заканчивается нужный код
        $len   = $to-$from+1; // получаем длинну
        return implode(array_slice($lines, $from-1, $len)); // обрезаем массив, и переводим в строку
    }

    static function getMethodSource(ReflectionMethod $method) { // принимаем объект класса ReflectionMethod
        $path  = $method->getFileName(); // получаем путь к файлу
        $lines = @file($path); // получаем массив с кодом
        $from  = $method->getStartLine(); // получаем строку где начинается нужный код
        $to    = $method->getEndLine(); //получаем строку где заканчивается нужный код
        $len   = $to-$from+1; // получаем длинну
        return implode(array_slice($lines, $from-1, $len)); // обрезаем массив, и переводим в строку
    }
}

$prod_class = new ReflectionClass("CDProduct");
print ReflectionUtil::getClassSource($prod_class);

echo "<hr>";

//---------------------------------------------------------------------------------
// исследование методов

function methodData(ReflectionMethod $method){
    $details = "";
    $name = $method->getName();

    if($method->isUserDefined()){
        $details .= "$name -- метод определён пользователем<br>";
    }

    if($method->isInternal()){
        $details .= "$name -- внутренний метод<br>";
    }

    if($method->isAbstract()){
        $details .= "$name -- абстрактный метод<br>";
    }

    if($method->isPublic()){
        $details .= "$name -- публичный метод<br>";
    }

    if($method->isProtected()){
        $details .= "$name -- защищенный метод<br>";
    }

    if($method->isPrivate()){
        $details .= "$name -- закрытый метод метод<br>";
    }

    if($method->isStatic()){
        $details .= "$name -- статичный метод<br>";
    }

    if($method->isFinal()){
        $details .= "$name -- финальный метод<br>";
    }

    if($method->isConstructor()){
        $details .= "$name -- метод конструктора<br>";
    }

    if($method->returnsReference()){
        $details .= "$name -- метод возвращает ссылку а не значение<br>";
    }

    return $details;
}

$prod_class = new ReflectionClass("CDProduct");
$methods = $prod_class->getMethods(); // записываем в переменную объект класса ReflectionMethod, в котором описаны методы

foreach($methods as $method){ // перебираем все методы
    print methodData($method); // выводим информацию о методах
    print "<br>------------------------------</br>";
}

echo "<hr>";

$method_summ = $prod_class->getMethod('getSummaryLine'); // записываем в переменную метод
print ReflectionUtil::getMethodSource($method_summ); // выводим код метода

echo "<hr>";

//---------------------------------------------------------------------------------
// исследование аргументов методов

function argData(ReflectionParameter $arg){
    $details        = "";
    $declaringClass = $arg->getDeclaringClass();
    $name           = $arg->getName();
    $class          = $arg->getClass();
    $position       = $arg->getPosition();
    $details .= "$name Находится на позиции $position <br>";

    if(!empty($class)){
        $classname = $class->getName(); // возвращает объект класса ReflectionClass если в сигнатуре класса было уточнение
        $details .= "$name должен быть объектом типа $classname <br>";
    }

    if($arg->isPassedByReference()){ // проверяет является ли аргумент ссылкой
        $details .= "$name передан по ссылке <br>";
    }

    if($arg->isDefaultValueAvailable()){ // проверяет есть ли значение по умолчанию
        $def = $arg->getDefaultValue(); // получает значение по умолчанию
        $details = "$name по умолчанию равно: $def <br>";
    }

    return $details;
}


$prod_class = new ReflectionClass("CDProduct");
$method = $prod_class->getMethod("__construct"); // записываем в переменную объект класса ReflectionMethod, в котором описан метод __construct
$params = $method->getParameters(); // записываем в массив объект класса ReflectionParameter, в котором описаны аргументы метода

foreach($params as $param){ // перебираем массив с аргументами
    print argData($param); // передаём каждый аргумент функции argData()
}

echo "<hr>";

echo "</pre>";