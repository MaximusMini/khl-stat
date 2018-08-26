
<?php

$mysqli = new mysqli("localhost", "root", "07011989", "db_preview");
//
//// получение параметров из запроса
//
//$clear_table = $_POST['clear_table'];
//
//$answer_server = ['answer' => $clear_table];
//        $answer_server = json_encode($answer_server);
//        return $res ='Таблицы champ очищены';
//
//echo '!!!-'.$clear_table;


$clear_table = $_POST['clear_table'];

//echo '++++-'.$res;

// очистка таблицы table_conf
if ($clear_table == 'table_conf'){
    $query = 'TRUNCATE table_conf';
    $result = $mysqli->query($query);
    if ($result) {
        $answer_server = array('classP' => 'table_conf', 'answerServer' => '<span>Таблица table_conf очищена</span>');
		echo json_encode($answer_server);
        return;
    };
};


// очистка таблицы stat_wins
if ($clear_table == 'stat_wins'){
    $query = 'TRUNCATE stat_wins; ';
    $result = $mysqli->query($query);
    if ($result) {
        $answer_server = array('classP' => 'stat_wins', 'answerServer' => '<span>Таблица stat_wins очищена</span>');
        echo json_encode($answer_server);
        return;
    };
};

// очистка таблиц  stat_puck, stat_allow_puck, stat_penalty, stat_throw, stat_throw_rival, stat_wins
if ($clear_table == 'table_champ'){
    $query = 'TRUNCATE stat_puck; TRUNCATE stat_allow_puck; TRUNCATE stat_penalty; TRUNCATE stat_penalty; TRUNCATE stat_throw; TRUNCATE stat_throw_rival; TRUNCATE stat_wins; ';
    $result = $mysqli->query($query);
    if ($result) {
        $answer_server = '<span>Таблица table_champ очищена</span>';
        //$answer_server = json_encode($answer_server);
        echo $answer_server;
        return;
    };
};


$answer_server = "<span>$clear_table</span>";
echo $answer_server;


?>