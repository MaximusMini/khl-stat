<!DOCTYPE html>
<html lang="en">
<head>
    <link rel='stylesheet' href="../../css/bootstrap.min.css">
	<link rel='stylesheet' href="../../css/androidstudio.css">
	<link rel='stylesheet' href="../../css/style.css">
	
	<script src="../../js/jquery-3.1.0.min.js"></script>
	<script src="../../js/highlight.min.js"></script>
	<script src="../../js/bootstrap.js"></script>
    <meta charset="UTF-8">
    <title>Лидеры команды</title>
</head>
<body style='padding-top: 70px'>
   <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container" style="padding-top:10px;">
             <a href="../main.php" class="btn btn-info">на главную</a>
             <a href="#" class="btn btn-sm btn-danger pull-right" onclick=processAjax()>Обновить</a>
             <span class="pull-right" style="padding-right:10px;">&nbsp</span>
             <a href="https://www.khl.ru/stat/players/468/" target="_blank" class="btn btn-sm btn-warning pull-right"> страница</a>
             
        </div>
    </nav>
    <div class="container">
       <div class="col-lg-9">
           <div class="col-lg-3"> 
                <select class="form-control col-lg-" id='team' name="team">
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
           <button class="btn btn-sm btn-success category" data-category='pucks'>Снайперы</button>
           <button class="btn btn-sm btn-success category" data-category='scores'>Бомбардиры</button>
           <button class="btn btn-sm btn-success category" data-category='pass'>Ассистенты</button>
           <button class="btn btn-sm btn-success category" data-category='plus_minus'>Плюс/Минус</button>
           <button class="btn btn-sm btn-info pull-right" onclick='$("p#insert-content").empty()'>очистить</button>
            <br><br>
            <p id='insert-content'>
                
            </p>     
       </div>
        <div class="col-lg-3">
            <code>
                <h4>Основной алгоритм</h4>    
                    <ul>
                        <li>Сбор данных о лидерах команды</li>
                        <li>Инфа берется с таблиц https://www.khl.ru/stat/players/468/</li>
                        <li>перед формированием данных их нужно обновить</li>
                        <li></li>
                        <li></li>
                    </ul>
                <h4>Обновить</h4>
                    <ul>
                        <li>первоначально нужно обновить файл ajax_php/l.dat</li>
                        <li>происходить очистка таблиц БД, новый сбор и запись инфы</li>
                    </ul>
            </code>
        </div>
        
    </div>  
<!-- блок прелоадера    -->
<div id='block-preloader' style="display:none; z-index:999; background-color:gray; position:absolute; top:0px; left:0px; opacity:1;">
<img id='img_preloader' style='position:absolute; top:20px; left:-70px; display:block; ' src="../img/loading.gif" alt="" class="src" width="250">
    <div id='btn_close' style="position:absolute; cursor:pointer" onclick="$('div#block-preloader').css({'display':'none'})">
    <img src="../img/btn_close.png" alt="" width='20'>
    </div>
<div id='div_info' style='width:400px; height:300px; border:5px solid #555; border-radius:10px; padding-left:10px; opacity:1; z-index:9999; overflow:auto; background-color:white'>
<p id="p_info" style="color:green; font-size: 14px;"></p>
</div>
</div>
<!--  ***********************  -->
</body>

<script>
$(document).ready(function(){
    //alert();
    $('#block-preloader').width(document.documentElement.clientWidth);
    $('#block-preloader').height(document.documentElement.clientHeight);
    var imgTop = (Math.round(document.documentElement.clientHeight / 2))-32-200;
    var imgLeft = (Math.round(document.documentElement.clientWidth / 2))-32;
    $('#img_preloader').offset({top:imgTop,left:imgLeft-45});
    $('div#btn_close').width(20);
    $('div#btn_close').height(20);
    $('div#btn_close').offset({top:imgTop+150,left:imgLeft+200});
    $('#div_info').offset({top:imgTop+150,left:imgLeft-200});
})
 
var contentBlock='';    
// запрос на обновление данных
function updateData(nameGetFunc){
    var funcNameGetFunc;
    //alert(nameGetFunc);
    $.ajax({
        // перед отправкой запроса
        beforeSend:function(){$('div#block-preloader').css({'display':'block'}); },
        url:'ajax_php/leaders_update.php',
        data:'nameGetFunc='+nameGetFunc,
        dataType:'JSON',
        type:'POST',
        success:function(data){
            $('p#p_info').append(data.answer);
            //alert(data.nameGetFunc);
            //alert(data.answer);
            if(data.nameGetFunc == 'truncateTable'){processAjax('getDateGoalies')};
            if(data.nameGetFunc == 'getDateGoalies'){processAjax('getDateDefenders')};
            if(data.nameGetFunc == 'getDateDefenders'){processAjax('getDateAttacks')};
            // завершение цикла запросов
            if(data.nameGetFunc == 'end'){$('img#img_preloader').css({display:'none'});};
        },
        complete:function(){
        },
        error: function(jqXHR, srtErr){
            alert(srtErr);
        }
    });
};

// обработка ответа Ajax запроса
function processAjax(nameGetFunc){
     if(nameGetFunc == undefined){
       $('p#p_info').empty();
       $('img#img_preloader').css({display:'block'});  
       updateData('truncateTable');
       }
        // nameGetFunc = getDateGoalies - сбор и запись статистики вратарей
        if(nameGetFunc == 'getDateGoalies'){$('p#p_info').append('<br><span style="color:red;">Идет сбор и запись статистики вратарей</span>');updateData('getDateGoalies');}
        // nameGetFunc = getDateGoalies - сбор и запись статистики защитников    
        if(nameGetFunc == 'getDateDefenders'){$('p#p_info').append('<br><span style="color:red;">Идет сбор и запись статистики защитников</span>');updateData('getDateDefenders');}
        // nameGetFunc = getDateAttacks - сбор и запись статистики нападающих
        if(nameGetFunc == 'getDateAttacks'){$('p#p_info').append('<br><span style="color:red;">Идет сбор и запись статистики нападающих</span>');updateData('getDateAttacks');}
}    

// обработка нажатия на кнопки категорий - Снайперы Бомбардиры Ассистенты Плюс/Минус
$('button.category').on('click',function(){
            //alert($(this).data('category'));
            var category = $(this).data('category');
            var team = $('[name=team]').val();
            $.ajax({
                beforesend:function(){},
                url:'ajax_php/leaders_select.php',
                data:'category='+category+'&team='+team,
                type:'POST',
                success:function(data){
                    //alert(data);
                    $('p#insert-content').append(data);
                }
            })
            
        }
      )
    
    
</script>










</html>