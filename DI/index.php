<?php

class Db {
    public function query($query) {
        return $query;
    }
}

class User {

    protected $db;

    public function __construct(Db $db) { // при создании обьекта класса User,
        // принимает обьект класса Db
        $this->db = $db; // и записывает его в свойство $db
    }


    public function getAllUsers() {
        return $this->db->query("SELECT * FROM 'users'"); // выполняет метод query, со свойства $db, которому присвоили обьект класса Db
    }
}

$db = new Db(); // создаём обьект класса Db
$user = new User($db); // создаём обьект класса User и передаём ему обьект класса Db
echo $user->getAllUsers(); 