<?php

// Наследование

class ShopProduct{

    public $title;
    public $price;

    public function __construct($title, $price){
        $this->title = $title;
        $this->price = $price;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getView(){
        $result = $this->title."<br>".$this->price;
        return $result;
    }

}

class digitalProduct extends ShopProduct{
    public $type;
    public $size;

    public function __construct($title, $price, $type, $size){
        parent::__construct($title, $price);
        $this->type = $type;
        $this->size = $size;
    }

    public function getView(){
        $result = parent::getView();
        $result.="<br>".$this->type."<br>".$this->size;
        return $result;
    }
}

$cd = new digitalProduct('Metallica',350,'cd',670);
echo $cd->getView();
