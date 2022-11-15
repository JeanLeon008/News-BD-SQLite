<?php

$id = abs((int)$_GET['view']);
if($id){
    $res = $news->showNews($id);
    $arr = $res->fetchArray(SQLITE3_ASSOC);
    if(!$res){
        $errMsg = "Произошла ошибка";
    } else{
        echo "
        <h1> {$arr['title']} </h1>
        <p> {$arr['description']} <br> {$arr['category']}</p><p> {$arr['datetime']}</p>
        <p> Источник: {$arr['source']}</p>";
    }
}
