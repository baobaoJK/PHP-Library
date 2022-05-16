$(function(){
    // 初始化
    init();

    // 添加用户按钮
    $(document).on('click', '.add-user-button', function (e) { 
        e.preventDefault();
        
        // 获取表单信息
        var addForm = new FormData($('#add-user-form')[0]);

        // 获取输入信息
        var name = addForm.get('add-name');
        var gender = addForm.get('add-gender');
        var idCard = addForm.get('add-id-card');
        var phone = addForm.get('add-phone');
        var identity = addForm.get('add-identity');

        // 判断输入信息
        if(name == ''){
            alert("请输入名字");
        }
        else if(gender == ''){
            alert("请输入性别");
        }
        else if(idCard == ''){
            alert("请输入借书卡号");
        }
        else if(phone == ''){
            alert("请输入手机号");
        }
        else if(identity == ''){
            alert("请输入身份");
        }
        else{
            addForm.append("request", "add");
            addUser(addForm);
        }
    });

    // 删除用户按钮
    $(document).on('click', '.btn-delete', function(e) { 
        e.preventDefault();
        
        // 获取名字
        var name = $(this).parent().parent().find('.name').text();
        var id = $(this).attr('name');

        // 设置名字
        $('#delete-name').text(name);
        $('.delete-user-button').attr('id', id);
    });

    $(document).on('click', '.delete-user-button', function (e) {
        e.preventDefault();

        // 获取id
        var id = $(this).attr('id');

        // 生成表单数据
        var deleteForm = new FormData();

        // 添加表单数据
        deleteForm.append('request', 'delete');
        deleteForm.append('id', id);
        
        // 删除用户
        deleteUser(deleteForm);
    });

    // 编辑用户按钮
    $(document).on('click', '.btn-edit', function (e) { 
        e.preventDefault();

        // 获取id
        var id = $(this).attr('name');

        // 设置名字
        $('.edit-user-button').attr('id', id);
    });

    $(document).on('click', '.edit-user-button', function (e) { 
        e.preventDefault();

        // 获取id
        var id = $(this).attr('id');

        // 生成表单数据
        var editForm = new FormData($('#edit-user-form')[0]);

        // 添加表单数据
        editForm.append('request', 'edit');
        editForm.append('id', id);
        
        // 删除用户
        editUser(editForm);
    });

    // 搜索用户按钮
    $(document).on('click', '.btn-search', function (e) { 
        e.preventDefault();

        // 获取表单
        var searchForm = new FormData($('#search-form')[0]);

        // 获取信息
        var searchText = searchForm.get('search-text');

        // 判断信息
        if(searchText == ''){
            alert("请输入要搜索的信息");
        }
        else{
            searchForm.append("request", "search");
            searchForm.append("search-start", 0);
            searchUser(searchForm);
        }
    });
});

// 初始化
function init(){
    // 从第几条开始
    var start = 0;

    // n条数据 / 页
    var page = 10;

    // 获取用户
    getUser(start, page);

    // 分页按钮
    $('.pag-box').pagination({
        mode: 'fixed',
        totalData: getUserCount(),
        showData: 10,
        callback: function(api){
            start = api.getCurrent();
            getUser((start - 1) * 10, page);
        }
    });
}

// 添加用户
function addUser(addForm){
    $.ajax({
        type: "post",
        url: "/library/api/user.php",
        data: addForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.resultCode == 0){
                alert("添加用户失败，手机号或借书卡号存在");
            }
            else if(data.resultCode == 1){
                alert("添加用户成功");
                window.location.reload('./');
            }
            else{
                alert("出现错误");
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });
}

// 删除用户
function deleteUser(deleteForm){
    $.ajax({
        type: "post",
        url: "/library/api/user.php",
        data: deleteForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.resultCode == 0){
                alert("删除失败，该用户不存在");
            }
            else if(data.resultCode == 1){
                alert("删除成功");
                window.location.reload('./');
            }
            else{
                alert("服务器错误");
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });
}

// 编辑用户
function editUser(editForm){
    $.ajax({
        type: "post",
        url: "/library/api/user.php",
        data: editForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.resultCode == 0){
                alert("编辑失败，借阅卡号或手机号已存在");
            }
            else if(data.resultCode == 1){
                alert("编辑成功");
                window.location.reload('./');
            }
            else{
                alert("出现错误");
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });
}

// 搜索用户
function searchUser(searchForm){
    // 删除原先数据
    $('#user-table table tbody tr').remove();

    $.ajax({
        type: "post",
        url: "/library/api/user.php",
        data: searchForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            console.log(data);

            var length = data.length;
            for(var i = 0; i < length; i++){
                $('#user-table table tbody').append(
                    '<tr>' +
                        '<th>' + data[i][0] + '</th>' +
                        '<td class="name">' + data[i][2] + '</td>' +
                        '<td>' + data[i][5] + '</td>' +
                        '<td>' + data[i][6] + '</td>' +
                        '<td>' + data[i][7] + '</td>' +
                        '<td>' + data[i][8] + '</td>' +
                        '<td>' + data[i][9] + '</td>' +
                        '<td>' +
                            getOperate(data[i][0]) +
                         '</td>' +
                    '</tr>'
                );
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });
}

// 获取用户数据
function getUser(start, page){

    // 删除原先数据
    $('#user-table table tbody tr').remove();

    $.ajax({
        type: "get",
        url: "/library/api/user.php",
        data: {"request": "get", "start": start, "page": page},
        dataType: "json",
        success: function (data) {            
            // console.log(data);
            var length = data.length;
            for(var i = 0; i < length; i++){
                $('#user-table table tbody').append(
                    '<tr>' +
                        '<th>' + data[i][0] + '</th>' +
                        '<td class="name">' + data[i][2] + '</td>' +
                        '<td>' + data[i][5] + '</td>' +
                        '<td>' + data[i][6] + '</td>' +
                        '<td>' + data[i][7] + '</td>' +
                        '<td>' + data[i][8] + '</td>' +
                        '<td>' + data[i][9] + '</td>' +
                        '<td>' +
                            getOperate(data[i][0]) +
                         '</td>' +
                    '</tr>'
                );
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });
}

// 获取用户数量
function getUserCount(){
    
    // 用户数量
    var count = 0;

    $.ajax({
        type: "get",
        url: "/library/api/user.php",
        data: {"request": "count"},
        async: false,
        dataType: "json",
        success: function (data) {
            count = data.count;
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });

    return count;
}

// 获取用户操作按钮
function getOperate(id){
    if(id == 1){
        return "";
    }

    return  '<button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit-user-modal" name="' + id + '"><i class="bi bi-pencil-square"></i>编辑</button>' +
            '<button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#delete-user-modal" name="' + id + '"><i class="bi bi-trash"></i>删除</button>';
}