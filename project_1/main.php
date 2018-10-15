<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once('../php/link.php'); ?>
    <meta charset="UTF-8">
    <title>Главная страница</title>
</head>
<body style='padding-top: 70px'>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container" style="padding-top:10px;">
            <a href="scripts_php/help.php" class="btn btn-default pull-right" target="_blank">Справка</a>
        </div>
    </nav>
    <div class="container">
        <div class="col-md-4">
            <a href="result_teams.php" class="btn btn-info" target="_self">Обновить табличные данные</a>
            <br><br>
            <a href="result_teams_2018.php" class="btn btn-info" target="_self">Обновить табличные данные 2018/19</a> 
            <p><code>собирает информацию с таблицы КХЛ<br>перед использование нужно обновить файлы<br>table_conf\west.php<br>table_conf\west.php</code></p>
            <hr>
            <a href="stat_team.php" class="btn btn-primary" target="_self">Обновить данные champ</a>
            <br><br>
            <a href="stat_team_2108.php" class="btn btn-primary" target="_self">Обновить данные champ 2018/19</a>
            <p><code>собирает информацию с профиля каждой команды и раскладывает по таблицам БД<br>перед использование нужно обновить файлы</code></p>
            <hr>
            <a href="images.php" class="btn btn-warning" target="_self">Формировать картинки</a>
            <br><br>
            <a href="images_2018.php" class="btn btn-warning" target="_self">Формировать картинки 2018/19</a>
            <p></p>
            <hr>
            <a href="pars_results.php" class="btn btn-default" target="_self">Парсинг результатов</a>
            <p></p>
			<a href="pars_results_2018.php" class="btn btn-default" target="_self">Парсинг результатов 2018/19</a>
            <p></p>
            <hr>
            <a href="scripts_php/p_play_p_kill.php" class="btn btn-success" target="_self">Меньшинстов/Большинство</a>
            <p><code>Парсинг данных Меньшинстов/Большинство.</code></p>
            <a href="scripts_php/p_play_p_kill_2018.php" class="btn btn-success" target="_self">Меньшинстов/Большинство 2018/19</a>  
        </div>
        <div class="col-md-3">
            <a href="total.php" class="btn btn-info" target="_self">Расчитать тотал для команд</a>
            <p></p>
            <a href="pre_match.php" class="btn btn-info" target="_self">Предматчевый анализ команд</a>
            <p></p>
            <hr>
            <a href="scripts_php/leaders.php" class="btn btn-info" target="_self">Лидеры команды</a>
            <p></p>
            <hr>
            <a href="scripts_php/stat_pl_off.php" class="btn btn-info" target="_self">Статистика плей-офф</a>
        </div>
        <div class="col-md-3">
            <a href="record_results.php" class="btn btn-info" target="_self">Запись результатов</a>
            <p></p>
        </div>
        <div class="col-md-2">
            <a href="#" class="btn btn-danger btn-xs" onclick='clear_teams("table_conf")'>Очистить табличные данные</a>
            <p class='table_conf'></p>
            <a href="#" class="btn btn-danger btn-xs" onclick='clear_teams("stat_wins")'>Очистить таблицу stat_wins</a>
            <p class='stat_wins'></p>
        </div>
    </div> 
</body>

<script>

 function clear_teams(table_db_preview){
        //alert(table_db_preview);
        $.ajax({
            url: "clear_teams.php",
            data:'clear_table='+table_db_preview,
            type:'POST',
			dataType:"json",
            success: function(data){
                $("p."+data.classP+"").append("<span>!!!"+data.answerServer+"</span>");
            },
			error: function(jqXHR, textStatus, errorThrown){
                alert('error'+textStatus);	
             }

        }); 
    }
</script>




</html>