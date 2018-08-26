<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Запись результатов</title>
</head>
<body>
    
</body>
</html>




<?php

// массив с сылками страниц для парсинга
$link_results_team = [
        ['id_team'=>'1', 'name' => 'Авангард', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63634/result.html'],
        ['id_team'=>'2', 'name' => 'Автомобилист', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63280/result.html'],
        ['id_team'=>'3', 'name' => 'Адмирал', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63636/result.html'],
        ['id_team'=>'4', 'name' => 'Ак Барс', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63282/result.html'],
        ['id_team'=>'5', 'name' => 'Амур', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63638/result.html'],
        ['id_team'=>'6', 'name' => 'Барыс', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63640/result.html'],
        ['id_team'=>'7', 'name' => 'Витязь', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63266/result.html'],
        ['id_team'=>'8', 'name' => 'ХК Динамо М', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63268/result.html'],
        ['id_team'=>'9', 'name' => 'Динамо Мн', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63254/result.html'],
        ['id_team'=>'10', 'name' => 'Динамо Р', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63256/result.html'],
        ['id_team'=>'11', 'name' => 'Йокерит', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63258/result.html'],
        ['id_team'=>'12', 'name' => 'Куньлунь РС', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63642/result.html'],
        ['id_team'=>'13', 'name' => 'Лада', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63284/result.html'],
        ['id_team'=>'14', 'name' => 'Локомотив', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63270/result.html'],
        ['id_team'=>'15', 'name' => 'Мталлург Мг', 'linl'=>'https://www.championat.com/hockey/_superleague/2202/team/63626/result.html'],
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

// функция записи данных результатов команд
function record_data(){
    global $link_results_team;
    foreach($link_results_team as $val){
        //echo $val['linl'];
        $name_file = 'temp\\'.$val['id_team'].'_results.php';
        $data_curl = curl_get($val['linl']);
        file_put_contents($name_file,$data_curl);
    }
    echo 'Файлы успешно записаны!';
}


// вызовы функций ***********************************************************
    record_data();
// **************************************************************************



function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}




?>