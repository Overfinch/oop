<?php

// $this, конструктор и деструктор

class ShopProduct{
    public $title = "какой-то товар";
    public $lastName = "фамилия";
    public $firstName = "имя";
    public $price = 0;

    public function __construct($title, $lastName, $firstName, $price){
        $this->title = $title;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->price = $price;

        echo $this->getAllView();
    }

    public function __destruct(){
        echo $this->title." был занесен в БД<br>";
    }

    public function getAllView(){
        return "{$this->firstName} {$this->lastName} <br> Название: {$this->title}<br> цена: {$this->price}<hr>";
    }
}


$tovar1 = new ShopProduct("Мастер и Маргарита", "Булгаков", "Михаил", 25);
$tovar2 = new ShopProduct("Эхо лабиринита", "Фрай", "Макс", 40);
