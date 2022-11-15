<?php
$title = trim(strip_tags($_POST['title']));
$category  = abs((int)$_POST['category']);
$description = trim(strip_tags($_POST['description']));
$source = trim(strip_tags($_POST['source']));
if(empty($title) or empty($description)){
    $errMsg = 'Заполните все поля формы!';
} else {
    $result = $news->saveNews($title, $category, $description, $source);
    if(!$result){
        $errMsg = 'Произошла ошибка при добавлении новости';
    } else {
        header("Location: news.php");
        exit;
    }
}

