<?php
// getters & setters
class Config {
    private $host = "localhost";
    private $user = "root";
    private $dbname = "DB";
    private $password = "pass";

    public function get($key){ // универсальный getter
        return $this->$key;
    }

    public function set($key, $value){ // универсальный setter
        $this->$key = $value;
    }
}

$obj = new Config();
$obj->set('host','newhost');
echo $obj->get('host');