<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Парсинг судей</title>
</head>
<body>
    
</body>
</html>


<?php
include_once('php\phpQuery.php');

    $ref_khl         = file_get_contents('files_referee\ref_khl_site.php');
    $ref_champ_13_14 = file_get_contents('files_referee\ref_champ_13_14.php');
    $ref_champ_14_15 = file_get_contents('files_referee\ref_champ_14_15.php');
    $ref_champ_15_16 = file_get_contents('files_referee\ref_champ_15_16.php');
    $ref_champ_16_17 = file_get_contents('files_referee\ref_champ_16_17.php');
    $ref_champ_17_18 = file_get_contents('files_referee\ref_champ_17_18.php');

    //создаем объекты класса phpQuery
    $r_khl      = phpQuery::newDocument($ref_khl);
    $r_ch_13_14 = phpQuery::newDocument($ref_champ_13_14);
    $r_ch_14_15 = phpQuery::newDocument($ref_champ_14_15);
    $r_ch_15_16 = phpQuery::newDocument($ref_champ_15_16);
    $r_ch_16_17 = phpQuery::newDocument($ref_champ_16_17);
    $r_ch_17_18 = phpQuery::newDocument($ref_champ_17_18);


    $array_referee = []; // массив судей

    ref($r_khl,$r_ch_13_14,$r_ch_14_15,$r_ch_15_16,$r_ch_16_17,$r_ch_17_18);

// парсинг судей
function ref($r_khl,$r_ch_13_14,$r_ch_14_15,$r_ch_15_16,$r_ch_16_17,$r_ch_17_18){
    
    $par_2013 = $r_khl->find('table tr');
    foreach ($par_2013 as $el){
        $ref = trim(pq($el)->find('td:nth-child(1)')->text());
        echo '<br>'.$ref;
        //$coach = explode(' ',$coach)[2].' '.explode(' ',$coach)[0];
        //echo '<br>'.pq($el)->html();
        //массив в котором буду хранится id игроков
        //array_push($array_coach, $coach);
    }
    
    
    
    
    
    //echo $array_coach[0];
    
    //asort($array_coach); // сортировка массива
    //$array_coach = array_unique($array_coach);// удаление дубликатов
    
    //$g=-1;
    
//    foreach($array_coach as $val){
//        //echo '<br>'.$g.' тренер -  '.$val;
//        echo '<br>\''.$g.'\' =>\''.$val.'\',';
//        $g++;
//    }
    
    
    
    
}




?>
