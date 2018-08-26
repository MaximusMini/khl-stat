<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../php/link.php'); ?>
    <meta charset="UTF-8">
    <title>Парсинг результатов</title>

<style>
h4, h5, h6 {
    margin-top: 0px;
    margin-bottom: 0px;
}
</style>

</head>
<body class='container' style='padding-top: 70px'>
     <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container" style="margin-top:10px">
            <a href="main.php" class="btn btn-info">на главную</a>
        </div>
    </nav>

</body>
</html>




<?php
include_once('..\php\phpQuery.php');

/*

массив $result_team
    



*/



// массив с сылками страниц для парсинга
$link_results_team = [
        ['id_team'=>'1', 'name' => 'Авангард', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63634/result.html'],
        ['id_team'=>'2', 'name' => 'Автомобилист', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63280/result.html'],
        ['id_team'=>'3', 'name' => 'Адмирал', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63636/result.html'],
        ['id_team'=>'4', 'name' => 'Ак Барс', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63282/result.html'],
        ['id_team'=>'5', 'name' => 'Амур', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63638/result.html'],
        ['id_team'=>'6', 'name' => 'Барыс', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63640/result.html'],
        ['id_team'=>'7', 'name' => 'Витязь', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63266/result.html'],
        ['id_team'=>'8', 'name' => 'Динамо М', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63268/result.html'],
        ['id_team'=>'9', 'name' => 'Динамо Мн', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63254/result.html'],
        ['id_team'=>'10', 'name' => 'Динамо Р', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63256/result.html'],
        ['id_team'=>'11', 'name' => 'Йокерит', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63258/result.html'],
        ['id_team'=>'12', 'name' => 'Куньлунь Ред Стар', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63642/result.html'],
        ['id_team'=>'13', 'name' => 'Лада', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63284/result.html'],
        ['id_team'=>'14', 'name' => 'Локомотив', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63270/result.html'],
        ['id_team'=>'15', 'name' => 'Металлург Мг', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63626/result.html'],
        ['id_team'=>'16', 'name' => 'Нефтехимик', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63628/result.html'],
        ['id_team'=>'17', 'name' => 'Салават Юлаев', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63644/result.html'],
        ['id_team'=>'18', 'name' => 'Северсталь', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63272/result.html'],
        ['id_team'=>'19', 'name' => 'Сибирь', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63646/result.html'],
        ['id_team'=>'20', 'name' => 'СКА', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63260/result.html'],
        ['id_team'=>'21', 'name' => 'Слован', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63262/result.html'],
        ['id_team'=>'22', 'name' => 'ХК Сочи', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63276/result.html'],
        ['id_team'=>'23', 'name' => 'Спартак', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63264/result.html'],
        ['id_team'=>'24', 'name' => 'Торпедо', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63274/result.html'],
        ['id_team'=>'25', 'name' => 'Трактор', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63630/result.html'],
        ['id_team'=>'26', 'name' => 'ЦСКА', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63278/result.html'],
        ['id_team'=>'27', 'name' => 'Югра', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63632/result.html'],
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
function link_go(){
//     подключение к БД
        global $id_connect_DB, $link_results_team;
        $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
        if($id_connect_DB){
            // очищаем таблицу result_match
            $id_connect_DB->query('TRUNCATE TABLE result_match');
            for($t_m=1; $t_m<28; $t_m++){
                    //вызываем функцию для парсинга
                    //$link_page = 'result_team\\'.$t_m.'_results.php';
                    pars_results($link_results_team[$t_m-1]['linl'], $t_m, $link_results_team[$t_m-1]['name']);
                // pars_results('result_team\1_results.php', 1, 'Авангард');
                //break;
                }
        }else{
            echo '<br> соединение с БД не устанолвено';
        }
    // закрытие подключения к БД
    mysqli_close($id_connect_DB);
   
}
// функция парсинга страницы
function pars_results($link_page, $id_team, $name_team){
    // запрос страницы
    $data_results = curl_get($link_page);
    //$data_results        = file_get_contents($link_page);
    //создание объекта phpQuery
    $doc_Dom = phpQuery::newDocument($data_results);
    // парсинг страницы в массив $result_team
    //----------------------------------------
    for ($w=1; $w<90; $w++){
        //$d=$w+1;
        $res = $doc_Dom->find('tr:nth-child('.($w+1).')  td:nth-child(5) a')->text();
        // определяем сыгран ли был матч
        if (trim($res) != '-:-'){
            // порядковый номер матча
            $number_match = $w;
            // счет матча
            $puck_team = trim($doc_Dom->find('tr:nth-child('.($w+1).') td:nth-child(5) a:nth-child(1)')->text());
            // соперник, место игры, заброшенные шайбы
            // если название первой команды в матче соотвествует названию команды которую парсим, значит игра проходит дома и соперник в названии второй команды 
            if (trim($doc_Dom->find('tr:nth-child('.($w+1).') td:nth-child(4) a:nth-child(1)')->text()) == $name_team){
                $result_team[$id_team][$number_match]['rival'] = trim($doc_Dom->find('tr:nth-child('.($w+1).') td:nth-child(4) a:nth-child(2)')->text());
                $result_team[$id_team][$number_match]['place'] = 'home';
                $result_team[$id_team][$number_match]['puck_team'] = substr($puck_team,0,1);
                $result_team[$id_team][$number_match]['puck_rival'] = substr($puck_team,2,1);
            // иначе игра в гостях
            }else {
                $result_team[$id_team][$number_match]['rival'] = trim($doc_Dom->find('tr:nth-child('.($w+1).') td:nth-child(4) a:nth-child(1)')->text());
                $result_team[$id_team][$number_match]['place'] = 'guest';
                $result_team[$id_team][$number_match]['puck_team'] = substr($puck_team,2,1);
                $result_team[$id_team][$number_match]['puck_rival'] = substr($puck_team,0,1);
            }
            //дата игры
            $result_team[$id_team][$number_match]['date_match'] = trim($doc_Dom->find('tr:nth-child('.($w+1).') td:nth-child(2)')->text());
            // время окончания матча
            $time_end = trim($doc_Dom->find('tr:nth-child('.($w+1).') td:nth-child(5) a:nth-child(1)')->text());
            if(strpos($time_end, 'ОТ')){$result_team[$id_team][$number_match]['time_end'] = 'ОТ';}
            elseif(strpos($time_end, 'Б')){$result_team[$id_team][$number_match]['time_end'] = 'Б';}
            else{$result_team[$id_team][$number_match]['time_end'] = 'normal';}
            // результат игры для команды
            if($result_team[$id_team][$number_match]['puck_team'] > $result_team[$id_team][$number_match]['puck_rival'])
            {$result_team[$id_team][$number_match]['result'] = 'win';}
            else{$result_team[$id_team][$number_match]['result'] = 'lose';}        
        }else{
            // матч не сыгран
            break;
        }
        
    } 
    
    printArray($result_team);
    // вызов функции записи в БД
    write_result($result_team, $id_team);
    
}
// функция записи данных в БД
function write_result($result_team, $id_team){
    // обяъвление глобального дескриптора подключения к БД
    global $id_connect_DB;
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
    // определяем количество записей для внесения в БД
    $count_record = count($result_team[$id_team]);
    for($rec=1; $rec<=$count_record; $rec++){
      // формирования запроса на добавление данных о заброшенных шайбах
        $query_1 = "INSERT INTO result_match (id_team, rival, place, date_match, time_end, puck_team, puck_rival, result) VALUES (".$id_team.", '".$result_team[$id_team][$rec]['rival']."',' ".$result_team[$id_team][$rec]['place']."', ".strtotime($result_team[$id_team][$rec]['date_match']).",' ".$result_team[$id_team][$rec]['time_end']."',' ".$result_team[$id_team][$rec]['puck_team']."',' ".$result_team[$id_team][$rec]['puck_rival']."',' ".$result_team[$id_team][$rec]['result']."')";
        // добавление данных в БД
        $id_connect_DB->query($query_1);
    //------------------------------------------------------------------
    }  
}
// функция вывода данных из БД
function display_data_db(){
    global $link_results_team;
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
        if($id_connect_DB){
            $query_all_count = 'SELECT COUNT(*) FROM result_match';
            $result = $id_connect_DB->query($query_all_count);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo '<br><h5>Количество строк в таблице result_match - '.$row['COUNT(*)'].'</h5>';
            for ($t_m=1; $t_m<28; $t_m++){
               $query_team_count = 'SELECT COUNT(*) FROM result_match WHERE id_team='.$t_m;
               $result = $id_connect_DB->query($query_team_count);
               $row = $result->fetch_array(MYSQLI_ASSOC);
               echo '<br><h5>Количество матчей команды '.$link_results_team[$t_m-1]['name'].' - '.$row['COUNT(*)'].'</h5>';
            }
                 
        }else{
            echo '<br> соединение с БД не устанолвено';
        }
    
    
    
}


//====запросы на выборку данных========
// запрос на получение данных о забитых шайбах в последних пяти играх
function puck_last_5(){
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
    // запрос
    //$q ='SELECT * FROM result_match WHERE id_team=1 ORDER BY date_match DESC LIMIT 5';
    // обращение к БД
    //$res = $id_connect_DB->query($q);
    $res = $id_connect_DB->query('SELECT * FROM result_match WHERE id_team=1 ORDER BY date_match DESC LIMIT 5');
    //echo get_class($res);
    
    $d_ar = mysqli_fetch_all($res, MYSQLI_ASSOC);
    printArray($d_ar);
    echo '<br>забитые шайбы'.count($d_ar);
    for ($i=0;$i<count($d_ar);$i++){
        echo '<br>забитых шайбы - '.$d_ar[$i]['puck_team'];
        echo '<br>дата - '.date("d.m.Y",$d_ar[$i]['date_match']);
        echo '<br>соперник - '.$d_ar[$i]['rival'];
        //echo '<br>result - '.$d_ar[$i]['result'];
        //echo '<br> - '.strlen($d_ar[$i]['result']);
        if (trim($d_ar[$i]['result']) === 'lose'){
            echo '<br>результат игры - поражение';
        }
        if (trim($d_ar[$i]['result']) == 'win'){
            echo '<br>результат игры - победа';
        }
    }
    
        
    
}
// запрос на получение данных о забитых шайбах в последних десяти играх
// запрос на получение данных о забитых шайбах в последних пяти играх дома
// запрос на получение данных о забитых шайбах в последних пяти играх в гостях



// вызовы функций ***********************************************************
    //link_go();
    //pars_results('temp\results.php',1);
    //pars_results($link_results_team[0]['linl'], 1, $link_results_team[0]['name']);
    //display_data_db(); // вывод данных из БД
    puck_last_5();
// **************************************************************************



function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}





?>