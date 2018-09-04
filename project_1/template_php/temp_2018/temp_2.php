<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../../../php/link.php'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="image/png">
    <title>Шаблон 2 (Общая статистика)</title>
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


$id_team_1 = '1';
$id_team_2 = '2';
$id_team_1 = $_POST['team_1'];
$id_team_2 = $_POST['team_2'];

$date_match = '04.09.2018';
$date_match = $_POST['date_match'];

$number_match = '307';
$number_match = $_POST['number_match'];


echo '<br>id 1--'.$id_team_1;
echo '<br>id 2--'.$id_team_2;

// подключаем БД
$id_connect_DB = new mysqli('localhost', 'root', '', 'db_preview');
//$id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
    if($id_connect_DB){
        // формируем и выполняем запрос к таблице table_conf 
            $query_team_1 = 'SELECT * FROM table_conf WHERE id_team='.$id_team_1;
            $data_team_1 = $id_connect_DB->query($query_team_1);
            $query_team_2 = 'SELECT * FROM table_conf WHERE id_team='.$id_team_2;
            $data_team_2 = $id_connect_DB->query($query_team_2);
        // данные команд из таблицы table_conf
            $row_team_1 = mysqli_fetch_array($data_team_1);
            $row_team_2 = mysqli_fetch_array($data_team_2);
        //----------------------------------------------------------------//
        // формируем и выполняем запрос к таблице stat_penalty 
            $stat_penalty_team_1 = 'SELECT * FROM stat_penalty WHERE id_team='.$id_team_1;
            $data_team_1 = $id_connect_DB->query($stat_penalty_team_1);
            $stat_penalty_team_2 = 'SELECT * FROM stat_penalty WHERE id_team='.$id_team_2;
            $data_team_2 = $id_connect_DB->query($stat_penalty_team_2);
        // данные команд из таблицы stat_penalty
            $row_stat_penalty_team_1 = mysqli_fetch_array($data_team_1);
            $row_stat_penalty_team_2 = mysqli_fetch_array($data_team_2);
        //----------------------------------------------------------------//
        // формируем и выполняем запрос к таблице stat_throw
            $stat_throw_team_1 = 'SELECT * FROM stat_throw WHERE id_team='.$id_team_1;
            $data_team_1 = $id_connect_DB->query($stat_throw_team_1);
            $stat_throw_team_2 = 'SELECT * FROM stat_throw WHERE id_team='.$id_team_2;
            $data_team_2 = $id_connect_DB->query($stat_throw_team_2);
        // данные команд из таблицы stat_throw
            $row_stat_throw_team_1 = mysqli_fetch_array($data_team_1);
            $row_stat_throw_team_2 = mysqli_fetch_array($data_team_2);
        //----------------------------------------------------------------//
        // формируем и выполняем запрос к таблице stat_trow_percent
            $stat_trow_percent_team_1 = 'SELECT * FROM stat_trow_percent WHERE id_team='.$id_team_1;
            $data_team_1 = $id_connect_DB->query($stat_trow_percent_team_1);
            $stat_trow_percent_team_2 = 'SELECT * FROM stat_trow_percent WHERE id_team='.$id_team_2;
            $data_team_2 = $id_connect_DB->query($stat_trow_percent_team_2);
        // данные команд из таблицы stat_trow_percent
            $row_stat_trow_percent_team_1 = mysqli_fetch_array($data_team_1);
            $row_stat_trow_percent_team_2 = mysqli_fetch_array($data_team_2);
        //----------------------------------------------------------------//
        // формируем и выполняем запрос к таблице  stat_throw_rival
            $stat_throw_rival_team_1 = 'SELECT * FROM  stat_throw_rival WHERE id_team='.$id_team_1;
            $data_team_1 = $id_connect_DB->query($stat_throw_rival_team_1);
            $stat_throw_rival_team_2 = 'SELECT * FROM  stat_throw_rival WHERE id_team='.$id_team_2;
            $data_team_2 = $id_connect_DB->query($stat_throw_rival_team_2);
        // данные команд из таблицы stat_throw_rival
            $row_stat_throw_rival_team_1 = mysqli_fetch_array($data_team_1);
            $row_stat_throw_rival_team_2 = mysqli_fetch_array($data_team_2);
        //----------------------------------------------------------------//
        // формируем и выполняем запрос к таблице  stat_faceoff
            $stat_faceoff_team_1 = 'SELECT * FROM  stat_faceoff WHERE id_team='.$id_team_1;
            $data_team_1 = $id_connect_DB->query($stat_faceoff_team_1);
            $stat_faceoff_team_2 = 'SELECT * FROM  stat_faceoff WHERE id_team='.$id_team_2;
            $data_team_2 = $id_connect_DB->query($stat_faceoff_team_2);
        // данные команд из таблицы stat_throw_rival
            $row_stat_faceoff_team_1 = mysqli_fetch_array($data_team_1);
            $row_stat_faceoff_team_2 = mysqli_fetch_array($data_team_2);
        //----------------------------------------------------------------//
        // формируем и выполняем запрос к таблице  stat_pow_play_pow_kill
            $stat_pow_play_pow_kill_team_1 = 'SELECT * FROM  stat_pow_play_pow_kill WHERE id_team='.$id_team_1;
            $data_team_1 = $id_connect_DB->query($stat_pow_play_pow_kill_team_1);
            $stat_pow_play_pow_kill_team_2 = 'SELECT * FROM  stat_pow_play_pow_kill WHERE id_team='.$id_team_2;
            $data_team_2 = $id_connect_DB->query($stat_pow_play_pow_kill_team_2);
        // данные команд из таблицы stat_throw_rival
            $row_stat_pow_play_pow_kill_team_1 = mysqli_fetch_array($data_team_1);
            $row_stat_pow_play_pow_kill_team_2 = mysqli_fetch_array($data_team_2);
        //----------------------------------------------------------------//
    
        // вызов функции формирования шаблона
        template_2($row_team_1, $row_team_2, $row_stat_penalty_team_1, $row_stat_penalty_team_2, $row_stat_throw_team_1, $row_stat_throw_team_2, $row_stat_trow_percent_team_1, $row_stat_trow_percent_team_2, $row_stat_throw_rival_team_1, $row_stat_throw_rival_team_2, $row_stat_faceoff_team_1, $row_stat_faceoff_team_2, $row_stat_pow_play_pow_kill_team_1, $row_stat_pow_play_pow_kill_team_2, $date_match, $number_match);
        
    }else{
        echo '<br> соединение с БД не устанолвено';
    }


// формирование шаблона 1
function template_2($row_team_1, $row_team_2, $row_stat_penalty_team_1, $row_stat_penalty_team_2, $row_stat_throw_team_1, $row_stat_throw_team_2, $row_stat_trow_percent_team_1, $row_stat_trow_percent_team_2, $row_stat_throw_rival_team_1, $row_stat_throw_rival_team_2, $row_stat_faceoff_team_1, $row_stat_faceoff_team_2, $row_stat_pow_play_pow_kill_team_1, $row_stat_pow_play_pow_kill_team_2, $date_match, $number_match){

// загружаем изображение
//$image = imagecreatefrompng('../../template_img/temp_1-1.png');
$image = imagecreatefrompng('../../template_img/temp2018_1-2.png');
// вставляем данные 
$grey = imagecolorallocate($image, 250, 250, 250);
$green = imagecolorallocate($image, 206, 225, 199);
$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 250, 250, 250);
// Замена пути к шрифту на пользовательский
$font__ = '../../font/soviet.ttf';
$font = '../../font/BigNoodleTitlingCyr.ttf';
// логотипы
$path_logo_temp_1 = '..\..\logo\logo_2018\\'.$row_team_1['id_team'].'.png';
$path_logo_temp_2 = '../../logo/logo_2018/'.$row_team_2['id_team'].'.png';
    $logo_team_1 = imagecreatefrompng($path_logo_temp_1);
    $logo_team_2 = imagecreatefrompng($path_logo_temp_2);
    
    
    $size_logo=200;
    // Копирование и наложение логотипов команд
    imagecopyresized($image, $logo_team_1, 90, 50, 0, 0, $size_logo, $size_logo, $size_logo, $size_logo);
    imagecopyresized($image, $logo_team_2, 420, 50, 0, 0, $size_logo, $size_logo, $size_logo, $size_logo);


//echo '***'.$path_logo_temp_2;

// название команд
    // корректировка некоторых имен команд
    if ($row_team_1['name'] == 'Куньлунь Ред Стар') {$row_team_1['name'] = 'Куньлунь РC';};
    if ($row_team_2['name'] == 'Куньлунь Ред Стар') {$row_team_2['name'] = 'Куньлунь РC';};
    // !!! для каждой команды нужно подгонять позицию по гор - в отдельную функцию
    $place_name_1 = place_name_1($row_team_1['name']);
    $place_name_2 = place_name_2($row_team_2['name']);
    //imagettftext($image, 40, 0, $place_name_1, 255, $black , $font_name_team, $row_team_1['name']);
    //imagettftext($image, 40, 0, $place_name_2, 255, $black, $font_name_team,$row_team_2['name']);
// дата
    imagettftext($image, 25, 0, 300, 140, $white , $font, $date_match);
    $s_f = 23; $pos_x_2 = 560;
// 1-пропущенные шайбы (таблица=table_conf cтолбец=miss_puck)
    imagettftext($image, $s_f, 0, 110, 383, $grey, $font, $row_team_1['miss_puck']);
    imagettftext($image, $s_f, 0, $pos_x_2, 383, $grey, $font, $row_team_2['miss_puck']);
// 2-штрафное время (таблица=stat_penalty столбец=penalty_time)
    imagettftext($image, $s_f, 0, 110, 430, $grey, $font, $row_stat_penalty_team_1['penalty_time']);
    imagettftext($image, $s_f, 0, $pos_x_2, 430, $grey, $font, $row_stat_penalty_team_2['penalty_time']);
// 3-броски по воротам за матч (таблица=stat_throw столбец=total_throw_average)
    imagettftext($image, $s_f, 0, 110, 476, $grey, $font, $row_stat_throw_team_1['total_throw_average']);
    imagettftext($image, $s_f, 0, $pos_x_2, 476, $grey, $font, $row_stat_throw_team_2['total_throw_average']);
// 4-реализация бросков (таблица=stat_trow_percent столбец=throw_perc_total)
    imagettftext($image, $s_f, 0, 110, 525, $grey, $font, $row_stat_trow_percent_team_1['throw_perc_total']);
    //imagettftext($image, 24, 0, 145, 524, $grey, $font_name_team,'%');
    imagettftext($image, $s_f, 0, $pos_x_2, 525, $grey, $font, $row_stat_trow_percent_team_2['throw_perc_total']);
    //imagettftext($image, 24, 0, 596, 524, $grey, $font_name_team,'%');
// 5-броски соперника за матч (таблица=stat_throw_rival столбец=throw_rival_average)
    imagettftext($image, $s_f, 0, 110, 570, $grey, $font, $row_stat_throw_rival_team_1['throw_rival_average']);
    imagettftext($image, $s_f, 0, $pos_x_2, 570, $grey, $font, $row_stat_throw_rival_team_2['throw_rival_average']);
// 6-реализация бросков соперником (таблица=stat_trow_percent столбец=throw_rival_perc_total)
    imagettftext($image, $s_f, 0, 110, 617, $grey, $font, $row_stat_trow_percent_team_1['throw_rival_perc_total']);
    //imagettftext($image, 24, 0, 145, 617, $grey, $font_name_team,'%');
    imagettftext($image, $s_f, 0, $pos_x_2, 617, $grey, $font, $row_stat_trow_percent_team_2['throw_rival_perc_total']);
    //imagettftext($image, 24, 0, 596, 617, $grey, $font_name_team,'%');
// 7-вбрасывания (таблица=stat_faceoff столбец=faceoff_total)
    imagettftext($image, $s_f, 0, 110, 667, $grey, $font, $row_stat_faceoff_team_1['faceoff_total']);
    imagettftext($image, $s_f, 0, $pos_x_2, 667, $grey, $font, $row_stat_faceoff_team_2['faceoff_total']);
// 8-выигранные вбрасывания  (таблица=stat_faceoff столбец=faceoff_perc_wins_total)
    imagettftext($image, $s_f, 0, 110, 712, $grey, $font, $row_stat_faceoff_team_1['faceoff_perc_wins_total']);
    //imagettftext($image, 20, 0, 150, 712, $grey, $font_name_team,'%');
    imagettftext($image, $s_f, 0, $pos_x_2, 712, $grey, $font, $row_stat_faceoff_team_2['faceoff_perc_wins_total']);
    //imagettftext($image, 20, 0, 600, 712, $grey, $font_name_team,'%');
// 9-реализация большинства (таблица=stat_pow_play_pow_kill столбец=perc_power_play)
    imagettftext($image, $s_f, 0, 110, 760, $grey, $font, $row_stat_pow_play_pow_kill_team_1['perc_power_play']);
    imagettftext($image, $s_f, 0, $pos_x_2, 760, $grey, $font, $row_stat_pow_play_pow_kill_team_2['perc_power_play']);
// 10-реализация меньшинства соперником (таблица=stat_pow_play_pow_kill столбец=perc_power_kill)
    imagettftext($image, $s_f, 0, 110, 808, $grey, $font, $row_stat_pow_play_pow_kill_team_1['perc_power_kill']);
    imagettftext($image, $s_f, 0, $pos_x_2, 808, $grey, $font, $row_stat_pow_play_pow_kill_team_2['perc_power_kill']);
    
    
imagepng($image,'../../template_img/new_2018/match_'.$number_match.'_temp_1-2.png',9);

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
            case 'Куньлунь РC':     $x_team_1 = 70; break;
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
            case 'Куньлунь РC':     $x_team_2 = 430; break;
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