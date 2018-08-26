<?

include_once('..\php\phpQuery.php');

// массивы для сбора данных
$arr_scores=[];// массив бомбардиров
$arr_goals=[];// массив снайперов
// страница с данными
$page = curl_get ('https://www.khl.ru/stat/');

// функция полученяи страницы

// парсинг бомбардиров плей-офф
function parse_scores($url){
    global $arr_scores; global $page;
	$data_pQ = phpQuery::newDocument($page);
    
   $scores = $data_pQ->find('.b-data_row:nth-child(1) .k-data_table table tr');

    $num_arr=0;
    foreach ($scores as $val_1){
        echo "</br>---".pq($val_1)->find('td:nth-child(1) h5')->text();
        // имя игрока
        $arr_scores[$num_arr]['name'] = trim(strip_tags(pq($val_1)->find('td:nth-child(1) h5')->text()));
        // фото игрока
        $arr_scores[$num_arr]['foto'] = 'https://khl.ru'.pq($val_1)->find('td:nth-child(1) img')->attr('src');
        // номер игрока
        $arr_scores[$num_arr]['number'] = trim(pq($val_1)->find('td:nth-child(2)')->text());
        // клуб игрока
        $arr_scores[$num_arr]['club'] = trim(pq($val_1)->find('td:nth-child(3)')->text());
        // проведенных игр
        $arr_scores[$num_arr]['games'] = trim(pq($val_1)->find('td:nth-child(4)')->text());
        // заброшенных шайб
        $arr_scores[$num_arr]['pucks'] = trim(pq($val_1)->find('td:nth-child(5)')->text());
        // передач
        $arr_scores[$num_arr]['pass'] = trim(pq($val_1)->find('td:nth-child(6)')->text());
        // очков
        $arr_scores[$num_arr]['scores'] = trim(pq($val_1)->find('td:nth-child(7)')->text());
        $num_arr++;
    }
    printArray($arr_scores);
    template($arr_scores,'scores');
}
// парсинг снайперов плей-офф
function parse_goals($url){
    global $arr_goals; global $page;
	$data_pQ = phpQuery::newDocument($page);
    
   $scores = $data_pQ->find('.b-data_row:nth-child(4) .k-data_table table tr');

    $num_arr=0;
    foreach ($scores as $val_1){
        echo "</br>---".pq($val_1)->find('td:nth-child(1) h5')->text();
        // имя игрока
        $arr_goals[$num_arr]['name'] = trim(strip_tags(pq($val_1)->find('td:nth-child(1) h5')->text()));
        // фото игрока
        $arr_goals[$num_arr]['foto'] = 'https://khl.ru'.pq($val_1)->find('td:nth-child(1) img')->attr('src');
        // номер игрока
        $arr_goals[$num_arr]['number'] = trim(pq($val_1)->find('td:nth-child(2)')->text());
        // клуб игрока
        $arr_goals[$num_arr]['club'] = trim(pq($val_1)->find('td:nth-child(3)')->text());
        // проведенных игр
        $arr_goals[$num_arr]['games'] = trim(pq($val_1)->find('td:nth-child(4)')->text());
        // заброшенных шайб
        $arr_goals[$num_arr]['pucks'] = trim(pq($val_1)->find('td:nth-child(5)')->text());
        // передач
        $arr_goals[$num_arr]['pass'] = trim(pq($val_1)->find('td:nth-child(6)')->text());
        // очков
        $arr_goals[$num_arr]['scores'] = trim(pq($val_1)->find('td:nth-child(7)')->text());
        $num_arr++;
    }
    printArray($arr_goals);
    template($arr_goals,'goals');
}
// парсинг ассистентов плей-офф
function parse_assist($url){
    global $arr_goals; global $page;
	$data_pQ = phpQuery::newDocument($page);
    
   $scores = $data_pQ->find('.b-data_row:nth-child(7) .k-data_table table tr');

    $num_arr=0;
    foreach ($scores as $val_1){
        echo "</br>---".pq($val_1)->find('td:nth-child(1) h5')->text();
        // имя игрока
        $arr_goals[$num_arr]['name'] = trim(strip_tags(pq($val_1)->find('td:nth-child(1) h5')->text()));
        // фото игрока
        $arr_goals[$num_arr]['foto'] = 'https://khl.ru'.pq($val_1)->find('td:nth-child(1) img')->attr('src');
        // номер игрока
        $arr_goals[$num_arr]['number'] = trim(pq($val_1)->find('td:nth-child(2)')->text());
        // клуб игрока
        $arr_goals[$num_arr]['club'] = trim(pq($val_1)->find('td:nth-child(3)')->text());
        // проведенных игр
        $arr_goals[$num_arr]['games'] = trim(pq($val_1)->find('td:nth-child(4)')->text());
        // заброшенных шайб
        $arr_goals[$num_arr]['pucks'] = trim(pq($val_1)->find('td:nth-child(5)')->text());
        // передач
        $arr_goals[$num_arr]['pass'] = trim(pq($val_1)->find('td:nth-child(6)')->text());
        // очков
        $arr_goals[$num_arr]['scores'] = trim(pq($val_1)->find('td:nth-child(7)')->text());
        $num_arr++;
    }
    printArray($arr_goals);
    template($arr_goals,'assist');
}
// парсинг бомбардиров-защитников плей-офф
function parse_scores_def($url){
    global $arr_goals; global $page;
	$data_pQ = phpQuery::newDocument($page);
    
   $scores = $data_pQ->find('.b-data_row:nth-child(2) .k-data_table table tr');

    $num_arr=0;
    foreach ($scores as $val_1){
        echo "</br>---".pq($val_1)->find('td:nth-child(1) h5')->text();
        // имя игрока
        $arr_goals[$num_arr]['name'] = trim(strip_tags(pq($val_1)->find('td:nth-child(1) h5')->text()));
        // фото игрока
        $arr_goals[$num_arr]['foto'] = 'https://khl.ru'.pq($val_1)->find('td:nth-child(1) img')->attr('src');
        // номер игрока
        $arr_goals[$num_arr]['number'] = trim(pq($val_1)->find('td:nth-child(2)')->text());
        // клуб игрока
        $arr_goals[$num_arr]['club'] = trim(pq($val_1)->find('td:nth-child(3)')->text());
        // проведенных игр
        $arr_goals[$num_arr]['games'] = trim(pq($val_1)->find('td:nth-child(4)')->text());
        // заброшенных шайб
        $arr_goals[$num_arr]['pucks'] = trim(pq($val_1)->find('td:nth-child(5)')->text());
        // передач
        $arr_goals[$num_arr]['pass'] = trim(pq($val_1)->find('td:nth-child(6)')->text());
        // очков
        $arr_goals[$num_arr]['scores'] = trim(pq($val_1)->find('td:nth-child(7)')->text());
        $num_arr++;
    }
    printArray($arr_goals);
    template($arr_goals,'scores_def');
}
// парсинг снайперов-защитников плей-офф
function parse_goals_def($url){
    global $arr_goals; global $page;
	$data_pQ = phpQuery::newDocument($page);
    
   $scores = $data_pQ->find('.b-data_row:nth-child(5) .k-data_table table tr');

    $num_arr=0;
    foreach ($scores as $val_1){
        echo "</br>---".pq($val_1)->find('td:nth-child(1) h5')->text();
        // имя игрока
        $arr_goals[$num_arr]['name'] = trim(strip_tags(pq($val_1)->find('td:nth-child(1) h5')->text()));
        // фото игрока
        $arr_goals[$num_arr]['foto'] = 'https://khl.ru'.pq($val_1)->find('td:nth-child(1) img')->attr('src');
        // номер игрока
        $arr_goals[$num_arr]['number'] = trim(pq($val_1)->find('td:nth-child(2)')->text());
        // клуб игрока
        $arr_goals[$num_arr]['club'] = trim(pq($val_1)->find('td:nth-child(3)')->text());
        // проведенных игр
        $arr_goals[$num_arr]['games'] = trim(pq($val_1)->find('td:nth-child(4)')->text());
        // заброшенных шайб
        $arr_goals[$num_arr]['pucks'] = trim(pq($val_1)->find('td:nth-child(5)')->text());
        // передач
        $arr_goals[$num_arr]['pass'] = trim(pq($val_1)->find('td:nth-child(6)')->text());
        // очков
        $arr_goals[$num_arr]['scores'] = trim(pq($val_1)->find('td:nth-child(7)')->text());
        $num_arr++;
    }
    printArray($arr_goals);
    template($arr_goals,'goals_def');
}
// парсинг ассистентов-защитников плей-офф
function parse_assist_def($url){
    global $arr_goals; global $page;
	$data_pQ = phpQuery::newDocument($page);
    
   $scores = $data_pQ->find('.b-data_row:nth-child(8) .k-data_table table tr');

    $num_arr=0;
    foreach ($scores as $val_1){
        echo "</br>---".pq($val_1)->find('td:nth-child(1) h5')->text();
        // имя игрока
        $arr_goals[$num_arr]['name'] = trim(strip_tags(pq($val_1)->find('td:nth-child(1) h5')->text()));
        // фото игрока
        $arr_goals[$num_arr]['foto'] = 'https://khl.ru'.pq($val_1)->find('td:nth-child(1) img')->attr('src');
        // номер игрока
        $arr_goals[$num_arr]['number'] = trim(pq($val_1)->find('td:nth-child(2)')->text());
        // клуб игрока
        $arr_goals[$num_arr]['club'] = trim(pq($val_1)->find('td:nth-child(3)')->text());
        // проведенных игр
        $arr_goals[$num_arr]['games'] = trim(pq($val_1)->find('td:nth-child(4)')->text());
        // заброшенных шайб
        $arr_goals[$num_arr]['pucks'] = trim(pq($val_1)->find('td:nth-child(5)')->text());
        // передач
        $arr_goals[$num_arr]['pass'] = trim(pq($val_1)->find('td:nth-child(6)')->text());
        // очков
        $arr_goals[$num_arr]['scores'] = trim(pq($val_1)->find('td:nth-child(7)')->text());
        $num_arr++;
    }
    printArray($arr_goals);
    template($arr_goals,'assist_def');
}
// функция формирования картинки
function template($arr,$categories){
    // загружаем изображение
    switch($categories){
            case 'scores'       :$image = imagecreatefrompng('temp_lead_scores.png');break;
            case 'goals'        :$image = imagecreatefrompng('temp_lead_goals.png');break;
            case 'assist'       :$image = imagecreatefrompng('temp_lead_assist.png');break;
            case 'scores_def'   :$image = imagecreatefrompng('temp_lead_scores_def.png');break;
            case 'goals_def'        :$image = imagecreatefrompng('temp_lead_goals_def.png');break;
            case 'assist_def'       :$image = imagecreatefrompng('temp_lead_assist_def.png');break;
            
    }
    
    //$image = imagecreatefrompng('temp_lead_scores.png');
    // ЦВЕТА 
    $grey = imagecolorallocate($image, 249, 230, 85);
    $green = imagecolorallocate($image, 206, 225, 199);
    $green_1 = imagecolorallocate($image, 209,227,207);
    $green_2 = imagecolorallocate($image, 243,245,243);
    $green_3 = imagecolorallocate($image, 90,229,79);
    $black = imagecolorallocate($image, 0, 0, 0);
    $yellow = imagecolorallocate($image, 244,255,120);
    // ШРИФТЫ
    $font = '../font/soviet.ttf';
    $font_BigNoodle = '../font/BigNoodleTitlingCyr.ttf';
    $font_Xolonium = '../font/Xolonium_Bold.ttf';
    $font_Impact = '../font/Impact_Regular.ttf';
    $font_Verdana = '../font/verdanab.ttf';
    // -------------------------------------------------
    // категория статистики
    //imagettftext($image, 15, 0, 270, 195, $yellow, $font, 'БОБМАРДИРЫ');
    // -------------------------------------------------
    // ИГРОК 1
    // фото игрока
    $img_photo = imagecreatefromjpeg($arr[1]['foto']);
    imagecopyresized($image,$img_photo ,11,289,0,0,186,181, 320,320);
    // фамилия имя
    $pos_x = pos_name($arr[1]['name'], 1); // высчитываем положение фамилии и имени игрока
    if ($arr[1]['name'] == 'Кагарлицкий Дмитрий'){
        imagettftext($image, 13, 0, 14, 495, $green_1, $font_Impact, $arr[1]['name']);    
    }else {imagettftext($image, 15, 0, $pos_x[0], 495, $green_1, $font_Impact, $arr[1]['name']);}
    // клуб
    $pos_club = pos_club($arr[1]['club']);
    imagettftext($image, 13, 0, $pos_club[0], 520, $green_2, $font_BigNoodle, $arr[1]['club']);
    // игр
    if(strlen( $arr[1]['games']) == 1){
        imagettftext($image, 18, 0, 30, 588, $green_3, $font_Verdana, $arr[1]['games']);    
    }else{ imagettftext($image, 18, 0, 20, 588, $green_3, $font_Verdana, $arr[1]['games']);}
    // шайб
    if(strlen( $arr[1]['pucks']) == 1){
        imagettftext($image, 18, 0, 73, 588, $green_3, $font_Verdana, $arr[1]['pucks']);    
    }else{ imagettftext($image, 18, 0, 63, 588, $green_3, $font_Verdana, $arr[1]['pucks']);}
    // передач
    if(strlen( $arr[1]['pass']) == 1){
        imagettftext($image, 18, 0, 109, 588, $green_3, $font_Verdana, $arr[1]['pass']);    
    }else{ imagettftext($image, 18, 0, 99, 588, $green_3, $font_Verdana, $arr[1]['pass']);}
    // очков
    if(strlen( $arr[1]['scores']) == 1){
        imagettftext($image, 18, 0, 148, 588, $green_3, $font_Verdana, $arr[1]['scores']);    
    }else{ imagettftext($image, 18, 0, 138, 588, $green_3, $font_Verdana, $arr[1]['scores']);}
    // -------------------------------------------------
    // -------------------------------------------------
    // ИГРОК 2
    // фото игрока
    $img_photo = imagecreatefromjpeg($arr[2]['foto']);
    imagecopyresized($image,$img_photo ,215,289,0,0,186,181, 320,320);
    // фамилия имя
    $pos_x = pos_name($arr[2]['name'], 2); // высчитываем положение фамилии и имени игрока
    imagettftext($image, 15, 0, $pos_x[1], 495, $green_1, $font_Impact, $arr[2]['name']);
    // клуб
    $pos_club = pos_club($arr[2]['club']);
    imagettftext($image, 13, 0, $pos_club[1], 520, $green_2, $font_BigNoodle, $arr[2]['club']);
    // игр
    if(strlen( $arr[2]['games']) == 1){
        imagettftext($image, 18, 0, 237, 588, $green_3, $font_Verdana, $arr[2]['games']);    
    }else{ imagettftext($image, 18, 0, 227, 588, $green_3, $font_Verdana, $arr[2]['games']);}
    // шайб
    if(strlen( $arr[2]['pucks']) == 1){
        imagettftext($image, 18, 0, 277, 588, $green_3, $font_Verdana, $arr[2]['pucks']);    
    }else{ imagettftext($image, 18, 0, 267, 588, $green_3, $font_Verdana, $arr[2]['pucks']);}
    // передач
    if(strlen( $arr[2]['pass']) == 1){
        imagettftext($image, 18, 0, 314, 588, $green_3, $font_Verdana, $arr[2]['pass']);    
    }else{ imagettftext($image, 18, 0, 304, 588, $green_3, $font_Verdana, $arr[2]['pass']);}
    // очков
    if(strlen( $arr[2]['scores']) == 1){
        imagettftext($image, 18, 0, 351, 588, $green_3, $font_Verdana, $arr[2]['scores']);    
    }else{ imagettftext($image, 18, 0, 341, 588, $green_3, $font_Verdana, $arr[2]['scores']);}
    // -------------------------------------------------
    // -------------------------------------------------
    // ИГРОК 3
    // фото игрока
    $img_photo = imagecreatefromjpeg($arr[3]['foto']);
    imagecopyresized($image,$img_photo ,419,289,0,0,186,181, 320,320);
    // фамилия имя
    $pos_x = pos_name($arr[3]['name'], 3); // высчитываем положение фамилии и имени игрока
    //imagettftext($image, 15, 0, $pos_x[2], 495, $green_1, $font_Impact, $arr[3]['name']);
    if ($arr[3]['name'] == 'Кагарлицкий Дмитрий'){
        imagettftext($image, 13, 0, 425, 495, $green_1, $font_Impact, $arr[3]['name']);    
    }else {imagettftext($image, 15, 0, $pos_x[2], 495, $green_1, $font_Impact, $arr[3]['name']);}
    // клуб
    $pos_club = pos_club($arr[3]['club']);
    imagettftext($image, 13, 0, $pos_club[2], 520, $green_2, $font_BigNoodle, $arr[3]['club']);
    // игр
    if(strlen( $arr[3]['games']) == 1){
        imagettftext($image, 18, 0, 440, 588, $green_3, $font_Verdana, $arr[3]['games']);    
    }else{ imagettftext($image, 18, 0, 430, 588, $green_3, $font_Verdana, $arr[3]['games']);}
     // шайб
    if(strlen( $arr[3]['pucks']) == 1){
        imagettftext($image, 18, 0, 480, 588, $green_3, $font_Verdana, $arr[3]['pucks']);    
    }else{ imagettftext($image, 18, 0, 470, 588, $green_3, $font_Verdana, $arr[3]['pucks']);}
    // передач
    if(strlen( $arr[3]['pass']) == 1){
        imagettftext($image, 18, 0, 517, 588, $green_3, $font_Verdana, $arr[3]['pass']);    
    }else{ imagettftext($image, 18, 0, 507, 588, $green_3, $font_Verdana, $arr[3]['pass']);}
    // очков
    if(strlen( $arr[3]['scores']) == 1){
        imagettftext($image, 18, 0, 555, 588, $green_3, $font_Verdana, $arr[3]['scores']);    
    }else{ imagettftext($image, 18, 0, 545, 588, $green_3, $font_Verdana, $arr[3]['scores']);}
    // -------------------------------------------------
    // -------------------------------------------------
    // ИГРОК 4
    // фото игрока
    $img_photo = imagecreatefromjpeg($arr[4]['foto']);
    imagecopyresized($image,$img_photo ,624,289,0,0,186,181, 320,320);
    // фамилия имя
    $pos_x = pos_name($arr[4]['name'], 4); // высчитываем положение фамилии и имени игрока
    if ($arr[4]['name'] == 'Кагарлицкий Дмитрий'){
        imagettftext($image, 13, 0, 627, 495, $green_1, $font_Impact, $arr[4]['name']);    
    }else {imagettftext($image, 15, 0, $pos_x[3], 495, $green_1, $font_Impact, $arr[4]['name']);}
    // клуб
    $pos_club = pos_club($arr[4]['club']);
    imagettftext($image, 13, 0, $pos_club[3], 520, $green_2, $font_BigNoodle, $arr[4]['club']);
    // игр
    if(strlen( $arr[4]['games']) == 1){
        imagettftext($image, 18, 0, 645, 588, $green_3, $font_Verdana, $arr[4]['games']);    
    }else{ imagettftext($image, 18, 0, 635, 588, $green_3, $font_Verdana, $arr[4]['games']);}
     // шайб
    if(strlen( $arr[4]['pucks']) == 1){
        imagettftext($image, 18, 0, 686, 588, $green_3, $font_Verdana, $arr[4]['pucks']);    
    }else{ imagettftext($image, 18, 0, 676, 588, $green_3, $font_Verdana, $arr[4]['pucks']);}
    // передач
    if(strlen( $arr[4]['pass']) == 1){
        imagettftext($image, 18, 0, 722, 588, $green_3, $font_Verdana, $arr[4]['pass']);    
    }else{ imagettftext($image, 18, 0, 712, 588, $green_3, $font_Verdana, $arr[4]['pass']);}
    // очков
    if(strlen( $arr[4]['scores']) == 1){
        imagettftext($image, 18, 0, 761, 588, $green_3, $font_Verdana, $arr[4]['scores']);    
    }else{ imagettftext($image, 18, 0, 751, 588, $green_3, $font_Verdana, $arr[4]['scores']);}
    // -------------------------------------------------
    // -------------------------------------------------
    // ИГРОК 5
    // фото игрока
    $img_photo = imagecreatefromjpeg($arr[5]['foto']);
    imagecopyresized($image,$img_photo ,827,289,0,0,186,181, 320,320);
    // фамилия имя
    $pos_x = pos_name($arr[5]['name'], 5); // высчитываем положение фамилии и имени игрока
    if ($arr[5]['name'] == 'Кагарлицкий Дмитрий'){
        imagettftext($image, 13, 0, 830, 495, $green_1, $font_Impact, $arr[5]['name']);    
    }else {imagettftext($image, 15, 0, $pos_x[4], 495, $green_1, $font_Impact, $arr[5]['name']);}
    // клуб
    $pos_club = pos_club($arr[5]['club']);
    imagettftext($image, 13, 0, $pos_club[4], 520, $green_2, $font_BigNoodle, $arr[5]['club']);
    // игр
    if(strlen( $arr[5]['games']) == 1){
        imagettftext($image, 18, 0, 850, 588, $green_3, $font_Verdana, $arr[5]['games']);    
    }else{ imagettftext($image, 18, 0, 840, 588, $green_3, $font_Verdana, $arr[5]['games']);}
     // шайб
    if(strlen( $arr[5]['pucks']) == 1){
        imagettftext($image, 18, 0, 890, 588, $green_3, $font_Verdana, $arr[5]['pucks']);    
    }else{ imagettftext($image, 18, 0, 880, 588, $green_3, $font_Verdana, $arr[5]['pucks']);}
    // передач
    if(strlen( $arr[5]['pass']) == 1){
        imagettftext($image, 18, 0, 925, 588, $green_3, $font_Verdana, $arr[5]['pass']);    
    }else{ imagettftext($image, 18, 0, 915, 588, $green_3, $font_Verdana, $arr[5]['pass']);}
    // очков
    if(strlen( $arr[5]['scores']) == 1){
        imagettftext($image, 18, 0, 965, 588, $green_3, $font_Verdana, $arr[5]['scores']);    
    }else{ imagettftext($image, 18, 0, 955, 588, $green_3, $font_Verdana, $arr[5]['scores']);}
    // -------------------------------------------------
    
    // СОХРАНЕНИЕ
    imagepng($image,'new/playoff_'.$categories.'.png',9);   
}



// функция расчета позиции фамилии игрока
function pos_name($name, $num_payer){
    // фамлия должна кончаться в точке по х -  196(1), 487(2)
    // т.е. от этого значения нужно отнять длину фамилии
    // определяем длину фамилии - один символ ~ 25-30 (27)
    // массив конечных позиций
//    $pos_end=[196,410];
    echo '<br>длина фамилии '.strlen($name);
//    $pos_x = ($pos_end[$num_payer-1] - (strlen($name)/2*15));
//    echo '<br>позиция '.$pos_x;
    switch(strlen($name)){
            case 13:$pos_x=[50,275,480,700,860];break;
            case 19:$pos_x=[60,255,465,660,870];break;
            case 20:$pos_x=[50,255,465,670,860];break;
            case 21:$pos_x=[50,250,465,670,860];break;
            case 22:$pos_x=[50,255,465,670,860];break;
            case 23:$pos_x=[50,255,455,655,860];break;
            case 24:$pos_x=[50,255,465,670,860];break;
            case 25:$pos_x=[40,245,445,640,850];break;
            case 26:$pos_x=[50,255,465,670,860];break;
            case 27:$pos_x=[35,240,440,645,850];break;
            case 28:$pos_x=[50,255,440,670,860];break;
            case 29:$pos_x=[30,230,437,640,840];break;
            case 31:$pos_x=[26,255,430,640,840];break;
            case 33:$pos_x=[50,225,422,627,832];break;
            case 37:$pos_x=[50,255,430,625,860];break;
        default:$pos_x=[50,255,465,670,860];break;
    }
    
    echo '<br>позиция '.printArray($pos_x);
    return $pos_x;
}

// функция установки позиции названия клуба
function pos_club($name){
    switch($name){
        case 'Амур':$pos_club=[50,255,465,670,860];break;
        case 'Авангард':$pos_club=[50,280,480,685,885];break;
        case 'Ак Барс':$pos_club=[85,285,495,685,900];break;    
        case 'Йокерит':$pos_club=[85,285,490,700,900];break;
        case 'Локомотив':$pos_club=[65,255,490,680,860];break;
        case 'Металлург Мг':$pos_club=[50,275,475,680,885];break;
        case 'Нефтехимик':$pos_club=[50,275,475,680,885];break;
        case 'Салават Юлаев':$pos_club=[60,260,465,670,875];break;
        case 'Северсталь':$pos_club=[65,255,475,680,870];break;
        case 'ХК Сочи':$pos_club=[50,255,465,670,900];break;    
        case 'СКА':$pos_club=[95,300,510,715,905];break;
        case 'Торпедо':$pos_club=[50,285,490,690,890];break;
        case 'Трактор':$pos_club=[85,285,480,690,890];break;
        case 'ЦСКА':$pos_club=[80,285,495,700,890];break;

        default: $pos_club=[50,255,465,670,860];
    };
    return $pos_club;
}

// вызовы функций ***********************************************************
	parse_scores('https://www.khl.ru/stat/');
    parse_goals('https://www.khl.ru/stat/');
    parse_assist($url);
    parse_scores_def($url);
    parse_goals_def($url);
    parse_assist_def($url);
// **************************************************************************

// вспомогательные функции ***********************************************************    
    function printArray($arr){
        echo '<pre>'.print_r($arr,true).'</pre>';
    }
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
// **************************************************************************





















?>