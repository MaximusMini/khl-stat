<?php
/*
модуль обновления данных для таблиц 
    stat_goalies    таблица с данными вратарей
    stat_defenders	таблица с данными защитников (https://www.khl.ru/stat/players/468/)
    stat_attacks	таблица с данными нападающих (https://www.khl.ru/stat/players/468/)
*/

// параметры получаемые из leaders.php
//$nameGetFunc = $_GET['nameGetFunc'];
// http://khl-stat/project_1/scripts_php/ajax_php/leaders_update.php?nameGetFunc=truncateTable
$nameGetFunc = $_GET['nameGetFunc'];
$nameGetFunc = $_POST['nameGetFunc'];

include_once('..\..\..\php\phpQuery.php');


$player_stat = array();     // массив для сбора данных вратарей
$defenders_stat = array();  // массив для сбора данных защитников
$attacks_stat = array();    // массив для сбора данных нападающих

$answer=''; // переменная для формирования ответа в вызываемую функцию


// функция очистки таблицы stat_goalies (вратари)
function truncate_stat_goalies(){
    global $answer;
    // подключаем БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
    if($id_connect_DB){
        $query = 'TRUNCATE TABLE stat_goalies';
        $id_connect_DB->query($query);
        $answer = $answer.'<br>Таблица stat_goalies (голкиперы) очищена';
        //echo '<br>Таблица stat_goalies (голкиперы) очищена';
    }
    else{
        echo '<br> соединение с БД не устанолвено';
    }
    return;
} 
// функция очистки таблицы stat_defenders (защитники)
function truncate_stat_defenders(){
    global $answer;
    // подключаем БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
    if($id_connect_DB){
        $query = 'TRUNCATE TABLE stat_defenders';
        $id_connect_DB->query($query);
        $answer = $answer.'<br>Таблица stat_defenders (защитники) очищена';
        //echo '<br>Таблица stat_defenders очищена';
    }
    else{
        echo '<br> соединение с БД не устанолвено';
    }
    return;   
}
// функция очистки таблицы stat_attacks (нападающих)
function truncate_stat_attacks(){
    global $answer; 
    // подключаем БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
    if($id_connect_DB){
        $query = 'TRUNCATE TABLE stat_attacks';
        $id_connect_DB->query($query);
        $answer = $answer.'<br>Таблица stat_attacks (нападающие) очищена';
        //echo '<br>Таблица stat_attacks (нападающие) очищена';
    }
    else{
        echo '<br> соединение с БД не устанолвено';
    }
    return;   
}


// функция получения данных вратарей
function get_date_goalies(){
    global $player_stat, $answer;
    $file = file_get_contents('l.dat');
//    $file = curl_get('https://www.khl.ru/stat/players/468/');
    $file_phpQuery = phpQuery::newDocument($file);
    $result_phpQuery = $file_phpQuery->find('table#goalies_dataTable tr');
    foreach($result_phpQuery as $val){
        //пропускаем строку с заголовками столбцов     
        if ($e<1){$e++;continue;}
        // id игрока
        $id_player = explode('/',pq($val)->find('td:nth-child(1) a')->attr('href'));
        $player_stat[$e]['id_player'] = $id_player[(count($id_player)-2)];
        // ссылка на профиль
        $player_stat[$e]['profile'] = 'https://www.khl.ru'.pq($val)->find('td:nth-child(1) a')->attr('href');
        // ссылка на фото
        $player_stat[$e]['image'] = 'https://www.khl.ru'.pq($val)->find('td:nth-child(1) img')->attr('src');
        // фамилия и имя
        $last_name = explode(' ',trim(pq($val)->find('td:nth-child(1)')->text()))[0];
        $first_name = explode(' ',trim(pq($val)->find('td:nth-child(1)')->text()))[1];
        $player_stat[$e]['last_name'] = $last_name;
        $player_stat[$e]['first_name'] = $first_name;
        // номер игрока
        $player_stat[$e]['number']=trim(pq($val)->find('td:nth-child(2)')->text());
        // клуб
        $player_stat[$e]['club']=substr(trim(pq($val)->find('td:nth-child(3)')->text()),0,6);
        //количество проведеных игр
        $player_stat[$e]['games']=trim(pq($val)->find('td:nth-child(4)')->text());
        //количество выигранных игр
        $player_stat[$e]['games_win']=trim(pq($val)->find('td:nth-child(5)')->text());
        //количество проигранных игр
        $player_stat[$e]['games_loss']=trim(pq($val)->find('td:nth-child(6)')->text());
        //количество игр с буллитами
        $player_stat[$e]['games_bul']=trim(pq($val)->find('td:nth-child(7)')->text());
        //количество бросков в створ ворот
        $player_stat[$e]['throw']=trim(pq($val)->find('td:nth-child(8)')->text());
        //количество пропущенных шайб
        $player_stat[$e]['pucks_off']=trim(pq($val)->find('td:nth-child(9)')->text());
        //количество отраженных бросков
        $player_stat[$e]['throw_off']=trim(pq($val)->find('td:nth-child(10)')->text());
        //процент отраженных бросков
        $player_stat[$e]['throw_off_perc']=trim(pq($val)->find('td:nth-child(11)')->text());
        //коэффициент надежности
        $player_stat[$e]['k_reliab']=trim(pq($val)->find('td:nth-child(12)')->text());
        //количество заброшенных шайб
        $player_stat[$e]['pucks']=trim(pq($val)->find('td:nth-child(13)')->text());
        //количество передач
        $player_stat[$e]['pass']=trim(pq($val)->find('td:nth-child(14)')->text());
        //количество сухих матчей
        $player_stat[$e]['games_null']=trim(pq($val)->find('td:nth-child(15)')->text());
        //штрафное время
        $player_stat[$e]['penalty']=trim(pq($val)->find('td:nth-child(16)')->text());
        //среднее время на площадке за игру (минуты)
        $player_stat[$e]['time_game_m']=explode(':',trim(pq($val)->find('td:nth-child(17)')->text()))[0];
        //среднее время на площадке за игру (секунды)
        $player_stat[$e]['time_game_s']=explode(':',trim(pq($val)->find('td:nth-child(17)')->text()))[1];
        $e++;    
    }
    //echo '<br><h2>Сбор данных заверешен</h2>';
    $answer = '<br>Сбор статистики вратарей заверешен'; 
    return ;
    
}
// функция получения данных защитников
function get_date_defenders(){
    global $defenders_stat,$answer;
    $file = file_get_contents('l.dat');
//    $file = curl_get('https://www.khl.ru/stat/players/468/');
    $file_phpQuery = phpQuery::newDocument($file);
    $result_phpQuery = $file_phpQuery->find('table#defenses_dataTable tr');
    foreach($result_phpQuery as $val){
        //пропускаем строку с заголовками столбцов     
        if ($e<1){$e++;continue;}
        // id игрока
        $id_player = explode('/',pq($val)->find('td:nth-child(1) a')->attr('href'));
        $defenders_stat[$e]['id_player'] = $id_player[(count($id_player)-2)];
        // ссылка на профиль
        $defenders_stat[$e]['profile'] = 'https://www.khl.ru'.pq($val)->find('td:nth-child(1) a')->attr('href');
        // ссылка на фото
        $defenders_stat[$e]['image'] = 'https://www.khl.ru'.pq($val)->find('td:nth-child(1) img')->attr('src');
        // фамилия и имя
        $last_name = explode(' ',trim(pq($val)->find('td:nth-child(1)')->text()))[0];
        $first_name = explode(' ',trim(pq($val)->find('td:nth-child(1)')->text()))[1];
        $defenders_stat[$e]['last_name'] = $last_name;
        $defenders_stat[$e]['first_name'] = $first_name;
        // номер игрока
        $defenders_stat[$e]['number']=trim(pq($val)->find('td:nth-child(2)')->text());
        // клуб
        $defenders_stat[$e]['club']=substr(trim(pq($val)->find('td:nth-child(3)')->text()),0,6);
        //количество проведеных игр
        $defenders_stat[$e]['games']=trim(pq($val)->find('td:nth-child(4)')->text());
        //количество заброшенных шайб
        $defenders_stat[$e]['pucks']=trim(pq($val)->find('td:nth-child(5)')->text());
        //количество передач
        $defenders_stat[$e]['pass']=trim(pq($val)->find('td:nth-child(6)')->text());  
        //количество очков
        $defenders_stat[$e]['scores']=trim(pq($val)->find('td:nth-child(7)')->text());
        //показатели по системе плюс/минус
        $defenders_stat[$e]['plus_minus']=trim(pq($val)->find('td:nth-child(8)')->text());
        //штрафное время
        $defenders_stat[$e]['penalty']=trim(pq($val)->find('td:nth-child(9)')->text());
        //количество шайб в равных составах
        $defenders_stat[$e]['pucks_equal']=trim(pq($val)->find('td:nth-child(10)')->text());
        //количество шайб в большинстве
        $defenders_stat[$e]['pucks_most']=trim(pq($val)->find('td:nth-child(11)')->text());
        //количество шайб в меньшинстве
        $defenders_stat[$e]['pucks_min']=trim(pq($val)->find('td:nth-child(12)')->text());
        //количество шайб в овертаймах
        $defenders_stat[$e]['pucks_ot']=trim(pq($val)->find('td:nth-child(13)')->text());
        //количество победных шайб
        $defenders_stat[$e]['pucks_win']=trim(pq($val)->find('td:nth-child(14)')->text());
        //количество победных булитов
        $defenders_stat[$e]['bullets_win']=trim(pq($val)->find('td:nth-child(15)')->text());
        //количество бросков
        $defenders_stat[$e]['throw']=trim(pq($val)->find('td:nth-child(16)')->text());
        //процент реализации бросков
        $defenders_stat[$e]['throw_percent']=trim(pq($val)->find('td:nth-child(17)')->text());
        //количество бросков за игру
        $defenders_stat[$e]['throw_games']=trim(pq($val)->find('td:nth-child(18)')->text());
        //количество вбрасываний
        $defenders_stat[$e]['faceoff']=trim(pq($val)->find('td:nth-child(19)')->text());
        //количество выигранных вбрасываний
        $defenders_stat[$e]['faceoff_win']=trim(pq($val)->find('td:nth-child(20)')->text());
        //процент выигранных вбрасываний
        $defenders_stat[$e]['faceoff_percent']=trim(pq($val)->find('td:nth-child(21)')->text());
        //среднее время на площадке за игру (минуты)
        $defenders_stat[$e]['time_game_m']=explode(':',trim(pq($val)->find('td:nth-child(22)')->text()))[0];
        //среднее время на площадке за игру (секунды)
        $defenders_stat[$e]['time_game_s']=explode(':',trim(pq($val)->find('td:nth-child(22)')->text()))[1];
        //среднее количество смен за игру
        $defenders_stat[$e]['change_game']=trim(pq($val)->find('td:nth-child(23)')->text());
        //количество силовых приемов
        $defenders_stat[$e]['power_recep']=trim(pq($val)->find('td:nth-child(24)')->text());
        //количество блокированных бросков
        $defenders_stat[$e]['block_throw']=trim(pq($val)->find('td:nth-child(25)')->text());
        //количество фолов на игроке
        $defenders_stat[$e]['fouls_against']=trim(pq($val)->find('td:nth-child(26)')->text());
        //дата и время записи
        //$defenders_stat[$e]['date_wrte']=
        $e++;
        //if($e>10)break;
    }
    $answer = '<br>Сбор статистики защитников заверешен';
//    printArray($defenders_stat);
    return ;
    
}
// функция получения данных нападающих
function get_date_attacks(){
    global $attacks_stat;
    $file = file_get_contents('l.dat');
//    $file = curl_get('https://www.khl.ru/stat/players/468/');
    $file_phpQuery = phpQuery::newDocument($file);
    $result_phpQuery = $file_phpQuery->find('table#forwards_dataTable tr');
    foreach($result_phpQuery as $val){
        //пропускаем строку с заголовками столбцов     
        if ($e<1){$e++;continue;}
        // id игрока
        $id_player = explode('/',pq($val)->find('td:nth-child(1) a')->attr('href'));
        $attacks_stat[$e]['id_player'] = $id_player[(count($id_player)-2)];
        // ссылка на профиль
        $attacks_stat[$e]['profile'] = 'https://www.khl.ru'.pq($val)->find('td:nth-child(1) a')->attr('href');
        // ссылка на фото
        $attacks_stat[$e]['image'] = 'https://www.khl.ru'.pq($val)->find('td:nth-child(1) img')->attr('src');
        // фамилия и имя
        $last_name = explode(' ',trim(pq($val)->find('td:nth-child(1)')->text()))[0];
        $first_name = explode(' ',trim(pq($val)->find('td:nth-child(1)')->text()))[1];
        $attacks_stat[$e]['last_name'] = $last_name;
        $attacks_stat[$e]['first_name'] = $first_name;
        // номер игрока
        $attacks_stat[$e]['number']=trim(pq($val)->find('td:nth-child(2)')->text());
        // клуб
        $attacks_stat[$e]['club']=substr(trim(pq($val)->find('td:nth-child(3)')->text()),0,6);
        //количество проведеных игр
        $attacks_stat[$e]['games']=trim(pq($val)->find('td:nth-child(4)')->text());
        //количество заброшенных шайб
        $attacks_stat[$e]['pucks']=trim(pq($val)->find('td:nth-child(5)')->text());
        //количество передач
        $attacks_stat[$e]['pass']=trim(pq($val)->find('td:nth-child(6)')->text());  
        //количество очков
        $attacks_stat[$e]['scores']=trim(pq($val)->find('td:nth-child(7)')->text());
        //показатели по системе плюс/минус
        $attacks_stat[$e]['plus_minus']=trim(pq($val)->find('td:nth-child(8)')->text());
        //штрафное время
        $attacks_stat[$e]['penalty']=trim(pq($val)->find('td:nth-child(9)')->text());
        //количество шайб в равных составах
        $attacks_stat[$e]['pucks_equal']=trim(pq($val)->find('td:nth-child(10)')->text());
        //количество шайб в большинстве
        $attacks_stat[$e]['pucks_most']=trim(pq($val)->find('td:nth-child(11)')->text());
        //количество шайб в меньшинстве
        $attacks_stat[$e]['pucks_min']=trim(pq($val)->find('td:nth-child(12)')->text());
        //количество шайб в овертаймах
        $attacks_stat[$e]['pucks_ot']=trim(pq($val)->find('td:nth-child(13)')->text());
        //количество победных шайб
        $attacks_stat[$e]['pucks_win']=trim(pq($val)->find('td:nth-child(14)')->text());
        //количество победных булитов
        $attacks_stat[$e]['bullets_win']=trim(pq($val)->find('td:nth-child(15)')->text());
        //количество бросков
        $attacks_stat[$e]['throw']=trim(pq($val)->find('td:nth-child(16)')->text());
        //процент реализации бросков
        $attacks_stat[$e]['throw_percent']=trim(pq($val)->find('td:nth-child(17)')->text());
        //количество бросков за игру
        $attacks_stat[$e]['throw_games']=trim(pq($val)->find('td:nth-child(18)')->text());
        //количество вбрасываний
        $attacks_stat[$e]['faceoff']=trim(pq($val)->find('td:nth-child(19)')->text());
        //количество выигранных вбрасываний
        $attacks_stat[$e]['faceoff_win']=trim(pq($val)->find('td:nth-child(20)')->text());
        //процент выигранных вбрасываний
        $attacks_stat[$e]['faceoff_percent']=trim(pq($val)->find('td:nth-child(21)')->text());
        //среднее время на площадке за игру (минуты)
        $attacks_stat[$e]['time_game_m']=explode(':',trim(pq($val)->find('td:nth-child(22)')->text()))[0];
        //среднее время на площадке за игру (секунды)
        $attacks_stat[$e]['time_game_s']=explode(':',trim(pq($val)->find('td:nth-child(22)')->text()))[1];
        //среднее количество смен за игру
        $attacks_stat[$e]['change_game']=trim(pq($val)->find('td:nth-child(23)')->text());
        //количество силовых приемов
        $attacks_stat[$e]['power_recep']=trim(pq($val)->find('td:nth-child(24)')->text());
        //количество блокированных бросков
        $attacks_stat[$e]['block_throw']=trim(pq($val)->find('td:nth-child(25)')->text());
        //количество фолов на игроке
        $attacks_stat[$e]['fouls_against']=trim(pq($val)->find('td:nth-child(26)')->text());
        //дата и время записи
        //$attacks_stat[$e]['date_wrte']=
        $e++;
        //if($e>10)break;
    }
}


// функция записи данных вратарей в БД
function write_date_goalies(){
    global $player_stat, $answer;
    // подключаем БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
    if($id_connect_DB){
        for($count=1; $count<count($player_stat); $count++){
                // формирования запроса на добавление данных
                $query = 'INSERT INTO stat_goalies (id_player, profile, image, last_name, first_name , number, club, games, games_win, games_loss, games_bul, throw, pucks_off, throw_off, throw_off_perc, k_reliab, pucks, pass, games_null, penalty, time_game_m, time_game_s ) VALUES('.$player_stat[$count]['id_player'].',\''.$player_stat[$count]['profile'].'\',\''.$player_stat[$count]['image'].'\',\''.$player_stat[$count]['last_name'].'\',\''.$player_stat[$count]['first_name'].'\',\''.$player_stat[$count]['number'].'\',\''.$player_stat[$count]['club'].'\',\''.$player_stat[$count]['games'].'\',\''.$player_stat[$count]['games_win'].'\',\''.$player_stat[$count]['games_loss'].'\',\''.$player_stat[$count]['games_bul'].'\',\''.$player_stat[$count]['throw'].'\',\''.$player_stat[$count]['pucks_off'].'\',\''.$player_stat[$count]['throw_off'].'\',\''.$player_stat[$count]['throw_off_perc'].'\',\''.$player_stat[$count]['k_reliab'].'\',\''.$player_stat[$count]['pucks'].'\',\''.$player_stat[$count]['pass'].'\',\''.$player_stat[$count]['games_null'].'\',\''.$player_stat[$count]['penalty'].'\',\''.$player_stat[$count]['time_game_m'].'\',\''.$player_stat[$count]['time_game_s'].'\')';
                // добавление данных в БД
                //echo '<br>'.$query.';';
                //echo '<br>------------------------------------------------';
                $id_connect_DB->query($query);
                //------------------------------------------------------------------
            }
    } 
    else{
        echo '<br> соединение с БД не устанолвено';
        $answer = '<br>Ошибка записи статистики вратарей в БД';
    }
    //echo '<br>Данные в таблицу stat_goalies занесены';
    $answer = '<br>Запись статистики вратарей в БД заверешен';
    return;
}
// функция записи данных защитников в БД
function write_date_defenders(){
   global $defenders_stat, $answer;
    // подключаем БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
    if($id_connect_DB){
        for($count=1; $count<=count($defenders_stat); $count++){
                // формирования запроса на добавление данных
                $query = 'INSERT INTO stat_defenders(num, id_player, profile, image, last_name, first_name, number, club, games, pucks, pass, scores, plus_minus, penalty, pucks_equal, pucks_most, pucks_min, pucks_ot, pucks_win, bullets_win, throw, throw_percent, throw_games, faceoff, faceoff_win, faceoff_percent, time_game_m, time_game_s, change_game, power_recep, block_throw, fouls_against, date_wrte) 
                VALUES ('
                .$count.','
                .$defenders_stat[$count]['id_player'].',\''
                .$defenders_stat[$count]['profile'].'\',\''
                .$defenders_stat[$count]['image'].'\',\''
                .$defenders_stat[$count]['last_name'].'\',\''
                .$defenders_stat[$count]['first_name'].'\',\''
                .$defenders_stat[$count]['number'].'\',\''
                .$defenders_stat[$count]['club'].'\',\''
                .$defenders_stat[$count]['games'].'\',\''
                .$defenders_stat[$count]['pucks'].'\',\''
                .$defenders_stat[$count]['pass'].'\',\''
                .$defenders_stat[$count]['scores'].'\',\''
                .$defenders_stat[$count]['plus_minus'].'\',\''
                .$defenders_stat[$count]['penalty'].'\',\''
                .$defenders_stat[$count]['pucks_equal'].'\',\''
                .$defenders_stat[$count]['pucks_most'].'\',\''
                .$defenders_stat[$count]['pucks_min'].'\',\''
                .$defenders_stat[$count]['pucks_ot'].'\',\''
                .$defenders_stat[$count]['pucks_win'].'\',\''
                .$defenders_stat[$count]['bullets_win'].'\',\''
                .$defenders_stat[$count]['throw'].'\',\''
                .$defenders_stat[$count]['throw_percent'].'\',\''
                .$defenders_stat[$count]['throw_games'].'\',\''
                .$defenders_stat[$count]['faceoff'].'\',\''
                .$defenders_stat[$count]['faceoff_win'].'\',\''
                .$defenders_stat[$count]['faceoff_percent'].'\',\''
                .$defenders_stat[$count]['time_game_m'].'\',\''
                .$defenders_stat[$count]['time_game_s'].'\',\''
                .$defenders_stat[$count]['change_game'].'\',\''
                .$defenders_stat[$count]['power_recep'].'\',\''
                .$defenders_stat[$count]['block_throw'].'\',\''
                .$defenders_stat[$count]['fouls_against'].'\','
                .'NOW()'.')';
                // добавление данных в БД
                //echo '<br>'.$query.';';
                //echo '<br>------------------------------------------------';
                $id_connect_DB->query($query);
                //------------------------------------------------------------------
            }
    } 
    else{
        //echo '<br> соединение с БД не установлено';
        $answer = '<br>Ошибка записи статистики защитников в БД';
    }
    //echo '<br>Данные в таблицу stat_defenders занесены';
    $answer = '<br>Запись статистики защитников в БД заверешен';
    return; 
}
// функция записи данных нападающих в БД
function write_date_attacks(){global $attacks_stat;
    global $answer;
    // подключаем БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
    if($id_connect_DB){
        for($count=1; $count<=count($attacks_stat); $count++){
                // формирования запроса на добавление данных
                $query = 'INSERT INTO stat_attacks (num, id_player, profile, image, last_name, first_name, number, club, games, pucks, pass, scores, plus_minus, penalty, pucks_equal, pucks_most, pucks_min, pucks_ot, pucks_win, bullets_win, throw, throw_percent, throw_games, faceoff, faceoff_win, faceoff_percent, time_game_m, time_game_s, change_game, power_recep, block_throw, fouls_against, date_wrte) 
                VALUES ('
                .$count.','
                .$attacks_stat[$count]['id_player'].',\''
                .$attacks_stat[$count]['profile'].'\',\''
                .$attacks_stat[$count]['image'].'\',\''
                .$attacks_stat[$count]['last_name'].'\',\''
                .$attacks_stat[$count]['first_name'].'\',\''
                .$attacks_stat[$count]['number'].'\',\''
                .$attacks_stat[$count]['club'].'\',\''
                .$attacks_stat[$count]['games'].'\',\''
                .$attacks_stat[$count]['pucks'].'\',\''
                .$attacks_stat[$count]['pass'].'\',\''
                .$attacks_stat[$count]['scores'].'\',\''
                .$attacks_stat[$count]['plus_minus'].'\',\''
                .$attacks_stat[$count]['penalty'].'\',\''
                .$attacks_stat[$count]['pucks_equal'].'\',\''
                .$attacks_stat[$count]['pucks_most'].'\',\''
                .$attacks_stat[$count]['pucks_min'].'\',\''
                .$attacks_stat[$count]['pucks_ot'].'\',\''
                .$attacks_stat[$count]['pucks_win'].'\',\''
                .$attacks_stat[$count]['bullets_win'].'\',\''
                .$attacks_stat[$count]['throw'].'\',\''
                .$attacks_stat[$count]['throw_percent'].'\',\''
                .$attacks_stat[$count]['throw_games'].'\',\''
                .$attacks_stat[$count]['faceoff'].'\',\''
                .$attacks_stat[$count]['faceoff_win'].'\',\''
                .$attacks_stat[$count]['faceoff_percent'].'\',\''
                .$attacks_stat[$count]['time_game_m'].'\',\''
                .$attacks_stat[$count]['time_game_s'].'\',\''
                .$attacks_stat[$count]['change_game'].'\',\''
                .$attacks_stat[$count]['power_recep'].'\',\''
                .$attacks_stat[$count]['block_throw'].'\',\''
                .$attacks_stat[$count]['fouls_against'].'\','
                .'NOW()'.')';
                // добавление данных в БД
                //echo '<br>'.$query.';';
                //echo '<br>------------------------------------------------';
                $id_connect_DB->query($query);
                //------------------------------------------------------------------
            }
    } 
    else{
        echo '<br> соединение с БД не устанолвено';
    }
    $answer = '<br>Запись статистики нападающих в БД заверешен';
    return; 
}


// функция вывода изображений игроков
function pic_img(){
   global $player_stat;
    for($r=1; $r<=count($player_stat);$r++){
        echo '<img src="'.$player_stat[$r]["image"].'">';
    }
    
}
// функция формирования ответа на Ajax запрос
function answerAjax(){
    global $answer, $nameGetFunc;
    $arr = ['answer'=>$answer, 'nameGetFunc'=>$nameGetFunc];
    $arr = json_encode($arr);
    echo $arr; 
}



// вызовы функций ***********************************************************
    //$start = microtime(true);
    //http://khl-stat/project_1/scripts_php/ajax_php/leaders_update.php?nameGetFunc=getDateDefenders
    // очитка таблиц
    if($nameGetFunc == 'truncateTable' ){
        truncate_stat_goalies();
        truncate_stat_defenders();
        truncate_stat_attacks();
        answerAjax();
    };
    // получение и запись статистики вратарей
    if ($nameGetFunc == 'getDateGoalies'){
        get_date_goalies();
        write_date_goalies();
        answerAjax();
    }
    // получение и запись статистики защитников
    if ($nameGetFunc == 'getDateDefenders'){
        get_date_defenders();
        write_date_defenders();
        answerAjax();
    }
    // получение и запись статистики нападающих
    if($nameGetFunc == 'getDateAttacks'){
        get_date_attacks();
        write_date_attacks();
        $nameGetFunc = 'end';
        answerAjax();
    }

    
//    truncate_stat_goalies();
//    truncate_stat_attacks();
//    get_date_attacks();
//    write_date_attacks();
//    truncate_stat_defenders();
//    get_date_defenders();
//    write_date_defenders();
//    printArray($attacks_stat);
    //echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.';

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