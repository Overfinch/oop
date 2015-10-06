<?php

class ShopProduct implements Chargeable {
    private $id;
    private $title;
    private $producerMainName;
    private $producerFirstName;
    protected $price;
    private $discount;

    function __construct($title, $firstName, $mainName, $price){
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
    }

    function setId($id){
        $this->id = $id;
    }

    function getProducerFirstNmae(){
        return $this->producerFirstName;
    }

    function getProducerMainName(){
        return $this->producerMainName;
    }

    function setDiscount($num){
        $this->discount = $num;
    }

    function getDiscount(){
        return $this->discount;
    }

    function getTitle(){
        return $this->title;
    }

    function getPrice(){
        return ($this->price - $this->discount);
    }

    function getProducer(){
        return $this->producerFirstName.' '.$this->producerMainName;
    }

    function getSummaryLine(){ // выводим общую базовую информацию
        $base = "$this->title ( {$this->producerMainName}, ";
        $base .= "{$this->producerFirstName} )";
        return $base;
    }

    public static function getInstance($id, PDO $pdo){ // ФАБРИКА которая находит товар в БД по id и создаёт обьект нужного типа
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id=?"); // подготавливаем выборку по id
        $result = $stmt->execute([$id]); // выполняем
        $row = $stmt->fetch(); // получаем результат

        if(empty($row)){ // проверяем не пуста ли строка
            return null;

        }

        if($row['type'] == "book"){ // проверяем "тип"
            $product = new BookProduct( $row['title'],
                                        $row['firstname'],
                                        $row['mainname'],
                                        $row['price'],
                                        $row['numpages']);
        }else if($row['type'] == "cd"){ // проверяем "тип"
            $product = new CDProduct(   $row['title'],
                                        $row['firstname'],
                                        $row['mainname'],
                                        $row['price'],
                                        $row['playlength']);
        }else{ // если неизвесный "тип", то применяем родительский класс ShopProduct
            $product = new ShopProduct( $row['title'],
                                        $row['firstname'],
                                        $row['mainname'],
                                        $row['price']);
        }

        $product->setId($row['id']); // назначаем id согласно id из БД
        $product->setDiscount($row['discount']); // назначаем скидку согласно скидке из БД
        return $product; // возвращаем полученый обьект нужного нам класса
    }


}

interface Chargeable { // интерфейс, все классы которые его наследуют, обязаны иметь описанные в нём методы
    public function getPrice();
}

class CDProduct extends ShopProduct {
    private $playLenght;
    public static $coverUrl = "http://";

    function __construct($title, $firstName, $mainName, $price, $playLenght){
        parent::__construct($title, $firstName, $mainName, $price);
        $this->playLength = $playLenght;
    }

    function getPlayLength(){
        return $this->playLength;
    }

    function getSummaryLine(){
        $base = parent::getSummaryLine();
        $base .= ": Время звучания - ". $this->playLength;
        return $base;
    }

}

class BookProduct extends ShopProduct{
    private $numPages;

    function __construct($title, $firstName, $mainName, $price, $numPages){
        parent::__construct($title, $firstName, $mainName, $price);
        $this->numPages = $numPages;
    }

    function getNumberOfPages(){
        return $this->numPages;
    }

    function getSummaryLine(){
        $base = parent::getSummaryLine();
        $base .= ": ". $this->numPages." стр.";
        return $base;
    }

    function getPrice(){
        return $this->price;
    }

}

abstract class ShopProductWriter{ // абстрактный класс для сбора обьектов и вывода базовой информации
    protected $products = [];

    public function addProduct(ShopProduct $shopProduct){ // принимаем обьект класса ShopProduct (или класса который его расширяет)
        $this->products[] = $shopProduct; // и дописываем этот обьёкт в массив
    }

    abstract public function write(); // абстрактный метод (который должен быть реализован классе который его наследует)
}

class XmlProductWriter extends ShopProductWriter { // выводит свойства обьекта в виде XML
    public function write(){
        $str = '<?xml version="1.0" encoding="UTF-8"?>';
        $str .= '<products>';

        foreach($this->products as $shopProduct){
            $str .= "\t<product title=\"{$shopProduct->getTitle()}\" >";
            $str .= "\t\t<summary>";
            $str .= "\t\t{$shopProduct->getSummaryLine()}";
            $str .= "\t\t</summary>";
            $str .= "\t</product>";
        }

        $str .= "</products>";
        print $str;
    }
}

class TextProductWriter extends ShopProductWriter { // выводит свойства обьекта в виде текста
    public function write(){
        $str = "<br>Товары:<br>";

        foreach($this->products as $shopProduct){
            $str .= $shopProduct->getSummaryLine();
            $str .= "<br>";
        }

        print $str;
    }
}

echo "<pre>";

$pdo = new PDO('mysql:host=localhost;dbname=matt','root',''); // инициализируем PDO

$obj = ShopProduct::getInstance(1, $pdo); // создание нового обьекта через фабрику, достаём из БД по id
$cd = new CDProduct('Harakiri', 'Serj', 'Tankian', 100, 120); // создание новго обьекта через конструктор

$text = new TextProductWriter(); // новый обьект класса TextProductWriter()
$text->addProduct($cd); // добавляем в массив обьект $cd
$text->addProduct($obj); // добавляем в массив обьект $obj
$text->write(); // выводим свойства обьектов из массива

echo "</pre>";
