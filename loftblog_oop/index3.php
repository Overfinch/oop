<?php

// Инкапсуляция и спецификаторы доступа
// public открыт для доступа везде
// private закрыт для доступа извне
// protected открыт для доступа в своём классе и в классе который его расширяет(extends)

class ShopProduct{
    public $title = "какой-то товар";
    private $price = 0;

    public function __construct($title, $price){
        $this->title = $title;
        $this->price = $price;
    }

    public function getPrice(){
        return $this->price;
    }

}

class Saller {
    public function sale(ShopProduct $product, $sale){
        return $product->getPrice() - ($product->getPrice()*$sale);
    }
}

$product = new ShopProduct("Часы", 100);
$saller = new Saller();

echo $saller->sale($product, 0.2);
echo "<br>";
echo $saller->sale($product, 0);