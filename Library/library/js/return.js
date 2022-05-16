$(function(){

    // 初始化
    init();

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
            searchForm.append("request", "searchBorrowBookIsbn");
            searchBook(searchForm);
        }
    });
    
    // 归还图书按钮
    $(document).on('click', '.btn-return', function(e) { 
        e.preventDefault();
        
        // 获取名字
        var name = $(this).parent().parent().find('.name').text();
        var id = $(this).attr('name');

        // 设置名字
        $('#return-name').text(name);
        $('.return-book-button').attr('id', id);
    });

    $(document).on('click', '.return-book-button', function (e) { 
        e.preventDefault();
        
        // 表单
        var returnForm = new FormData($('#return-form')['0']);

        // 获取id
        var id = $(this).attr('id');

        returnForm.append("id", id);
        returnForm.append("request", "return");

        // 归还图书
        returnBook(returnForm);
    });
});

function init(){

    // 从第几条开始
    var start = 0;

    // n条数据 / 页
    var page = 10;

    getBook(start, page);

    // 分页按钮
    $('.pag-box').pagination({
        mode: 'fixed',
        totalData: getCount('borrow'),
        showData: 10,
        callback: function(api){
            var start = api.getCurrent();
            getBook((start - 1) * 10, page);
        }
    });
}

// 获取图书数据
function getBook(start, page){

    // 删除原先数据
    $('#return-table table tbody tr').remove();

    $.ajax({
        type: "get",
        url: "/library/api/book.php",
        data: {"request": "searchBorrowBook", "start": start, "page": page},
        dataType: "json",
        success: function (data) {            
            // console.log(data);
            var length = data.length;
            for(var i = 0; i < length; i++){
                $('#return-table table tbody').append(
                    '<tr>' +
                        '<th>' + data[i][0] + '</th>' +
                        '<td class="name">' + data[i][1] + '</td>' +
                        '<td>' + data[i][2] + '</td>' +
                        '<td>' + data[i][3] + '</td>' +
                        '<td>' + data[i][4] + '</td>' +
                        '<td>' + data[i][5] + '</td>' +
                        '<td>' +
                            '<button class="btn btn-success btn-return" data-toggle="modal" data-target="#return-book-modal" name="' + data[i][0] + '"><i class="bi bi-box-arrow-in-left"></i>归还</button>' + 
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
function getCount(type){

    var count = 0;

    $.ajax({
        type: "get",
        url: "/library/api/book.php",
        data: {"request": "count", "type": type},
        async: false,
        dataType: "json",
        success: function (data) {
            // 获取数量
            count = data.count;
        },
        error: function (data) {
            // 报错
            // alert('服务器错误');
            // 日志
            console.log(data);
        }
    });

    return count;
}

// 搜索图书
function searchBook(searchForm){
    // 删除原先数据
    $('#return-table table tbody tr').remove();

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
                $('#return-table table tbody').append(
                    '<tr>' +
                        '<th>' + data[i][0] + '</th>' +
                        '<td class="name">' + data[i][1] + '</td>' +
                        '<td>' + data[i][2] + '</td>' +
                        '<td>' + data[i][3] + '</td>' +
                        '<td>' + data[i][4] + '</td>' +
                        '<td>' + data[i][5] + '</td>' +
                        '<td>' +
                            '<button class="btn btn-success btn-return" data-toggle="modal" data-target="#return-book-modal" name="' + data[i][0] + '"><i class="bi bi-box-arrow-in-left"></i>归还</button>' + 
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

// 归还图书
function returnBook(returnForm){
    $.ajax({
        type: "post",
        url: "/library/api/book.php",
        data: returnForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            console.log(data);

            if(data.resultCode == 0){
                alert("归还图书失败，此书不存在");
            }
            else if(data.resultCode == 1){
                alert("归还成功");
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