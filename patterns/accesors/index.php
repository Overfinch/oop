<?php
// getters & setters
class Config {
    private $host = "localhost";
    private $user = "root";
    private $dbname = "DB";
    private $password = "pass";

    public function __get($key){ // универсальный getter
        return $this->$key;
    }

    public function __set($key, $value){ // универсальный setter
        $this->$key = $value;
    }
}

$obj = new Config();
$obj->__set('host','newhost');
echo $obj->__get('host');