<?php
$items = $news->getNews();
if($items === false){
    $errMsg = 'Произошла ошибка при выводе новостной ленты';
}else {
    foreach($items as $v){
        
        echo "
        <h3> {$v['title']} </h3>
        <p> {$v['description']} <br> {$v['category']}</p><p> {$v['datetime']}</p>
        <p> Источник: {$v['source']}</p>
        <p>
        <a href='news.php?view={$v['id']}'> Подробней </a>
        </p>";
    }
}