<?php

class Singleton {

    protected static $instance;

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
            echo "<p>First initialization</p>";
        }else{
            echo "<p>initialization</p>";
        }

        return self::$instance;
    }

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

}

Singleton::getInstance();
Singleton::getInstance();
Singleton::getInstance();

