<?php

$db = new PDO("mysql:host=localhost;dbname=tree","root",""); // инициализация БД
$db->query("SET NAMES utf8");

function showTree($p_id,$db){
    global $data; // глобальная переменная для записи в неё данных
    $sql = "SELECT * FROM categories WHERE p_id=".$p_id;
    $result = $db->query($sql);

    $data .= "<ul>";
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $next_pid = $row['id'];
        $data .="<li>";
        $data .= $row['name'];
        $data .="</li>";
        showTree($next_pid, $db);
    }
    $data .="</ul>";
    return $data;
}

$tree = showTree(0,$db);
echo $tree;