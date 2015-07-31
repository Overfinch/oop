<?php

interface ProductInterface {
    public function getId();
    public function getModel();
    public function getPrice();
    public function getType();
}


class Keyboard implements ProductInterface{
    protected $_id;
    protected $_model;
    protected $_price;

    public function __construct($product){
        $this->_id    = $product['id'];
        $this->_model = $product['model'];
        $this->_price = $product['price'];
    }

    public function getId(){
        return $this->_id;
    }

    public function getModel(){
        return $this->_model;
    }

    public function getPrice(){
        return $this->_price;
    }

    public function getType(){
        return 'Keyboard';
    }
}

class Mouse implements ProductInterface{
    protected $_id;
    protected $_model;
    protected $_price;

    public function __construct($product){
        $this->_id    = $product['id'];
        $this->_model = $product['model'];
        $this->_price = $product['price'];
    }

    public function getId(){
        return $this->_id;
    }

    public function getModel(){
        return $this->_model;
    }

    public function getPrice(){
        return $this->_price;
    }

    public function getType(){
        return 'Mouse';
    }
}


class ProductFactory { // сама фабрика
    private $_types = [];

    public function __construct(){ // массив из разрешенных типов
        $this->_types = [
            'keyboard' => 'keyboard',
            'mouse'    => 'mouse'
        ];
    }

    public function make($product){

        if(!array_key_exists($product['type'], $this->_types)){ // проверяем разрешен ли такой тип
            throw new InvalidArgumentException("Тип ".$product['type']." не найден!");
        }

        $class_name = $this->_types[$product['type']]; // имя класса называется именем переданного типа

        return new $class_name($product); // создаётся объект нужного класса
    }
}


$products = [
    [
        'id' => 1,
        'model' => 'LOGITECH K810',
        'price' => 150,
        'type'  => 'keyboard'
    ],
    [
        'id' => 2,
        'model' => 'LOGITECH WIRELES MOUSE G700',
        'price' => 140,
        'type'  => 'mouse'
    ]
];


$productsFactory = new ProductFactory();

$cart = [];

foreach($products as $product){
    $cart[] = $productsFactory->make($product);
}

var_dump($cart);

echo $cart[1]->getPrice(); // например достаём цену


