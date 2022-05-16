<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>系统设置</title>
    <link rel="stylesheet" href="/library/css/system.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/bootstrap/css/bootstrap-icons.css">
    <link rel="shortcut icon" href="/library/imgs/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="app">
        <div class="system-information">
            <div class="card">
                <div class="card-header">系统设置</div>
                <div class="card-body">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#add-type-modal">添加图书种类</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#delete-type-modal">删除图书种类</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#edit-admin-modal">修改管理员 admin 密码</button>
                </div>
            </div>
        </div>

        <!-- 添加图书种类模态框 -->
        <div class="modal fade" id="add-type-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">添加图书种类</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-type-form">
                        <div class="form-item">
                            <label for="add-type-name"><span class="must">*</span>种类名</label>
                            <input type="text" name="add-type-name" id="add-type-name" class="form-control" placeholder="种类名">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-success add-type-button">添加</button>
                </div>
                </div>
            </div>
        </div>

        <!-- 删除图书种类模态框 -->
        <div class="modal fade" id="delete-type-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">删除图书种类</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="delete-type-form">
                        <div class="form-item">
                            <label for="delete-type-name"><span class="must">*</span>种类名</label>
                            <input type="text" name="delete-type-name" id="delete-type-name" class="form-control" placeholder="种类名">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-danger delete-type-button">删除</button>
                </div>
                </div>
            </div>
        </div>


        <!-- 修改管理员 admin 密码 -->
        <div class="modal fade" id="edit-admin-modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">修改密码</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-admin-form">
                        <div class="form-item">
                            <label for="edit-admin-password"><span class="must">*</span>新密码</label>
                            <input type="text" name="edit-admin-password" id="edit-admin-password" class="form-control" placeholder="新密码">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-success edit-admin-password-button">修改</button>
                </div>
                </div>
            </div>
        </div>

    <script src="/library/js/jquery.min.js"></script>
    <script src="/library/js/popper.min.js"></script>
    <script src="/library/bootstrap/js/bootstrap.min.js"></script>
    <script src="/library/js/system.js"></script>
</body>

</html>