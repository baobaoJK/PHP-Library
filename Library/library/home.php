<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>主页</title>
    <link rel="stylesheet" href="/library/css/home.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap-icons.css">
    <link rel="shortcut icon" href="/library/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="app">
        <div class="home">
            <div class="container-fluid info-board">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="book">
                            <i class="bi bi-book"></i>
                            <div class="text">
                                <p class="title">图书馆书本数量</p>
                                <p class="subtitle">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="overtime">
                            <i class="bi bi-clipboard-x"></i>
                            <div class="text">
                                <p class="title">超时未归还书本数量</p>
                                <p class="subtitle">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="borrow">
                            <i class="bi bi-clipboard-data"></i>
                            <div class="text">
                                <p class="title">借出书本数量</p>
                                <p class="subtitle">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="time">
                            <i class="bi bi-clock"></i>
                            <div class="text">
                                <p class="title">系统时间</p>
                                <p class="subtitle">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="open-source-information">
                <div class="card">
                    <div class="card-header">开源信息</div>
                    <div class="card-body">
                        <p>该项目模拟学校图书馆的图书管理系统</p>
                        <p>码云下载地址：<a href="https://gitee.com/baobao_JK/PHP-Library">Gitee</a></p>
                        <p>GitHub下载地址：<a href="https://github.com/baobaoJK/PHP-Library">GitHub</a></p>
                        <p>文档地址：<a href="https://gitee.com/baobao_JK/PHP-Library/blob/master/%E6%96%87%E6%A1%A3/%E8%AF%B4%E6%98%8E%E6%96%87%E6%A1%A3.md">文档.md</a></p>
                    </div>
                </div>
            </div>

            <div class="log">
                <div class="card">
                    <div class="card-header">日志信息</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>操作时间</th>
                                    <th>名字</th>
                                    <th>书名</th>
                                    <th>操作信息</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>2022-3-24 20:00</td>
                                    <td>熊二</td>
                                    <td>HTML入门到精通</td>
                                    <td>借走了 HTML入门到精通 书籍</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/library/js/jquery.min.js"></script>
    <script src="/library/js/popper.min.js"></script>
    <script src="/library/bootstrap/js/bootstrap.min.js"></script>
    <script src="/library/js/home.js"></script>
</body>

</html>