<?php

class Product {
    public $name;
    public $price;

    function __construct($name, $price){
        $this->name = $name;
        $this->price = $price;
    }
}

class ProcessSale {
    private $callbacks;

    function registerCallback($callback){ // записывает переданную функцию в массив
        if(!is_callable($callback)){ // проверка на "вызываемость"
            throw new Exception("Функция обратного вызова невызываемая!");
        }

        $this->callbacks[] = $callback; // сама запись в массив
    }

    function sale(Product $product){ // принимаем объект класса Product
        print $product->name." Обрабатывается...<br>";
        foreach ($this->callbacks as $callback) {
            call_user_func($callback, $product); // выводим каждую функцию, и передаём ей объект класса Product
        }

    }
}

class Mailer {
    function doMail($product){  // создаём метод который добавим потом в массив
        print "упаковываем $product->name <br>";
    }
}

class Totalizer {
    static function warnAmount($amt){ // статичной метод который возвращает анонимную функцию
        $count = 0; // счетчик суммы товаров
        return function($product) use ($amt, &$count){ // перед переменной $count стоит &, это означает что передаётся только ссылка на переменную, что бы она не обнулялась
            $count += $product->price; // добавляет к счетчику суммы товаров, цену товара
            print "сумма $count <br>"; // выводит сумму товара
            if($count > $amt){ // если сумма товара выше заданной суммы, то выводим сообщение
                print "продано товаров на сумму $count <br>";
            }
        };
    }
}

$logger = create_function('$product', 'print "Записываем {$product->name} <br>";'); // создаём новую анонимную функцию
$logger2 = function($product){ print "Записываем $product->name <br>"; };// болие удобный способ создание анонимной функции

$processor = new ProcessSale(); // создаём новый объект класса ProcessSale
$processor->registerCallback($logger); // записываем в массив нашу новую анонимную функцию $logger
$processor->registerCallback($logger2); // записываем в массив нашу новую анонимную функцию $logger2
$processor->registerCallback([new Mailer(), "doMail"]); // записываем в массив новый метод из класс Mailer
$processor->registerCallback(Totalizer::warnAmount(8)); // записываем в массив новый статичный метод класса Totalizer, который принимает сумму после которой начинает выводить определённое сообщение

$processor->sale(new Product("Туфли", 6)); // передаём новый объект класса Product, в метод который который передаёт его всем записанным в массив новым функциям
echo "<br>";
$processor->sale(new Product("Кофе", 6));
