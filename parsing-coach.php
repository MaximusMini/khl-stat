<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Парсинг тренеров</title>
</head>
<body>
    
</body>
</html>


<?php
include_once('php\phpQuery.php');

    $data_protocol_2013 = file_get_contents('files_coach\coach_champ_2013_2014.php');
    $data_protocol_2014 = file_get_contents('files_coach\coach_champ_2014_2015.php');    
    $data_protocol_2015 = file_get_contents('files_coach\coach_champ_2015_2016.php');
    $data_protocol_2016 = file_get_contents('files_coach\coach_champ_2016_2017.php');
    $data_protocol_2017 = file_get_contents('files_coach\coach_champ_2017_2018.php');   


    //создаем объект класса phpQuery
    $results = '';
    $results_2013 = phpQuery::newDocument($data_protocol_2013);
    $results_2014 = phpQuery::newDocument($data_protocol_2014);
    $results_2015 = phpQuery::newDocument($data_protocol_2015);
    $results_2016 = phpQuery::newDocument($data_protocol_2016);
    $results_2017 = phpQuery::newDocument($data_protocol_2017);

    $array_coach = []; // массив тренеров

    coach_champ_2016_2017($results_2013,$results_2014,$results_2015, $results_2016, $results_2017, $array_coach);

// парсинг тренеров https://www.championat.com/hockey/_superleague/1770/coaches.html
function coach_champ_2016_2017($results_2013,$results_2014,$results_2015, $results_2016, $results_2017, $array_coach){
    
    $par_2013 = $results_2013->find('table.b-table-sortlist tr');
    foreach ($par_2013 as $el){
        $coach = trim(pq($el)->find('td:nth-child(3)')->text());
        $coach = explode(' ',$coach)[2].' '.explode(' ',$coach)[0];
        //echo '<br>'.$coach;
        //массив в котором буду хранится id игроков
        array_push($array_coach, $coach);
    }
    
    $par_2014 = $results_2014->find('table.b-table-sortlist tr');
    foreach ($par_2014 as $el){
        $coach = trim(pq($el)->find('td:nth-child(3)')->text());
        $coach = explode(' ',$coach)[2].' '.explode(' ',$coach)[0];
        //echo '<br>'.$coach;
        //массив в котором буду хранится id игроков
        array_push($array_coach, $coach);
    }
    
    $par_2015 = $results_2015->find('table.b-table-sortlist tr');
    foreach ($par_2015 as $el){
        $coach = trim(pq($el)->find('td:nth-child(3)')->text());
        $coach = explode(' ',$coach)[2].' '.explode(' ',$coach)[0];
        //echo '<br>'.$coach;
        //массив в котором буду хранится id игроков
        array_push($array_coach, $coach);
    }
    
    $par_2016 = $results_2015->find('table.b-table-sortlist tr');
    foreach ($par_2016 as $el){
        $coach = trim(pq($el)->find('td:nth-child(3)')->text());
        $coach = explode(' ',$coach)[2].' '.explode(' ',$coach)[0];
        //echo '<br>'.$coach;
        //массив в котором буду хранится id игроков
        array_push($array_coach, $coach);
    }
    
    $par_2017 = $results_2017->find('table.b-table-sortlist tr');
    foreach ($par_2015 as $el){
        $coach = trim(pq($el)->find('td:nth-child(3)')->text());
        $coach = explode(' ',$coach)[2].' '.explode(' ',$coach)[0];
        //echo '<br>'.$coach;
        //массив в котором буду хранится id игроков
        array_push($array_coach, $coach);
    }
    
    
    
    
    
    //echo $array_coach[0];
    
    asort($array_coach); // сортировка массива
    $array_coach = array_unique($array_coach);// удаление дубликатов
    
    $g=-1;
    
    foreach($array_coach as $val){
        //echo '<br>'.$g.' тренер -  '.$val;
        echo '<br>\''.$g.'\' =>\''.$val.'\',';
        $g++;
    }
    
    
    
    
}




?>
