<?php

class DatabaseConnection
{
    public static function get()
    {
        static $db = null;
        if ( $db == null )
            $db = new DatabaseConnection();
        return $db;
    }

    private $_handle = null;

    private function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=laravel';
        $this->_handle =& new PDO($dsn,'root','');
    }

    public function handle()
    {
        return $this->_handle;
    }
}

var_dump(DatabaseConnection::get()->handle());
var_dump(DatabaseConnection::get()->handle());