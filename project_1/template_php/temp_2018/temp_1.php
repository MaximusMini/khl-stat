<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../../../php/link.php'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="image/png">
    <title>Шаблон 1</title>
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
           <img src="temp_1.php" alt=""> 
        </div>
        <div class="col-md-4">
            
        </div>
    </div>  
</body>
</html>


<?php
// из файла images.php получаем параметры для определения команд и дату матча

$id_team_1 = $_POST['team_1'];
$id_team_2 = $_POST['team_2'];

//$id_team_1 = '14';
//$id_team_2 = '15';

$date_match = $_POST['date_match'];
//$date_match = '14.10.2017';


$number_match = $_POST['number_match'];
//$number_match = '307';




echo '<br>id 1--'.$id_team_1;
echo '<br>id 2--'.$id_team_2;

// подключаем БД
//$id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
$id_connect_DB = new mysqli('localhost', 'root', '', 'db_preview');
    if($id_connect_DB){
        // формируем и выполняем запрос к таблице table_conf 
            $query_team_1 = 'SELECT * FROM table_conf WHERE id_team='.$id_team_1;
            $data_team_1 = $id_connect_DB->query($query_team_1);
            $query_team_2 = 'SELECT * FROM table_conf WHERE id_team='.$id_team_2;
            $data_team_2 = $id_connect_DB->query($query_team_2);
        
        // данные команд из таблицы table_conf
            $row_team_1 = mysqli_fetch_array($data_team_1);
            $row_team_2 = mysqli_fetch_array($data_team_2);
        
        // определяем конференции команд
        $conf_team_1 = 'SELECT conf FROM team WHERE id_team='.$id_team_1;
        $conf_team_1 = mysqli_fetch_row($id_connect_DB->query($conf_team_1));
        $conf_team_2 = 'SELECT conf FROM team WHERE id_team='.$id_team_2;
        $conf_team_2 = mysqli_fetch_row($id_connect_DB->query($conf_team_2));
        
        $row = mysqli_fetch_array($data_team_1);
        
        echo '<br>---'.$row['throw_puck'];
        
        template_1($row_team_1, $row_team_2, $conf_team_1, $conf_team_2, $date_match, $number_match);
        
    }else{
        echo '<br> соединение с БД не устанолвено';
    }


// формирование шаблона 1
function template_1($row_team_1, $row_team_2, $conf_team_1, $conf_team_2, $date_match, $number_match){

// загружаем изображение
//$image = imagecreatefrompng('../../template_img/temp_1-1.png');
$image = imagecreatefrompng('../../template_img/temp2018_1-1.png');
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
    //if ($row_team_1['name'] == 'Куньлунь Ред Стар') {$row_team_1['name'] = 'Куньлунь РC';};
    //if ($row_team_2['name'] == 'Куньлунь Ред Стар') {$row_team_2['name'] = 'Куньлунь РC';};
    // !!! для каждой команды нужно подгонять позицию по гор - в отдельную функцию
    $place_name_1 = place_name_1($row_team_1['name']);
    $place_name_2 = place_name_2($row_team_2['name']);
    //imagettftext($image, 40, 0, $place_name_1, 255, $black , $font_name_team, $row_team_1['name']);
    //imagettftext($image, 40, 0, $place_name_2, 255, $black, $font_name_team,$row_team_2['name']);
// дата
    imagettftext($image, 25, 0, 300, 140, $white , $font, $date_match);
// конференция
    //imagettftext($image, 11, 0, 100, 338, $grey, $font, $conf_team_1[0]);
    //imagettftext($image, 11, 0, 515, 338, $grey, $font, $conf_team_2[0]);
// место в конференции
    imagettftext($image, 23, 0, 120, 380, $grey, $font, $row_team_1['place']);
    imagettftext($image, 23, 0, 565, 380, $grey, $font, $row_team_2['place']);
// проведенные игры
    imagettftext($image, 23, 0, 120, 430, $grey, $font, $row_team_1['games']);
    imagettftext($image, 23, 0, 565, 430, $grey, $font, $row_team_2['games']);
// набранные очки
    //echo "<br>row_team_1['scores']".$row_team_1['scores'];
    //echo "<br>row_team_1['scores']".$row_team_1['scores'];
    imagettftext($image, 23, 0, 120, 476, $grey, $font, $row_team_1['scores']);
    imagettftext($image, 23, 0, 565, 476, $grey, $font, $row_team_2['scores']);
// победы
    imagettftext($image, 23, 0, 120, 524, $grey, $font, $row_team_1['clear_wins']);
    imagettftext($image, 23, 0, 565, 524, $grey, $font, $row_team_2['clear_wins']);
// победы ОТ
    imagettftext($image, 23, 0, 120, 570, $grey, $font, $row_team_1['ot_wins']);
    imagettftext($image, 23, 0, 565, 570, $grey, $font, $row_team_2['ot_wins']);
// победы Б
    imagettftext($image, 23, 0, 120, 617, $grey, $font, $row_team_1['b_wins']);
    imagettftext($image, 23, 0, 565, 617, $grey, $font, $row_team_2['b_wins']);
// поражения
    imagettftext($image, 23, 0, 120, 667, $grey, $font, $row_team_1['clear_defeat']);
    imagettftext($image, 23, 0, 565, 667, $grey, $font, $row_team_2['clear_defeat']);
// поражения ОТ
    imagettftext($image, 23, 0, 120, 712, $grey, $font, $row_team_1['ot_defeat']);
    imagettftext($image, 23, 0, 565, 712, $grey, $font, $row_team_2['ot_defeat']);
// поражения Б
    imagettftext($image, 23, 0, 120, 760, $grey, $font, $row_team_1['b_defeat']);
    imagettftext($image, 23, 0, 565, 760, $grey, $font, $row_team_2['b_defeat']);
// заброшенные шайбы
    imagettftext($image, 23, 0, 120, 808, $grey, $font, $row_team_1['throw_puck']);
    imagettftext($image, 23, 0, 565, 808, $grey, $font, $row_team_2['throw_puck']);
// сохраняем изображение
    imagepng($image,'../../template_img/new_2018/match_'.$number_match.'_temp_1-1.png',9);

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
            case 'Салават Юлаев':   $x_team_2 = 410; break;
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