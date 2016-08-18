<?php

  $hostName = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "tree";
  if (!($link=mysql_connect($hostName,$userName,$password))) {
 printf("Ошибка при соединении с MySQL !\n");
 exit();
 }
  if (!mysql_select_db($databaseName, $link)) {
 printf("Ошибка базы данных !");
 exit();
 }

mysql_query("SET NAMES utf8", $link);

 function ShowTree($ParentID, $lvl) { 

    global $data; // глобальная переменная для записи строки в неё
    global $link; // Настройки БД
    global $lvl; // уровень вложенности, всегда можно узнать/вывести его используя $lvl
    $lvl++; // инкремент уровня

    $sSQL="SELECT id,name,p_id FROM categories WHERE p_id=".$ParentID." ORDER BY name"; // выбираем всё где parrent_id $ParentID
    $result=mysql_query($sSQL, $link); // результат

    if (mysql_num_rows($result) > 0) { // если есть результат
        $data .= "<ul>";
        while ( $row = mysql_fetch_array($result) ) { // пока будет выполнятся условия с parent_id = $ParentID 
            $ID1 = $row["id"]; // задаём этой переменной значение id, оно будет использовано как parent_id в следующем цикле
            $data .=("<li>");
            $data .= $row["name"];
            $data .=("</li>");
            ShowTree($ID1, $lvl); // вызыввем рекурсивно функцию c заданым $lvl, а в $ParentID передаём id с этого цикла
            $lvl--; // уменьшаем $lvl на 1
        }
        $data .= "</ul>";
    }
    
    return $data;

}

$string = ShowTree(0, 0); 
echo ($string);

mysql_close($link); 