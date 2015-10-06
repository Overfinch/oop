<?php
//-------------------------------------------------------------------------------------------------------------
// Информация о классах

require_once('../index.php');

echo "<pre>";

echo "<hr>";

print_r(get_class_methods("ShopProduct")); // возвращает массив с методами класса
print_r(get_class_vars("CDProduct")); // возвращает массив со свойствами класса
print get_parent_class("CDProduct"); // возвращает название родительского класса

echo "<hr>";

$methodname = "getTitle"; // строка с именем метода
if(is_callable([$cd, $methodname])){ // проверяем есть ли в массиве методов обьекта, нужный нам метод
    echo $cd->$methodname(); // выводит метод, используя переменную в которой хранится строка с именем метода
}

echo "<hr>";

if(is_subclass_of($cd, "ShopProduct")){ // проверяем, является ли класс дочерним для другого класса
    echo "расширяет класс ShopProduct";
}

echo "<hr>";

if(in_array("Chargeable", class_implements("ShopProduct"))){ // проверяем есть ли в массиве интерфейсов которые реализует класс ShopProduct, интерфейс Chargeable
    echo "класс ShopProduct реализует интерфейс Chargeable";
}

echo "</pre>";