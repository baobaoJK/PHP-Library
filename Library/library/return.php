<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图书管理</title>
    <link rel="stylesheet" href="/library/css/return.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/library/css/pagination.css">
    <link rel="shortcut icon" href="/library/imgs/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="app">
        <div class="return">
            <div class="operate-pane">
                <div class="row">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8">
                        <form id="search-form">
                            <div class="search">
                                <input type="text" class="form-control" name="search-text" id="search-text" placeholder="ISBN号码">
                                <button type="submit" class="btn btn-primary btn-search" name="search-button" id="search-button">搜索</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
            </div>

            <div class="return-pane">
                <div id="return-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>书名</th>
                            <th>ISBN号码</th>
                            <th>借阅人</th>
                            <th>借阅人ID卡</th>
                            <th>借阅人手机</th>
                            <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- 样板 -->
                        <!-- <tr>
                            <th>1</th>
                            <td>房龙地理</td>
                            <td>9780000000001</td>
                            <td>张三</td>
                            <td>20220001</td>
                            <td>13700000001</td>
                            <td>
                                <button class="btn btn-primary btn-edit">归还</button>
                            </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>

                <div class="page-box">
                    <div class="m-style pag-box"></div>
                </div>
            </div>
        </div>

        <!-- 归还图书模态框 -->
        <div class="modal fade" id="return-book-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">归还图书</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>确定归还 <span id="return-name"></span> 此书吗？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success return-book-button">归还</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/library/js/jquery.min.js"></script>
    <script src="/library/js/jquery.pagination.js"></script>
    <script src="/library/js/popper.min.js"></script>
    <script src="/library/bootstrap/js/bootstrap.min.js"></script>
    <script src="/library/js/return.js"></script>
</body>
</html>