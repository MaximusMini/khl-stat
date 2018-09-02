<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../../php/link.php'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="image/png">
    <title>Шаблон 11 (большинство/меньшинство) </title>
</head>
<body style='padding-top: 70px'>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container" style="margin-top:10px">
            <a href="main.php" class="btn btn-info">на главную</a>
            <a href="images.php" class="btn btn-info">Формировать картинки</a>
            <a href="final_images.php" class="btn btn-success">Просмотр готовых</a>
        </div>
    </nav>
    <div class="container">
        <div class="col-md-8">
           <img src="" alt=""> 
        </div>
        <div class="col-md-4">
            
        </div>
    </div>  
</body>
</html>


<?php
// из файла images.php получаем параметры для определения команд и дату матча


$id_team_1 = '14';
$id_team_2 = '17';
$date_match = '14.10.2017';
$number_match = '307';

$id_team_1 = $_POST['team_1'];
$id_team_2 = $_POST['team_2'];
$date_match = $_POST['date_match'];
$number_match = $_POST['number_match'];

echo '<br>id 1--'.$id_team_1;
echo '<br>id 2--'.$id_team_2;

// подключаем БД
$id_connect_DB = new mysqli('localhost', 'root', '', 'db_preview');
    if($id_connect_DB){
        // формируем и выполняем запрос к таблице table_conf 
            $query_team_1 = 'SELECT * FROM stat_pow_play_pow_kill WHERE id_team='.$id_team_1;
            $data_team_1 = $id_connect_DB->query($query_team_1);
            $query_team_2 = 'SELECT * FROM stat_pow_play_pow_kill WHERE id_team='.$id_team_2;
            $data_team_2 = $id_connect_DB->query($query_team_2);
        // данные команд из таблицы table_conf
            $row_team_1 = mysqli_fetch_array($data_team_1);
            $row_team_2 = mysqli_fetch_array($data_team_2);
        //----------------------------------------------------------------//
        
    
        // вызов функции формирования шаблона
        template_5($row_team_1, $row_team_2, $date_match, $number_match);
        
    }else{
        echo '<br> соединение с БД не устанолвено';
    }


// формирование шаблона 1
function template_5($row_team_1, $row_team_2, $date_match, $number_match){

// загружаем изображение
$image = imagecreatefrompng('../template_img/temp_10.png');

// вставляем данные 
$grey = imagecolorallocate($image, 249, 230, 85);
$green = imagecolorallocate($image, 206, 225, 199);
$black = imagecolorallocate($image, 0, 0, 0);
// Замена пути к шрифту на пользовательский
$font = '../font/soviet.ttf';
$font_name_team = '../font/BigNoodleTitlingCyr.ttf';
// размер основного шрифта
$s_f=13;
// логотипы
$path_logo_temp_1 = '../logo/'.$row_team_1['id_team'].'.gif';
$path_logo_temp_2 = '../logo/'.$row_team_2['id_team'].'.gif';
$logo_team_1 = imagecreatefromgif($path_logo_temp_1);
$logo_team_2 = imagecreatefromgif($path_logo_temp_2);
    // Копирование и наложение
    imagecopymerge($image, $logo_team_1, 70, 20, 0, 0, 200, 200, 100);
    imagecopymerge($image, $logo_team_2, 430, 20, 0, 0, 200, 200, 100);


//echo '***'.$path_logo_temp_2;

// название команд
    // корректировка некоторых имен команд
    if ($row_team_1['name'] == 'Куньлунь Ред Стар') {$row_team_1['name'] = 'Куньлунь РC';};
    if ($row_team_2['name'] == 'Куньлунь Ред Стар') {$row_team_2['name'] = 'Куньлунь РC';};
    // !!! для каждой команды нужно подгонять позицию по гор - в отдельную функцию
    $place_name_1 = place_name_1($row_team_1['name']);
    $place_name_2 = place_name_2($row_team_2['name']);
    imagettftext($image, 40, 0, $place_name_1, 255, $black , $font_name_team, $row_team_1['name']);
    imagettftext($image, 40, 0, $place_name_2, 255, $black, $font_name_team,$row_team_2['name']);
// дата
    imagettftext($image, 13, 0, 305, 124, $green , $font, $date_match);
// 1-количество большинства (таблица=stat_pow_play_pow_kill cтолбец=total_power_play)
    imagettftext($image, $s_f, 0, 120, 380, $grey, $font, $row_team_1['total_power_play']);
    imagettftext($image, $s_f, 0, 560, 380, $grey, $font, $row_team_2['total_power_play']);
// 2-шайбы в большинстве (таблица=stat_pow_play_pow_kill cтолбец=goals_power_play)
    imagettftext($image, $s_f, 0, 120, 430, $grey, $font, $row_team_1['goals_power_play']);
    imagettftext($image, $s_f, 0, 560, 430, $grey, $font, $row_team_2['goals_power_play']);
// 3-реализация большинства (таблица=stat_pow_play_pow_kill cтолбец=perc_power_play)
    imagettftext($image, $s_f, 0, 120, 476, $grey, $font, $row_team_1['perc_power_play']);
    imagettftext($image, $s_f, 0, 560, 476, $grey, $font, $row_team_2['perc_power_play']);
// 4-пропущенные шайбы в большинстве (таблица=stat_pow_play_pow_kill cтолбец=goals_against_power_play)
    imagettftext($image, $s_f, 0, 120, 523, $grey, $font, $row_team_1['goals_against_power_play']);
    imagettftext($image, $s_f, 0, 560, 523, $grey, $font, $row_team_2['goals_against_power_play']);
// 5-количество меньшинства (таблица=stat_pow_play_pow_kill cтолбец=total_power_kill)
    imagettftext($image, $s_f, 0, 120, 570, $grey, $font, $row_team_1['total_power_kill']);
    imagettftext($image, $s_f, 0, 560, 570, $grey, $font, $row_team_2['total_power_kill']);
// 6-пропущенно шайб в меньшинстве (таблица=stat_pow_play_pow_kill cтолбец=goals_against_power_kill)
    imagettftext($image, $s_f, 0, 120, 617, $grey, $font, $row_team_1['goals_against_power_kill']);
    imagettftext($image, $s_f, 0, 560, 617, $grey, $font, $row_team_2['goals_against_power_kill']);
// 7-нереализация меньшинства соперником (таблица=stat_pow_play_pow_kill cтолбец=perc_power_kill)
    imagettftext($image, $s_f, 0, 120, 665, $grey, $font, $row_team_1['perc_power_kill']);
    imagettftext($image, $s_f, 0, 560, 665, $grey, $font, $row_team_2['perc_power_kill']);
// 8-заброшенные шайбы в меньшинстве  (таблица=stat_pow_play_pow_kill cтолбец=goals_power_kill)
    imagettftext($image, $s_f, 0, 120, 712, $grey, $font, $row_team_1['goals_power_kill']);
    imagettftext($image, $s_f, 0, 560, 712, $grey, $font, $row_team_2['goals_power_kill']);
    
imagepng($image,'../template_img/new/match_'.$number_match.'_temp_10.png',9);

}

// функция установки позиции имени команды хозяйки
function place_name_1($name_team){
    // команды востока
     switch ($name_team){
            case 'Авангард':        $x_team_1 = 90; break;
            case 'Автомобилист':    $x_team_1 = 55; break;
            case 'Адмирал':         $x_team_1 = 90; break;
            case 'Ак Барс':         $x_team_1 = 90; break;
            case 'Амур':            $x_team_1 = 130; break;
            case 'Барыс':           $x_team_1 = 120; break;
            case 'Куньлунь РС':     $x_team_1 = 70; break;
            case 'Лада':            $x_team_1 = 130; break;
            case 'Металлург Мг':    $x_team_1 = 70; break;
            case 'Нефтехимик':      $x_team_1 = 80; break;
            case 'Салават Юлаев':   $x_team_1 = 50; break;
            case 'Сибирь':          $x_team_1 = 105; break;
            case 'Трактор':         $x_team_1 = 90; break;
            case 'Югра':            $x_team_1 = 130; break;
    }    
    // команды запада
     switch ($name_team){
            case 'Витязь':      $x_team_1 = 110; break;
            case 'Динамо М':    $x_team_1 = 90; break;
            case 'Динамо Мн':   $x_team_1 = 95; break;
            case 'Динамо Р':    $x_team_1 = 90; break;
            case 'Йокерит':     $x_team_1 = 105; break;
            case 'Локомотив':   $x_team_1 = 80; break;
            case 'Северсталь':  $x_team_1 = 80; break;
            case 'СКА':         $x_team_1 = 130; break;
            case 'Слован':      $x_team_1 = 110; break;
            case 'ХК Сочи':     $x_team_1 = 105; break;
            case 'Спартак':     $x_team_1 = 105; break;
            case 'Торпедо':     $x_team_1 = 105; break;
            case 'ЦСКА':        $x_team_1 = 130; break;
    }  
    // возвращаемый результат
    return $x_team_1; 
}

// функция установки позиции имени команды гостей
function place_name_2($name_team){
// команды востока
     switch ($name_team){
            case 'Авангард':        $x_team_2 = 460; break;
            case 'Автомобилист':    $x_team_2 = 420; break;
            case 'Адмирал':         $x_team_2 = 460; break;
            case 'Ак Барс':         $x_team_2 = 460; break;
            case 'Амур':            $x_team_2 = 490; break;
            case 'Барыс':           $x_team_2 = 490; break;
            case 'Куньлунь РС':     $x_team_2 = 430; break;
            case 'Лада':            $x_team_2 = 490; break;
            case 'Металлург Мг':    $x_team_2 = 430; break;
            case 'Нефтехимик':      $x_team_2 = 440; break;
            case 'Салават Юлаев':   $x_team_2 = 430; break;
            case 'Сибирь':          $x_team_2 = 480; break;
            case 'Трактор':         $x_team_2 = 460; break;
            case 'Югра':            $x_team_2 = 490; break;
    }    
    // команды запада
     switch ($name_team){
            case 'Витязь':      $x_team_2 = 480; break;
            case 'Динамо М':    $x_team_2 = 470; break;
            case 'Динамо Мн':   $x_team_2 = 460; break;
            case 'Динамо Р':    $x_team_2 = 470; break;
            case 'Йокерит':     $x_team_2 = 460; break;
            case 'Локомотив':   $x_team_2 = 440; break;
            case 'Северсталь':  $x_team_2 = 440; break;
            case 'СКА':         $x_team_2 = 500; break;
            case 'Слован':      $x_team_2 = 480; break;
            case 'ХК Сочи':     $x_team_2 = 460; break;
            case 'Спартак':     $x_team_2 = 460; break;
            case 'Торпедо':     $x_team_2 = 460; break;
            case 'ЦСКА':        $x_team_2 = 490; break;
    }  
    // возвращаемый результат
    return $x_team_2; 
}



function printArray($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}






?>