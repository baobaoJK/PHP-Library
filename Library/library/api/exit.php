<?php
header("Content-type:text/html;charset=utf-8");

session_start();

// 返回信息
$resultArray = array();

// 请求类型
$request = $_REQUEST['request'];

// 获取请求类型
if($request == 'exit'){
    loginOut();
}

// 用户登录
function loginOut(){
    global $resultArray;
    
    $username = $_SESSION['username'];
    if(!empty($username)){
        unset($_SESSION['username']);
    }
    
    $resultArray = array('resultCode' => 1);

    echo json_encode($resultArray);
}
?>