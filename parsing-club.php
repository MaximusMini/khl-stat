<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <?php require_once('php/link.php'); ?>

    <title>Парсинг клубов</title>

</head>

<body>
<!--<button onclick='start()'>запуск</button>-->
    

</body>

</html>




<?php

include_once('php\phpQuery.php');


    $data_protocol = file_get_contents('files_club\all_clubs.php');


    //создаем объект класса phpQuery
    $results = '';
    $results = phpQuery::newDocument($data_protocol);

    link_page_club($results);




// получение ссылок клубов
function link_page_club($results){
    
    $par = $results->find('h5.e-club_name a');
    
    foreach ($par as $el){
        echo '<br>'.pq($el)->attr('href');
        //массив в котором буду хранится id игроков
        //array_push($players_id, substr(pq($el)->attr('href'),9,strpos(pq($el)->attr('href'),'/',9)-9));
    }
    
}
























