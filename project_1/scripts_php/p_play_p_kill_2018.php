<!DOCTYPE html>
<html lang="en">
<head>
    <link rel='stylesheet' href="../../css/bootstrap.min.css">
	<link rel='stylesheet' href="../../css/androidstudio.css">
	<link rel='stylesheet' href="../../css/style.css">
	
	<script src="../../js/jquery-3.1.0.min.js"></script>
	<script src="../../js/highlight.min.js"></script>
	<script src="../../js/bootstrap.js"></script>

    <meta charset="UTF-8">
    <title>Большинство/Меньшинство</title>
</head>
<body>
   <div class="container">
    
<?php
include_once('..\..\php\phpQuery.php');

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
    
    // получаем страницу для парсинга
    $file = curl_get('https://www.khl.ru/stat/teams/671/powerplay-gf/');

    //создаем объекты класса phpQuery
    $file_phpQuery = phpQuery::newDocument($file);
    // делаем запрос на поиск нужной информации
    $result = $file_phpQuery->find('table.nowrap.stripe.compact.hover');
    
    // массив команд
	$arr_t = [
			["id_team"=>1,"name"=>"Авангард"],
			["id_team"=>2,"name"=>"Автомобилист"],
			["id_team"=>3,"name"=>"Адмирал"],
			["id_team"=>4,"name"=>"Ак Барс"],
			["id_team"=>5,"name"=>"Амур"],
			["id_team"=>6,"name"=>"Барыс"],
			["id_team"=>7,"name"=>"Витязь"],
			["id_team"=>8,"name"=>"ХК Динамо М"],
			["id_team"=>9,"name"=>"Динамо Мн"],
			["id_team"=>10,"name"=>"Динамо Р"],
			["id_team"=>11,"name"=>"Йокерит"],
			["id_team"=>12,"name"=>"Куньлунь РС"],
			["id_team"=>13,"name"=>"Локомотив"],
			["id_team"=>14,"name"=>"Металлург Мг"],
			["id_team"=>15,"name"=>"Нефтехимик"],
			["id_team"=>16,"name"=>"Салават Юлаев"],
			["id_team"=>17,"name"=>"Северсталь"],
			["id_team"=>18,"name"=>"Сибирь"],
			["id_team"=>19,"name"=>"СКА"],
			["id_team"=>20,"name"=>"Слован"],
			["id_team"=>21,"name"=>"Спартак"],
			["id_team"=>22,"name"=>"Торпедо HH"],
			["id_team"=>23,"name"=>"Трактор"],
            ["id_team"=>24,"name"=>"ХК Сочи"],
			["id_team"=>25,"name"=>"ЦСКА"],
		];
	
	// массив для сбора данных
	$team = array();


// функция парсинга результатов большинства/меньшинства    
function pars_pow_play_pow_kill($result, $arr_t){
    global $team;
    foreach ($result as $val){
		for ($t=1; $t<28; $t++){
			// получаем имя команды
			$name_team = pq($val)->find('tr:nth-child('.$t.') span.e-club_name')->text();
			// поиск id команды в массиве $arr_t по её названию, взятому из парсинга
			for ($tt=0; $tt<25; $tt++){
                //echo $tt.' array_search: '.array_search($name_team, $arr_t[$tt]).'</br>';
                //echo 'type: '.gettype($arr_t[$tt]).'</br>';
				if(array_search($name_team, $arr_t[$tt]) == 'name'){
					// определить id команды
					$team[$t]['id_team'] = $arr_t[$tt]['id_team'];
				}
			}
			// название команды
			$team[$t]['name_team'] = $name_team;
			// количество сыгранных игр
			$team[$t]['games'] 						= pq($val)->find('tr:nth-child('.$t.') td:nth-child(3)')->text();
			// количество полученных численных преимуществ
			$team[$t]['total_power_play'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(4)')->text();
			// шайб заброшенных в большинстве
			$team[$t]['goals_power_play'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(5)')->text();
			// процент реализованных численных преимуществ
			$team[$t]['perc_power_play']			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(6)')->text();
			// шайбы пропущенные в большинстве
			$team[$t]['goals_against_power_play'] 	= pq($val)->find('tr:nth-child('.$t.') td:nth-child(7)')->text();
			// количество численных преимуществ полученных соперником
			$team[$t]['total_power_kill'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(8)')->text();
			// шайбы, пропущенные в меньшинстве
			$team[$t]['goals_against_power_kill'] 	= pq($val)->find('tr:nth-child('.$t.') td:nth-child(9)')->text();
			// процент нереализованных численных преимуществ соперников
			$team[$t]['perc_power_kill'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(10)')->text();
			// шайбы, заброшенные в меньшинстве
			$team[$t]['goals_power_kill'] 			= pq($val)->find('tr:nth-child('.$t.') td:nth-child(11)')->text();
		}
    }
}
    
// функция записи данных в БД
function  write_data_power($team){
    // подключаем БД
    $id_connect_DB = new mysqli('localhost', 'root', '', 'khl_stat_2018');
    // очищаем таблицу от старых записей
    $query_delete = 'TRUNCATE stat_pow_play_pow_kill';
    $id_connect_DB->query($query_delete);
        if($id_connect_DB){
            for($count=1; $count<28; $count++){
                // формирования запроса на добавление данных
                $query = 'INSERT INTO stat_pow_play_pow_kill (id_team, name, games, total_power_play, goals_power_play, perc_power_play, goals_against_power_play, total_power_kill, goals_against_power_kill, perc_power_kill, goals_power_kill) VALUES ('.$team[$count]['id_team'].',\''.$team[$count]['name_team'].'\',' .$team[$count]['games'].',' .$team[$count]['total_power_play'].',' .$team[$count]['goals_power_play'].',' .$team[$count]['perc_power_play'].',' .$team[$count]['goals_against_power_play'].',' .$team[$count]['total_power_kill'].','.$team[$count]['goals_against_power_kill'].',' .$team[$count]['perc_power_kill'].','.$team[$count]['goals_power_kill'].')';
                // добавление данных в БД
                echo '<br>'.$query;
                $id_connect_DB->query($query);
                //------------------------------------------------------------------
            }
        }
    else{
        echo '<br> соединение с БД не устанолвено';
    }
    echo '<br><h2>Данные добавлены!</h2>';
}
    
// вызовы функций ***********************************************************
    pars_pow_play_pow_kill($result, $arr_t); // парсинг
    write_data_power($team);// запись в БД
    //printArray($team);
// **************************************************************************
    
    
    
// вспомогательные функции ***********************************************************    
function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}
// **************************************************************************
    
?>
    
 </div>    
</body>
</html>