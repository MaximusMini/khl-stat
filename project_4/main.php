<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../php/link.php'); ?>
    <meta charset="UTF-8">
    <title>Протоколы матчей</title>
</head>
<style>
    .p-head{
        padding:10px 0px 10px 10px; 
        font: 18px 'Georgia';       
    }
</style>


<body style='padding-top: 70px'>
    <div class="container">
        <!--  Протоколы матчей регулярного сезона КХЛ      -->
        <div class="row">
            <h3>Протоколы матчей регулярного сезона КХЛ</h3>
            <div class="col-lg-3">
                <p class="bg-primary p-head">Основное время</p>
                <div class="form-group">
                <label for="protocol">номер протокола</label>
                <input type="text" class="form-control" id='protocol' name="protocol">
                <br>
                <button class="btn btn-success" id='btn-protocol'>протокол</button>
                </div>   
            </div>
            <div class="col-lg-3">
                <p class="bg-primary p-head">Овертайм</p>
                    <div class="form-group">
                    <label for="protocol_ot">номер протокола</label>
                    <input type="text" class="form-control" id='protocol_ot' name="protocol_ot">
                    <br>
                    <button class="btn btn-success" id='btn-protocol_ot'>протокол</button>
                </div>     
            </div>
            <div class="col-lg-3">
                <p class="bg-primary p-head">Буллиты</p>
                <div class="form-group">
                    <label for="protocol_b">номер протокола</label>
                    <input type="text" class="form-control" id='protocol_b' name="protocol_b">
                    <br>
                    <button class="btn btn-success" id='btn-protocol_b'>протокол</button>
                </div>      
            </div>
            <div class="col-lg-3">
                
            </div>
        </div>
        <hr>
        <!--  Протоколы матчей плей-офф КХЛ      -->
        <div class="row">
            <h3>Протоколы матчей плей-офф КХЛ </h3>
            <div class="col-lg-3">
                <p class="bg-primary p-head">Основное время</p>
                <div class="form-group">
                <label for="protocol_pl">номер протокола</label>
                <input type="text" class="form-control" id='protocol_pl' name="protocol_pl">
                <br>
                <button class="btn btn-success" id='btn-protocol_pl'>протокол</button>
                </div>   
            </div>
            <div class="col-lg-3">
                <p class="bg-primary p-head">Овертайм</p>
                    <div class="form-group">
                    <label for="protocol_ot_pl">номер протокола</label>
                    <input type="text" class="form-control" id='protocol_ot_pl' name="protocol_ot_pl">
                    <br>
                    <button class="btn btn-success" id='btn-protocol_ot_pl'>протокол</button>
                </div>     
            </div>
            <div class="col-lg-3">
                <p class="bg-primary p-head">Буллиты</p>
                <div class="form-group">
                    <label for="protocol_b_pl">номер протокола</label>
                    <input type="text" class="form-control" id='protocol_b_pl' name="protocol_b_pl">
                    <br>
                    <button class="btn btn-success" id='btn-protocol_b_pl'>протокол</button>
                </div>      
            </div>
            <div class="col-lg-3">
                
            </div>
        </div>
    </div>
</body>


<script>
(function(){

$('button').on('click',function(event){
    //alert($(this).attr('id'));
    var numProtocol = $().val();// номер протокола
    var arrParAjax=[];// инициализируем объект с параметрами для вызова нужного ajax запроса
    var idButton = $(this).attr('id');// определяем на какой кнопке нажали
    switch(idButton):
        case 'btn-protocol':arrParAjax['protocol_khl.php']; break;
        case 'btn-protocol_ot':break;
        case 'btn-protocol_b':break;
        case 'btn-protocol_pl':break;        
        case 'btn-protocol_ot_pl':break;
        case 'btn-protocol_b_pl':break;
        default:alert('no paramets');
});
    
}())
    
// вызов скрипта ajax
function ajaxRequest(){
    
}
    
</script>




</html>