<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../php/link.php'); ?>
    <meta charset="UTF-8">
    <title>Формирвать картинки</title>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
</head>
    <style>
        blockquote small:before {content: none}
        div.label-last-5{
            float:left;
        }
        h4.all-matches{
            padding-right: 5px;
        }
        div.label-last-5 p.total-date{
             padding-right: 5px;
        }
        div.label-last-5 p.total-date span.label-date{
            background-color: #0c0c0c;
        }
        div.label-last-5 p.total-up{
            padding-left: 25px;
        }
        div.label-last-5 p.total-down{
            padding-left: 20px;
        }
    </style>
<body style='padding-top: 70px'>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container" style="margin-top:10px">
    <a href="main.php" class="btn btn-info">на главную</a>
    </div>
</nav>

<div class="container">
   <div class="row">
            <div class="col-md-3">
                        <div class="form-group">
                        <label for="team_1">Выбрать команду</label>
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
            <!-- <div class="col-md-6">
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
                   </div>-->
    </div>
    <hr>
    <div class="alert alert-info" role="alert"><h3 style='margin: 0px'>Анализ игр команды</h3></div>
<!--    <h4>показатели побед и поражений команды (в основное время)</h4>-->
    <div class="row">
        <div class="col-md-2" style="border-right: 3px solid #eee">
            <p style='padding: 5px; font-size: 13px;' class="alert alert-warning"><strong>Победы/поражения</strong></p>
            <button class="btn btn-success btn-sm" onclick="gamesLast5()">Все матчи</button>
            <p></p>
            <button class="btn btn-success btn-sm" onclick="gamesLast5()">Последние 5 матчей</button>
            <p></p>
            <button class="btn btn-success btn-sm" onclick="">Последние 10 матчей</button>
            <p></p>
            <p style='padding: 5px; font-size: 13px;' class="alert alert-warning"><strong>Заброшенные шайбы</strong></p>
            <button class="btn btn-success btn-sm" onclick="gamesLast5()">Все матчи</button>
            <p></p>
            <button class="btn btn-success btn-sm" onclick="gamesLast5()">Последние 5 матчей</button>
            <p></p>
            <button class="btn btn-success btn-sm" onclick="">Последние 10 матчей</button>
            <p></p>
            
        </div>
        <div class="col-md-10" id='games_last_5'>
<!--            <blockquote><small>показатели побед и поражений команды</small></blockquote>-->
            <div class="row">
                <div class="col-md-4">
                    <h4>Все матчи</h4>
                    <div class='label-last-5'>
                        <h4 class="all-matches"><span class="label label-success">В</span></h4>
                        <h4 class="all-matches"><span class="label label-default">2</span></h4>
                    </div>
                    <div class='label-last-5'>
                        <h4 class="all-matches"><span class="label label-warning">Н</span></h4>
                        <h4 class="all-matches"><span class="label label-default">1</span></h4>
                    </div>
                    <div class='label-last-5'>
                        <h4 class="all-matches"><span class="label label-danger">П</span></h4>
                        <h4 class="all-matches"><span class="label label-default">2</span></h4>
                    </div>
                </div>
                <div class="col-md-4">
                     <h4>Все матчи дома</h4>
                     <div class='label-last-5'>
                        <h4 class="all-matches"><span class="label label-success">В</span></h4>
                        <h4 class="all-matches"><span class="label label-default">2</span></h4>
                    </div>
                    <div class='label-last-5'>
                        <h4 class="all-matches"><span class="label label-warning">Н</span></h4>
                        <h4 class="all-matches"><span class="label label-default">1</span></h4>
                    </div>
                    <div class='label-last-5'>
                        <h4 class="all-matches"><span class="label label-danger">П</span></h4>
                        <h4 class="all-matches"><span class="label label-default">2</span></h4>
                    </div>
                </div>
                <div class="col-md-4">
                     <h4>Все матчи в гостях</h4>
                     <div class='label-last-5'>
                        <h4 class="all-matches"><span class="label label-success">В</span></h4>
                        <h4 class="all-matches"><span class="label label-default">2</span></h4>
                    </div>
                    <div class='label-last-5'>
                        <h4 class="all-matches"><span class="label label-warning">Н</span></h4>
                        <h4 class="all-matches"><span class="label label-default">1</span></h4>
                    </div>
                    <div class='label-last-5'>
                        <h4 class="all-matches"><span class="label label-danger">П</span></h4>
                        <h4 class="all-matches"><span class="label label-default">2</span></h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 style="padding-left:10px">Последние 5 матчей</h4>
                <div class="col-md-2" id='games_last_5_1'>
                <div>
                    <div class='label-last-5'>
                        <p><span class="label label-success">В</span></p>
                        <p><span class="label label-default">2</span></p>
                    </div>
                    <div class='label-last-5'>
                        <p><span class="label label-warning">Н</span></p>
                        <p><span class="label label-default">1</span></p>
                    </div>
                    <div class='label-last-5'>
                        <p><span class="label label-danger">П</span></p>
                        <p><span class="label label-default">2</span></p>
                    </div>
                </div>
            </div>
                <div class="col-md-10" id='games_last_5_2'>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-primary">Д</span></p>
                        <p class="total-down"><span class="label label-success">2-1</span></p>
                        <p class="total-down"><img src="logo/1.png" alt="Авангард" title="Авангард" class="img-responsive" width="30"></p>
                    </div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-info">Г</span></p>
                        <p class="total-down"><span class="label label-warning">1-1</span></p>
                        <p class="total-down"><img src="logo/5.png" alt="Амур" title="Авангард" class="img-responsive" width="30"></p>
                    </div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-info">Г</span></p>
                        <p class="total-down"><span class="label label-danger">2-4</span></p>
                        <p class="total-down"><img src="logo/8.png" alt="Динамо М" title="Авангард" class="img-responsive" width="30"></p>
                    </div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-info">Г</span></p>
                        <p class="total-down"><span class="label label-danger">1-3</span></p>
                        <p class="total-down"><img src="logo/9.png" alt="Динамо Мн" title="Авангард" class="img-responsive" width="30"></p>
                    </div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-primary">Д</span></p>
                        <p class="total-down"><span class="label label-success">2-1</span></p>
                        <p class="total-down"><img src="logo/15.png" alt="Металлург Мг" title="Авангард" class="img-responsive" width="30"></p>
                    </div>        
            </div>
            </div>
            <div class="row">
                <h4 style="padding-left:10px">Последние 10 матчей</h4>
                <div class="col-md-2" id='games_last_5_1'>
                <div>
                    <div class='label-last-5'>
                        <p><span class="label label-success">В</span></p>
                        <p><span class="label label-default">2</span></p>
                    </div>
                    <div class='label-last-5'>
                        <p><span class="label label-warning">Н</span></p>
                        <p><span class="label label-default">1</span></p>
                    </div>
                    <div class='label-last-5'>
                        <p><span class="label label-danger">П</span></p>
                        <p><span class="label label-default">2</span></p>
                    </div>
                </div>
            </div>
                <div class="col-md-10" id='games_last_5_2' style="padding-right: 0px;">
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-primary">Д</span></p>
                        <p class="total-down"><span class="label label-success">2-1</span></p>
                        <p class="total-down"><img src="logo/1.png" alt="Авангард" title="Авангард" class="img-responsive" width="30"></p>
</div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-info">Г</span></p>
                        <p class="total-down"><span class="label label-warning">1-1</span></p>
                        <p class="total-down"><img src="logo/5.png" alt="Амур" title="Авангард" class="img-responsive" width="30"></p>
</div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-info">Г</span></p>
                        <p class="total-down"><span class="label label-danger">2-4</span></p>
                        <p class="total-down"><img src="logo/8.png" alt="Динамо М" title="Авангард" class="img-responsive" width="30"></p>
</div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-info">Г</span></p>
                        <p class="total-down"><span class="label label-danger">1-3</span></p>
                        <p class="total-down"><img src="logo/9.png" alt="Динамо Мн" title="Авангард" class="img-responsive" width="30"></p>
</div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-primary">Д</span></p>
                        <p class="total-down"><span class="label label-success">2-1</span></p>
                        <p class="total-down"><img src="logo/15.png" alt="Металлург Мг" title="Авангард" class="img-responsive" width="30"></p>
</div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-primary">Д</span></p>
                        <p class="total-down"><span class="label label-success">2-1</span></p>
                        <p class="total-down"><img src="logo/1.png" alt="Авангард" title="Авангард" class="img-responsive" width="30"></p>
                    </div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-info">Г</span></p>
                        <p class="total-down"><span class="label label-warning">1-1</span></p>
                        <p class="total-down"><img src="logo/5.png" alt="Амур" title="Авангард" class="img-responsive" width="30"></p>
                    </div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-info">Г</span></p>
                        <p class="total-down"><span class="label label-danger">2-4</span></p>
                        <p class="total-down"><img src="logo/8.png" alt="Динамо М" title="Авангард" class="img-responsive" width="30"></p>
                    </div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-info">Г</span></p>
                        <p class="total-down"><span class="label label-danger">1-3</span></p>
                        <p class="total-down"><img src="logo/9.png" alt="Динамо Мн" title="Авангард" class="img-responsive" width="30"></p>
                    </div>
                    <div class='label-last-5' style="float:left">
                        <p class="total-date"><span class="label label-date">01.01.2017</span></p>
                        <p class="total-up"><span class="label label-primary">Д</span></p>
                        <p class="total-down"><span class="label label-success">2-1</span></p>
                        <p class="total-down"><img src="logo/15.png" alt="Металлург Мг" title="Авангард" class="img-responsive" width="30"></p>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>


</body>


<script>

// функция выбора     
function gamesLast5(){
    var team_1 = $('[name=team_1]').val();
    //var team_2 = $('[name=team_2]').val();
    //alert(team_1);
         $.ajax({
            url: "scripts_php/wins_last_5.php",
            data:'team_1='+team_1,
            type:'GET',
			dataType:"json",
            success: function(data){
                
            },
			error: function(jqXHR, textStatus, errorThrown){
                alert('error-'+textStatus);	
             }

        }); 
}
    
    
    
    
</script>














</html>