<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php require_once('php/link.php'); ?>
   
    <!--    -->
   
    <title>Протокол матча</title>
</head>
<body>
  <div class="container">
    <h3>Сбор данных из протокола матча</h3>
    <hr>
   
   <div class="col-md-6">
        <form action="">
            <div class="form-group">
                <label for="">Ссылка на проткол матча</label>
                <input type="text" class='form-control' id='link_protocol' value=''>
            </div>
            <button type="submit" class="btn btn-info pull-right" onclick='goProtocol()'>начать</button>
        </form>
   </div>

  </div>


<script>
    
function goProtocol(){
    //alert('goProtocol');
    $.ajax({
        url:'protocol-scrab.php',
        type:"GET",
        dataType:'text',
        success: function (data){
                    viewProtocol(data);
            alert('GOOD-');
                },
//        error:function(jqXHR){
//            jqXHR.fail(function(jqXHR, textStatus, errorThrown){
//                alert('error-'+ textStatus);
//                alert('errorThrown-'+ errorThrown);
//            })
//        }
        error: function(request, status, error) {
                 var statusCode = request.status; // вот он код ответа
            alert('statusCode-'+ statusCode);
            alert('error-'+ error);
                }
    });
} 
    
function  viewProtocol(data){
    $('body').append(data);
    alert(data);
}  
    
    
</script>    
        
            
                
                    
                        
                            
                                
                                    
                                        
                                            
                                                
                                                        
</body>
</html>