<?php

//http://khl-stat/project_1/scripts_php/games_last_5.php?team_1=8


$id_team_1 = $_GET['team_1'];
//$id_team_2 = $_GET['team_2'];

$games_last_team_1; $games_last_team_2;

 $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
 if($id_connect_DB){
        // формирование SQL запроса на выборку последних 5 матчей
        $query_team_1 = 'SELECT * FROM result_match WHERE id_team='.$id_team_1.' ORDER BY date_match DESC LIMIT 5';
        // выполнение запроса
        $result = $id_connect_DB->query($query_team_1);
        // получение ассоциативного массива
        $row = $result->fetch_all(MYSQLI_ASSOC);
        
        printArray($row);
        
    }else{
        echo '<br> соединение с БД не устанолвено';
    }

    $answer_server = array('total5_team_1' => $total5_team_1, 'total5_team_2' => $total5_team_2);
    echo json_encode($answer_server);
    return;

/*
выборка результатов за последние 5 игр

в результате запроса 
    SELECT * FROM result_match WHERE id_team=1 ORDER BY date_match DESC LIMIT 5
получаем 5 строк
нас интересует столбец puck_team
при этом нужно учесть ОТ и Б
*/



function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}
?>


