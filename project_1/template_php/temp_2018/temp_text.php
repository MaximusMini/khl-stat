<?php
/*
модуль формирования пояснительного текста к матчу

*/

$id_team_1 = $_POST['team_1']-1;
$id_team_2 = $_POST['team_2']-1;

//$id_team_1 = 14-1;
//$id_team_2 = 15-1;

$date_match = $_POST['date_match'];
//$date_match = '14.10.2017';


$number_match = $_POST['number_match'];
//$number_match = '307';

$teams = ["Авангард",
          "Автомобилист",
          "Адмирал",
          "Ак Барс",
          "Амур",
          "Барыс",
          "Витязь",
          "Динамо М",
          "Динамо Мн",
          "Динамо Р",
          "Йокерит",
          "Куньлунь РС",
          "Локомотив",
          "Металлург Мг",
          "Нефтехимик",
          "Салават Юлаев",
          "Северсталь",
          "Сибирь",
          "СКА",
          "Слован",
          "Спартак",
          "Торпедо НН",
          "Трактор",          
          "ХК Сочи",
          "ЦСКА"];

$tags = ["#лучшиеболельщики #омскийавангард","#хкавтомобилист #давайавто","#хкадмирал","#акбарс #айдаАкБарс","#хкамур #амур","#спорт_todaykz #барыс","#хквитязь","#МыДинамо  #хкдинамомосква","#намроднаякоманда #хкдинамоминск","#динаморига","#Йокерит","#КуньлуньРС","#хклада	#ТольяттиГородХоккея","#хклокомотив","#hcmetallurg #братьяпоогню","#Нефтехимик #Волки","#салаватюлаев","#hcseverstal #хксеверсталь","#хксибирь #hcsibir","#хкска #hccska","#слован","#хксочи","#хкспартак","#торпедонн #хкторпедо","#хктрактор","#хкцска","#ХКЮгра #Югра"];

$text_match = <<<TEXT

$date_match 
$teams[$id_team_1] - $teams[$id_team_2]. Предматчевая статистика.


TEXT;

echo __DIR__;

file_put_contents('..\..\template_img\new_2018\text_2018.txt',$text_match,FILE_APPEND);








/*

КХЛ Регулярный сезон $date_match
Матч №$number_match: $teams[$id_team_1] - $teams[$id_team_2]
Предматчевая статистика команд
#Хоккей #КХЛ #живихоккеем #всенахоккей $tags[$id_team_1] $tags[$id_team_2]

КХЛ Регулярный сезон $date_match
Матч №$number_match: $teams[$id_team_1] - $teams[$id_team_2]
Лидеры команд
#Хоккей #КХЛ #живихоккеем #всенахоккей $tags[$id_team_1] $tags[$id_team_2]



*/



?>






















