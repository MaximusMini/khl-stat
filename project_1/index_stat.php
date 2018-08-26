<!DOCTYPE html>
<html lang="en">
<head>
    
     <?php require_once('../php/link.php'); ?>
    
    <meta charset="UTF-8">
    <title>Формирование статистики</title>
</head>
<body>
   
   <div class="container">
      <div class="row text-center">
          <div class="col-lg-6">Клуб 1</div>
          <div class="col-lg-6">Клуб 2</div>
      </div>
       
   </div>
   
    
</body>
</html>




<?php


$homepage = file_get_contents('json\east_09_10_2017.json');
//echo $homepage;

//printArray(json_decode($homepage, true));


$team = json_decode($homepage, true);




//echo count($team);

//echo search_index($team,'Нефтехимик');

$index = search_index($team,'Нефтехимик');

stat_team($index, $team);


//echo array_search('green',$team['name']);


/*
выводим статистику конкретной команды - Нефтехимик

1. ищем массив где имя ['name'] Ак Барс и определяем его индекс
    search_index($team,'Нефтехимик');
2. по найденному индекусу получаем остальные данные

foreach(){
    
    
    
}

*/ 

// поиск индекса массива по названию команды
function search_index($team,$name_team)
{
    for($i=0; $i<count($team); $i++){
        if ($team[$i]['name'] == $name_team){
            return  $i;
        }
    }
} 


// вывод статистики команды по найденному индексу
function stat_team($index, $team){
    //место в конференции
    echo '<h3>Место в конференции - '.$index.'</h3>';
    // Количество проведенных игр
    echo '<h3> Количество проведенных игр - '.$team[$index]['games'].'</h3>';
    // Количество набранных очков
    echo '<h3> Количество набранных очков - '.$team[$index]['scores'].'</h3>';
}





function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}





?>