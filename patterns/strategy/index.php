<?php

//реализация паттерна Strategy

class Lesson{
    private $duration; // продолжительность
    private $strategy; // объект Strategy

    public function __construct($duration,Strategy $strategy){ // принимает подолжительность занятия, и Стратегию которая будет генерировать данные в зависимости от вида оплаты
        $this->duration = $duration;
        $this->strategy = $strategy;
    }

    public function getPayType(){
        return $this->strategy->getPayType(); // выводит вид оплаты
    }

    public function getPrice(){
        return $this->strategy->getPrice($this); // высчитывает стоимость через стратегию и передаёт экземпляр себя(в данном случае для того что бы стратегия знала $this->duration)
    }

    public function getDuration(){
        return $this->duration;
    }
}

abstract class Strategy{ // абстрактный класс стратегии
    abstract function getPrice(Lesson $lesson);
    abstract function getPayType();
}

class FixedStrategy extends Strategy{ // стратегия вывода информании по фиксированой оплате
    function getPrice(Lesson $lesson){
        return 20;
    }

    function getPayType(){
        return "фиксированая цена";
    }
}

class TimedStrategy extends Strategy{ // стратегия вывода информации по почасовой оплате
    function getPrice(Lesson $lesson){
        return $lesson->getDuration() * 5; // здесь высчитывается цена, исходя из продолжительности ($lesson->getDuration())
    }

    function getPayType(){
        return "почасовая оплата";
    }
}

$lesson1 = new Lesson(10, new TimedStrategy); // урок продолжительностью 10, и стратегией вывода почасовой оплаты (TimedStrategy)
$lesson2 = new Lesson(4, new FixedStrategy); // урок продолжительностью 4, и стратегией вывода фиксированной оплаты (FixedStrategy)
echo "Вид оплаты - {$lesson1->getPayType()}, цена - {$lesson1->getPrice()} <br>";
echo "Вид оплаты - {$lesson2->getPayType()}, цена - {$lesson2->getPrice()} <br>";
