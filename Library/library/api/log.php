<?php
header("Content-type:text/html;charset=utf-8");

// 返回信息
$resultArray = array();

// 请求类型
$request = $_REQUEST['request'];

// 获取请求类型
if($request == 'log'){
    getLog();
}

// 获取图书数量
function getLog(){
    global $resultArray;
    
    // 设置返回信息数量
    $num = 50;

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM operation_record ORDER BY Id DESC LIMIT 0," . $num;

    $result = mysqli_query($connect, $sql);

    if($result){
        $resultArray = mysqli_fetch_all($result);
    }
    else{
        $resultArray = array('resultCode' => 0);
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}
?>