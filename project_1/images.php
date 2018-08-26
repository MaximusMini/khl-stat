<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../php/link.php'); ?>
    <meta charset="UTF-8">
    <title>Формирвать картинки</title>
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
           <h3 class="text-info">Выбор команд.</h3>
           <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="team_1">команда хозяев</label>
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
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="team_1">команда гостей</label>
                        <select class="form-control" id='team_1' name="team_2">
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
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date_match">дата матча</label>
                            <input type="date" class="form-control" id="date_match" name="date_match" placeholder="Дата" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                        <label for="number_match">номер матча</label>
                        <input type="number" class="form-control" id="date_match" name="number_match" placeholder="номер матча" required>
                        </div>
                    </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-primary" onclick="ajax_temp1()">сформировать шаблон 1</button>
                    
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" onclick="ajax_temp2()">сформировать шаблон 2</button>
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>  -->
            <hr>
             <!-- Сформировать все шаблоны  -->
            <div class="row">
                <div class="col-lg-6 bg-primary">
                    <h4 class="text-default"><strong>Все шаблоны</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="all_temp()">сформировать шаблоны</button>
                </div>
            </div>
            <hr>
            <!-- 1-1 Общая статистика  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>1-1 - Общая статистика</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(1)">сформировать шаблон</button>
                    <button class="btn btn-primary" onclick="ajax_temp('p1')">шаблон плей-офф</button>
                </div>
            </div>
            <hr>
            <!-- 1-2 Общая статистика  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>1-2 - Общая статистика</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(2)">сформировать шаблон</button>
                    <button class="btn btn-primary" onclick="ajax_temp('p2')">шаблон плей-офф</button>
                </div>
            </div>
            <hr>
            <!-- 2 Победы -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>2-Победы</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(3)">сформировать шаблон</button>
                </div>
            </div>
            <hr>
            <!-- 3 Поражения  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>3-Поражения</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(4)">сформировать шаблон</button>
                </div>
            </div>
            <hr>
            <!-- 4 Заброшенные шайбы  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>4-Заброшенные шайбы</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(5)">сформировать шаблон</button>
                </div>
            </div>
            <hr>
            <!-- 5 Пропущенные шайбы  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>5-Пропущенные шайбы</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(6)">сформировать шаблон</button>
                </div>
            </div>
            <hr>
            <!-- 6 Штрафное время  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>6-Штрафное время</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(7)">сформировать шаблон</button>
                </div>
            </div>
            <hr>
            <!-- 7 Броски по воротам  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>7-Броски по воротам</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(8)">сформировать шаблон</button>
                </div>
            </div>
            <hr>
            <!-- 8 Броски соперника  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>8-Броски соперника</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(9)">сформировать шаблон</button>
                </div>
            </div>
            <hr>
            <!-- 9 Вбрасывания  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>9-Вбрасывания</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(10)">сформировать шаблон</button>
                </div>
            </div>
            <hr>
            <!-- 10 Большинство/Меньшинство  -->
            <div class="row">
                <div class="col-lg-6 bg-success">
                    <h4 class="text-info"><strong>10-Большинство/Меньшинство</strong></h4>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" onclick="ajax_temp(11)">сформировать шаблон</button>
                </div>
            </div>
            <hr>
         </div><!--    div class="col-md-8"-->
        </div><!--    div class="container"-->
               
</body>


<script>
function all_temp(){
    ajax_temp(1); ajax_temp(2); ajax_temp(3); ajax_temp(4); ajax_temp(5); ajax_temp(6); ajax_temp(7); ajax_temp(8); ajax_temp(9); ajax_temp(10); ajax_temp(11);
    textMatch();
}
function ajax_temp(template_number){
    var file_template;
    var team_1 = $('[name=team_1]').val();
    var team_2 = $('[name=team_2]').val();
    var date_match = $('[name=date_match]').val();
    var number_match = $('[name=number_match]').val();
        // преобразовываем дату в нужный формат
        date_match = date_match.split('-');
        date_match = date_match[2]+'.'+date_match[1]+'.'+date_match[0];
    //alert(date_match);
    // регулярный чемпионат
    if(template_number==1){file_template='template_php/temp_1.php'}
    if(template_number==2){file_template='template_php/temp_2.php'}
    if(template_number==3){file_template='template_php/temp_3.php'}
    if(template_number==4){file_template='template_php/temp_4.php'}
    if(template_number==5){file_template='template_php/temp_5.php'}
    if(template_number==6){file_template='template_php/temp_6.php'}
    if(template_number==7){file_template='template_php/temp_7.php'}
    if(template_number==8){file_template='template_php/temp_8.php'}
    if(template_number==9){file_template='template_php/temp_9.php'}
    if(template_number==10){file_template='template_php/temp_10.php'}
    if(template_number==11){file_template='template_php/temp_11.php'}
    // плей-офф
    if(template_number=='p1'){file_template='template_php/temp_p1.php'}
    if(template_number=='p2'){file_template='template_php/temp_p2.php'}
    $.ajax({
        data:'team_1='+team_1+'&team_2='+team_2+'&date_match='+date_match+'&number_match=' +number_match,
        type:"POST",
        url:file_template,
        success: function(){
            alert('Load was performed.');
        }
    });  
}
function ajax_temp1(){
    var team_1 = $('[name=team_1]').val();
    var team_2 = $('[name=team_2]').val();
    var date_match = $('[name=date_match]').val();
    var number_match = $('[name=number_match]').val();
        // преобразовываем дату в нужный формат
        date_match = date_match.split('-');
        date_match = date_match[2]+'.'+date_match[1]+'.'+date_match[0];
    //alert(date_match);
    $.ajax({
       data:'team_1='+team_1+'&team_2='+team_2+'&date_match='+date_match+'&number_match='+number_match,
        type:"POST",
        url:"template_php/temp_1.php",
        success: function(){
            alert('Load was performed.');
        }
    });  
}
function ajax_temp2(){
    var team_1          = $('[name=team_1]').val();
    var team_2          = $('[name=team_2]').val();
    var date_match      = $('[name=date_match]').val();
    var number_match    = $('[name=number_match]').val();
        // преобразовываем дату в нужный формат
        date_match = date_match.split('-');
        date_match = date_match[2]+'.'+date_match[1]+'.'+date_match[0];
    //alert(date_match);
    $.ajax({
      data:'team_1='+team_1+'&team_2='+team_2+'&date_match='+date_match+'&number_match='+number_match,
        type:"POST",
        url:"template_php/temp_2.php",
        success: function(){
            alert('Load was performed.');
        }
    });  
}

// формирования текста к матчу
function textMatch(){
    var team_1 = $('[name=team_1]').val();
    var team_2 = $('[name=team_2]').val();
    var date_match = $('[name=date_match]').val();
    var number_match = $('[name=number_match]').val();
	// преобразовываем дату в нужный формат
        date_match = date_match.split('-');
        date_match = date_match[2]+'.'+date_match[1]+'.'+date_match[0];
    $.ajax({
        data:'team_1='+team_1+'&team_2='+team_2+'&date_match='+date_match+'&number_match=' +number_match,
        type:"POST",
        url:'template_php/temp_text.php',
        success: function(){
            alert('Текстовый файл сфомирван. '+ date_match);
        }
    });
}
    
    
</script>







</html>