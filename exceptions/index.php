<?php

try{
    $a = 1;
    $b = 0;

    if($b == 0){
        throw new Exception("Деление на ноль");
    }

    $c = $a/$b;

}catch (Exception $e){
    echo $e->getMessage()."<br>";
    echo $e->getLine()."<br>";
    echo $e->getFile()."<br>";
}