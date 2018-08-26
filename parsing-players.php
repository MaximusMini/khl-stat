<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <?php require_once('php/link.php'); ?>

    <title>Парсинг данных игроков</title>

</head>

<body>
<!--<button onclick='start()'>запуск</button>-->
    

</body>

</html>




<?php

include_once('php\phpQuery.php');

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

    //получаем данные протокола
    //$data_protocol = curl_get('files_players\players_1.php');
    $data_protocol = file_get_contents('files_players\players_1.php');
    //file_put_contents('data_protocol.php',$data_protocol);
    //echo '!!!!!'.$data_protocol;


    //создаем объект класса phpQuery
    $results = '';
    $results = phpQuery::newDocument($data_protocol);


class Players {
    
    public $players = [];
    //public $players_id = [];
    
    
}

 $obj_players = new Players();


id_players($results, $obj_players);

//printArray($obj_players);

//plaers_info(20861, $obj_players);


//month_name('5 Июня 1984');


// получаем id игроков
function id_players ($results, $obj_players){
   
    $players_id = [];
    
    //формирование id игроков
    $elements = $results->find('table#players_dataTable tbody tr td a');
    foreach ($elements as $el){
        //echo '<br>'.substr(pq($el)->attr('href'),9,strpos(pq($el)->attr('href'),'/',9)-9);
        //массив в котором буду хранится id игроков
        array_push($players_id, substr(pq($el)->attr('href'),9,strpos(pq($el)->attr('href'),'/',9)-9));
    }
    
    /* проверка значенией в массиве
    foreach($players_id as $pl){
        echo '<br>'.$pl;
    }
    */
    
    
    
    
    $full_name = $results->find('table#players_dataTable tbody td b.e-player_name');
    foreach ($full_name as $f_n){
        //echo '<br>'.explode(' ',pq($f_n)->html())[0];
    }
    
    $role = $results->find('table#players_dataTable tbody tr td');//объект, состоящий из других объектов
    $r=1; $f=0;
    foreach ($role as $rl){
        //echo '<br><span class="bg-danger">'.$f.'</span>';
        //echo '<br>'.pq($rl)->html();
        switch($r){
             case 1:
                //echo '<h4 class="bg-primary">Фамилия</h4>';
                //echo '<br>'.explode(' ',trim(strip_tags(pq($rl)->html())))[0];
                //echo '<h4>Имя</h4>';
                //echo '<br>'.explode(' ',trim(strip_tags(pq($rl)->html())))[1];
                // запись данных в главный массив
                $obj_players->players[$players_id[$f]]['surname_cir']=   explode(' ',trim(strip_tags(pq($rl)->html())))[0];
                $obj_players->players[$players_id[$f]]['name_cir']=      explode(' ',trim(strip_tags(pq($rl)->html())))[1];
                break;
//            case 2:
//                echo '<h5>клуб</h5>';
//                echo '<br>'.pq($rl)->html();
//                break;
            case 3:
                //echo '<p class="bg-success"><b>амплуа</b></p>';
                //echo '<br>'.pq($rl)->html();
                $obj_players->players[$players_id[$f]]['role']= pq($rl)->html();
                break;
            case 4:
                //echo '<p class="bg-info">дата рождения</p>';
               // echo '<br>'.pq($rl)->html();
                // преобразовываем дату в нужный вид
                $new_b_date = month_name(trim(strip_tags(pq($rl)->html())));
                $obj_players->players[$players_id[$f]]['b_date']= $new_b_date;
                break;
            case 6:
                //echo '<p class="bg-danger">гражданство</p>';
                //echo '<br>'.strip_tags(pq($rl)->html());
                $obj_players->players[$players_id[$f]]['country']= trim(strip_tags(pq($rl)->html()));
                break;
        }
        if($r<8){$r++;}else{$r=1;$f++;};
        
        //$r++;
        /*
        1. Фамлия Имя
        2. клуб
        3. амплуа
        4. дата рождения
        5. возраст
        6. гражданство
        7. контракт до
		
		сформировать массив игроков для добавления в БД

		$players[id_players][surname_cir]

		$players[id_players][name_cir]

		$players[id_players][role]

		$players[id_players][b_date]

		$players[id_players][country]

		
        */
    }
    
    echo '<br>!!!'.$obj_players->players[20861]['surname_cir'].'<br>';
    echo '<br>'.$obj_players->players[20861]['b_date'].'<br>';
    //month_name($obj_players->players[20861]['b_date']);
    
    
    
    //printArray($obj_players);
    
    echo json_encode($obj_players, JSON_UNESCAPED_UNICODE);
    
    /*
    вывод дат рождения игроков
    foreach ($obj_players->players as $key => $value){
        echo '<br>'.$obj_players->players[$key]['b_date'];
    }
    */ 
    
}


function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}

function plaers_info($id_players, $obj_pl){
$g=$obj_pl->players[$id_players]['surname_cir'];
$h = $obj_pl->players[$id_players]['name_cir'];
    
    //printArray($obj_pl);
    
    //echo $id_players;
    //echo '<br>!!!'.$obj_pl->players[$id_players]['surname_cir'].'<br>';
    
$info = <<< INFO_PL
<div class='col-md-6'>
<div class="panel panel-primary">
    <div class="panel-heading">Информация об игроке </div>
  <div class="panel-body">
    Фамилия - $g
    <br>
    Имя - $h
  </div>
</div>
INFO_PL;

echo   $info;  
}

// функция преобразования даты из текста в число
function month_name($n_m){
    // массив соответствия названия месяцев цифре
    $month_digital = array('Января' => '01', 'Февраля' => '02', 'Марта' => '03', 
		'Апреля' => '04', 'Мая' => '05', 'Июня' => '06', 
		'Июля' => '07', 'Августа' => '08', 'Сентября' => '09', 
		'Октября' => '10', 'Ноября' => '11', 'Декабря' => '12');
    // на входе получаем строку из парсинга данных игрока - параметр $n_m
    // из строки получаем название месяца - explode(' ',$n_m)[1]
    $month_text = explode(' ',$n_m)[1];
    // проверяем первую цифру - если нужно добавляем ноль
    if (strlen(explode(' ',$n_m)[0]) == 1){
        $new_date = '0'.explode(' ',$n_m)[0];
    }else {$new_date = explode(' ',$n_m)[0];}
    // проверяем наличе ключа в массиве
    if (array_key_exists($month_text, $month_digital)){
        //echo '<br> ключ есть';
        //echo '<br>'.$month_digital[$month_text];
        //echo '<br>'.explode(' ',$n_m)[0].'.'.$month_digital[$month_text].'.'.explode(' ',$n_m)[2];
        return $new_date.'.'.$month_digital[$month_text].'.'.explode(' ',$n_m)[2];
    }
    
}















































