$(function(){
    // 初始化
    init();

    // 添加图书按钮
    $(document).on('click', '.add-book-button', function (e) { 
        e.preventDefault();
        
        // 获取表单信息
        var addForm = new FormData($('#add-book-form')[0]);

        // 获取输入信息
        var group = addForm.get('add-group');
        var name = addForm.get('add-name');
        var author = addForm.get('add-author');
        var press = addForm.get('add-press');
        var price = addForm.get('add-price');
        var count = addForm.get('add-count');
        var isbn = addForm.get('add-isbn');

        // 判断输入信息
        if(group == ''){
            alert("请选择组别");
        }
        else if(name == ''){
            alert("请输入名字");
        }
        else if(author == ''){
            alert("请输入作者");
        }
        else if(press == ''){
            alert("请输入出版社");
        }
        else if(price == ''){
            alert("请输入价格");
        }
        else if(count == ''){
            alert("请输入书本数量");
        }
        else if(isbn == ''){
            alert("请输入 ISBN 号码");
        }
        else{
            addForm.append("request", "add");
            addBook(addForm);
        }
    });

    // 删除图书按钮
    $(document).on('click', '.btn-delete', function(e) { 
        e.preventDefault();
        
        // 获取名字
        var name = $(this).parent().parent().find('.name').text();
        var id = $(this).attr('name');

        // 设置名字
        $('#delete-name').text(name);
        $('.delete-book-button').attr('id', id);
    });

    $(document).on('click', '.delete-book-button', function (e) {
        e.preventDefault();

        // 获取id
        var id = $(this).attr('id');

        // 生成表单数据
        var deleteForm = new FormData();

        // 添加表单数据
        deleteForm.append('request', 'delete');
        deleteForm.append('id', id);
        
        // 删除图书
        deleteBook(deleteForm);
    });

    // 编辑图书按钮
    $(document).on('click', '.btn-edit', function (e) { 
        e.preventDefault();

        // 获取id
        var id = $(this).attr('name');

        // 设置名字
        $('.edit-book-button').attr('id', id);
    });

    $(document).on('click', '.edit-book-button', function (e) { 
        e.preventDefault();

        // 获取id
        var id = $(this).attr('id');

        // 生成表单数据
        var editForm = new FormData($('#edit-book-form')[0]);

        // 添加表单数据
        editForm.append('request', 'edit');
        editForm.append('id', id);
        
        // 删除图书
        editBook(editForm);
    });

    // 搜索图书按钮
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
            searchBook(searchForm);
        }
    });
});

// 初始化
function init(){
    // 从第几条开始
    var start = 0;

    // n条数据 / 页
    var page = 10;

    // 获取图书
    getBook(start, page);

    // 分页按钮
    $('.pag-box').pagination({
        mode: 'fixed',
        totalData: getBookCount(),
        showData: 10,
        callback: function(api){
            start = api.getCurrent();
            getBook((start - 1) * 10, page);
        }
    });

    // 获取图书组别
    getGroups();
}

// 添加图书
function addBook(addForm){
    $.ajax({
        type: "post",
        url: "/library/api/book.php",
        data: addForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.resultCode == 0){
                alert("添加图书失败，ISBN号码存在");
            }
            else if(data.resultCode == 1){
                alert("添加图书成功");
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

// 删除图书
function deleteBook(deleteForm){
    $.ajax({
        type: "post",
        url: "/library/api/book.php",
        data: deleteForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.resultCode == 0){
                alert("删除失败，该图书不存在");
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

// 编辑图书
function editBook(editForm){
    $.ajax({
        type: "post",
        url: "/library/api/book.php",
        data: editForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.resultCode == 0){
                alert("编辑失败，ISBN号码已存在");
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

// 搜索图书
function searchBook(searchForm){
    // 删除原先数据
    $('#book-table table tbody tr').remove();

    $.ajax({
        type: "post",
        url: "/library/api/book.php",
        data: searchForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            var length = data.length;
            for(var i = 0; i < length; i++){
                $('#book-table table tbody').append(
                    '<tr>' +
                        '<th>' + data[i][0] + '</th>' +
                        '<td>' + data[i][1] + '</td>' +
                        '<td class="name">' + data[i][2] + '</td>' +
                        '<td>' + data[i][3] + '</td>' +
                        '<td>' + data[i][4] + '</td>' +
                        '<td>' + data[i][5] + '</td>' +
                        '<td>' + data[i][6] + '</td>' +
                        '<td>' + data[i][7] + '</td>' +
                        '<td>' +
                            '<button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit-book-modal" name="' + data[i][0] + '"><i class="bi bi-pencil-square"></i>编辑</button>' + 
                            '<button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#delete-book-modal" name="' + data[i][0] + '"><i class="bi bi-trash"></i>删除</button>' +
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

// 获取图书数据
function getBook(start, page){

    // 删除原先数据
    $('#book-table table tbody tr').remove();

    $.ajax({
        type: "get",
        url: "/library/api/book.php",
        data: {"request": "get", "start": start, "page": page},
        dataType: "json",
        success: function (data) {            
            // console.log(data);
            var length = data.length;
            for(var i = 0; i < length; i++){
                $('#book-table table tbody').append(
                    '<tr>' +
                        '<th>' + data[i][0] + '</th>' +
                        '<td>' + data[i][1] + '</td>' +
                        '<td class="name">' + data[i][2] + '</td>' +
                        '<td>' + data[i][3] + '</td>' +
                        '<td>' + data[i][4] + '</td>' +
                        '<td>' + data[i][5] + '</td>' +
                        '<td>' + data[i][6] + '</td>' +
                        '<td>' + data[i][7] + '</td>' +
                        '<td>' +
                            '<button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#edit-book-modal" name="' + data[i][0] + '"><i class="bi bi-pencil-square"></i>编辑</button>' + 
                            '<button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#delete-book-modal" name="' + data[i][0] + '"><i class="bi bi-trash"></i>删除</button>' +
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

// 获取图书数量
function getBookCount(){
    
    // 图书数量
    var count = 0;

    $.ajax({
        type: "get",
        url: "/library/api/book.php",
        data: {"request": "count", "type": "book"},
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

// 获取图书组
function getGroups(){
    $.ajax({
        type: "get",
        url: "/library/api/book.php",
        data: {"request": "groups"},
        dataType: "json",
        success: function (data) {
            for(var i = 0; i < data.length; i++){
                $('.groups').append(
                    '<option value="' + data[i][1] + '">' + data[i][1] + '</option>'
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