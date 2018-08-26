<?php

//http://khl-stat/project_1/totalMatch5.php?team_1=1&team_2=2

// id команды 1,2
//$id_team_1 = 1;
//$id_team_2 = 2;


$id_team_1 = $_GET['team_1'];
$id_team_2 = $_GET['team_2'];

$total5_team_1; $total5_team_2;

 $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
 if($id_connect_DB){
        // расчет тотал за матчи в гостях
        $q_total5_team_1 = 'SELECT * FROM result_match WHERE id_team='.$id_team_1.' AND place=" guest"';
        $result = $id_connect_DB->query($q_total5_team_1);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $count_matchs_team_1 = count($row);
        foreach ($row as $val){
            //echo '<br>'.$val['puck_team'];
            //echo '<br>'.$val['result'];
            // проверяем на ОТ и Б
            if(trim($val['time_end'])=='Б' or trim($val['time_end'])=='ОТ' and trim($val['result'])=='win'){
                $total5_team_1 += $val['puck_team']-1;
            }else{$total5_team_1 += $val['puck_team'];}
            
        }
        $q_total5_team_2 = 'SELECT * FROM result_match WHERE id_team='.$id_team_2.' AND place=" guest"';
        $result = $id_connect_DB->query($q_total5_team_2);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $count_matchs_team_2 = count($row);
        foreach ($row as $val){
            if(trim($val['time_end'])=='Б' or trim($val['time_end'])=='ОТ' and trim($val['result'])=='win'){
                $total5_team_2 += $val['puck_team']-1;
            }else{$total5_team_2 += $val['puck_team'];}

        }
        $total5_team_1 = $total5_team_1/$count_matchs_team_1;
        $total5_team_2 = $total5_team_2/$count_matchs_team_2;
    }else{
        echo '<br> соединение с БД не устанолвено';
    }

    $answer_server = array('total5_team_1' => round($total5_team_1,2), 'total5_team_2' => round($total5_team_2,2));
    echo json_encode($answer_server);
    return;

/*
расчет тотал за все матчи

в результате запроса 
    SELECT *  FROM result_match WHERE id_team=1
получаем все строки для запрашиваемых команд
нас интересует столбец puck_team
при этом нужно учесть ОТ и Б
*/



function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}
?>