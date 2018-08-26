
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <?php require_once('php/link.php'); ?>

    <title>Document</title>

</head>

<body>
<!--<button onclick='start()'>запуск</button>-->
    

</body>

</html>

<?php

$style = <<<STYLE_SCRIPT
<style>
h5{
    margin:2px;
    color:red;
}
h5 span {
    color:gray;
}
</style>
STYLE_SCRIPT;
echo $style;

include_once('php\phpQuery.php');





/*
список используемых функций

name_team($results, $match_protocol)        - названия команд
number_match($results, $match_protocol)     - номер, дата и время матча
arena_match($results, $match_protocol)      - арена, город, количество зрителей
referee($results, $match_protocol)          - судьи
team_owner($results, $match_protocol)       - получение состава команды хозяев
team_guests($results, $match_protocol)      - получение состава команды гостей
goals($results, $match_protocol)            - заброшенные шайбы




*/





class Protocol {
    public $number_match='';        //номер матча
    public $date_match='';          //дата матча
    public $time_match='';          //время матча
    public $name_arena='';          //название арены
    public $audience='';            //количество зрителей
    public $city_match='';          //город в котором проводился матч
    public $main_referee1='';         //главный судья
    public $main_referee2='';         //главный судья
    public $lain_referee1='';         //линейный судья
    public $lain_referee2='';         //линейный судья
    public $lain_referee3='';         //линейный судья
    public $team_master='';         //команда хозяин
    public $team_guest='';          //команда гость
    public $coach_team_master='';   //тренер команды хозяев
    public $coach_team_guest='';    //тренер команды гостей
    public $game_score=[];          //счет матча
    
    
    public $game_score2='';          //счет матча
    
    public $score_period1=[];       //счет первого периода
    public $score_period2=[];       //счет второго периода
    public $score_period3=[];       //счет третьего периода
    public $score_overtime=[];      //счет овертайма
    public $score_bullets=[];       //счет серии булитов
    
    
    public $goals=[];               //забитые шайбы
    /*
    goals[$count_goals]['goals_number'] 		- номер шайбы
    goals[$count_goals]['goals_period'] 		- период в котором забита шайба
    goals[$count_goals]['goals_time']			- время заброшенной шайбы
    goals[$count_goals]['goals_score']			- каким стал счет после заброшенной шайбы
    goals[$count_goals]['composition_score']	- в каких составах заброшена шайба
    goals[$count_goals]['goal_player']			- автор шайбы
    goals[$count_goals]['goal_assistant1']		- асистент 1
    goals[$count_goals]['goal_assistant2']		- асистент 2
    goals[$count_goals]['goal_presence_owner1']	- присутствующий игрок команды хозяйки
    goals[$count_goals]['goal_presence_owner2']	- присутствующий игрок команды хозяйки
    goals[$count_goals]['goal_presence_owner3']	- присутствующий игрок команды хозяйки
    goals[$count_goals]['goal_presence_owner4']	- присутствующий игрок команды хозяйки
    goals[$count_goals]['goal_presence_owner5']	- присутствующий игрок команды хозяйки
    goals[$count_goals]['goal_presence_guests1']- присутствующий игрок команды гостей
    goals[$count_goals]['goal_presence_guests2']- присутствующий игрок команды гостей
    goals[$count_goals]['goal_presence_guests3']- присутствующий игрок команды гостей
    goals[$count_goals]['goal_presence_guests4']- присутствующий игрок команды гостей
    goals[$count_goals]['goal_presence_guests5']- присутствующий игрок команды гостей
    */
    
    public $team_owner = [];         // состав команды хозяев
    /*
    общие данные
        $team_owner = [$number_player][''];         - 
    
    статистика для вратарей
        $team_owner = [$number_player]['result_match'];         - результат матча
        
    
    
    */
    public $team_guests = [];        // состав команды гостей
    
    
    
    
    // массив данных для записи данных о матче в таблицу "Match"
    public $data_match = [];
    // функция данных в массив
    function record_data_match(){
        $this->data_match['number_match'] = $this->number_match;                //номер матча
        $this->data_match['team_master'] = $this->team_master;                  //команда хозяин
        $this->data_match['team_guest'] = $this->team_guest;                    //команда гость
        $this->data_match['coach_team_master'] = $this->coach_team_master;      //тренер команды хозяев
        $this->data_match['coach_team_guest'] = $this->coach_team_guest;        //тренер команды гостей
        $this->data_match['date_match'] = $this->date_match;                    //дата матча
        $this->data_match['time_match'] = $this->time_match;                    //время матча
        $this->data_match['name_arena'] = $this->name_arena;                    //название арены
        $this->data_match['audience'] = $this->audience;                        //количество зрителей
        $this->data_match['city_match'] = $this->city_match;                    //город
        $this->data_match['game_score'] = $this->game_score['goals_count'];     //счет матча
        
        $this->data_match['goals_owner'] = $this->game_score['goals_owner'];     //кол-во шайб хозяев
        $this->data_match['goals_guest'] = $this->game_score['goals_guest'];     //кол-во шайб хозяев
        
        
        
        $this->data_match['score_period1'] = $this->score_period1;              //счет первого периода
        $this->data_match['score_period2'] = $this->score_period2;              //счет второго периода
        $this->data_match['score_period3'] = $this->score_period3;              //счет третьего периода
        $this->data_match['score_overtime'] = $this->score_overtime;            //счет овертайма
        $this->data_match['score_bullets'] = $this->score_bullets;              //счет серии булитов
        
        
//        
//        // количество шайб команды хозяин за матч
//    $match_protocol->game_score['goals_owner'] = $schet[0];
//    // количество шайб команды гость
//    $match_protocol->game_score['goals_guest'] = schet[strlen($schet)-1];
//    // общий счет за матч
//    $match_protocol->game_score['goals_count'] = $match_protocol->game_score['goals_owner'].'-'.$match_protocol->game_score['goals_guest'];
        
        
        
    }
    
    
    
}

// объект класса Protocol
$match_protocol = new Protocol();



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

// получаем данные протокола
    //$data_protocol = curl_get('http://www.khl.ru/game/405/49538/protocol/', $referer = 'http://google.com');
    //echo $data_protocol;

    //include_once('files_protocol\1_match.php');


$data_protocol = file_get_contents('files_protocol\7season_match_b.php');
$data_protocol = file_get_contents('files_protocol\7season_match_ot.php');
$data_protocol = file_get_contents('files_protocol\1_match.php');
//$data_protocol = file_get_contents('files_protocol\match_8_2308_17_18_MetalurgMg_Avtomobilist.php');


    //запись протоколов в файлы
    for ($i=49621, $count_match = 1; $i<=4; $i++, $count_match++ ){
//        $data_protocol = curl_get('http://www.khl.ru/game/405/'.$i.'/protocol/', $referer = 'http://google.com');
//        //создаем объект класса phpQuery
//        $results = '';
//        $results = phpQuery::newDocument($data_protocol);
//        //получение названия команд
//        name_team($results, $match_protocol);           // название команд
//        // формирование имени файла
//        $name_files_protocol = 'files_protocol/'.$count_match.'_match_'.$i.'_'.$match_protocol->team_master.'-'.$match_protocol->team_guest.'.txt';
//        echo '</br>кодировка-'.mb_detect_encoding($name_files_protocol);
//        // перекодировка имени файла
//        $name_files_protocol = iconv("UTF-8", "Windows-1251//TRANSLIT", $name_files_protocol);  
//        // запись в файл
//        $fp = fopen($name_files_protocol, "w"); // создаем файл 
//        $test = fwrite($fp,  $data_protocol); // Запись в файл
//        if ($test) {
//            echo 'Данные в файл <b>'.$name_files_protocol.' </b>успешно занесены.</br>';}
//        else {
//            echo 'Ошибка при записи в файл - '.$name_files_protocol;}
//        fclose($fp); //Закрытие файла
    }




//создаем объект класса phpQuery
    $results = '';
    $results = phpQuery::newDocument($data_protocol);

    

    // функции извлечения данных из протокола
    coach_team($results, $match_protocol);          // тренеры команд
    number_match($results, $match_protocol);        // номер, дата и время матча
    name_team($results, $match_protocol);           // название команд
    arena_match($results, $match_protocol);
    referee($results, $match_protocol);             // судьи матча
    
    //team_owner($results, $match_protocol);            // состав команды хозяев
    //team_guests($results, $match_protocol);           // состав команды гостей
    //goals($results, $match_protocol);                // шайбы матча

    score_match($results, $match_protocol);

    $match_protocol->record_data_match();
    printArray($match_protocol->number_match);
    printArray($match_protocol->data_match);





//    echo '<br><h5>Номер матча: <span>'.$match_protocol->number_match.'</span></h5>';
//    echo '<br><h5>Дата матча: <span>'.$match_protocol->date_match.'</span></h5>';
//    echo '<br><h5>Время матча: <span>'.$match_protocol->time_match.'</span></h5>';
//    echo '<br><h5>Команда хозяев: <span>'.$match_protocol->team_master.'</span></h5>';
//    echo '<br><h5>Команда гость: <span>'.$match_protocol->team_guest.'</span></h5>';           
//    echo '<br><h5>Тренер хозяев: <span>'.$match_protocol->coach_team_master.'</span></h5>';
//    echo '<br><h5>Тренер гостей: <span>'.$match_protocol->coach_team_guest.'</span></h5>';
//    echo '<br><h5>Арена: <span>'.$match_protocol->name_arena.'</span></h5>';
//    echo '<br><h5>Город: <span>'.$match_protocol->city_match.'</span></h5>';
//    echo '<br><h5>Количество зрителей: <span>'.$match_protocol->audience.'</span></h5>';
//    echo '<br><h5>Главный судья: <span>'.$match_protocol->main_referee1.'</span></h5>';
//    echo '<br><h5>Главный судья: <span>'.$match_protocol->main_referee2.'</span></h5>';
//    echo '<br><h5>Линейный судья: <span>'.$match_protocol->lain_referee1.'</span></h5>';
//    echo '<br><h5>Линейный судья: <span>'.$match_protocol->lain_referee2.'</span></h5>';


// тренеры команд
function coach_team($results, $match_protocol) {
    include_once('id_coach.php');
    
    $elements = $results->find('dd.b-details_txt ul.e-player_honors a'); 
    foreach ($elements as $u_name){
        $u_name = pq($u_name);
        if ($coach_guest != 1){ // разделяем тренеров
            
            // определение id тренера
            $coach_team_master = explode(' ',$u_name->text())[1].' '.explode(' ',$u_name->text())[0];
            
    $match_protocol->coach_team_master = array_search($coach_team_master, $id_coach);
            
            //$match_protocol->coach_team_master=$coach_team_master;
        }else{
            $coach_team_guest = explode(' ',$u_name->text())[1].' '.explode(' ',$u_name->text())[0];
             $match_protocol->coach_team_guest = array_search($coach_team_guest, $id_coach);
            //$match_protocol->coach_team_guest=$u_name->text();
        }
            $coach_guest = 1;
			} 
}

//номер, дата и время матча
function number_match($results, $match_protocol){
    // номер матча
    $elements = $results->find('li.b-match_add_info_item span.e-num');
    $match_protocol->number_match = substr(strip_tags($elements->html()),4);
    // дата матча
    $elements = $results->find('ul.b-match_add_info li.b-match_add_info_item:first span:nth-child(2)');
    $match_protocol->date_match = substr(strip_tags($elements->html()),0,10);
    //echo substr(strip_tags($elements->html()),0,10);
    //время матча
    $match_protocol->time_match = substr(strip_tags($elements->html()),10);
    //echo '</br>время-'.substr(strip_tags($elements->html()),10);
}

// названия команд
function name_team($results, $match_protocol){
    // название команды хозяина
    $elements = $results->find('dl.b-details.m-club dd.b-details_txt h3.e-club_name:first'); 
    // определение id команды
    include_once('id_team.php'); // скрипт для хранения id команд
    $match_protocol->team_master = array_search($elements->html(), $id_team);
    // название команды гость
    $elements = $results->find('dl.b-details.m-club.m-rightward dd.b-details_txt h3.e-club_name'); 
    $match_protocol->team_guest = array_search($elements->html(), $id_team);
}

// арена, город, количество зрителей
function arena_match($results, $match_protocol){
    // арена матча
    $elements = $results->find('ul.b-match_add_info li.b-match_add_info_item:eq(1) span:nth-child(2)');
    // разбор полученной строки ','
    $str = explode('<br>',$elements->html());
    $position = strpos($str[0],',');
    // арена 
    $match_protocol->name_arena = substr($str[0],0,$position);
    // город
    $match_protocol->city_match = substr($str[0],$position+1);
    // количество зрителей
    $audience = explode(' ',$str[1]);
    $match_protocol->audience = $audience[0];
}

// судьи
function referee($results, $match_protocol){
    $elements = $results->find('ul.b-match_add_info li.m-last span:eq(1) a');
    $match_protocol->main_referee1 = $results->find('ul.b-match_add_info li.m-last span:eq(1) a:eq(0)')->html();
    $match_protocol->main_referee2 = $results->find('ul.b-match_add_info li.m-last span:eq(1) a:eq(1)')->html();
    $match_protocol->lain_referee1 = $results->find('ul.b-match_add_info li.m-last span:eq(1) a:eq(2)')->html();
    $match_protocol->lain_referee2 = $results->find('ul.b-match_add_info li.m-last span:eq(1) a:eq(3)')->html(); 
}


// заброшенные шайбы
function goals($results, $match_protocol){
    // определить сколько шайб
    $elements = $results->find('table#goals tbody tr td');
    
    //echo 'шайбы<pre>'.print_r($results->find('table#goals tbody tr:first'),true).'</pre>';
    
    $count=0; $count_goals=1;
    foreach($elements as $elem){
         switch($count){
            case 0:
                echo '<br>Номер шайбы - '.pq($elem)->html();
                $match_protocol->goals[$count_goals]['goals_number'] = pq($elem)->html();
                echo '<br>Номер шайбы - '.$match_protocol->goals[$count_goals]['goals_number']; 
                break;
            case 1:
                echo '<br>Период - '.pq($elem)->html();
                $match_protocol->goals[$count_goals]['goals_period']=pq($elem)->html();
                break;
            case 2:
                echo '<br>Время шайбы - '.pq($elem)->html();
                $match_protocol->goals[$count_goals]['goals_time']=pq($elem)->html(); 
                break;
            case 3:
                echo '<br>Каким стал счет - '.pq($elem)->html();
                $match_protocol->goals[$count_goals]['goals_score']=pq($elem)->html(); 
                break;
            case 4:
                echo '<br>В каких составах - '.pq($elem)->html();
                $match_protocol->goals[$count_goals]['composition_score']=pq($elem)->html(); 
                break;
            case 5:
                echo '<br>Автор гола - '.pq($elem)->html();
                $match_protocol->goals[$count_goals]['goal_player'] = substr(strip_tags(pq($elem)->html()),strpos(pq($elem)->html(),' ')+1,-4);
                echo '<br>Автор гола - '.$match_protocol->goals[$count_goals]['goal_player']; 
                break;
            case 6:
                echo '<br>Передача 1 - '.pq($elem)->html();
                $match_protocol->goals[$count_goals]['goal_assistant1'] = substr(strip_tags(pq($elem)->html()),strpos(pq($elem)->html(),' ')+1,-4);
                 echo '<br>Передача 1 - '.$match_protocol->goals[$count_goals]['goal_assistant1'];
                 break;
            case 7:
                $match_protocol->goals[$count_goals]['goal_assistant2'] = substr(strip_tags(pq($elem)->html()),strpos(pq($elem)->html(),' ')+1,-4);
                echo '<br>Передача 2 - '.$match_protocol->goals[$count_goals]['goal_assistant2']; 
                break;
            case 8:
                echo '<br>Состав хозяев - ';
                 for ($n=0; $n<count(explode(',',pq($elem)->html())); $n++){
                     $player = explode(',',pq($elem)->html());
                     $num = $player[$n];
                     echo  $match_protocol->team_owner[trim(strip_tags($num))]['full_name'].', ';
                    }     
                break;
            case 9:
                echo '<br>Состав гостей - ';
                for ($n=0; $n<count(explode(',',pq($elem)->html())); $n++){
                     $player = explode(',',pq($elem)->html());
                     $num = $player[$n];
                     echo  $match_protocol->team_guests[trim(strip_tags($num))]['full_name'].', ';
                    }   
                break;
            }
            if ($count<9){
                $count++;
            }else{
                 $count=0;
                 $count_goals++;
            }

        //echo '<br>'.pq($elem)->html();
    }
    
    
}

// получение состава команды хозяев
function team_owner($results, $match_protocol){
    // определяем количество вратарей, защитников, нападающих
    $count_goalies = $results->find('table#goaliesA tbody tr');     // вратари
    $count_defenders = $results->find('table#defensesA tbody tr');  // защитники
    $count_forwards = $results->find('table#forwardsA tbody tr');   // нападающие
    
    // вратари
    for ($z=0; $z<count($count_goalies);$z++){
        $str_number='table#goaliesA tbody tr:eq('.$z.') td:eq(0) a';
        $str_name='table#goaliesA tbody tr:eq('.$z.') td:eq(1) a';
        $str_id='table#forwardsA tbody tr:eq('.$z.') td:eq(1) a';
        $number_goaelies = $results->find($str_number);
            //echo $number_gaeles->html();
        $name_goaelies = $results->find($str_name);
            //echo $name_gaeles->html();
         // получение id игрока
        $id_player = substr($results->find($str_id)->attr('href'),9,strpos($results->find($str_id)->attr('href'),'/',9)-9);
        $full_name_goaelies     = $name_goaelies->html();
        $first_name_goaelies    = explode(' ', $name_goaelies->html())[0];
        $second_name_goaelies   = explode(' ', $name_goaelies->html())[1];
        $nbm = $number_goaelies->html();
        $match_protocol->team_owner[$nbm]['full_name']      = $full_name_goaelies;
        $match_protocol->team_owner[$nbm]['first_name']     = $first_name_goaelies;
        $match_protocol->team_owner[$nbm]['second_name']    = $second_name_goaelies;
        $match_protocol->team_owner[$nbm]['id_player']      = $id_player;
    }
    
     // защитники
    for ($z=0; $z<count($count_defenders);$z++){
        $str_number='table#defensesA tbody tr:eq('.$z.') td:eq(0) a';
        $str_name='table#defensesA tbody tr:eq('.$z.') td:eq(1) a';
        $str_id='table#forwardsA tbody tr:eq('.$z.') td:eq(1) a';
        $number_defenses = $results->find($str_number);
            //echo $number_gaeles->html();
        $name_defenses = $results->find($str_name);
            //echo $name_gaeles->html();
         // получение id игрока
        $id_player = substr($results->find($str_id)->attr('href'),9,strpos($results->find($str_id)->attr('href'),'/',9)-9);
        $full_name_defenses     = $name_defenses->html();
        $first_name_defenses    = explode(' ', $name_defenses->html())[0];
        $second_name_defenses   = explode(' ', $name_defenses->html())[1];
        $nbm = $number_defenses->html();
        $match_protocol->team_owner[$nbm]['full_name']      = $full_name_defenses;
        $match_protocol->team_owner[$nbm]['first_name']     = $first_name_defenses;
        $match_protocol->team_owner[$nbm]['second_name']    = $second_name_defenses;
        $match_protocol->team_owner[$nbm]['id_player']      = $id_player;
        
    }
    
    // нападающие
    for ($z=0; $z<count($count_forwards);$z++){
        $str_number='table#forwardsA tbody tr:eq('.$z.') td:eq(0) a';
        $str_name='table#forwardsA tbody tr:eq('.$z.') td:eq(1) a';
        $str_id='table#forwardsA tbody tr:eq('.$z.') td:eq(1) a';
        $number_defenses = $results->find($str_number);
            //echo $number_gaeles->html();
        $name_defenses = $results->find($str_name);
            //echo $name_gaeles->html();
        // получение id игрока
        $id_player = substr($results->find($str_id)->attr('href'),9,strpos($results->find($str_id)->attr('href'),'/',9)-9);
        $full_name_defenses     = $name_defenses->html();
        $first_name_defenses    = explode(' ', $name_defenses->html())[0];
        $second_name_defenses   = explode(' ', $name_defenses->html())[1];
        $nbm = $number_defenses->html();
        $match_protocol->team_owner[$nbm]['full_name']      = $full_name_defenses;
        $match_protocol->team_owner[$nbm]['first_name']     = $first_name_defenses;
        $match_protocol->team_owner[$nbm]['second_name']    = $second_name_defenses;
        $match_protocol->team_owner[$nbm]['id_player']      = $id_player;
    }
    
    
    //printArray($match_protocol->team_owner);
    
    // вывод данных
    /*
    $sss = 1;
    foreach($match_protocol->team_owner as $key => $player){
        echo '<br>';
        echo '<pre style="width:500px;">'.$sss."&#9 ".$key ."&#9".$player['first_name'].' id-'.$player['id_player'].'</pre>';
        $sss++;
    }
    
    */
    
    
    //echo '<pre style="width:500px;">'.$match_protocol->team_owner[10]['full_name'].' id-'.$match_protocol->team_owner[10]['id_player'].'</pre>';
    
}


// получение состава команды гостей
function team_guests($results, $match_protocol){
     // определяем количество вратарей, защитников, нападающих
    $count_goalies = $results->find('table#goaliesB tbody tr');     // вратари
    $count_defenders = $results->find('table#defensesB tbody tr');  // защитники
    $count_forwards = $results->find('table#forwardsB tbody tr');   // нападающие
    
    // вратари
    for ($z=0; $z<count($count_goalies);$z++){
        $str_number='table#goaliesB tbody tr:eq('.$z.') td:eq(0) a';
        $str_name='table#goaliesB tbody tr:eq('.$z.') td:eq(1) a';    
        $number_goaelies = $results->find($str_number);
            //echo $number_gaeles->html();
        $name_goaelies = $results->find($str_name);
            //echo $name_gaeles->html();
        $full_name_goaelies     = $name_goaelies->html();
        $first_name_goaelies    = explode(' ', $name_goaelies->html())[0];
        $second_name_goaelies   = explode(' ', $name_goaelies->html())[1];
        $nbm = $number_goaelies->html();
        $match_protocol->team_guests[$nbm]['full_name']      = $full_name_goaelies;
        $match_protocol->team_guests[$nbm]['first_name']     = $first_name_goaelies;
        $match_protocol->team_guests[$nbm]['second_name']    = $second_name_goaelies;
    }
    
     // защитники
    for ($z=0; $z<count($count_defenders);$z++){
        $str_number='table#defensesB tbody tr:eq('.$z.') td:eq(0) a';
        $str_name='table#defensesB tbody tr:eq('.$z.') td:eq(1) a';    
        $number_defenses = $results->find($str_number);
            //echo $number_gaeles->html();
        $name_defenses = $results->find($str_name);
            //echo $name_gaeles->html();
        $full_name_defenses     = $name_defenses->html();
        $first_name_defenses    = explode(' ', $name_defenses->html())[0];
        $second_name_defenses   = explode(' ', $name_defenses->html())[1];
        $nbm = $number_defenses->html();
        $match_protocol->team_guests[$nbm]['full_name']      = $full_name_defenses;
        $match_protocol->team_guests[$nbm]['first_name']     = $first_name_defenses;
        $match_protocol->team_guests[$nbm]['second_name']    = $second_name_defenses;
    }
    
    // нападающие
    for ($z=0; $z<count($count_forwards);$z++){
        $str_number='table#forwardsB tbody tr:eq('.$z.') td:eq(0) a';
        $str_name='table#forwardsB tbody tr:eq('.$z.') td:eq(1) a';    
        $number_defenses = $results->find($str_number);
            //echo $number_gaeles->html();
        $name_defenses = $results->find($str_name);
            //echo $name_gaeles->html();
        $full_name_defenses     = $name_defenses->html();
        $first_name_defenses    = explode(' ', $name_defenses->html())[0];
        $second_name_defenses   = explode(' ', $name_defenses->html())[1];
        $nbm = $number_defenses->html();
        $match_protocol->team_guests[$nbm]['full_name']      = $full_name_defenses;
        $match_protocol->team_guests[$nbm]['first_name']     = $first_name_defenses;
        $match_protocol->team_guests[$nbm]['second_name']    = $second_name_defenses;
    }
    
    // вывод данных
    /*
    $sss = 1;
    foreach($match_protocol->team_guests as $key => $player){
        echo '<br>';
        echo '<pre style="width:500px;">'.$sss."&#9 ".$key ."&#9".$player[key($player)].'</pre>';
        $sss++;
    }
    */
}


// получение счета матча общего и по периодам
function score_match($results, $match_protocol){
    /*
    три периода -   длина строки 9
    овертайм -      длина строки 12
    буллиты -       длина строки 12
    количество шайб хозяев - 0
    количество шайб гостей - 8
        strlen($schet_period)
    длина трех периодов - 13
    длина с овертаймом  - 18
    длина с буллитами   - 23
    */
    
    // общий счет
    $elements = $results->find('dt.b-total_score h3');
    $schet = trim(html_entity_decode(strip_tags($elements->html())));

        // количество шайб команды хозяин за матч
        $match_protocol->game_score['goals_owner'] = $schet[0];
        // количество шайб команды гость
        $match_protocol->game_score['goals_guest'] = $schet[8];
        // общий счет за матч
        $match_protocol->game_score['goals_count'] = $match_protocol->game_score['goals_owner'].'-'.$match_protocol->game_score['goals_guest'];

    
    // счет по периодам
    $elements = $results->find('dd.b-period_score');
    $schet_period = trim(strip_tags($elements->html()));

    
        // количество шайб команды хозяин за 1,2,3 периоды
        $match_protocol->score_period1['goals_owner'] = $schet_period[0];
        $match_protocol->score_period2['goals_owner'] = $schet_period[5];
        $match_protocol->score_period3['goals_owner'] = $schet_period[10];
        // количество шайб команды гость за 1,2,3 периоды
        $match_protocol->score_period1['goals_guest'] = $schet_period[2];
        $match_protocol->score_period2['goals_guest'] = $schet_period[7];
        $match_protocol->score_period3['goals_guest'] = $schet_period[12];
        // общий счет за 1,2,3 периоды
        $match_protocol->score_period1['goals_count'] = $match_protocol->score_period1['goals_owner'].'-'.$match_protocol->score_period1['goals_guest'];
        $match_protocol->score_period2['goals_count'] = $match_protocol->score_period2['goals_owner'].'-'.$match_protocol->score_period2['goals_guest'];
        $match_protocol->score_period3['goals_count'] = $match_protocol->score_period3['goals_owner'].'-'.$match_protocol->score_period3['goals_guest'];
        
    // в случае овертайма
    if(strlen($schet_period) >= 18){
        // количество шайб команды хозяин в овертайме
        $match_protocol->score_overtime['goals_owner'] = $schet_period[15];
        // количество шайб команды гость в овертайме
        $match_protocol->score_overtime['goals_guest'] = $schet_period[17];
        // общий счет за овертайм
        $match_protocol->score_overtime['goals_count'] = $match_protocol->score_overtime['goals_owner'].'-'.$match_protocol->score_overtime['goals_guest'];
    } 
    
    // в случае буллитов
    if(strlen($schet_period) == 23){
        // количество шайб команды хозяин в овертайме
        $match_protocol->score_bullets['goals_owner'] = $schet_period[20];
        // количество шайб команды гость в овертайме
        $match_protocol->score_bullets['goals_guest'] = $schet_period[22];
        // общий счет за овертайм
        $match_protocol->score_bullets['goals_count'] = $match_protocol->score_bullets['goals_owner'].'-'.$match_protocol->score_bullets['goals_guest'];
        
    }
    
}








function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}




?>



<script>
$(document).ready(function(){
                  //alert();
})


function start(){
   //sdf = $('table#goals thead').html();
    sdf = $('table#goals').html();
    //sdf = $('table#goals tbody tr:first').find('td:first');
    alert(sdf); 
}    
    

</script>

