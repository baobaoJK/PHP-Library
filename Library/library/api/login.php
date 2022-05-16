<?php
header("Content-type:text/html;charset=utf-8");

session_start();

// 返回信息
$resultArray = array();

// 请求类型
$request = $_REQUEST['request'];

// 获取请求类型
if($request == 'login'){
    login();
}

// 用户登录
function login(){
    global $resultArray;
    
    // 用户信息
    $username = $_POST['username'];
    $password = $_POST['password'];

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM user WHERE username = '" . $username . 
            "' AND password = '" . $password . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $row = mysqli_fetch_array($result);
        $tempGroups = $row['groups'];
        $tempUsername = $row['username'];
        $tempPassword = $row['password'];

        $userGroups = 'admin';

        if($tempGroups == $userGroups && $tempUsername == $username && $tempPassword == $password){
            $_SESSION['username'] = $tempUsername;
            $resultArray = array('resultCode' => 1);
        }
        else{
            $resultArray = array('resultCode' => 0);
        }
    }
    else{
        $resultArray = array('resultCode' => 0);
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}
?>