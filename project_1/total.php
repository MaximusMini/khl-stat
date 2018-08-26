<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../php/link.php'); ?>
    <meta charset="UTF-8">
    <title>Расчитать тотал</title>
</head>
<body style='padding-top: 70px'>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container" style="margin-top:10px">
    <a href="main.php" class="btn btn-info">на главную</a>
    <button class="btn btn-default pull-right" onclick="clearDisplay()">очистить табло</button>
    </div>
</nav>
<div class="container">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                        <div class="form-group">
                        <label for="team_1">команда хозяев</label>
                        <select class="form-control" id='team_1' name="team_1">
                        <option value="1">1-Авангард</option>
                        <option value="2">2-Автомобилист</option>
                        <option value="3">3-Адмирал</option>
                        <option value="4">4-Ак Барс</option>
                        <option value="5">5-Амур</option>
                        <option value="6">6-Барыс</option>
                        <option value="7">7-Витязь</option>
                        <option value="8">8-Динамо М</option>
                        <option value="9">9-Динамо Мн</option>
                        <option value="10">10-Динамо Р</option>
                        <option value="11">11-Йокерит</option>
                        <option value="12">12-Куньлунь РС</option>
                        <option value="13">13-Лада</option>
                        <option value="14">14-Локомотив</option>
                        <option value="15">15-Металлург Мг</option>
                        <option value="16">16-Нефтехимик</option>
                        <option value="17">17-Салават Юлаев</option>
                        <option value="18">18-Северсталь</option>
                        <option value="19">19-Сибирь</option>
                        <option value="20">20-СКА</option>                                                
                        <option value="21">21-Слован</option>
                        <option value="22">22-ХК Сочи</option>
                        <option value="23">23-Спартак</option>
                        <option value="24">24-Торпедо</option>
                        <option value="25">25-Трактор</option>
                        <option value="26">26-ЦСКА</option>
                        <option value="27">27-Югра</option>
                        </select>
                        </div>
                    </div>
            <div class="col-md-6">
                        <div class="form-group">
                        <label for="team_1">команда гостей</label>
                        <select class="form-control" id='team_1' name="team_2">
                        <option value="1">1-Авангард</option>
                        <option value="2">2-Автомобилист</option>
                        <option value="3">3-Адмирал</option>
                        <option value="4">4-Ак Барс</option>
                        <option value="5">5-Амур</option>
                        <option value="6">6-Барыс</option>
                        <option value="7">7-Витязь</option>
                        <option value="8">8-Динамо М</option>
                        <option value="9">9-Динамо Мн</option>
                        <option value="10">10-Динамо Р</option>
                        <option value="11">11-Йокерит</option>
                        <option value="12">12-Куньлунь РС</option>
                        <option value="13">13-Лада</option>
                        <option value="14">14-Локомотив</option>
                        <option value="15">15-Металлург Мг</option>
                        <option value="16">16-Нефтехимик</option>
                        <option value="17">17-Салават Юлаев</option>
                        <option value="18">18-Северсталь</option>
                        <option value="19">19-Сибирь</option>
                        <option value="20">20-СКА</option>                                                
                        <option value="21">21-Слован</option>
                        <option value="22">22-ХК Сочи</option>
                        <option value="23">23-Спартак</option>
                        <option value="24">24-Торпедо</option>
                        <option value="25">25-Трактор</option>
                        <option value="26">26-ЦСКА</option>
                        <option value="27">27-Югра</option>
                        </select>
                        </div>
                    </div>
        </div>
        <hr>
        <button onclick='totalMatch5()'>Тотал за последние 5 матчей</button>
        <button onclick='totalAll()'>Тотал за все матчи</button>
        <hr>
        <button onclick='totalHome()'>Тотал дома</button>
        <button onclick='totalGuest()'>Тотал в гостях</button>
        <hr>
        <button onclick=''>Показатели меньшинства</button>
        <button onclick=''>Показатели большинства</button>
    </div><!--    div class="col-md-8"-->
    <div class="col-md-6">
        <div class="display">
            
        </div>
    </div><!--    div class="col-md-4"-->
</div><!--    div class="container"-->    
    
        
                
</body>
</html>



<script>
// запрос на получение данных о тотале последних 5 матчей
function totalMatch5(){
    var team_1 = $('[name=team_1]').val();
    var team_2 = $('[name=team_2]').val();
    //alert(team_1);
         $.ajax({
            url: "scripts_php/totalMatch5.php",
            data:'team_1='+team_1+'&team_2='+team_2,
            type:'GET',
			dataType:"json",
            success: function(data){
                 //$(".display").empty();
                 $(".display").append("<p>Тотал (5) команды хозяев = <strong><span class='text-danger'>"+data.total5_team_1+"</span></strong></p>");
                 $(".display").append("<p>Тотал (5) команды гостей = <strong><span class='text-danger'>"+data.total5_team_2+"</span></strong></p>");
                $(".display").append('<hr>');
            },
			error: function(jqXHR, textStatus, errorThrown){
                alert('error-'+textStatus);	
             }

        });
    
}

// запрос на получение данных о тотале всех матчей    
function totalAll(){
    var team_1 = $('[name=team_1]').val();
    var team_2 = $('[name=team_2]').val();
    //alert(team_1);
         $.ajax({
            url: "scripts_php/total_all.php",
            data:'team_1='+team_1+'&team_2='+team_2,
            type:'GET',
			dataType:"json",
            success: function(data){
                 //$(".display").empty();
                 $(".display").append("<p>Тотал (all) команды хозяев = <strong><span class='text-danger'>"+data.total5_team_1+"</span></strong></p>");
                 $(".display").append("<p>Тотал (all) команды гостей = <strong><span class='text-danger'>"+data.total5_team_2+"</span></strong></p>");
                $(".display").append('<hr>');
            },
			error: function(jqXHR, textStatus, errorThrown){
                alert('error-'+textStatus);	
             }

        });
    
}    

// фуекция для очистки табло    
function clearDisplay(){
    $(".display").empty();
}
</script>



<?php









?>