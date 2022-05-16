<?php
session_start();

$username = $_SESSION['username'];

if(empty($username)){
    echo '<script>alert("请登录");window.location.replace("./login.php")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图书管理系统</title>
    <link rel="stylesheet" href="/library/css/library.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap-icons.css">
    <link rel="shortcut icon" href="/library/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="app">
        <div class="library">
            <div class="aside">
                <div class="title">
                    <h4>图书管理系统</h4>
                </div>
                <div class="nav">
                    <nav class="navbar">

                        <!-- Links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" data-id="#library-frame" data-url="home.php"><i class="bi bi-house"></i>主页</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bar-link" data-target="#book-bar" data-toggle="collapse" href="#" aria-expanded="false"><i class="bi bi-book"></i>图书<i class="bi bi-chevron-down"></i></a>
                                <div class="collapse item-bar" id="book-bar">
                                    <a data-id="#library-frame" data-url="book.php">图书管理</a>
                                    <a data-id="#library-frame" data-url="borrow.php">借阅图书</a>
                                    <a data-id="#library-frame" data-url="return.php">归还图书</a>
                                    <a data-id="#library-frame" data-url="overtime.php">超时查询</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bar-link" data-target="#user-bar" data-toggle="collapse" href="#" aria-expanded="false"><i class="bi bi-person"></i>用户<i class="bi bi-chevron-down"></i></a>
                                <div class="collapse item-bar" id="user-bar">
                                    <a data-id="#library-frame" data-url="user.php">用户管理</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bar-link" data-target="#system-bar" data-toggle="collapse" href="#" aria-expanded="false"><i class="bi bi-gear"></i>其他<i class="bi bi-chevron-down"></i></a>
                                <div class="collapse item-bar" id="system-bar">
                                    <a data-id="#library-frame" data-url="about.php">关于</a>
                                    <a data-id="#library-frame" data-url="system.php">系统管理</a>
                                    <a data-id="#library-frame" data-url="test01.php">测试页 1</a>
                                    <a data-id="#library-frame" data-url="test02.php">测试页 2</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link exit" href="#"><i class="bi bi-arrow-left"></i>退出系统</a>
                            </li>
                        </ul>

                    </nav>
                </div>
            </div>
            <div class="pane">
                <div class="header">
                    <div class="user-bar">
                        <p class="username"><?php echo $username; ?></p>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-gear"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <p class="dropdown-item">欢迎您！<?php echo $username ?></p>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item exit" href="#">退出系统</a>
                            </div>
                        </div>
                    </div>

                    <div class="tabs">

                        <!-- Nav pills -->
                        <ul class="nav" id="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-id="#library-frame" data-url="home.php" data-toggle="link" style="padding-right:0px;">主页</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-id="#library-frame" data-url="book.php" data-toggle="link">图书管理</a><i class="bi bi-x tab-close"></i>
                            </li> -->
                        </ul>

                    </div>

                </div>
                <div class="main">
                    <iframe src="home.php" frameborder="0" id="library-frame" name="library-frame"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="/library/js/jquery.min.js"></script>
    <script src="/library/js/popper.min.js"></script>
    <script src="/library/bootstrap/js/bootstrap.min.js"></script>
    <script src="/library/js/library.js"></script>
</body>

</html>