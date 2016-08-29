<?php

// Пример использования синглтона

class Products{

    private $_db = null;

    public function __construct(){
        $this->_db = Db::getInstance();
    }

    public function getAllProducts(){
        $result = $this->_db->query("SELECT * FROM blog");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

}

class Db { // сам синглтон, может быть ток один экземпляр объекта, и он служит для подключения к БД

    private static $_db = null;

    public static function getInstance(){
        if(self::$_db == null){
            self::$_db = new PDO('mysql:host=localhost;dbname=laravel','root','');
        }
        return self::$_db;
    }

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<?php

$products = new Products();

echo "<pre>";
var_dump($products->getAllProducts());
echo "</pre>";

?>

</body>
</html>