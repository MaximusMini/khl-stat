<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../php/link.php'); ?>
    <meta charset="UTF-8">
    <title>Данные champ</title>
</head>
<body style='padding-top: 70px'>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <a href="main.php" class="btn btn-info">на главную</a>
        </div>
    </nav>
    <div class="container">
        <div class="col-md-6">
            <a href="main.php" class="btn btn-info">на главную</a>
            <p></p>  
        </div>
        <div class="col-md-6">

        </div>
    </div> 
    
</body>
</html>


<?php
include_once('..\php\phpQuery.php');


// массив с сылками на статистику команд
$link_stat_team = [
        ['id_team'=>'1', 'name' => 'Авангард',      'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99237/tstat.html'],
        ['id_team'=>'2', 'name' => 'Автомобилист',  'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99225/tstat.html'],
        ['id_team'=>'3', 'name' => 'Адмирал',       'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99239/tstat.html'],
        ['id_team'=>'4', 'name' => 'Ак Барс',       'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99227/tstat.html'],
        ['id_team'=>'5', 'name' => 'Амур',          'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99241/tstat.html'],
        
        ['id_team'=>'6', 'name' => 'Барыс',         'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99243/tstat.html'],
        ['id_team'=>'7', 'name' => 'Витязь',        'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99213/tstat.html'],
        ['id_team'=>'8', 'name' => 'Динамо М',      'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99201/tstat.html'],
        ['id_team'=>'9', 'name' => 'Динамо Мн',     'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99215/tstat.html'],
        ['id_team'=>'10', 'name' => 'Динамо Р',     'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99203/tstat.html'],
        
        ['id_team'=>'11', 'name' => 'Йокерит',      'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99205/tstat.html'],
        ['id_team'=>'12', 'name' => 'Куньлунь РС',  'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99245/tstat.html'],
        ['id_team'=>'13', 'name' => 'Локомотив',    'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99217/tstat.html'],
        ['id_team'=>'14', 'name' => 'Металлург Мг', 'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99217/tstat.html'],
        ['id_team'=>'15', 'name' => 'Нефтехимик',   'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99231/tstat.html'],
        
        ['id_team'=>'16', 'name' => 'Салават Юлаев', 'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99247/tstat.html'],
        ['id_team'=>'17', 'name' => 'Северсталь',   'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99207/tstat.html'],
        ['id_team'=>'18', 'name' => 'Сибирь',       'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99249/tstat.html'],
        ['id_team'=>'19', 'name' => 'СКА',          'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99209/tstat.html'],
        ['id_team'=>'20', 'name' => 'Слован',       'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99219/tstat.html'],
        
        ['id_team'=>'21', 'name' => 'Спартак',      'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99211/tstat.html'],
        ['id_team'=>'22', 'name' => 'Торпедо',      'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99233/tstat.html'],
        ['id_team'=>'23', 'name' => 'Трактор',      'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99235/tstat.html'],
        ['id_team'=>'24', 'name' => 'ХК Сочи',      'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99221/tstat.html'],
        ['id_team'=>'25', 'name' => 'ЦСКА',         'linl'=>'https://www.championat.com/hockey/_superleague/2593/team/99223/tstat.html'],
];

// дескриптор подключения к БД
$id_connect_DB;

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
	};


// функция подключения к БД, выбора ссылки и запуска парсинга
function link_go($arr){
    // подключение к БД
    global $id_connect_DB;
    // очистка таблиц
    truncate_table();
    $id_connect_DB = new mysqli('localhost', 'root', '', 'khl_stat_2018');
    if($id_connect_DB){
       foreach($arr as $data){
            // получаем ссылку и передаем её для парсинга
            $_link = $data['linl'];
            echo '<br>начало парсинга команды '.$data['name'];
            //echo '<br>ссылка '.$_link;
            pars_stat_team($data);
            echo '<br>конец парсинга команды '.$data['name'];
           //break;
        } 
    }else{
        echo '<br> соединение с БД не установлено';
    }
    // закрытие подключения к БД
    mysqli_close($id_connect_DB);
}


// функция парсинга страницы
function pars_stat_team($data_team){
    // запрос страницы
    $data_stat_team = curl_get ($data_team['linl']);
    //создание объекта phpQuery
    $doc_Dom = phpQuery::newDocument($data_stat_team);
    // парсинг страницы в массив $stat_team
     //----------------------------------------
    // заброшенные шайбы
    $stat_team['throw_puck'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(2)')->text();
    $stat_team['throw_puck_average'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(3)')->text();
    $stat_team['throw_puck_home'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(4)')->text();    
    $stat_team['throw_puck_home_average'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(5)')->text();
    $stat_team['throw_puck_guest'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(6)')->text();    
    $stat_team['throw_puck_guest_average'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(7)')->text();
    // пропущенные шайбы
    $stat_team['allow_puck'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(2)')->text();
    $stat_team['allow_puck_average'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(3)')->text();
    $stat_team['allow_puck_home'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(4)')->text();    
    $stat_team['allow_puck_average_home'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(5)')->text();
    $stat_team['allow_puck_guest'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(6)')->text();    
    $stat_team['allow_puck_average_guest'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(7)')->text();
    // штрафное время
    $stat_team['penalty_time'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(2)')->text();
    $stat_team['penalty_time_average'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(3)')->text();
    if ($doc_Dom->find('tr:nth-child(15) td:nth-child(4)')->text() == NULL){
        $stat_team['penalty_time_home'] = 0;  
    }else{
        $stat_team['penalty_time_home'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(4)')->text(); 
    }  
    $stat_team['penalty_time_average_home'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(5)')->text();
    
    if ($doc_Dom->find('tr:nth-child(15) td:nth-child(6)')->text() == NULL){
        $stat_team['penalty_time_guest'] = 0;  
    }else{
        $stat_team['penalty_time_guest'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(6)')->text(); 
    }   
    $stat_team['penalty_time_average_guest'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(7)')->text();
    // броски по воротам
    $stat_team['total_throw'] = check_value($doc_Dom->find('tr:nth-child(19) td:nth-child(2)')->text());
    $stat_team['total_throw_average'] = check_value($doc_Dom->find('tr:nth-child(19) td:nth-child(3)')->text());
    $stat_team['total_throw_home'] = check_value($doc_Dom->find('tr:nth-child(19) td:nth-child(4)')->text());    
    $stat_team['total_throw_average_home'] = check_value($doc_Dom->find('tr:nth-child(19) td:nth-child(5)')->text());
    $stat_team['total_throw_guest'] = check_value($doc_Dom->find('tr:nth-child(19) td:nth-child(6)')->text());    
    $stat_team['total_throw_average_guest'] = check_value($doc_Dom->find('tr:nth-child(19) td:nth-child(7)')->text());
    // броски соперника по воротам 
    $stat_team['throw_rival'] = check_value($doc_Dom->find('tr:nth-child(20) td:nth-child(2)')->text());
    $stat_team['throw_rival_average'] = check_value($doc_Dom->find('tr:nth-child(20) td:nth-child(3)')->text());
    $stat_team['throw_rival_home'] = check_value($doc_Dom->find('tr:nth-child(20) td:nth-child(4)')->text());    
    $stat_team['throw_rival_average_home'] = check_value($doc_Dom->find('tr:nth-child(20) td:nth-child(5)')->text());
    $stat_team['throw_rival_guest'] = check_value($doc_Dom->find('tr:nth-child(20) td:nth-child(6)')->text());    
    $stat_team['throw_rival_average_guest'] = check_value($doc_Dom->find('tr:nth-child(20) td:nth-child(7)')->text());
    // реализация бросков
    $stat_team['throw_perc_total'] = check_value(del_last_word($doc_Dom->find('tr:nth-child(21) td:nth-child(2)')->text()));
    $stat_team['throw_perc_home'] = check_value(del_last_word($doc_Dom->find('tr:nth-child(21) td:nth-child(3)')->text()));
    $stat_team['throw_perc_guest'] = check_value(del_last_word($doc_Dom->find('tr:nth-child(21) td:nth-child(4)')->text()));    
    $stat_team['throw_rival_perc_total'] = check_value(del_last_word($doc_Dom->find('tr:nth-child(22) td:nth-child(2)')->text()));
    $stat_team['throw_rival_perc_home'] = check_value(del_last_word($doc_Dom->find('tr:nth-child(22) td:nth-child(3)')->text()));    
    $stat_team['throw_rival_perc_guest'] = check_value(del_last_word($doc_Dom->find('tr:nth-child(22) td:nth-child(4)')->text()));
    // вбрасывания
    $stat_team['faceoff_total'] = $doc_Dom->find('tr:nth-child(23) td:nth-child(2)')->text();
    $stat_team['faceoff_home'] = $doc_Dom->find('tr:nth-child(23) td:nth-child(3)')->text();
    $stat_team['faceoff_guest'] = $doc_Dom->find('tr:nth-child(23) td:nth-child(4)')->text();   
    $stat_team['faceoff_perc_wins_total'] = del_last_word($doc_Dom->find('tr:nth-child(24) td:nth-child(2)')->text());
    $stat_team['faceoff_perc_wins_home'] = del_last_word($doc_Dom->find('tr:nth-child(24) td:nth-child(3)')->text());    
    $stat_team['faceoff_perc_wins_guest'] = del_last_word($doc_Dom->find('tr:nth-child(24) td:nth-child(4)')->text());
    $stat_team['faceoff_perc_wins_rival_total'] = del_last_word($doc_Dom->find('tr:nth-child(25) td:nth-child(2)')->text());
    $stat_team['faceoff_perc_wins_rival_home'] = del_last_word($doc_Dom->find('tr:nth-child(25) td:nth-child(3)')->text());    
    $stat_team['faceoff_perc_wins_rival_guest'] = del_last_word($doc_Dom->find('tr:nth-child(25) td:nth-child(4)')->text());
    // победы команды
    $stat_team['clear_wins'] = $doc_Dom->find('tr:nth-child(4) td:nth-child(2):first')->text();
    $stat_team['clear_wins_home'] = $doc_Dom->find('tr:nth-child(4) td:nth-child(4)')->text();
    $stat_team['clear_wins_guest'] = $doc_Dom->find('tr:nth-child(4) td:nth-child(6)')->text();
    $stat_team['ot_wins'] = $doc_Dom->find('tr:nth-child(5) td:nth-child(2):first')->text();
    $stat_team['ot_wins_home'] = $doc_Dom->find('tr:nth-child(5) td:nth-child(4)')->text();  
    $stat_team['ot_wins_guest'] = $doc_Dom->find('tr:nth-child(5) td:nth-child(6)')->text();
    $stat_team['b_wins'] = $doc_Dom->find('tr:nth-child(6) td:nth-child(2):first')->text();
    $stat_team['b_wins_home'] = $doc_Dom->find('tr:nth-child(6) td:nth-child(4)')->text();  
    $stat_team['b_wins_guest'] = $doc_Dom->find('tr:nth-child(6) td:nth-child(6)')->text();
    // поражения команды
    $stat_team['clear_loss'] = $doc_Dom->find('tr:nth-child(10) td:nth-child(2):first')->text();
    $stat_team['clear_loss_home'] = $doc_Dom->find('tr:nth-child(10) td:nth-child(4)')->text();
    $stat_team['clear_loss_guest'] = $doc_Dom->find('tr:nth-child(10) td:nth-child(6)')->text();
    $stat_team['ot_loss'] = $doc_Dom->find('tr:nth-child(9) td:nth-child(2):first')->text();
    $stat_team['ot_loss_home'] = $doc_Dom->find('tr:nth-child(9) td:nth-child(4)')->text();  
    $stat_team['ot_loss_guest'] = $doc_Dom->find('tr:nth-child(9) td:nth-child(6)')->text();
    $stat_team['b_loss'] = $doc_Dom->find('tr:nth-child(8) td:nth-child(2):first')->text();
    $stat_team['b_loss_home'] = $doc_Dom->find('tr:nth-child(8) td:nth-child(4)')->text();  
    $stat_team['b_loss_guest'] = $doc_Dom->find('tr:nth-child(8) td:nth-child(6)')->text();
    
    
    echo printArray($stat_team);
    
    // вызов функции записи в БД
    
    write_stat($stat_team, $data_team['id_team'], $data_team['name']);
  
}

// функция записи данных в БД
function write_stat($stat_team,$id_team, $name){
    // обяъвление глобального дескриптора подключения к БД
    global $id_connect_DB;
    

    // формирования запроса на добавление данных о заброшенных шайбах - stat_puck
    $query_1 = 'INSERT INTO stat_puck (id_team, name , throw_puck, throw_puck_home, throw_puck_guest, throw_puck_average, throw_puck_average_home, throw_puck_average_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['throw_puck'].','.$stat_team['throw_puck_home'].','.$stat_team['throw_puck_guest'].','.str_replace(',','.',$stat_team['throw_puck_average']).','.str_replace(',','.',$stat_team['throw_puck_home_average']).','.str_replace(',','.',$stat_team['throw_puck_guest_average']).')';
    // добавление данных в БД
    $id_connect_DB->query($query_1);
    //------------------------------------------------------------------
    // формирования запроса на добавление данных о пропущенных шайбах - stat_allow_puck
    $query_2 = 'INSERT INTO stat_allow_puck (id_team, name , allow_puck, allow_puck_home, allow_puck_guest, allow_puck_average, allow_puck_average_home, allow_puck_average_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['allow_puck'].','.$stat_team['allow_puck_home'].','.$stat_team['allow_puck_guest'].','.str_replace(',','.',$stat_team['allow_puck_average']).','.str_replace(',','.',$stat_team['allow_puck_average_home']).','.str_replace(',','.',$stat_team['allow_puck_average_guest']).')';
    // добавление данных в БД
    //echo '<br>'.$query_2;
    $id_connect_DB->query($query_2);
    //------------------------------------------------------------------
    // формирования запроса на добавление данных о штрафном времени - stat_penalty
    $query_3 = 'INSERT INTO stat_penalty (id_team, name , penalty_time, penalty_time_home, penalty_time_guest, penalty_time_average, penalty_time_average_home, penalty_time_average_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['penalty_time'].','.$stat_team['penalty_time_home'].','.$stat_team['penalty_time_guest'].','.str_replace(',','.',$stat_team['penalty_time_average']).','.str_replace(',','.',$stat_team['penalty_time_average_home']).','.str_replace(',','.',$stat_team['penalty_time_average_guest']).')';
    // добавление данных в БД
    echo '<br>'.$query_3;
    $id_connect_DB->query($query_3);
    //------------------------------------------------------------------
    // формирования запроса на добавление данных о бросках по воротам - stat_throw
    $query_4 = 'INSERT INTO stat_throw (id_team, name , total_throw, total_throw_home, total_throw_guest, total_throw_average, total_throw_average_home, total_throw_average_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['total_throw'].','.$stat_team['total_throw_home'].','.$stat_team['total_throw_guest'].','.str_replace(',','.',$stat_team['total_throw_average']).','.str_replace(',','.',$stat_team['total_throw_average_home']).','.str_replace(',','.',$stat_team['total_throw_average_guest']).')';
    // добавление данных в БД
    //echo '<br>'.$query_4;
    $id_connect_DB->query($query_4);
    //------------------------------------------------------------------
    // формирования запроса на добавление данных о бросках соперника по воротам - stat_throw_rival
    $query_5 = 'INSERT INTO stat_throw_rival (id_team, name , throw_rival, throw_rival_home, throw_rival_guest, throw_rival_average, throw_rival_average_home, throw_rival_average_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['throw_rival'].','.$stat_team['throw_rival_home'].','.$stat_team['throw_rival_guest'].','.str_replace(',','.',$stat_team['throw_rival_average']).','.str_replace(',','.',$stat_team['throw_rival_average_home']).','.str_replace(',','.',$stat_team['throw_rival_average_guest']).')';
    // добавление данных в БД
    //echo '<br>'.$query_5;
    $id_connect_DB->query($query_5);
    //------------------------------------------------------------------
    // формирования запроса на добавление данных о победах команды - stat_wins
    $query_6 = 'INSERT INTO stat_wins (id_team, name, clear_wins, clear_wins_home, clear_wins_guest, ot_wins, ot_wins_home, ot_wins_guest, b_wins, b_wins_home, b_wins_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['clear_wins'].','.$stat_team['clear_wins_home'].','.$stat_team['clear_wins_guest'].','.$stat_team['ot_wins'].','.$stat_team['ot_wins_home'].','.$stat_team['ot_wins_guest'].','.$stat_team['b_wins'].','.$stat_team['b_wins_home'].','.$stat_team['b_wins_guest'].')';
    // добавление данных в БД
    //echo '<br>'.$query_6;
    $id_connect_DB->query($query_6);
    //------------------------------------------------------------------
    // формирования запроса на добавление данных о реализации бросков команды и соперником - stat_trow_percent
    $query_7 = 'INSERT INTO stat_trow_percent (id_team, name, throw_perc_total, throw_perc_home, throw_perc_guest, throw_rival_perc_total, throw_rival_perc_home, throw_rival_perc_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['throw_perc_total'].','.$stat_team['throw_perc_home'].','.$stat_team['throw_perc_guest'].','.$stat_team['throw_rival_perc_total'].','.$stat_team['throw_rival_perc_home'].','.$stat_team['throw_rival_perc_guest'].')';
    // добавление данных в БД
    //echo '<br>'.$query_7;
    $id_connect_DB->query($query_7);
    //------------------------------------------------------------------
    // формирования запроса на добавление данных о вбрасываниях - stat_faceoff
    $query_8 = 'INSERT INTO stat_faceoff (id_team, name, faceoff_total, faceoff_home, faceoff_guest, faceoff_perc_wins_total, faceoff_perc_wins_home, faceoff_perc_wins_guest, faceoff_perc_wins_rival_total, faceoff_perc_wins_rival_home, faceoff_perc_wins_rival_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['faceoff_total'].','.$stat_team['faceoff_home'].','.$stat_team['faceoff_guest'].','.$stat_team['faceoff_perc_wins_total'].','.$stat_team['faceoff_perc_wins_home'].','.$stat_team['faceoff_perc_wins_guest'].','.$stat_team['faceoff_perc_wins_rival_total'].','.$stat_team['faceoff_perc_wins_rival_home'].','.$stat_team['faceoff_perc_wins_rival_guest'].')';
    // добавление данных в БД
    //echo '<br>'.$query_7;
    $id_connect_DB->query($query_8);
    //------------------------------------------------------------------
    // формирования запроса на добавление данных о поражениях команды - stat_loss
    $query_9 = 'INSERT INTO stat_loss (id_team, name, clear_loss, clear_loss_home, clear_loss_guest, ot_loss, ot_loss_home, ot_loss_guest, b_loss, b_loss_home, b_loss_guest) VALUES ('.$id_team.',\''.$name.'\','.$stat_team['clear_loss'].','.$stat_team['clear_loss_home'].','.$stat_team['clear_loss_guest'].','.$stat_team['ot_loss'].','.$stat_team['ot_loss_home'].','.$stat_team['ot_loss_guest'].','.$stat_team['b_loss'].','.$stat_team['b_loss_home'].','.$stat_team['b_loss_guest'].')';
    // добавление данных в БД
    //echo '<br>'.$query_6;
    $id_connect_DB->query($query_9);
    //------------------------------------------------------------------
}

// функция очистки таблиц
function truncate_table(){
    // подключение к БД
    global $id_connect_DB;
    $id_connect_DB = new mysqli('localhost', 'root', '', 'khl_stat_2018');
    if($id_connect_DB){
        // массив таблиц
        $arr_table = ['stat_puck', 'stat_allow_puck', 'stat_penalty', 'stat_throw', 'stat_throw_rival', 'stat_wins', 'stat_trow_percent', 'stat_faceoff', 'stat_loss'];
        for($i=0; $i<count($arr_table)+1; $i++){
            // запрос на очистку таблицы
            $query_truncate = 'TRUNCATE TABLE '.$arr_table[$i];
            echo '<br>таблица'.$arr_table[$i].' очищена';
            // выполнение запроса
            $id_connect_DB->query($query_truncate);
        }
        
       
        /*
        TRUNCATE TABLE stat_puck;
        TRUNCATE TABLE stat_allow_puck;
        TRUNCATE TABLE stat_penalty;
        TRUNCATE TABLE stat_throw;
        TRUNCATE TABLE stat_throw_rival;
        TRUNCATE TABLE stat_wins;
        TRUNCATE TABLE stat_trow_percent;
        TRUNCATE TABLE stat_faceoff;
        TRUNCATE TABLE stat_loss;
        */
    }else{
        echo '<br> соединение с БД не установлено';
    }
    // закрытие подключения к БД
    mysqli_close($id_connect_DB);
}


// вызовы функций ***********************************************************
    link_go($link_stat_team);
    //pars_stat_team('https://www.championat.com/hockey/_superleague/2202/team/63634/tstat.html');
// **************************************************************************






// вспомогательная функция
function ghj(){
$arr_t = ["Авангард","Автомобилист","Адмирал","Ак Барс","Амур","Барыс","Витязь","Динамо М","Динамо Мн","Динамо Р","Йокерит","Куньлунь РС","Лада","Локомотив","Металлург Мг","Нефтехимик","Салават Юлаев","Северсталь","Сибирь","СКА","Слован","ХК Сочи","Спарта","Торпедо","Трактор","ЦСКА","Югра"];

for ($i=1; $i<28; $i++){
    $ss = $arr_t[$i-1];
    echo "<br>['id_team'=>'$i', 'name' => '$ss', 'linl'=>''],";
}
}

function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}

// функция удаления последнего символа
function del_last_word($word){
    return substr($word, 0, -1);
}

// функция проверки наличия данных в ячейке таблицы
function check_value($str){
    if($str == NULL){
        $str = 0;       
    }else{
        $str = $str;       
    }
    return $str;
}





?>