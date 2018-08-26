<form action="" method="get">
    <label for="team_1">команда хозяев</label>
    <select class="form-control" id='team_1' name="t1">
                        <option value="1">Авангард</option>
                        <option value="2">Автомобилист</option>
                        <option value="3">Адмирал</option>
                        <option value="4">Ак Барс</option>
                        <option value="5">Амур</option>
                        <option value="6">Барыс</option>
                        <option value="7">Витязь</option>
                        <option value="8">Динамо М</option>
                        <option value="9">Динамо Мн</option>
                        <option value="10">Динамо Р</option>
                        <option value="11">Йокерит</option>
                        <option value="12">Куньлунь РС</option>
                        <option value="13">Лада</option>
                        <option value="14">Локомотив</option>
                        <option value="15">Металлург Мг</option>
                        <option value="16">Нефтехимик</option>
                        <option value="17">Салават Юлаев</option>
                        <option value="18">Северсталь</option>
                        <option value="19">Сибирь</option>
                        <option value="20">СКА</option>                                                
                        <option value="21">Слован</option>
                        <option value="22">ХК Сочи</option>
                        <option value="23">Спартак</option>
                        <option value="24">Торпедо</option>
                        <option value="25">Трактор</option>
                        <option value="26">ЦСКА</option>
                        <option value="27">Югра</option>
                        </select>
    <label for="team_2">команда гостей</label>
    <select class="form-control" id='team_2' name="t2">
                        <option value="1">Авангард</option>
                        <option value="2">Автомобилист</option>
                        <option value="3">Адмирал</option>
                        <option value="4">Ак Барс</option>
                        <option value="5">Амур</option>
                        <option value="6">Барыс</option>
                        <option value="7">Витязь</option>
                        <option value="8">Динамо М</option>
                        <option value="9">Динамо Мн</option>
                        <option value="10">Динамо Р</option>
                        <option value="11">Йокерит</option>
                        <option value="12">Куньлунь РС</option>
                        <option value="13">Лада</option>
                        <option value="14">Локомотив</option>
                        <option value="15">Металлург Мг</option>
                        <option value="16">Нефтехимик</option>
                        <option value="17">Салават Юлаев</option>
                        <option value="18">Северсталь</option>
                        <option value="19">Сибирь</option>
                        <option value="20">СКА</option>                                                
                        <option value="21">Слован</option>
                        <option value="22">ХК Сочи</option>
                        <option value="23">Спартак</option>
                        <option value="24">Торпедо</option>
                        <option value="25">Трактор</option>
                        <option value="26">ЦСКА</option>
                        <option value="27">Югра</option>

                        </select>
    <input type="number" name='score1'>
    <input type="number" name='score2'>
    <label for="number_match">номер матча</label>
    <input type="text" name='number_match' id='number_match'>
    <input type="date" id="dat" name="date">
    <input type="submit" value="Отправить">
</form>



<?
//echo 'good';
include_once('..\..\..\php\phpQuery.php');

//$t1 = $_POST['t1'];
//$t2 = $_POST['t2'];
//$date = $_POST['date'];
$t1 = $_GET['t1'];
$t2 = $_GET['t2'];
$score1 = $_GET['score1'];
$score2 = $_GET['score2'];
$number_match = $_GET['number_match'];
$date = $_GET['date'];
// преобразовываем дату в нужный формат
        $date = explode('-',$date);
        $date = $date[2].'.'.$date[1].'.'.$date[0];

//$t1 = 5;
//$t2 = 4;
//$score1 = 1;
//$score2 = 2;
//$number_match = 29;
//$date = '08.03.2018';

// массив с сылками на статистику команд в плей-офф 2017/2018
$link_stat_team = [
        ['id_team'=>'1', 'name' => 'Авангард', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96481/tstat.html'],
        ['id_team'=>'2', 'name' => 'Автомобилист', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96473/tstat.html'],
        ['id_team'=>'3', 'name' => 'Адмирал', 
        'linl'=>''],
        ['id_team'=>'4', 'name' => 'Ак Барс', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96469/tstat.html'],
        ['id_team'=>'5', 'name' => 'Амур', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96483/tstat.html'],
        ['id_team'=>'6', 'name' => 'Барыс',
        'linl'=>''],
        ['id_team'=>'7', 'name' => 'Витязь', 'linl'=>''],
        ['id_team'=>'8', 'name' => 'Динамо М', 'linl'=>''],
        ['id_team'=>'9', 'name' => 'Динамо Мн', 'linl'=>''],
        ['id_team'=>'10', 'name' => 'Динамо Р', 'linl'=>''],
        ['id_team'=>'11', 'name' => 'Йокерит', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96461/tstat.html'],
        ['id_team'=>'12', 'name' => 'Куньлунь РС', 'linl'=>''],
        ['id_team'=>'13', 'name' => 'Лада', 'linl'=>''],
        ['id_team'=>'14', 'name' => 'Локомотив', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96463/tstat.html'],
        ['id_team'=>'15', 'name' => 'Металлург Мг', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96479/tstat.html'],
        ['id_team'=>'16', 'name' => 'Нефтехимик', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96471/tstat.html'],
        ['id_team'=>'17', 'name' => 'Салават Юлаев', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96477/tstat.html'],
        ['id_team'=>'18', 'name' => 'Северсталь', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96487/tstat.html'],
        ['id_team'=>'19', 'name' => 'Сибирь', 'linl'=>''],
        ['id_team'=>'20', 'name' => 'СКА', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96457/tstat.html'],
        ['id_team'=>'21', 'name' => 'Слован', 'linl'=>''],
        ['id_team'=>'22', 'name' => 'ХК Сочи', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96467/tstat.html'],
        ['id_team'=>'23', 'name' => 'Спартак', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96485/tstat.html'],
        ['id_team'=>'24', 'name' => 'Торпедо', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96465/tstat.html'],
        ['id_team'=>'25', 'name' => 'Трактор', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96475/tstat.html'],
        ['id_team'=>'26', 'name' => 'ЦСКА', 'linl'=>'https://www.championat.com/hockey/_superleague/2559/team/96459/tstat.html'],
        ['id_team'=>'27', 'name' => 'Югра', 
        'linl'=>''],
];

// функция парсинга данных заданных команд
function pars_team($link){
    // запрос страницы
    $data_stat_team = curl_get($link);
    //создание объекта phpQuery
    $doc_Dom = phpQuery::newDocument($data_stat_team);
    // парсинг страницы в массив $stat_team
     //----------------------------------------
    // сыгранные матчи
    $stat_team['games'] = $doc_Dom->find('div.sport__table:nth-child(3) tr:nth-child(3) td:nth-child(2)')->text();
    // заброшенные шайбы
    $stat_team['throw_puck'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(2)')->text();
    $stat_team['throw_puck_average'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(3)')->text();
    $stat_team['throw_puck_home'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(4)')->text();    
    $stat_team['throw_puck_home_average'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(5)')->text();
    $stat_team['throw_puck_guest'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(6)')->text();    
    $stat_team['throw_puck_guest_average'] = $doc_Dom->find('tr:nth-child(12) td:nth-child(7)')->text();
    // пропущенные шайбы
    $stat_team['allow_puck'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(2)')->text();
    $stat_team['allow_puck_average'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(3)')->text();
    $stat_team['allow_puck_home'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(4)')->text();    
    $stat_team['allow_puck_average_home'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(5)')->text();
    $stat_team['allow_puck_guest'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(6)')->text();    
    $stat_team['allow_puck_average_guest'] = $doc_Dom->find('tr:nth-child(13) td:nth-child(7)')->text();
    // штрафное время
    $stat_team['penalty_time'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(2)')->text();
    $stat_team['penalty_time_average'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(3)')->text();
    $stat_team['penalty_time_home'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(4)')->text();    
    $stat_team['penalty_time_average_home'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(5)')->text();
    $stat_team['penalty_time_guest'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(6)')->text();    
    $stat_team['penalty_time_average_guest'] = $doc_Dom->find('tr:nth-child(15) td:nth-child(7)')->text();
    // броски по воротам
    $stat_team['total_throw'] = $doc_Dom->find('tr:nth-child(19) td:nth-child(2)')->text();
    $stat_team['total_throw_average'] = $doc_Dom->find('tr:nth-child(19) td:nth-child(3)')->text();
    $stat_team['total_throw_home'] = $doc_Dom->find('tr:nth-child(19) td:nth-child(4)')->text();    
    $stat_team['total_throw_average_home'] = $doc_Dom->find('tr:nth-child(19) td:nth-child(5)')->text();
    $stat_team['total_throw_guest'] = $doc_Dom->find('tr:nth-child(19) td:nth-child(6)')->text();    
    $stat_team['total_throw_average_guest'] = $doc_Dom->find('tr:nth-child(19) td:nth-child(7)')->text();
    // броски соперника по воротам 
    $stat_team['throw_rival'] = $doc_Dom->find('tr:nth-child(20) td:nth-child(2)')->text();
    $stat_team['throw_rival_average'] = $doc_Dom->find('tr:nth-child(20) td:nth-child(3)')->text();
    $stat_team['throw_rival_home'] = $doc_Dom->find('tr:nth-child(20) td:nth-child(4)')->text();    
    $stat_team['throw_rival_average_home'] = $doc_Dom->find('tr:nth-child(20) td:nth-child(5)')->text();
    $stat_team['throw_rival_guest'] = $doc_Dom->find('tr:nth-child(20) td:nth-child(6)')->text();    
    $stat_team['throw_rival_average_guest'] = $doc_Dom->find('tr:nth-child(20) td:nth-child(7)')->text();
    // реализация бросков
    $stat_team['throw_perc_total'] = del_last_word($doc_Dom->find('tr:nth-child(21) td:nth-child(2)')->text());
    $stat_team['throw_perc_home'] = del_last_word($doc_Dom->find('tr:nth-child(21) td:nth-child(3)')->text());
    $stat_team['throw_perc_guest'] = del_last_word($doc_Dom->find('tr:nth-child(21) td:nth-child(4)')->text());    
    $stat_team['throw_rival_perc_total'] = del_last_word($doc_Dom->find('tr:nth-child(22) td:nth-child(2)')->text());
    $stat_team['throw_rival_perc_home'] = del_last_word($doc_Dom->find('tr:nth-child(22) td:nth-child(3)')->text());    
    $stat_team['throw_rival_perc_guest'] = del_last_word($doc_Dom->find('tr:nth-child(22) td:nth-child(4)')->text());
    // вбрасывания
    $stat_team['faceoff_total'] = $doc_Dom->find('tr:nth-child(23) td:nth-child(2)')->text();
    $stat_team['faceoff_home'] = $doc_Dom->find('tr:nth-child(23) td:nth-child(3)')->text();
    $stat_team['faceoff_guest'] = $doc_Dom->find('tr:nth-child(23) td:nth-child(4)')->text();   
    $stat_team['faceoff_perc_wins_total'] = del_last_word($doc_Dom->find('tr:nth-child(24) td:nth-child(2)')->text());
    $stat_team['faceoff_perc_wins_home'] = del_last_word($doc_Dom->find('tr:nth-child(24) td:nth-child(3)')->text());    
    $stat_team['faceoff_perc_wins_guest'] = del_last_word($doc_Dom->find('tr:nth-child(24) td:nth-child(4)')->text());
    $stat_team['faceoff_perc_wins_rival_total'] = del_last_word($doc_Dom->find('tr:nth-child(25) td:nth-child(2)')->text());
    $stat_team['faceoff_perc_wins_rival_home'] = del_last_word($doc_Dom->find('tr:nth-child(25) td:nth-child(3)')->text());    
    $stat_team['faceoff_perc_wins_rival_guest'] = del_last_word($doc_Dom->find('tr:nth-child(25) td:nth-child(4)')->text());
    // победы команды
    $stat_team['clear_wins'] = $doc_Dom->find('tr:nth-child(4) td:nth-child(2):first')->text();
    $stat_team['clear_wins_home'] = $doc_Dom->find('tr:nth-child(4) td:nth-child(4)')->text();
    $stat_team['clear_wins_guest'] = $doc_Dom->find('tr:nth-child(4) td:nth-child(6)')->text();
    $stat_team['ot_wins'] = $doc_Dom->find('tr:nth-child(5) td:nth-child(2):first')->text();
    $stat_team['ot_wins_home'] = $doc_Dom->find('tr:nth-child(5) td:nth-child(4)')->text();  
    $stat_team['ot_wins_guest'] = $doc_Dom->find('tr:nth-child(5) td:nth-child(6)')->text();
    $stat_team['b_wins'] = $doc_Dom->find('tr:nth-child(6) td:nth-child(2):first')->text();
    $stat_team['b_wins_home'] = $doc_Dom->find('tr:nth-child(6) td:nth-child(4)')->text();  
    $stat_team['b_wins_guest'] = $doc_Dom->find('tr:nth-child(6) td:nth-child(6)')->text();
    // поражения команды
    $stat_team['clear_loss'] = $doc_Dom->find('tr:nth-child(10) td:nth-child(2):first')->text();
    $stat_team['clear_loss_home'] = $doc_Dom->find('tr:nth-child(10) td:nth-child(4)')->text();
    $stat_team['clear_loss_guest'] = $doc_Dom->find('tr:nth-child(10) td:nth-child(6)')->text();
    $stat_team['ot_loss'] = $doc_Dom->find('tr:nth-child(9) td:nth-child(2):first')->text();
    $stat_team['ot_loss_home'] = $doc_Dom->find('tr:nth-child(9) td:nth-child(4)')->text();  
    $stat_team['ot_loss_guest'] = $doc_Dom->find('tr:nth-child(9) td:nth-child(6)')->text();
    $stat_team['b_loss'] = $doc_Dom->find('tr:nth-child(8) td:nth-child(2):first')->text();
    $stat_team['b_loss_home'] = $doc_Dom->find('tr:nth-child(8) td:nth-child(4)')->text();  
    $stat_team['b_loss_guest'] = $doc_Dom->find('tr:nth-child(8) td:nth-child(6)')->text();
    
    echo printArray($stat_team);
    return $stat_team;
}


// формирование шаблона 1
function template($t1,$t1_arr,$t2,$t2_arr,$date){
    global $link_stat_team;
    global $score1; global $score2; global $number_match;
// загружаем изображение
$image = imagecreatefrompng('../../template_img/temp_p1.png');

// вставляем данные 
$grey = imagecolorallocate($image, 249, 230, 85);
$green = imagecolorallocate($image, 206, 225, 199);
$green_1 = imagecolorallocate($image, 129, 255, 129);
$black = imagecolorallocate($image, 0, 0, 0);
$yellow = imagecolorallocate($image, 244,255,120);
// Замена пути к шрифту на пользовательский
$font = '../../font/soviet.ttf';
$font_name_team = '../../font/BigNoodleTitlingCyr.ttf';
$font_Xolonium = '../../font/Xolonium_Bold.ttf';
// логотипы
$path_logo_temp_1 = '../../logo/'.$link_stat_team[$t1-1]['id_team'].'.gif';
$path_logo_temp_2 = '../../logo/'.$link_stat_team[$t2-1]['id_team'].'.gif';
$logo_team_1 = imagecreatefromgif($path_logo_temp_1);
$logo_team_2 = imagecreatefromgif($path_logo_temp_2);
    // Копирование и наложение логотипов команд
    imagecopymerge($image, $logo_team_1, 70, 35, 0, 0, 200, 200, 100);
    imagecopymerge($image, $logo_team_2, 440, 35, 0, 0, 200, 200, 100);

    // цвет f4ff78 желтый 244,255,120
    
// название команд
    // !!! для каждой команды нужно подгонять позицию по гор - в отдельную функцию
    $place_name_1 = place_name_1($link_stat_team[$t1-1]['name']);
    $place_name_2 = place_name_2($link_stat_team[$t2-1]['name']);
    //imagettftext($image, 40, 0, $place_name_1, 270, $black, $font_name_team, $link_stat_team[$t1-1]['name']);
    imagettftext($image, 40, 0, $place_name_2, 270, $black, $font_name_team, $link_stat_team[$t2-1]['name']);
    if($link_stat_team[$t1-1]['name'] == 'Салават Юлаев'){
        imagettftext($image, 38, 0, $place_name_1, 270, $black, $font_name_team, $link_stat_team[$t1-1]['name']);    
    }else{imagettftext($image, 40, 0, $place_name_1, 270, $black, $font_name_team, $link_stat_team[$t1-1]['name']);}
// дата
    imagettftext($image, 13, 0, 300, 130, $green , $font, $date);
// проведенные игры
    imagettftext($image, 15, 0, 120, 385, $yellow, $font, $t1_arr['games']);
    imagettftext($image, 15, 0, 560, 385, $yellow, $font, $t2_arr['games']);
// победы
    imagettftext($image, 15, 0, 120, 432, $yellow, $font, $t1_arr['clear_wins']);
    imagettftext($image, 15, 0, 560, 432, $yellow, $font, $t2_arr['clear_wins']);
// победы ОТ
    imagettftext($image, 15, 0, 120, 478, $yellow, $font, $t1_arr['ot_wins']);
    imagettftext($image, 15, 0, 560, 478, $yellow, $font, $t2_arr['ot_wins']);
// победы Б
    imagettftext($image, 15, 0, 120, 525, $yellow, $font, $t1_arr['b_wins']);
    imagettftext($image, 15, 0, 560, 525, $yellow, $font, $t2_arr['b_wins']);
// поражения
    imagettftext($image, 15, 0, 120, 571, $yellow, $font, $t1_arr['clear_loss']);
    imagettftext($image, 15, 0, 560, 571, $yellow, $font, $t2_arr['clear_loss']);
// поражения ОТ
    imagettftext($image, 15, 0, 120, 619, $yellow, $font, $t1_arr['ot_loss']);
    imagettftext($image, 15, 0, 560, 619, $yellow, $font, $t2_arr['ot_loss']);
// поражения Б
    imagettftext($image, 15, 0, 120, 665, $yellow, $font, $t1_arr['b_loss']);
    imagettftext($image, 15, 0, 560, 665, $yellow, $font, $t2_arr['b_loss']);
// счет в серии
    imagettftext($image, 22, 0, 220, 725, $green_1, $font_Xolonium, 'СЧЕТ В СЕРИИ');
    imagettftext($image, 23, 0, 330, 765, $green_1, $font_Xolonium, $score1.':'.$score2);

// сохраняем изображение
    imagepng($image,'../../template_img/new/playoff_'.$number_match.'_temp_p1.png',9);

}


// функция удаления последнего символа
function del_last_word($word){
    return substr($word, 0, -1);
}
// функция установки позиции имени команды хозяйки
function place_name_1($name_team){
    // команды востока
     switch ($name_team){
            case 'Авангард':        $x_team_1 = 85; break;
            case 'Автомобилист':    $x_team_1 = 48; break;
            case 'Адмирал':         $x_team_1 = 90; break;
            case 'Ак Барс':         $x_team_1 = 100; break;
            case 'Амур':            $x_team_1 = 130; break;
            case 'Барыс':           $x_team_1 = 120; break;
            case 'Куньлунь РC':     $x_team_1 = 70; break;
            case 'Лада':            $x_team_1 = 130; break;
            case 'Металлург Мг':    $x_team_1 = 60; break;
            case 'Нефтехимик':      $x_team_1 = 70; break;
            case 'Салават Юлаев':   $x_team_1 = 45; break;
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
            case 'Локомотив':   $x_team_1 = 75; break;
            case 'Северсталь':  $x_team_1 = 75; break;
            case 'СКА':         $x_team_1 = 130; break;
            case 'Слован':      $x_team_1 = 110; break;
            case 'ХК Сочи':     $x_team_1 = 105; break;
            case 'Спартак':     $x_team_1 = 95; break;
            case 'Торпедо':     $x_team_1 = 95; break;
            case 'ЦСКА':        $x_team_1 = 130; break;
    }  
    // возвращаемый результат
    return $x_team_1; 
}
// функция установки позиции имени команды гостей
function place_name_2($name_team){
// команды востока
     switch ($name_team){
            case 'Авангард':        $x_team_2 = 485; break;
            case 'Автомобилист':    $x_team_2 = 447; break;
            case 'Адмирал':         $x_team_2 = 460; break;
            case 'Ак Барс':         $x_team_2 = 500; break;
            case 'Амур':            $x_team_2 = 520; break;
            case 'Барыс':           $x_team_2 = 490; break;
            case 'Куньлунь РC':     $x_team_2 = 430; break;
            case 'Лада':            $x_team_2 = 490; break;
            case 'Металлург Мг':    $x_team_2 = 450; break;
            case 'Нефтехимик':      $x_team_2 = 465; break;
            case 'Салават Юлаев':   $x_team_2 = 440; break;
            case 'Сибирь':          $x_team_2 = 480; break;
            case 'Трактор':         $x_team_2 = 490; break;
            case 'Югра':            $x_team_2 = 490; break;
    }    
    // команды запада
     switch ($name_team){
            case 'Витязь':      $x_team_2 = 480; break;
            case 'Динамо М':    $x_team_2 = 470; break;
            case 'Динамо Мн':   $x_team_2 = 460; break;
            case 'Динамо Р':    $x_team_2 = 470; break;
            case 'Йокерит':     $x_team_2 = 500; break;
            case 'Локомотив':   $x_team_2 = 475; break;
            case 'Северсталь':  $x_team_2 = 440; break;
            case 'СКА':         $x_team_2 = 520; break;
            case 'Слован':      $x_team_2 = 480; break;
            case 'ХК Сочи':     $x_team_2 = 485; break;
            case 'Спартак':     $x_team_2 = 460; break;
            case 'Торпедо':     $x_team_2 = 485; break;
            case 'ЦСКА':        $x_team_2 = 515; break;
    }  
    // возвращаемый результат
    return $x_team_2; 
}


// вызовы функций ***********************************************************
//  echo $link_stat_team[$t1]['linl'].'-'.$link_stat_team[$t1]['name'];
    echo $link_stat_team[$t1-1]['linl'];
    $t1_arr = pars_team($link_stat_team[$t1-1]['linl']);
    $t2_arr = pars_team($link_stat_team[$t2-1]['linl']);
    $name_t1=$link_stat_team[$t1-1]['name'];
    $name_t2=$link_stat_team[$t2-1]['name'];
    template($t1,$t1_arr,$t2,$t2_arr,$date);
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