<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户管理</title>
    <link rel="stylesheet" href="/library/css/user.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/library/css/pagination.css">
    <link rel="shortcut icon" href="/library/imgs/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="app">
        <div class="user">
            <div class="operate-pane">
                <div class="row">
                    <div class="col-lg-2">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-user-modal"><i class="bi bi-plus-lg"></i>添加用户</button>
                    </div>
                    <div class="col-lg-8">
                        <form method="get" id="search-form">
                            <div class="search">
                                <select name="search-type" id="search-type" class="form-control">
                                    <option value="name">名字</option>
                                    <option value="id-card">借书卡号</option>
                                    <option value="phone">手机号</option>
                                </select>
                                <input type="text" class="form-control" id="search-text" name="search-text">
                                <button type="submit" class="btn btn-primary btn-search">搜索</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
            </div>

            <div class="user-pane">
                <div id="user-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>名字</th>
                            <th>性别</th>
                            <th>借书卡号</th>
                            <th>手机号</th>
                            <th>身份</th>
                            <th>可借阅书本数量</th>
                            <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- 样板 -->
                        <!-- <tr>
                            <th>1</th>
                            <td>admin</td>
                            <td>男</td>
                            <td>10000000</td>
                            <td>10000000000</td>
                            <td>管理员</td>
                            <td>999</td>
                            <td>
                                <button class="btn btn-primary btn-edit">编辑</button>
                                <button class="btn btn-danger btn-delete">删除</button>
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

        <!-- 添加用户模态框 -->
        <div class="modal fade" id="add-user-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">添加用户</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-user-form">
                        <div class="form-item">
                            <label for="add-name"><span class="must">*</span>名字</label>
                            <input type="text" name="add-name" id="add-name" class="form-control" placeholder="名字">
                        </div>
                        <div class="form-item">
                            <label for="add-gender"><span class="must">*</span>性别</label>
                            <select name="add-gender" id="add-gender" class="form-control">
                                <option value="">请选择性别</option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>
                        <div class="form-item">
                            <label for="add-id-card"><span class="must">*</span>借书卡号</label>
                            <input type="text" name="add-id-card" id="add-id-card" class="form-control" placeholder="借书卡号">
                        </div>
                        <div class="form-item">
                            <label for="add-phone"><span class="must">*</span>手机号</label>
                            <input type="text" name="add-phone" id="add-phone" class="form-control" placeholder="手机号">
                        </div>
                        <div class="form-item">
                            <label for="add-identity"><span class="must">*</span>身份</label>
                            <select name="add-identity" id="add-identity" class="form-control">
                                <option value="">请选用户身份</option>
                                <option value="teacher">老师</option>
                                <option value="student">学生</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-success add-user-button">添加</button>
                </div>
                </div>
            </div>
        </div>

        <!-- 编辑用户模态框 -->
        <div class="modal fade" id="edit-user-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">编辑用户</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-user-form">
                        <div class="form-item">
                            <label for="edit-name">名字</label>
                            <input type="text" name="edit-name" id="edit-name" class="form-control" placeholder="名字">
                        </div>
                        <div class="form-item">
                            <label for="edit-gender">性别</label>
                            <select name="edit-gender" id="edit-gender" class="form-control">
                                <option value="">请选择性别</option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>
                        <div class="form-item">
                            <label for="edit-id-card">借书卡号</label>
                            <input type="text" name="edit-id-card" id="edit-id-card" class="form-control" placeholder="借书卡号">
                        </div>
                        <div class="form-item">
                            <label for="edit-phone">手机号</label>
                            <input type="text" name="edit-phone" id="edit-phone" class="form-control" placeholder="手机号">
                        </div>
                        <div class="form-item">
                            <label for="edit-identity">身份</label>
                            <select name="edit-identity" id="edit-identity" class="form-control">
                                <option value="">请选用户身份</option>
                                <option value="teacher">老师</option>
                                <option value="student">学生</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary edit-user-button">编辑</button>
                </div>
                </div>
            </div>
        </div>

        <!-- 删除用户模态框 -->
        <div class="modal fade" id="delete-user-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">删除用户</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>确定删除 <span id="delete-name"></span> 此用户吗？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-user-button">删除</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/library/js/jquery.min.js"></script>
    <script src="/library/js/jquery.pagination.js"></script>
    <script src="/library/js/popper.min.js"></script>
    <script src="/library/bootstrap/js/bootstrap.min.js"></script>
    <script src="/library/js/user.js"></script>
</body>
</html>