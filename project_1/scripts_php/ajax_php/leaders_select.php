<form action="" method="get">
    
    <select class="form-control" id='team' name="team">
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
    <select class="form-control" id='team_1' name="team_1">
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
    <select class="form-control" id='team_2' name="team_2">
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
    <input type="date" id="dat" name="date">
    <input type="submit" value="Отправить">
</form>



<?php
/*
модуль для выборки из таблиц stat_attacks, stat_defenders, stat_goalies лидеров конкртеной команды, по различным номинациям

запросы по категориям лидерства

goals       - снайпер
points      - бомбардир
assists     - асистенты
plus-minus  - плюс-минус
*/


//http://khl-stat/project_1/scripts_php/ajax_php/leaders_select.php?team=1&team_1=3&team_2=1&date=26.02.2018&category=pucks
//команда
$team = $_POST['team'];
$team_1 = $_POST['team_1'];
$team_2 = $_POST['team_2'];
$date = $_GET['date'];
$team = $_GET['team'];
$team_1 = $_GET['team_1'];
$team_2 = $_GET['team_2'];
$date = $_GET['date'];
//***************************
$team = $_GET['team'];
$team_1 = $_GET['team_1'];
$team_2 = $_GET['team_2'];
$date = $_GET['date'];
//***************************
//номинация - категория
$category = $_POST['category'];
$category = $_GET['category'];
//массив с названиями команд
$arr_t = [
			["id_team"=>1,"abr"=>"АВГ","name"=>"Авангард"],
			["id_team"=>2,"abr"=>"АВТ","name"=>"Автомобилист"],
			["id_team"=>3,"abr"=>"АДМ","name"=>"Адмирал"],
			["id_team"=>4,"abr"=>"АКБ","name"=>"Ак Барс"],
			["id_team"=>5,"abr"=>"АМР","name"=>"Амур"],
			["id_team"=>6,"abr"=>"БАР","name"=>"Барыс"],
			["id_team"=>7,"abr"=>"ВИТ","name"=>"Витязь"],
			["id_team"=>8,"abr"=>"ДИН","name"=>"Динамо Москва"],
			["id_team"=>9,"abr"=>"ДМН","name"=>"Динамо Минск"],
			["id_team"=>10,"abr"=>"ДРГ","name"=>"Динамо Рига"],
			["id_team"=>11,"abr"=>"ЙОК","name"=>"Йокерит"],
			["id_team"=>12,"abr"=>"КРС","name"=>"Кунлунь РС"],
			["id_team"=>13,"abr"=>"ЛАД","name"=>"Лада"],
			["id_team"=>14,"abr"=>"ЛОК","name"=>"Локомотив"],
			["id_team"=>15,"abr"=>"ММГ","name"=>"Металлург Мг"],
			["id_team"=>16,"abr"=>"НХК","name"=>"Нефтехемик"],
			["id_team"=>17,"abr"=>"СЮЛ","name"=>"Салават Юлаев"],
			["id_team"=>18,"abr"=>"СЕВ","name"=>"Северсталь"],
			["id_team"=>19,"abr"=>"СИБ","name"=>"Сибирь"],
			["id_team"=>20,"abr"=>"СКА","name"=>"СКА"],
			["id_team"=>21,"abr"=>"СЛВ","name"=>"Слован"],
			["id_team"=>22,"abr"=>"СОЧ","name"=>"ХК Сочи"],
			["id_team"=>23,"abr"=>"СПР","name"=>"Спартак"],
			["id_team"=>24,"abr"=>"ТОР","name"=>"Торпедо"],
			["id_team"=>25,"abr"=>"ТРК","name"=>"Трактор"],
			["id_team"=>26,"abr"=>"ЦСК","name"=>"ЦСКА"],
			["id_team"=>27,"abr"=>"ЮГР","name"=>"Югра"],
		];
$name_team  = $arr_t[$team-1]["name"];
$logo = "../../logo/".$team."_crop.png";
$team       = $arr_t[$team-1]["abr"];
$team_1     = $arr_t[$team_1-1]["name"];
$team_2     = $arr_t[$team_2-1]["name"];
//echo '<br>!!!$name_team'.$name_team;
//echo '<br>!!!LOGO'.$logo;
//echo $team.' - '.$category;
echo 'date - '.$date;

// идентификатор подключения БД
$id_connect_DB;
// массивы в которые записываются результаты выборки по категориям


// функция подключения БД
function connect_DB(){
    global $id_connect_DB;
    // подключаем БД
    $id_connect_DB = new mysqli('localhost', 'root', '07011989', 'db_preview');
}

// функция выбора данных по всем категориям
function all_leaders($team, $category){
    global $id_connect_DB;
    // получаем сформированные запросы для выборки данных
    $q['goals']=select_goals($team);
    $q['points']=select_points($team);
    $q['assists']=select_assists($team);
    $q['pl_min']=select_pl_min($team);
    // выполняем запросы
    $data['goals'] = $id_connect_DB->query($q['goals']);
    $data['points'] = $id_connect_DB->query($q['points']);
    $data['assists'] = $id_connect_DB->query($q['assists']);
    $data['pl_min'] = $id_connect_DB->query($q['pl_min']);
    // преобразуем полученные данные в ассоц. массив
    $row['goals'] = mysqli_fetch_all($data['goals'], MYSQLI_ASSOC);
    $row['points'] = mysqli_fetch_all($data['points'], MYSQLI_ASSOC);
    $row['assists'] = mysqli_fetch_all($data['assists'], MYSQLI_ASSOC);
    $row['pl_min'] = mysqli_fetch_all($data['pl_min'], MYSQLI_ASSOC);
    // вывод данных в таблицу
    $table_header = '<table class="table table-striped table-bordered"><thead><tr><th>№</th><th></th><th>Фамилия</th><th>Имя</th><th>'.'-----'.'</th><th>Номер игрока</th></tr></thead><tbody>';
    $table_footer = '</tbody></table>';
    foreach($row as $val_1){
        $table_body = '';
        foreach($val_1 as $val_2){
            $table_body .= '<tr><td>'.++$i.'</td><td><img src ="'.$val_2['image'].'" width=40></td><td>'.$val_2['last_name'].'</td><td>'.$val_2['first_name'].'</td><td>'.'----'.'</td><td>'.$val_2['number'].'</td></tr>';
        }
        echo $table_header.$table_body.$table_footer;
    }
    
    printArray($row);
    return $row;
}
// функция выбора данных по одной категории
function leaders_select($team, $category){
    global $id_connect_DB;
    // определяем нужный запрос для выборки данных, вызываем соответствующую функцию
    switch($category){
        case 'pucks'        : $q=select_goals($team); $name_col='Шайб';break; 
        case 'scores'       : $q=select_points($team); $name_col='Очков';break; 
        case 'pass'         : $q=select_assists($team); $name_col='Передач';break; 
        case 'plus_minus'   : $q=select_pl_min($team); $name_col='Плюс/Минус';break; 
    }
    if($id_connect_DB){
        $data = $id_connect_DB->query($q);
        $row_goals = mysqli_fetch_all($data, MYSQLI_ASSOC);
        $table_body = '';
        foreach ($row_team as $men){
            $table_body .= '<tr><td>'.++$i.'</td><td><img src ="'.$men['image'].'" width=40></td><td>'.$men['last_name'].'</td><td>'.$men['first_name'].'</td><td>'.$men[$category].'</td><td>'.$men['number'].'</td></tr>';
            //формирование картинки
             //template($men);
        }
    } 
    else{
        echo '<br> соединение с БД не установлено';
    }
    $table_header = '<table class="table table-striped table-bordered"><thead><tr><th>№</th><th></th><th>Фамилия</th><th>Имя</th><th>'.$name_col.'</th><th>Номер игрока</th></tr></thead><tbody>';
    $table_footer = '</tbody></table>';
    echo $table_header.$table_body.$table_footer;
    
    printArray($row_team);
    
    //формирование картинки
    template($row_goals);

}

// функции для формирования запросов
// запрос на выборку снайперов
function select_goals($team){
    $query = 'SELECT * FROM stat_defenders WHERE club=\''.$team.'\'  UNION SELECT * FROM stat_attacks WHERE club=\''.$team.'\' ORDER BY pucks DESC, games LIMIT 5';
    return $query;
} 
// запрос на выборку бомбардиров
function select_points($team){
    $query = 'SELECT * FROM stat_defenders WHERE club=\''.$team.'\'  UNION SELECT * FROM stat_attacks WHERE club=\''.$team.'\' ORDER BY scores DESC, games DESC LIMIT 5';
    return $query;
}
// запрос на выборку асистентов
function select_assists($team){
    $query = 'SELECT * FROM stat_defenders WHERE club=\''.$team.'\'  UNION SELECT * FROM stat_attacks WHERE club=\''.$team.'\' ORDER BY pass DESC, games DESC LIMIT 5';
    return $query;
}
// запрос на выборку лидеров по системе плюс-минус
function select_pl_min($team){
    $query = 'SELECT * FROM stat_defenders WHERE club=\''.$team.'\'  UNION SELECT * FROM stat_attacks WHERE club=\''.$team.'\' ORDER BY plus_minus DESC, games DESC LIMIT 5';
    echo 'запрос - '.$query;
    return $query;
} 

// функция определния положения названия команды
function pos_x_name_team($name_team){
    switch ($name_team){
//        case 'Авангард': $pos_x_name_team = 240; break;
//        case 'Автомобилист': $pos_x_name_team = 240; break;
//        case 'Адмирал': $pos_x_name_team = 310; break;
//        case 'Ак Барс': $pos_x_name_team = 240; break;
//        case 'Амур': $pos_x_name_team = 340; break;
//        case 'Барыс': $pos_x_name_team = 240; break;
//        case 'Витязь': $pos_x_name_team = 300; break;
//        case 'Динамо Москва': $pos_x_name_team = 250; break;
//        case 'Динамо Минск': $pos_x_name_team = 250; break;
//        case 'Динамо Рига': $pos_x_name_team = 250; break;
//        case 'Йокерит': $pos_x_name_team = 240; break;
//        case 'Кунлунь РС': $pos_x_name_team = 240; break;
//        case 'Лада': $pos_x_name_team = 240; break;
//        case 'Локомотив': $pos_x_name_team = 270; break;
//        case 'Металлург Мг': $pos_x_name_team = 240; break;
//        case 'Нефтехемик': $pos_x_name_team = 240; break;
//        case 'Салават Юлаев': $pos_x_name_team = 240; break;
//        case 'Северсталь': $pos_x_name_team = 240; break;
//        case 'Сибирь': $pos_x_name_team = 240; break;
//        case 'СКА': $pos_x_name_team = 240; break;
//        case 'Слован': $pos_x_name_team = 310; break;
//        case 'ХК Сочи': $pos_x_name_team = 310; break;
//        case 'Спартак': $pos_x_name_team = 240; break;
//        case 'Торпедо': $pos_x_name_team = 310; break;
//        case 'Трактор': $pos_x_name_team = 310; break;
//        case 'ЦСКА': $pos_x_name_team = 330; break;
//        case 'Югра': $pos_x_name_team = 240; break;   
        default: $pos_x_name_team = 235;
    }
    return $pos_x_name_team;
}

// функция определния длины по процентному соотношению
function len_line($max_len, $point_1, $point_2){
    // вычисляем отношение двух чисел - самого большого к меньшему
    $ratio = $point_2 / $point_1;
    // умножаем длину линии на отношение => для новой линии
    $new_len = $max_len * $ratio;
    if ($new_len < 0) $new_len =0; 
    return $new_len;
}

// функция формирования картинки
function template(){
    global $team; global $team_1; global $team_2; 
    global $name_team; global $logo; global $date;
    global $category;
    $row = all_leaders($team, $category);
    

    // загружаем шаблон
    $image = imagecreatefrompng('../../template_img/leaders/leaders_template.png');
     // установка шрифтов
    $font = '../../font/soviet.ttf';
    $font_LucidaSans = '../../font/LucidaSans.ttf';
    $font_BigNoodle = '../../font/BigNoodleTitlingCyr.ttf';
    $font_date = '../../font/Phantom cyr-lat.ttf';
    $font_Warface = '../../font/WarfaceRegularEnglish.ttf';
    $font_Xolonium = '../../font/Xolonium_Bold.ttf';
    $font_Odeon = '../../font/Odeon.ttf';
    // установка цветов
    $white = imagecolorallocate($image, 225, 225, 225); 
    $red = imagecolorallocate($image, 119, 9, 22);
    $green = imagecolorallocate($image, 206, 225, 199);
    $black = imagecolorallocate($image, 0, 0, 0);
    $bl_blue = imagecolorallocate($image, 45, 41, 74);
    $silver  = imagecolorallocate($image, 77, 77, 77);
    
//    foreach ($row_team as $men){
//        // Копирование и наложение логотипов команд
//        
//    
//    }
    
     //$iii = imagecreatefromjpeg('https://www.khl.ru/images/teamplayers/6640/17692.jpg');
    // вставка фото лидеров
    $img_size = 150; // размер фото
    $max_len = 190; // длина линии индикатора
    $x_indent_col1 = 325; // отступ индикаторов в первой колонке
    $x_indent_col1_mark = 210; // отступ показателя первой колонке
    $font_size_col1 = 14; // размер шрифта в первой колонке индикаторов
    $x_indent_col2 = 845; // отступ индикаторов в первой колонке
    $x_indent_col2_mark = 210; // отступ показателя во второй колонке
    $font_size_col2 = 14; // размер шрифта во второй колонке индикаторов
    // =====================================================================================
    // снайпер
    $img_goals = imagecreatefromjpeg($row['goals'][0]['image']); // фото
    //$img_goals = imagecreatefrompng('../../template_img/leaders/1-1.png');
    imagecopyresized($image, $img_goals, 100, 240, 0, 0, $img_size, $img_size, 320,320);
    $full_name = $row['goals'][0]['last_name']." ".$row['goals'][0]['first_name'];
    imagettftext($image, 22, 0, 100, 425, $red, $font_BigNoodle, $full_name);// фамилия имя
    imagettftext($image, 20, 0, 220, 450, $silver, $font_BigNoodle, "# ".$row['goals'][0]['number']);// номер
    imagettftext($image, 35, 0, 100, 470, $black, $font_BigNoodle, $row['goals'][0]['pucks']);//количество шайб
    imagettftext($image, 20, 0, 140, 470, $black, $font_BigNoodle, "шайб");
    // первый снайпер
    $full_name = $row['goals'][0]['last_name']." ".$row['goals'][0]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 260, $black, $font_Warface, $full_name);
    imagefilledrectangle($image, $x_indent_col1, 265, 520, 270, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 270, $black, $font_BigNoodle, $row['goals'][0]['pucks']);
    // второй снайпер
    $full_name = $row['goals'][1]['last_name']." ".$row['goals'][1]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 300, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['goals'][0]['pucks'], $row['goals'][1]['pucks']);
    imagefilledrectangle($image, $x_indent_col1, 305, ($x_indent_col1+$new_len), 310, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 310, $black, $font_BigNoodle, $row['goals'][1]['pucks']);
    // третий снайпер
    $full_name = $row['goals'][2]['last_name']." ".$row['goals'][2]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 340, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['goals'][0]['pucks'], $row['goals'][2]['pucks']);
    imagefilledrectangle($image, $x_indent_col1, 345, ($x_indent_col1+$new_len), 350, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 350, $black, $font_BigNoodle, $row['goals'][2]['pucks']);
    // четвертый снайпер
    $full_name = $row['goals'][3]['last_name']." ".$row['goals'][3]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 380, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['goals'][0]['pucks'], $row['goals'][3]['pucks']);
    imagefilledrectangle($image, $x_indent_col1, 385, ($x_indent_col1+$new_len), 390, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 390, $black, $font_BigNoodle, $row['goals'][3]['pucks']);
    // пятый снайпер
    $full_name = $row['goals'][4]['last_name']." ".$row['goals'][4]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 420, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['goals'][0]['pucks'], $row['goals'][4]['pucks']);
    imagefilledrectangle($image, $x_indent_col1, 425, ($x_indent_col1+$new_len), 430, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 430, $black, $font_BigNoodle, $row['goals'][4]['pucks']);
    // =====================================================================================
    // ассистент
    $img_points = imagecreatefromjpeg($row['assists'][0]['image']);
    imagecopyresized($image, $img_points, 630, 240, 0, 0, $img_size, $img_size, 320,320);
    $full_name = $row['assists'][0]['last_name']." ".$row['assists'][0]['first_name'];
    imagettftext($image, 22, 0, 630, 425, $red, $font_BigNoodle, $full_name);// фамилия имя
    imagettftext($image, 20, 0, 750, 450, $silver, $font_BigNoodle, "# ".$row['assists'][0]['number']);//номер
    imagettftext($image, 35, 0, 630, 470, $black, $font_BigNoodle, $row['assists'][0]['pass']);//количество передач
    imagettftext($image, 20, 0, 670, 470, $black, $font_BigNoodle, "передач");
    // первый ассистент
    $full_name = $row['assists'][0]['last_name']." ".$row['assists'][0]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 260, $black, $font_Warface, $full_name);
    imagefilledrectangle($image, $x_indent_col2, 265, 1040, 270, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 270, $black, $font_BigNoodle, $row['assists'][0]['pass']);
    // второй ассистент
    $full_name = $row['assists'][1]['last_name']." ".$row['assists'][1]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 300, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['assists'][0]['pass'], $row['assists'][1]['pass']);
    imagefilledrectangle($image, $x_indent_col2, 305, ($x_indent_col2+$new_len), 310, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 310, $black, $font_BigNoodle, $row['assists'][1]['pass']);
    // третий ассистент
    $full_name = $row['assists'][2]['last_name']." ".$row['assists'][2]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 340, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['assists'][0]['pass'], $row['assists'][2]['pass']);
    imagefilledrectangle($image, $x_indent_col2, 345, ($x_indent_col2+$new_len), 350, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 350, $black, $font_BigNoodle, $row['assists'][2]['pass']);
    // четвертый ассистент
    $full_name = $row['assists'][3]['last_name']." ".$row['assists'][3]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 380, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['assists'][0]['pass'], $row['assists'][3]['pass']);
    imagefilledrectangle($image, $x_indent_col2, 385, ($x_indent_col2+$new_len), 390, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 390, $black, $font_BigNoodle, $row['assists'][3]['pass']);
    // пятый ассистент
    $full_name = $row['assists'][4]['last_name']." ".$row['assists'][4]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 420, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['assists'][0]['pass'], $row['assists'][4]['pass']);
    imagefilledrectangle($image, $x_indent_col2, 425, ($x_indent_col2+$new_len), 430, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 430, $black, $font_BigNoodle, $row['assists'][4]['pass']);
    // =====================================================================================
    // бомбардир
    $img_assists = imagecreatefromjpeg($row['points'][0]['image']);
    imagecopyresized($image, $img_assists, 100, 505, 0, 0, $img_size, $img_size, 320,320);
    $full_name = $row['points'][0]['last_name']." ".$row['points'][0]['first_name'];
    imagettftext($image, 22, 0, 100, 690, $red, $font_BigNoodle, $full_name);// фамилия имя
    imagettftext($image, 20, 0, 220, 715, $silver, $font_BigNoodle, "# ".$row['points'][0]['number']);//номер
    imagettftext($image, 35, 0, 100, 735, $black, $font_BigNoodle, $row['points'][0]['scores']);//количество очков
    imagettftext($image, 20, 0, 140, 735, $black, $font_BigNoodle, "очков");
    // первый бомбардир
    $full_name = $row['points'][0]['last_name']." ".$row['points'][0]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 525, $black, $font_Warface, $full_name);
    imagefilledrectangle($image, $x_indent_col1, 530, 520, 535, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 535, $black, $font_BigNoodle, $row['points'][0]['scores']);
    // второй бомбардир
    $full_name = $row['points'][1]['last_name']." ".$row['points'][1]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 565, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['points'][0]['scores'], $row['points'][1]['scores']);
    imagefilledrectangle($image, $x_indent_col1, 570, ($x_indent_col1+$new_len), 575, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 575, $black, $font_BigNoodle, $row['points'][1]['scores']);
    // третий бомбардир
    $full_name = $row['points'][2]['last_name']." ".$row['points'][2]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 605, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['points'][0]['scores'], $row['points'][2]['scores']);
    imagefilledrectangle($image, $x_indent_col1, 610, ($x_indent_col1+$new_len), 615, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 615, $black, $font_BigNoodle, $row['points'][2]['scores']);
    // четвертый бомбардир
    $full_name = $row['points'][3]['last_name']." ".$row['points'][3]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 645, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['points'][0]['scores'], $row['points'][3]['scores']);
    imagefilledrectangle($image, $x_indent_col1, 650, ($x_indent_col1+$new_len), 655, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 655, $black, $font_BigNoodle, $row['points'][3]['scores']);
     // пятый бомбардир
    $full_name = $row['points'][4]['last_name']." ".$row['points'][4]['first_name'];
    imagettftext($image, $font_size_col1, 0, $x_indent_col1, 685, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['points'][0]['scores'], $row['points'][4]['scores']);
    imagefilledrectangle($image, $x_indent_col1, 690, ($x_indent_col1+$new_len), 695, $red);
    imagettftext($image, 25, 0, ($x_indent_col1+$x_indent_col1_mark), 695, $black, $font_BigNoodle, $row['points'][4]['scores']);
    // =====================================================================================
    // плюс/минус
    $img_pl_min = imagecreatefromjpeg($row['pl_min'][0]['image']);
    imagecopyresized($image, $img_pl_min, 630, 505, 0, 0, $img_size, $img_size, 320,320);
    $full_name = $row['pl_min'][0]['last_name']." ".$row['pl_min'][0]['first_name'];
    imagettftext($image, 22, 0, 630, 690, $red, $font_BigNoodle, $full_name);// фамилия имя
    imagettftext($image, 20, 0, 750, 715, $silver, $font_BigNoodle, "# ".$row['pl_min'][0]['number']);//номер
    imagettftext($image, 35, 0, 645, 735, $black, $font_BigNoodle, $row['pl_min'][0]['plus_minus']);//показатель плюс/минус
    imagettftext($image, 30, 0, 630, 735, $black, $font_BigNoodle, "+");
    // первый плюс/минус
    $full_name = $row['pl_min'][0]['last_name']." ".$row['pl_min'][0]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 525, $black, $font_Warface, $full_name);
    imagefilledrectangle($image, $x_indent_col2, 530, 1040, 535, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 535, $black, $font_BigNoodle, $row['pl_min'][0]['plus_minus']);
    // второй плюс/минус
    $full_name = $row['pl_min'][1]['last_name']." ".$row['pl_min'][1]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 565, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['pl_min'][0]['plus_minus'], $row['pl_min'][1]['plus_minus']);
    imagefilledrectangle($image, $x_indent_col2, 570, ($x_indent_col2+$new_len), 575, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 575, $black, $font_BigNoodle, $row['pl_min'][1]['plus_minus']);
    // третий плюс/минус
    $full_name = $row['pl_min'][2]['last_name']." ".$row['pl_min'][2]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 605, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['pl_min'][0]['plus_minus'], $row['pl_min'][2]['plus_minus']);
    imagefilledrectangle($image, $x_indent_col2, 610, ($x_indent_col2+$new_len), 615, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 615, $black, $font_BigNoodle, $row['pl_min'][2]['plus_minus']);
    // четвертый плюс/минус
    $full_name = $row['pl_min'][3]['last_name']." ".$row['pl_min'][3]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 645, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['pl_min'][0]['plus_minus'], $row['pl_min'][3]['plus_minus']);
    imagefilledrectangle($image, $x_indent_col2, 650, ($x_indent_col2+$new_len), 655, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 655, $black, $font_BigNoodle, $row['pl_min'][3]['plus_minus']);
    // пятый плюс/минус
    $full_name = $row['pl_min'][4]['last_name']." ".$row['pl_min'][4]['first_name'];
    imagettftext($image, $font_size_col2, 0, $x_indent_col2, 685, $black, $font_Warface, $full_name);
    $new_len = len_line($max_len, $row['pl_min'][0]['plus_minus'], $row['pl_min'][4]['plus_minus']);
    imagefilledrectangle($image, $x_indent_col2, 690, ($x_indent_col2+$new_len), 695, $red);
    imagettftext($image, 25, 0, ($x_indent_col2+$x_indent_col2_mark), 695, $black, $font_BigNoodle, $row['pl_min'][4]['plus_minus']);
    // =====================================================================================
    // вставка имени команды
    $pos_x_name_team = pos_x_name_team($name_team); // определяем местоположение названия команды
    imagettftext($image, 35, 0, $pos_x_name_team, 140, $black, $font_BigNoodle, $name_team);
    
    // вставка логотипа команды
    $img_logo = imagecreatefrompng($logo);
    imagecopymerge($image, $img_logo, 60, 120, 0, 0, 100, 50, 100);
    //imagecopyresized($image, $img_logo, 55, 93, 0, 0, 100, 100, 200,200);
    
    //вставка названия команд
    imagettftext($image, 32, 0, 50, 70, $black, $font_Odeon, $team_1.' - '.$team_2);
    // вставка даты матча
    imagettftext($image, 18, 0, 645, 70, $black, $font_date, $date);
    
    // сохраняем изображение
    $name_file = $name_team.'_'.(time());
    imagepng($image,'../../template_img/leaders/new/'.iconv("UTF-8","CP1251",$name_file).'.png',9);
    
}



// вызовы функций ***********************************************************
    connect_DB(); // подключение к БД
    /*
    вызываем функцию leaders_select четыре раза с разными запросами
    формируем нужные массивы игроков по категориям
    */
    
    //all_leaders($team, $category);
    template();
    
    //leaders_select($team, $category);
    //if($category){echo $category;}
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