<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Парсинг результатов команды</title>
</head>
<body>
    
</body>
</html>




<?php


//$homepage = file_get_contents('https://www.championat.com/hockey/_superleague/2202/team/63282/tstat.html');

//echo $homepage;

$arr_t = ["Авангард","Автомобилист","Адмирал","Ак Барс","Амур","Барыс","Витязь","ХК Динамо М","Динамо Мн","Динамо Р","Йокерит","Куньлунь РС","Лада","Локомотив","Мталлург Мг","Нефтехимик","Салават Юлаев","Северсталь","Сибирь","СКА","Слован","ХК Сочи","Спартак","Торпедо","Трактор","ЦСКА","Югра"];


for ($i=1; $i<28; $i++){
    
    echo "<br><p>INSERT INTO team (id_team, name_team, conf) values ($i,". $arr_t[$i-1].", запад)</p>";
    
    //<p>INSERT INTO team (id_team, name_team, conf) values ($i, $arr_t[$i], запад)</p>
    
    
}




?>