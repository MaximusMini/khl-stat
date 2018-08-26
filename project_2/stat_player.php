<?php
echo '';
include_once('..\php\phpQuery.php');


$arr_stat_player = [];


$ggg=30;

function main_pars(){
    global $arr_stat_player;
    $res_curl = curl_get ('https://www.ska.ru/team/player/105/');
    $file_phpQuery = phpQuery::newDocument($res_curl);
    $result_phpQuery = $file_phpQuery->find('span.js-dataPlayer')->text();

    $result_arr = json_decode($result_phpQuery,true);   
    //printArray($result_arr);team-block__number player-card__stats-value
    
	echo '<br>Фамилия '.explode(' ', $file_phpQuery->find('div.team-block__name')->text())[1];
    $arr_stat_player['family']=explode(' ', $file_phpQuery->find('div.team-block__name')->text())[1];
	
    echo '<br>Имя '.explode(' ', $file_phpQuery->find('div.team-block__name')->text())[0];
    $arr_stat_player['name']= explode(' ', $file_phpQuery->find('div.team-block__name')->text())[0];
	
    echo '<br>Фото https://cdn.ska.ru/'. $img_pl = $file_phpQuery->find('img.team-block__image-img')->attr('src');
    $arr_stat_player['image']='https://cdn.ska.ru/'.$file_phpQuery->find('img.team-block__image-img')->attr('src');
	
    echo '<br>номер '.$file_phpQuery->find('div.team-block__number')->text();
    $arr_stat_player['number']=$file_phpQuery->find('div.team-block__number')->text();
	
    echo '<br>амплуа '.$file_phpQuery->find('li.player-card__stats-item:nth-child(1) span.player-card__stats-value')->text();
    $arr_stat_player['amplua']=$file_phpQuery->find('li.player-card__stats-item:nth-child(1) span.player-card__stats-value')->text();
    
    echo '<br>Сезон '.$result_arr['type_regular']['2017/2018']['season'];
    $arr_stat_player['season']=$result_arr['type_regular']['2017/2018']['season'];
    
    echo '<br>Игр '.$result_arr['type_regular']['2017/2018']['gamesPlayed'];
    $arr_stat_player['gamesPlayed']= $result_arr['type_regular']['2017/2018']['gamesPlayed'];
    
    echo '<br>Очков '.$result_arr['type_regular']['2017/2018']['points'];
    $arr_stat_player['points']=$result_arr['type_regular']['2017/2018']['points'];
    
    echo '<br>Шайбы '.$result_arr['type_regular']['2017/2018']['goals'];
    $arr_stat_player['goals']=$result_arr['type_regular']['2017/2018']['goals'];
    
    echo '<br>Передачи '.$result_arr['type_regular']['2017/2018']['assists'];
    $arr_stat_player['assists']=$result_arr['type_regular']['2017/2018']['assists'];
    
    echo '<br>Среднее время на площадке '.$result_arr['type_regular']['2017/2018']['averageTimeOnIceGame'];
    $arr_stat_player['averageTimeOnIceGame']=$result_arr['type_regular']['2017/2018']['averageTimeOnIceGame'];
    
    echo '<br>Плюс/минус '.$result_arr['type_regular']['2017/2018']['plusMinus'];
    $arr_stat_player['plusMinus']=$result_arr['type_regular']['2017/2018']['plusMinus'];
    
    echo '<br>Штрафное время '.$result_arr['type_regular']['2017/2018']['penaltyInMinutes'];
    $arr_stat_player['penaltyInMinutes']= $result_arr['type_regular']['2017/2018']['penaltyInMinutes'];
    
    echo '<br>Шайбы в равных составах '.$result_arr['type_regular']['2017/2018']['evenStrengthGoal'];
    $arr_stat_player['evenStrengthGoal']= $result_arr['type_regular']['2017/2018']['evenStrengthGoal'];
    
    echo '<br>Шайбы в большинстве '.$result_arr['type_regular']['2017/2018']['powerPlayGoals'];
    $arr_stat_player['powerPlayGoals']=$result_arr['type_regular']['2017/2018']['powerPlayGoals'];
    
    echo '<br>Шайбы в меньшинстве '.$result_arr['type_regular']['2017/2018']['shorthandedGoals'];
    $arr_stat_player['shorthandedGoals']=$result_arr['type_regular']['2017/2018']['shorthandedGoals'];
    
    echo '<br>Победные шайбы '.$result_arr['type_regular']['2017/2018']['gameWinningGoals'];
    $arr_stat_player['gameWinningGoals']=$result_arr['type_regular']['2017/2018']['gameWinningGoals'];
    
    echo '<br>Шайбы в овертайме '.$result_arr['type_regular']['2017/2018']['overtimeGoals'];
    $arr_stat_player['overtimeGoals']=$result_arr['type_regular']['2017/2018']['overtimeGoals'];
    
    echo '<br>Решающие буллиты '.$result_arr['type_regular']['2017/2018']['shootoutsDecidingShots'];
    $arr_stat_player['shootoutsDecidingShots']=$result_arr['type_regular']['2017/2018']['shootoutsDecidingShots'];
    
    echo '<br>Броски по воротам '.$result_arr['type_regular']['2017/2018']['shotsOnGoal'];
    $arr_stat_player['shotsOnGoal']=$result_arr['type_regular']['2017/2018']['shotsOnGoal'];
    
    echo '<br>Процент реализованных бросков '.$result_arr['type_regular']['2017/2018']['shotsOnGoalPercentage'];
    $arr_stat_player['shotsOnGoalPercentage']=$result_arr['type_regular']['2017/2018']['shotsOnGoalPercentage'];
    
    echo '<br>Среднее количество бросков по воротам за игру '.$result_arr['type_regular']['2017/2018']['averageShotsGame'];
    $arr_stat_player['averageShotsGame']=$result_arr['type_regular']['2017/2018']['averageShotsGame'];
    
    echo '<br>Все вбрасывания '.$result_arr['type_regular']['2017/2018']['faceoffs'];
    $arr_stat_player['faceoffs']=$result_arr['type_regular']['2017/2018']['faceoffs'];
    
    echo '<br>Процент выигранных вбрасываний '.$result_arr['type_regular']['2017/2018']['faceoffsWonPercentage'];
    $arr_stat_player['faceoffsWonPercentage']=$result_arr['type_regular']['2017/2018']['faceoffsWonPercentage'];
    
    echo '<br>Выигранные вбрасывания '.$result_arr['type_regular']['2017/2018']['faceoffsWon'];
    $arr_stat_player['faceoffsWon']=$result_arr['type_regular']['2017/2018']['faceoffsWon'];
    
    echo '<br>Силовые приемы'.$result_arr['type_regular']['2017/2018']['hits'];
    $arr_stat_player['hits']=$result_arr['type_regular']['2017/2018']['hits'];
    
    echo '<br>Блокированные броски'.$result_arr['type_regular']['2017/2018']['blockedShots'];
    $arr_stat_player['blockedShots']=$result_arr['type_regular']['2017/2018']['blockedShots'];
    
    printArray($arr_stat_player);

}


function imageTemplate(){
    global $arr_stat_player,$ggg;
    
    // загружаем изображение
    $image = imagecreatefrompng('template_stat_player_SKA.png');
    
    
    // установка шрифтов
    $font = '../font/soviet.ttf';
    $font_BigNoodle = '../font/BigNoodleTitlingCyr.ttf';
    // установка цветов
    $red = imagecolorallocate($image, 119, 9, 22);
    $green = imagecolorallocate($image, 206, 225, 199);
    $black = imagecolorallocate($image, 0, 0, 0);
    
    // фото игрока
    $img_photo = imagecreatefrompng($arr_stat_player['image']);
    // подгоняем под нужный размер и вставляем
    imagecopyresized($image, $img_photo, 45, 60, 0, 0, 200, 200, 160,160);
    // убираем белый фон
    $img_photo = imagecropauto($img_photo,IMG_CROP_WHITE);
    /*
    расчет автоматического интервала между фамилией и именем
    фамилия - ГУСЕВ (5 символов) составляет 80 пунктов (79,37)
    т.е. один символ = 80/5 = 16 пунктов
    вычисление интервала
        получаем количество символов в фамилии strlen($arr_stat_player['family'])
        делим их на 2, т.к. функция возвращает удвоенное значение
        полученную цифру умножаем на 16
        добавляем 10-20 пунктов
        прибовляем к исходной позиции фамилии
    */
    // вставка фамилии
    imagettftext($image, 40, 0, 285, 100, $black, $font_BigNoodle, $arr_stat_player['family']);
    // вставка имени
    imagettftext($image, 40, 0, 285 + ((strlen($arr_stat_player['family']))/2)*18+$ggg , 100, $black, $font_BigNoodle, $arr_stat_player['name']);
    // вставка номера
    imagettftext($image, 40, 0, 330, 160, $black, $font_BigNoodle, $arr_stat_player['number']);
    // вставка амплуа
    imagettftext($image, 16, 0, 370, 203, $black, $font, $arr_stat_player['amplua']);
    // вставка игр
    imagettftext($image, 36, 0, 105, 375, $red, $font, $arr_stat_player['gamesPlayed']);
    // вставка очков
    imagettftext($image, 36, 0, 300, 375, $red, $font, $arr_stat_player['points']);
    // вставка шайб
    imagettftext($image, 36, 0, 495, 375, $red, $font, $arr_stat_player['goals']);
    // вставка передач
    imagettftext($image, 36, 0, 685, 375, $red, $font, $arr_stat_player['assists']);
    // вставка Шайбы в равных составах
    imagettftext($image, 36, 0, 52, 595, $red, $font, $arr_stat_player['evenStrengthGoal']);
    // вставка Шайбы в большинстве
    imagettftext($image, 36, 0, 165, 595, $red, $font, $arr_stat_player['powerPlayGoals']);
    // вставка Шайбы в меньшинстве
    imagettftext($image, 36, 0, 310, 595, $red, $font, $arr_stat_player['shorthandedGoals']);
    // вставка Победные шайбы
    imagettftext($image, 36, 0, 475, 595, $red, $font, $arr_stat_player['gameWinningGoals']);
    // вставка Шайбы в овертайме
    imagettftext($image, 36, 0, 585, 595, $red, $font, $arr_stat_player['overtimeGoals']);
    // вставка Решающие буллиты
    imagettftext($image, 36, 0, 715, 595, $red, $font, $arr_stat_player['shootoutsDecidingShots']);
    // вставка Среднее время на площадке
    imagettftext($image, 36, 0, 50, 750, $red, $font, $arr_stat_player['averageTimeOnIceGame']);
    // вставка Плюс/минус
    imagettftext($image, 36, 0, 252, 750, $red, $font, $arr_stat_player['plusMinus']);
    // вставка Штрафное время
    imagettftext($image, 36, 0, 387, 750, $red, $font, $arr_stat_player['penaltyInMinutes']);
    // вставка Силовые приемы
    imagettftext($image, 36, 0, 537, 750, $red, $font, $arr_stat_player['hits']);
    // вставка Блокированные броски
    imagettftext($image, 36, 0, 665, 750, $red, $font, $arr_stat_player['blockedShots']);
    // вставка Броски по воротам
    imagettftext($image, 36, 0, 50, 935, $red, $font, $arr_stat_player['shotsOnGoal']);
    // вставка Процент реализованных бросков
    imagettftext($image, 36, 0, 270, 935, $red, $font, $arr_stat_player['shotsOnGoalPercentage']);
    // вставка Среднее количество бросков по воротам за игру
    imagettftext($image, 36, 0, 575, 935, $red, $font, $arr_stat_player['averageShotsGame']);
    // вставка Все вбрасывания
    imagettftext($image, 36, 0, 50, 1102, $red, $font, $arr_stat_player['faceoffs']);
    // вставка Процент выигранных вбрасываний
    imagettftext($image, 36, 0, 270, 1102, $red, $font, $arr_stat_player['faceoffsWonPercentage']);
    // вставка Выигранные вбрасывания
    imagettftext($image, 36, 0, 575, 1102, $red, $font, $arr_stat_player['faceoffsWon']);
    
    
    
    
  

    // сохраняем изображение
    imagepng($image,'new/stat_player_SKA.png',9);
    
    
    
    
    
}




// вызовы функций ***********************************************************
    main_pars();
    imageTemplate();
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