<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图书管理</title>
    <link rel="stylesheet" href="/library/css/borrow.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap-icons.css">
    <link rel="shortcut icon" href="/library/imgs/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="app">
        <div class="borrow">
            <h2>借阅图书</h2>
            <div class="search-pane">
                <form id="search-form">
                    <input type="text" name="search-text" id="search-text" class="form-control search-text" maxlength="13" placeholder="请搜索要借阅的图书ISBN号码">
                    <input type="submit" value="搜索" name="search-button" id="search-button" class="btn btn-primary search-button">
                </form>
            </div>
            <div class="info-pane">
                <div class="book">
                    <h3>图书信息</h3>
                    <p>图书名称：<span class="book-name"></span></p>
                    <p>作者名称: <span class="book-author"></span></p>
                    <p>出版社名称：<span class="book-press"></span></p>
                    <p>ISBN号码: <span class="book-isbn"></span></p>
                    <p>库存(本): <span class="book-quantity"></span></p>
                </div>
                <div class="user">
                    <h3>用户信息</h3>
                    <form id="borrow-form">
                        <input type="text" name="username" id="username" class="form-control username" placeholder="借阅人名字">
                        <input type="text" name="id-card" id="id-card" class="form-control id-card" placeholder="借阅人卡号">
                        <input type="text" name="phone" id="phone" class="form-control phone" placeholder="借阅人手机号">
                        <input type="button" name="borrow-button" id="borrow-button" class="btn btn-primary form-control borrow-button" value="借阅图书"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/library/js/jquery.min.js"></script>
    <script src="/library/js/popper.min.js"></script>
    <script src="/library/bootstrap/js/bootstrap.min.js"></script>
    <script src="/library/js/borrow.js"></script>
</body>
</html>