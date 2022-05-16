<?php
session_start();

$username = $_SESSION['username'];

if(!empty($username)){
    echo '<script>window.location.replace("./library.php")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图书管理系统</title>
    <link rel="stylesheet" href="/library/css/login.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/library/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="app">
        <div class="login-pane">
            <div class="login-pane-left col-6">
                <div class="title">
                    <h2>欢迎登录</h2>
                    <h4>图书管理系统</h4>
                </div>
            </div>
            <div class="login-pane-right col-6">
                <form class="login-form" method="post" action="/library/library.php">
                    <input type="text" name="username" id="username" class="username" placeholder="用户名" autocomplete="off">
                    <input type="password" name="password" id="password" class="password" placeholder="密码" autocomplete="off">
                    <input type="submit" name="login-button" id="login-button" class="login-button" value="登录">
                    <span>Version 1.0</span>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="/library/js/jquery.min.js"></script>
<script src="/library/bootstrap/js/bootstrap.min.js"></script>
<script src="/library/js/login.js"></script>

</html>