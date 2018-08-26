<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../php/link.php'); ?>
    <meta charset="UTF-8">
    <title>Парсинг таблиц конференций</title>
</head>
<body style='padding-top: 70px'>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container" style="margin-top:10px">
            <a href="main.php" class="btn btn-info">на главную</a>
        </div>
    </nav>
    <div class="container">
        <div class="col-md-6">
            <p></p>  
        </div>
        <div class="col-md-6">

        </div>
    </div> 
</body>
</html>


<?php
include_once('..\php\phpQuery.php');

    $arr_team = ["1"=>"Авангард","2"=>"Автомобилист","3"=>"Адмирал","4"=>"Ак Барс","5"=>"Амур","6"=>"Барыс","7"=>"Витязь","8"=>"Динамо М","9"=>"Динамо Мн","10"=>"Динамо Р","11"=>"Йокерит","12"=>"Куньлунь Ред Стар","13"=>"Лада","14"=>"Локомотив","15"=>"Металлург Мг","16"=>"Нефтехимик","17"=>"Салават Юлаев", "18"=>"Северсталь", "19"=>"Сибирь", "20"=>"СКА","21"=>"Слован","22"=>"ХК Сочи", "23"=>"Спартак", "24"=>"Торпедо", "25"=>"Трактор","26"=>"ЦСКА","27"=>"Югра"];

    



    // раньше данные брали из файла после его ручного редактирования
    //$table_west         = file_get_contents('table_conf\west.php');
    //$table_east         = file_get_contents('table_conf\east.php');
    // а сейчас автоматически
    $res_curl = curl_get ('https://www.championat.com/hockey/_superleague/2593/table/all.html');
    $tables_khl = phpQuery::newDocument($res_curl);
    $table_west = $tables_khl->find('div.sport__table table:nth-child(2)');
    $table_east = $tables_khl->find('div.sport__table table:nth-child(4)');
    file_put_contents('table_conf\west.php', 'перезаписан '.date("d.m.Y \в H:i").'- '.$table_west);
    file_put_contents('table_conf\east.php', 'перезаписан '.date("d.m.Y \в H:i").'- '.$table_east);
    $table_west         = file_get_contents('table_conf\west.php');
    $table_east         = file_get_contents('table_conf\east.php');

    //создаем объекты класса phpQuery
    $t_west      = phpQuery::newDocument($table_west);
    $t_east      = phpQuery::newDocument($table_east);

    $team_east = []; // массив данных команд востока
    $team_west = []; // массив данных команд запада

// вызовы функций ***********************************************************
    delete_table_team(); //очистки БД
    
    $arr_west = name_team($t_west,$team_west, 'west');
    $arr_east = name_team($t_east,$team_east, 'east');

    // вывод массива
    //printArray($arr_west);
    //printArray($arr_east);

    view_DB();
// **************************************************************************   


// формирование массива
function name_team($t_conf,$team, $conf){
    global $arr_team;
    $result = $t_conf->find('table tr');
    
    
    $count_team=1;
    foreach($result as $val){
        // избавляемся от пустых значений
        if ($count_team < 4){$count_team++; continue;}
        
        //echo '<br>'.pq($val)->find('td:nth-child(4)')->text(); // название команд
        
        // формирование массива team
        $count_arr = $count_team-3;
        $team[$count_arr]['name']           = pq($val)->find('td:nth-child(4)')->text();
        $team[$count_arr]['place']          = $count_team-3;
        $team[$count_arr]['games']          = pq($val)->find('td:nth-child(5)')->text();
        $team[$count_arr]['clear_wins']     = pq($val)->find('td:nth-child(6)')->text();
        $team[$count_arr]['ot_wins']        = pq($val)->find('td:nth-child(7)')->text();
        $team[$count_arr]['b_wins']         = pq($val)->find('td:nth-child(8)')->text();
        $team[$count_arr]['b_defeat']       = pq($val)->find('td:nth-child(9)')->text();
        $team[$count_arr]['ot_defeat']      = pq($val)->find('td:nth-child(10)')->text();
        $team[$count_arr]['clear_defeat']   = pq($val)->find('td:nth-child(11)')->text();
        $team[$count_arr]['throw_puck']     = pq($val)->find('td:nth-child(12) span:nth-child(1)')->text();
        $team[$count_arr]['miss_puck']     	= pq($val)->find('td:nth-child(12) span:nth-child(3)')->text();
        $team[$count_arr]['scores']         = pq($val)->find('td:nth-child(13)')->text();
        $team[$count_arr]['percent_scr']    = pq($val)->find('td:nth-child(14)')->text();
        for($w=1; $w<=6; $w++){
            $old_match = 'old_match_'.$w;
            $res = 'td:nth-child(15) a:nth-child('.$w.') span';
            $team[$count_arr][$old_match]    = pq($val)->find($res)->attr('class');
        }
        $count_team++;
    }
    
    //echo json_encode($team, JSON_UNESCAPED_UNICODE);
    
    //echo '</br>'.$conf.'_'.date('d').'_'.date('m').'_'.date('Y').'.json';// название сформированных файлов
    
    $n_fale = $conf.'_'.date('d').'_'.date('m').'_'.date('Y').'.json';
    
    //save_json($team, $n_fale);// сохранение массива в файл json
    
    // запись данных в БД
    write_table_team($team,$arr_team);
    
    return $team;  
}

// сохранение массива в файл json
function save_json($team, $name_fale){
    $name_json_file = 'json\\'.$name_fale;
    
    file_put_contents($name_json_file, json_encode($team, JSON_UNESCAPED_UNICODE));
    
}

// функция записи данных в БД
function write_table_team($team,$arr_team){
    $mysqli = new mysqli("localhost", "root", "", "db_preview");
	//$mysqli = new mysqli("localhost", "root", "07011989", "db_preview");
    // перед записью стираем старые данные в таблице
    //$result = $mysqli->query('TRUNCATE TABLE table_conf'); 
    if ($mysqli) {
        foreach($team as $arr_1){
            //определяем id команды
            $name_team = $arr_1['name'];
            $key_name_team = array_search($name_team,$arr_team);
            // в показателе процентов меняем , на .
            $arr_1['percent_scr'] = str_replace(',','.',$arr_1['percent_scr']);
            // формирование запроса
            $query = "INSERT INTO table_conf (id_team,name, place, games, clear_wins, ot_wins, b_wins,clear_defeat,ot_defeat,b_defeat,throw_puck,miss_puck,scores,percent_scr,old_match_1,old_match_2,old_match_3,old_match_4,old_match_5,old_match_6) VALUES (".$key_name_team.",\"" .$arr_1['name']."\"," .$arr_1['place']."," .$arr_1['games']."," .$arr_1['clear_wins']. ",".$arr_1['ot_wins'].",". $arr_1['b_wins'].",".$arr_1['clear_defeat'].",".$arr_1['ot_defeat'].",".$arr_1['b_defeat'].",".$arr_1['throw_puck'].",".$arr_1['miss_puck'].",".$arr_1['scores'].",".$arr_1['percent_scr'].",\"".$arr_1['old_match_1']."\",\"".$arr_1['old_match_2']."\",\"".$arr_1['old_match_3']."\",\"".$arr_1['old_match_4']."\",\"".$arr_1['old_match_5']."\",\"" .$arr_1['old_match_6']."\")";
            // запись данных в БД
            $result = $mysqli->query($query);
        }
    }else{
        die('Ошибка соединения: ' . mysql_error());
    }

    
    
}

// функция очистки БД
function delete_table_team(){
    $mysqli = new mysqli("localhost", "root", "", "db_preview");
	//$mysqli = new mysqli("localhost", "root", "07011989", "db_preview");
    if ($mysqli) {
            $query = "TRUNCATE table_conf";
            // очистка данных в БД
            $result = $mysqli->query($query);
    }else{
        die('Ошибка соединения: ' . mysql_error());
    }
}

// функция вывода данных из таблицы БД
function view_DB(){
    // подключение к БД
    $mysqli = new mysqli("localhost", "root", "", "db_preview");
	//$mysqli = new mysqli("localhost", "root", "07011989", "db_preview");
    // получение данных
    if($mysqli){
        // формирование запрос
        $query = 'SELECT * FROM table_conf';
    }else{
        echo '<br>Ошибка подключения к БД';
    }
    //запрос к БД
    $result = $mysqli->query($query);
    // форматирование данных из БД
    //$row = mysqli_fetch_array($result); table.table.table-striped.table-condensed 
    
    echo '<div class="container"> <table class="table table-striped table-condensed"><thead><tr><th>id</th><th>команда</th><th>место</th><th>игр</th><th>побед</th><th>побед ОТ</th><th>побед Б</th><th>поражений</th><th>поражений ОТ</th><th>поражений Б</th><th>забр. шайб</th><th>пропущ. шайб</th><th>очки</th><th>процент</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th></tr></thead><tbody>';
        
    while($row = mysqli_fetch_array($result)) 
        {
        //printArray($row);
        echo '<tr>';
        echo "<td>".$row['id_team']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['place']."</td>";
        echo "<td>".$row['games']."</td>";
        echo "<td>".$row['clear_wins']."</td>";
        echo "<td>".$row['ot_wins']."</td>";
        echo "<td>".$row['b_wins']."</td>";
        echo "<td>".$row['clear_defeat']."</td>";
        echo "<td>".$row['ot_defeat']."</td>";
        echo "<td>".$row['b_defeat']."</td>";
        echo "<td>".$row['throw_puck']."</td>";
        echo "<td>".$row['miss_puck']."</td>";
        echo "<td>".$row['scores']."</td>";
        echo "<td>".$row['percent_scr']."</td>";
        echo "<td>".$row['old_match_1']."</td>";
        echo "<td>".$row['old_match_2']."</td>";
        echo "<td>".$row['old_match_3']."</td>";
        echo "<td>".$row['old_match_4']."</td>";
        echo "<td>".$row['old_match_5']."</td>";
        echo "<td>".$row['old_match_6']."</td>";
        echo '</tr>';
        }
    echo '</tbody></table></div>';
    
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

function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}




?>
