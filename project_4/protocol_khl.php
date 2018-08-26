<?php
/*

$p['num_match']                     - номер матча
$p['date_match']                    - дата матча
$p['name_t1']                       - название команды А
$p['name_t2']                       - название команды B
$p['total_score_t1']                - количество шайб забитых командой А
$p['total_score_t2']                - количество шайб забитых командой В
$p['match_len']                     - длина матча
$p['logo_t1']                       - логотип команды А
$p['logo_t2']                       - логотип команды В 
$p['date_match']                    - дата матча
$p['arena_match']                   - арена матча
$p['period_score']                  - счет по периодам
$p['goals_1']                       - шайбы, заброшенные в первом периоде
$p['goals_2']                       - шайбы, заброшенные в втором периоде
$p['goals_3]                        - шайбы, заброшенные в третьем периоде
$p['pucks_t1']                      - броски по воротам команды А
$p['pucks_t2']                      - броски по воротам команды B
$p['win_throw_in_t1']               - выигранные вбрасывания команды А
$p['win_throw_in_t2']               - выигранные вбрасывания команды B
$p['penalty_t1']                    - штраф команды А
$p['penalty_t2']                    - штраф команды B
$p['penalty_kill_t1']               - реализация большинства команды А
$p['penalty_kill_t2']               - реализация большинства команды В
$p['body_check_t1']                 - силовые приемы команды А
$p['body_check_t2']                 - силовые приемы команды B
$p['block_throw_t1']                - блокированные броски команды А
$p['block_throw_t2']                - блокированные броски команды B
$p['atack_time_t1']                 - время в атаке команды А
$p['atack_time_t2']                 - время в атаке команды B
$p['goaliesA']['name']              - имя вратаря команды А
$p['goaliesB']['name']              - имя вратаря команды B
$p['goaliesA']['reflect_throw']     - отраженные броски вратаря команды А
$p['goaliesB']['reflect_throw']     - отраженные броски вратаря команды B
$p['goaliesA']['perc_reflect_throw']- процент отраженных бросков вратаря команды А
$p['goaliesB']['perc_reflect_throw']- процент отраженных бросков вратаря команды B

*/

include_once('..\php\phpQuery.php');


$p = [];// мBссив для сбора данных протокола

function main_pars($num_m){
    global $p;
    //$res_curl = curl_get ('https://www.khl.ru/game/468/57824/protocol/'); // 
    $res_curl = curl_get ('https://www.khl.ru/game/468/'.$num_m.'/protocol/'); // б
    //$res_curl = file_get_contents('protocol.txt');
    $res_resume = curl_get ('https://www.khl.ru/game/468/'.$num_m.'/resume/');
    //$res_resume = file_get_contents('resume.txt');
    //$res_curl = curl_get ('https://www.khl.ru/game/468/57796/protocol/'); // ОТ
    $file_phpQuery = phpQuery::newDocument($res_curl);
    $file_resume = phpQuery::newDocument($res_resume);
    
    $elements = $file_phpQuery->find('.b-total_score h3');
    $schet = trim(html_entity_decode(strip_tags($elements->html())));
    
    // номер матча
    $p['num_match'] = substr($file_phpQuery->find('.b-match_add_info li:nth-child(1) span:nth-child(1)')->text(),3); 
    // дата матча
    $p['date_match'] = substr($file_phpQuery->find('.b-match_add_info li:nth-child(1) span:nth-child(2)')->text(),0,10);
    // название команд
    $p['name_t1'] = $file_phpQuery->find('dl.b-details.m-club:not(.m-rightward) h3.e-club_name')->text(); 
    $p['name_t2'] = $file_phpQuery->find('dl.b-details.m-club.m-rightward) h3.e-club_name')->text();
    // количество шайб команды хозяин за матч  
    echo '<br> количество шайб команды хозяин '. $schet[0];
    $p['total_score_t1'] =  $schet[0];
    // количество шайб команды гость
    echo '<br> количество шайб команды гость '. $schet[8];
    $p['total_score_t2']=$schet[8];
    // длина матча
    $p['match_len']=$schet[10].$schet[11];
    // логотипы команд
    $p['logo_t1']= $file_phpQuery->find('dl.b-details.m-club:not(.m-rightward) dt.e-details_img img')->attr('src');
    $p['logo_t2']= $file_phpQuery->find('dl.b-details.m-club.m-rightward dt.e-details_img img')->attr('src');
    // счет по периодам
    $p['period_score'] = trim(strip_tags($file_phpQuery->find('dd.b-period_score')->text()));
    // заброшенные шайбы
    $p['goals_1']=[];$p['goals_2']=[];$p['goals_3']=[];$p['goals_OT']=[];$p['goals_B']=[];
    $goals = substr($file_phpQuery->find('div.b-data_row + script')->text(),24,-6);
    $goals = strip_tags($goals);
    $goals = json_decode($goals);
    // первый период
    foreach($goals as $val){      
         if ($val[1] == 1){
            $family = explode(' ',$val[5])[1];
            $time_m = explode('′',$val[2])[0];
            $time_s = explode('′',$val[2])[1];
            $assist_1_family = explode(' ',$val[6])[1]; 
            $assist_2_family = explode(' ',$val[7])[1];
            array_push($p['goals_1'], ['time'=>$val[2], 'time_m'=>$time_m, 'time_s'=>$time_s, 'score'=>$val[3],'goals'=>$val[5], 'family'=> $family, 'assist_1'=>$val[6], 'assist_2'=>$val[7], 'assist_1_family'=>$assist_1_family, 'assist_2_family'=>$assist_2_family]);         
        }
    }
    // второй период
    foreach($goals as $val){      
         if ($val[1] == 2){
            $family = explode(' ',$val[5])[1];
            $time_m = explode('′',$val[2])[0];
            $time_s = explode('′',$val[2])[1];
            $assist_1_family = explode(' ',$val[6])[1]; 
            $assist_2_family = explode(' ',$val[7])[1];
             array_push($p['goals_2'], ['time'=>$val[2], 'time_m'=>$time_m, 'time_s'=>$time_s, 'score'=>$val[3],'goals'=>$val[5], 'family'=> $family, 'assist_1'=>$val[6], 'assist_2'=>$val[7], 'assist_1_family'=>$assist_1_family, 'assist_2_family'=>$assist_2_family]);         
        }
    }
    // третий период
    foreach($goals as $val){      
         if ($val[1] == 3){
            $family = explode(' ',$val[5])[1];
            $time_m = explode('′',$val[2])[0];
            $time_s = explode('′',$val[2])[1];
            $assist_1_family = explode(' ',$val[6])[1]; 
            $assist_2_family = explode(' ',$val[7])[1];
            array_push($p['goals_3'], ['time'=>$val[2], 'time_m'=>$time_m, 'time_s'=>$time_s, 'score'=>$val[3],'goals'=>$val[5], 'family'=> $family, 'assist_1'=>$val[6], 'assist_2'=>$val[7], 'assist_1_family'=>$assist_1_family, 'assist_2_family'=>$assist_2_family]);         
        }
    }
    // овертайм
    foreach($goals as $val){      
         if ($val[1] == 'ОТ'){
            $family = explode(' ',$val[5])[1];
            $time_m = explode('′',$val[2])[0];
            $time_s = explode('′',$val[2])[1];
            $assist_1_family = explode(' ',$val[6])[1]; 
            $assist_2_family = explode(' ',$val[7])[1];
            array_push($p['goals_OT'], ['time'=>$val[2], 'time_m'=>$time_m, 'time_s'=>$time_s, 'score'=>$val[3],'goals'=>$val[5], 'family'=> $family, 'assist_1'=>$val[6], 'assist_2'=>$val[7], 'assist_1_family'=>$assist_1_family, 'assist_2_family'=>$assist_2_family]);         
        }
    }
    // буллиты
    foreach($goals as $val){      
         if ($val[1] == 'РБ'){
            $family = explode(' ',$val[5])[1];
            $time_m = explode('′',$val[2])[0];
            $time_s = explode('′',$val[2])[1];
            $assist_1_family = explode(' ',$val[6])[1]; 
            $assist_2_family = explode(' ',$val[7])[1];
            array_push($p['goals_B'], ['time'=>$val[2], 'time_m'=>$time_m, 'time_s'=>$time_s, 'score'=>$val[3],'goals'=>$val[5], 'family'=> $family, 'assist_1'=>$val[6], 'assist_2'=>$val[7], 'assist_1_family'=>$assist_1_family, 'assist_2_family'=>$assist_2_family]);         
        }
    }
    // броски по воротам
    $p['pucks_t1'] = $file_resume->find('.b-match_resume div:nth-child(1) li.e-round_diagram_item:nth-child(2) input')->attr('value');
    $p['pucks_t2'] = $file_resume->find('.b-match_resume div:nth-child(3) li.e-round_diagram_item:nth-child(2) input')->attr('value');
    // выигранные вбрасывания
    $p['win_throw_in_t1'] = trim($file_resume->find('ul.wide_title li:nth-child(4) .b-details-left')->text());
    $p['win_throw_in_t2'] = trim($file_resume->find('ul.wide_title li:nth-child(4) .b-details-right')->text());
    // штрафное время
    $p['penalty_t1'] = trim($file_resume->find('ul.wide_title li:nth-child(5) .b-details-left')->text());
    $p['penalty_t2'] = trim($file_resume->find('ul.wide_title li:nth-child(5) .b-details-right')->text());
    // реализация большинства
    $penalty_kill_t1_one = $file_phpQuery->find('.b-data_row:nth-child(6) .dataTables_wrapper:nth-child(4) table.dataTable.stripe.compact.row-border.hl.no-footer.rc.m-table_small:nth-child(1) tbody tr:nth-child(1) td:nth-child(7)')->text();
    $penalty_kill_t1_two = $file_phpQuery->find('.b-data_row:nth-child(6) .dataTables_wrapper:nth-child(4) table.dataTable.stripe.compact.row-border.hl.no-footer.rc.m-table_small:nth-child(1) tbody tr:nth-child(1)  td:nth-child(8)')->text();
    $p['penalty_kill_t1'] = $penalty_kill_t1_one.'/'.$penalty_kill_t1_two;
    $penalty_kill_t2_one = $file_phpQuery->find('.b-data_row:nth-child(6) .dataTables_wrapper:nth-child(4) table.dataTable.stripe.compact.row-border.hl.no-footer.rc.m-table_small:nth-child(1) tbody tr:nth-child(2) td:nth-child(7)')->text();
    $penalty_kill_t2_two = $file_phpQuery->find('.b-data_row:nth-child(6) .dataTables_wrapper:nth-child(4) table.dataTable.stripe.compact.row-border.hl.no-footer.rc.m-table_small:nth-child(1) tbody tr:nth-child(2)  td:nth-child(8)')->text();
    $p['penalty_kill_t2'] = $penalty_kill_t2_one.'/'.$penalty_kill_t2_two;
    // силовые приемы
    $p['body_check_t1'] = trim($file_phpQuery->find('.b-data_row:nth-child(8) table tbody tr:nth-child(4) td:nth-child(3)')->text());
    $p['body_check_t2'] = trim($file_phpQuery->find('.b-data_row:nth-child(8) table tbody tr:nth-child(4) td:nth-child(6)')->text());
    // блокированные броски
    $p['block_throw_t1'] = trim($file_phpQuery->find('.b-data_row:nth-child(8) table tbody tr:nth-child(4) td:nth-child(2)')->text());
    $p['block_throw_t2'] = trim($file_phpQuery->find('.b-data_row:nth-child(8) table tbody tr:nth-child(4) td:nth-child(5)')->text());
    echo '<br>силовые приемы '.$p['block_throw_t1'];
    echo '<br>силовые приемы '.$p['block_throw_t2'];
    // время в атаке
    $p['atack_time_t1'] = trim($file_phpQuery->find('.b-data_row:nth-child(8) table tbody tr:nth-child(4) td:nth-child(4)')->text());
    $p['atack_time_t2'] = trim($file_phpQuery->find('.b-data_row:nth-child(8) table tbody tr:nth-child(4) td:nth-child(7)')->text());
    // данные вратаря команды А
    $goaliesA = $file_phpQuery->find('table#goaliesA + script')->text();
    $p['goaliesA'] = [];
    $goaliesA = strip_tags(substr($goaliesA,30,-8));
    eval('$arr_goaliesA = []; $arr_goaliesA = '.$goaliesA.';');
    foreach ($arr_goaliesA as $val){
        $family = explode(' ',$val[1])[0];
        array_push($p['goaliesA'],['name'=>$val[1], 'family'=>$family, 'games'=>$val[2], 'throw'=>$val[6],'reflect_throw'=>$val[8],'perc_reflect_throw'=>$val[9], 'coeff_safety'=>$val[10],'time'=>$val[15]]);
    }
    // данные вратаря команды В
    $goaliesB = $file_phpQuery->find('table#goaliesB + script')->text();
    $p['goaliesB'] = [];
    $goaliesB = strip_tags(substr($goaliesB ,30,-8));
    eval('$arr_goaliesB = []; $arr_goaliesB = '.$goaliesB.';');
    foreach ($arr_goaliesB as $val){
        $family = explode(' ',$val[1])[0];
        array_push($p['goaliesB'],['name'=>$val[1], 'family'=>$family, 'games'=>$val[2], 'throw'=>$val[6],'reflect_throw'=>$val[8],'perc_reflect_throw'=>$val[9], 'coeff_safety'=>$val[10],'time'=>$val[15]]);
    }
    echo '<br>win_throw_in_t1 - '.$p['win_throw_in_t1'];
    printArray($p);
  
}


// функция вычисления позиции фамилии вратаря команды 1
function pos_goalie_1($name){
    // фамлия должна кончаться в точке по х -  550
    // т.е. от этого значения нужно отнять длину фамилии
    // определяем длину фамилии - один символ ~ 25-30 (27)
    echo '<br>длина фамилии '.strlen($name);
    $pos_x = (550 - (strlen($name)/2*27 ));
    echo '<br>позиция '.$pos_x;
    return $pos_x;
}



function imageTemplate(){
    global $p;
    // загружаем изображение
    $image = imagecreatefrompng('protocol_123+.png');
    // установка шрифтов
    $font = '../font/soviet.ttf';
    $font_goals = '../font/LucidaSans.ttf';
    $font_BigNoodle = '../font/BigNoodleTitlingCyr.ttf';
    $font_date = '../font/Phantom cyr-lat.ttf';
    // установка цветов
    $white = imagecolorallocate($image, 225, 225, 225); 
    $red = imagecolorallocate($image, 119, 9, 22);
    $green = imagecolorallocate($image, 206, 225, 199);
    $black = imagecolorallocate($image, 0, 0, 0);
    $bl_blue = imagecolorallocate($image, 45, 41, 74);
    $silver  = imagecolorallocate($image, 192, 192, 192);
    
    
    // втавка имен команд
    switch($p['name_t1']){
        case 'Автомобилист':imagettftext($image, 65, 0, 165, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'Барыс':imagettftext($image, 65, 0, 415, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'Салават Юлаев':imagettftext($image, 65, 0, 155, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'Нефтехимик':imagettftext($image, 65, 0, 255, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'ХК Сочи':imagettftext($image, 65, 0, 350, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'Металлург Мг':imagettftext($image, 65, 0, 225, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'Трактор':imagettftext($image, 65, 0, 360, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'Сибирь':imagettftext($image, 65, 0, 360, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'Ак Барс':imagettftext($image, 65, 0, 350, 265, $white, $font_BigNoodle, $p['name_t1']); break;
		case 'Спартак':imagettftext($image, 65, 0, 360, 265, $white, $font_BigNoodle, $p['name_t1']); break;
		case 'Куньлунь РС':imagettftext($image, 65, 0, 240, 265, $white, $font_BigNoodle, $p['name_t1']); break;
		case 'Йокерит':imagettftext($image, 65, 0, 360, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'СКА':imagettftext($image, 65, 0, 435, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        case 'Югра':imagettftext($image, 65, 0, 435, 265, $white, $font_BigNoodle, $p['name_t1']); break;
        default:imagettftext($image, 65, 0, 275, 265, $white, $font_BigNoodle, $p['name_t1']);
    }
    imagettftext($image, 65, 0, 725, 265, $white, $font_BigNoodle, $p['name_t2']);
    // втавка общего счета
    imagettftext($image, 80, 0, 500, 155, $white, $font, $p['total_score_t1']);
    imagettftext($image, 80, 0, 690, 155, $white, $font, $p['total_score_t2']);
    imagettftext($image, 40, 0, 623, 145, $bl_blue, $font, $p['match_len']);
    // втавка эмблем команд
    $logo_t1 = imagecreatefrompng('https://www.khl.ru'.$p['logo_t1']);
    $logo_t2 = imagecreatefrompng('https://www.khl.ru'.$p['logo_t2']);
        // подгоняем под нужный размер и вставляем + убираем белый фон
        imagecopyresized($image, $logo_t1, 230, -20, 0, 0, 230, 230, 200,200);
        $logo_t1 = imagecropauto($logo_t1,IMG_CROP_WHITE);
        imagecopyresized($image, $logo_t2, 850, -20, 0, 0, 230, 230, 200,200);
        $logo_t2 = imagecropauto($logo_t2,IMG_CROP_WHITE);
    // втавка счета по периодам
    imagettftext($image, 45, 0, 545, 325, $white, $font_BigNoodle, $p['period_score']);
    // втавка заброшенных шайб 1 периода
    $period_1=0;
    foreach ($p['goals_1'] as $val){
        imagettftext($image, 20, 0, 95, 410+$period_1, $white, $font_goals, $val['score'].' - '.$val['time_m'].'.'.$val['time_s'].' '.$val['family']);
        if ($val['assist_1_family'] != ''){ // для проверки наличия ассистентов
        imagettftext($image, 15, 0, 95, 430+$period_1, $silver, $font_goals, '('.$val['assist_1_family'].', '.$val['assist_2_family'].')');
        }
        $period_1 =$period_1+55;
    }
    // втавка заброшенных шайб 2 периода
    $period_2=0;
    foreach ($p['goals_2'] as $val){
        imagettftext($image, 20, 0, 485, 410+$period_2, $white, $font_goals, $val['score'].' - '.$val['time_m'].'.'.$val['time_s'].' '.$val['family']);
        if ($val['assist_1_family'] != ''){ // для проверки наличия ассистентов
        imagettftext($image, 15, 0, 485, 430+$period_2, $silver, $font_goals, '('.$val['assist_1_family'].', '.$val['assist_2_family'].')');
        }
        $period_2 =$period_2+55;
    }
    // втавка заброшенных шайб 3 периода
    $period_3=0;
    foreach ($p['goals_3'] as $val){
        imagettftext($image, 20, 0, 880, 410+$period_3, $white, $font_goals, $val['score'].' - '.$val['time_m'].'.'.$val['time_s'].' '.$val['family']);
        if ($val['assist_1_family'] != ''){ // для проверки наличия ассистентов
        imagettftext($image, 15, 0, 880, 430+$period_3, $silver, $font_goals, '('.$val['assist_1_family'].', '.$val['assist_2_family'].')');
        }
        $period_3 =$period_3+55;
    }
    // втавка броски по воротам
    imagettftext($image, 45, 0, 300, 825, $white, $font_BigNoodle, $p['pucks_t1']);
    imagettftext($image, 45, 0, 875, 825, $white, $font_BigNoodle, $p['pucks_t2']);
    // втавка вбрасывания
    imagettftext($image, 45, 0, 300, 890, $white, $font_BigNoodle, $p['win_throw_in_t1']);
    imagettftext($image, 45, 0, 875, 890, $white, $font_BigNoodle, $p['win_throw_in_t2']);
    // втавка штраф
    imagettftext($image, 45, 0, 300, 950, $white, $font_BigNoodle, $p['penalty_t1']);
    imagettftext($image, 45, 0, 875, 950, $white, $font_BigNoodle, $p['penalty_t2']);
    // втавка реализация
    imagettftext($image, 45, 0, 290, 1140, $white, $font_BigNoodle, $p['penalty_kill_t1']);
    imagettftext($image, 45, 0, 875, 1140, $white, $font_BigNoodle, $p['penalty_kill_t2']);
    // втавка силовые приемы
    imagettftext($image, 45, 0, 300, 1075, $white, $font_BigNoodle, $p['body_check_t1']);
    imagettftext($image, 45, 0, 875, 1075, $white, $font_BigNoodle, $p['body_check_t2']);
    // втавка блокированные броски
    imagettftext($image, 45, 0, 300, 1015, $white, $font_BigNoodle, $p['block_throw_t1']);
    imagettftext($image, 45, 0, 875, 1015, $white, $font_BigNoodle, $p['block_throw_t2']);
    // втавка время в атаке
    imagettftext($image, 45, 0, 260, 1202, $white, $font_BigNoodle, $p['atack_time_t1']);
    imagettftext($image, 45, 0, 875, 1202, $white, $font_BigNoodle, $p['atack_time_t2']);
    // определение кто из вратарей играл
    if($p['goaliesA'][0]['games'] == 1){$num_gA=0;}else{$num_gA=1;}
    if($p['goaliesB'][0]['games'] == 1){$num_gB=0;}else{$num_gB=1;}    
    // вставка имена вратарей
    $pos_x = pos_goalie_1($p['goaliesA'][$num_gA]['family']);// определение коорд. х фамилии
    imagettftext($image, 33, 0, $pos_x, 1350, $white, $font_goals, $p['goaliesA'][$num_gA]['family']);
    imagettftext($image, 33, 0, 685, 1350, $white, $font_goals, $p['goaliesB'][$num_gB]['family']);
    // вставка отраженные броски
    imagettftext($image, 45, 0, 225, 1500, $white, $font_BigNoodle, $p['goaliesA'][$num_gA]['reflect_throw']);
    imagettftext($image, 45, 0, 355, 1500, $white, $font_BigNoodle, $p['goaliesB'][$num_gB]['reflect_throw']);
    // вставка % отраженных бросков
    imagettftext($image, 45, 0, 780, 1500, $white, $font_BigNoodle, $p['goaliesA'][$num_gA]['perc_reflect_throw']);
    imagettftext($image, 45, 0, 930, 1500, $white, $font_BigNoodle, $p['goaliesB'][$num_gB]['perc_reflect_throw']);
    // вставка дата матча
    imagettftext($image, 45, 90, 1275, 1000, $white, $font_date, $p['date_match']);
    // сохраняем изображение
    imagepng($image,'new/protocol_match_'.$p['num_match'].'.png',9);
    
}

/*
$p['goaliesA'][0]['family']
*/





// вызовы функций ***********************************************************
    main_pars(56092);
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