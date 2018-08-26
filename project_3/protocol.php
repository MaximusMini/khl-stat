<?php
/*
модуль сбора статистики протокола матча с чемпа + формирование поста

данные для сбора

$arr_protocol['date']
$arr_protocol['image_team_1']
$arr_protocol['image_team_2']
$arr_protocol['name_team_1']
$arr_protocol['name_team_1']
$arr_protocol['match_count']
$arr_protocol['match__count__extra']
$arr_protocol['stadium']


голы



вратари


*/


echo '';
include_once('..\php\phpQuery.php');



$arr_protocol = [];



function main_pars(){
    global $arr_protocol;
    $res_curl = curl_get ('https://www.championat.com/hockey/_superleague/2202/match/643538.html');
    $file_phpQuery = phpQuery::newDocument($res_curl);
    
    // шайбы матча
    $goals_1 = $file_phpQuery->find('div.match__tables:nth-child(1) div.match__stat div.match__stat__row._team1 a.match__stat__row__player');
    
    $goals_2 = $file_phpQuery->find('div.match__tables:nth-child(1) div.match__stat div.match__stat__row._team2 a[class = match__stat__row__player]');
    
    echo '<br>Команда 1';
    foreach($goals_1 as $val){
        echo '<br>!!!'.pq($val)->html();
    }
    echo '<br>Команда 2';
    foreach($goals_2 as $val){
        echo '<br>!!!'.pq($val)->html();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}








// вызовы функций ***********************************************************
    main_pars();
    //imageTemplate();
// **************************************************************************

// вспомогательные функции ***********************************************************    
    function printArray($arr){
        echo '<pre>'.print_r($arr,true).'</pre>';
    }
// функция для использования библиотеки curl
    function curl_get ($url, $referer = 'http://google.com'){
    $ch = curl_init();// инициализируем curl
    // задаем параметры (опции) curl 
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; rv:42.0) Gecko/20100101 Firefox/42.0');
    curl_setopt($ch, CURLOPT_REFERER,$referer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); // результат работы curl возвращается, а не выводиться
    //  выполняем запрос curl
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
    }
// **************************************************************************
?>