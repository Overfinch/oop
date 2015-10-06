<?php

$classname = "Task";
$path = $classname.".php";

if(!file_exists($path)){
    throw new Exception("файл $path не существует");
}
require_once($path);

$qclassname = "tasks\\{$classname}";
if(!class_exists($qclassname)){
    throw new Exception("класс $qclassname не существует");
}

$myObj = new $qclassname;
$myObj->doSpeek();
