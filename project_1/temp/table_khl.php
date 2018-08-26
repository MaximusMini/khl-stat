<?php
echo 'пр';

include_once('..\..\php\phpQuery.php');

//
function get_table(){
    $res_curl = curl_get ('https://www.championat.com/hockey/_superleague/2202/table/all.html');
    //создаем объекты класса phpQuery
    $tables_khl      = phpQuery::newDocument($res_curl);
    // ищем таблицу западной конференции
    echo '<br> Таблица западной конференции';
    echo $tables_khl->find('div.sport__table table:nth-child(2)');
    echo '<br>';
    // ищем таблицу восточной конференции
    echo '<br> Таблица восточной конференции';
    echo $tables_khl->find('div.sport__table table:nth-child(4)');
    echo '<br>'; 
}




// вызовы функций---------------------------------------------------------
    get_table();
//========================================================================



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