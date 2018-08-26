<?php

include_once('..\php\phpQuery.php');

function main_pars(){
    $p=[];
    $p['pucks_1']=[];
    $p['pucks_2']=[];
    $p['pucks_3']=[];
    $p['pucks_OT']=[];
    
    $res_curl = curl_get('https://www.khl.ru/game/468/57836/protocol/');
    $file_phpQuery = phpQuery::newDocument($res_curl);
    
    $strstr = substr($file_phpQuery->find('div.b-data_row + script')->text(),24,$lenn-6);
    $strstr = strip_tags($strstr);
    $strstr = json_decode($strstr);
    echo '<br>'.printArray($strstr);
    
    echo '<br>первый период';
    foreach($strstr as $val){
        if ($val[1] == 1){
            echo '<br>время '.$val[2];
            echo '<br>счет '.$val[3];
            echo '<br>кто забил '.$val[5];
            echo '<br>передача 1 '.$val[6];
            echo '<br>передача 2 '.$val[7];
            array_push($p['pucks_1'], ['time'=>$val[2],'score'=>$val[3],'goals'=>$val[5], 'assist_1'=>$val[6], 'assist_2'=>$val[7]]);         
        }
    }
    echo '<br>второй период';
    foreach($strstr as $val){
        if ($val[1] == 2){
            echo '<br>время '.$val[2];
            echo '<br>счет '.$val[3];
            echo '<br>кто забил '.$val[5];
            echo '<br>передача 1 '.$val[6];
            echo '<br>передача 2 '.$val[7];
            array_push($p['pucks_2'], ['time'=>$val[2],'score'=>$val[3],'goals'=>$val[5], 'assist_1'=>$val[6], 'assist_2'=>$val[7]]);        
        }
    }
    echo '<br>третий период';
    foreach($strstr as $val){
        if ($val[1] == 3){
            echo '<br>время '.$val[2];
            echo '<br>счет '.$val[3];
            echo '<br>кто забил '.$val[5];
            echo '<br>передача 1 '.$val[6];
            echo '<br>передача 2 '.$val[7];
            array_push($p['pucks_3'], ['time'=>$val[2],'score'=>$val[3],'goals'=>$val[5], 'assist_1'=>$val[6], 'assist_2'=>$val[7]]);        
        } 
    }
    echo '<br>третий период';
    foreach($strstr as $val){
        if ($val[1] == 'ОТ'){
            echo '<br>время '.$val[2];
            echo '<br>счет '.$val[3];
            echo '<br>кто забил '.$val[5];
            echo '<br>передача 1 '.$val[6];
            echo '<br>передача 2 '.$val[7];
            array_push($p['pucks_OT'], ['time'=>$val[2],'score'=>$val[3],'goals'=>$val[5], 'assist_1'=>$val[6], 'assist_2'=>$val[7]]);        
        }
    }
    
    printArray($p);
    
    $lenn = strlen($file_phpQuery->find('div.b-data_row + script')->text());
    echo '<br>'.$lenn;

}



// вызовы функций ***********************************************************
    main_pars();
    //imageTemplate();
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