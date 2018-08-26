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
    <title>Статистика плей-офф</title>
       
   
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body  style='padding-top: 70px'> 
   <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container" style="padding-top:10px;">
             <a href="../main.php" class="btn btn-info">на главную</a>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
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
            <div class="col-lg-2">
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
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="date_match">дата матча</label>
                    <input type="date" class="form-control" id="date_match"  name="date">
                </div>                
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="submit" value="Отправить" id='send'>                
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="submit" value="Отправить" id='send'>                
                </div>
            </div>
        </div>
        <hr>
    </div>
</body>

<script>
(function(){
    $('#send').on('click',function(){
        send();
    })
}())

//фуккция отправки ajax запроса для формирвания картинки     
function send(){
    var t1 = $('[name=team_1]').val();alert(t1);
    var t2 = $('[name=team_2]').val();
    var date = $('[name=date]').val();
    $.ajax({
        url:'ajax_php/stat_playoff.php',
        data:'t1='+t1+'&t2='+t2+'&date='+date,
        type:'get',
        dataType:'',
        success:function(data){alert('success: '+data)},
        error:function(jqXHR, srtErr, errorThrown){alert('error: '+srtErr+' errorThrown:'+errorThrown);}
        
        
    });
    
    
    
    
    
    
    
}   
    
    
    
</script>





</html>