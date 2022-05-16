$(function(){
    // 搜索图书按钮
    $(document).on('click', '.search-button', function (e) { 
        e.preventDefault();

        // 获取表单
        var searchForm = new FormData($('#search-form')[0]);

        // 获取信息
        var searchText = searchForm.get('search-text');

        // 判断信息
        if(searchText == ''){
            alert("请输入要搜索的图书ISBN号码");
        }
        else{
            searchForm.append("request", "isbn");
            searchBook(searchForm);
        }
    });

    // 借阅图书按钮
    $(document).on('click', '.borrow-button', function (e) { 
        e.preventDefault();
        
        // 获取表单
        var borrowForm = new FormData($('#borrow-form')[0]);

        // 获取信息
        var isbn = $('#search-text').val();
        var name = $('.book-name').text();
        var username = borrowForm.get('username');
        var idCard = borrowForm.get('id-card');
        var phone = borrowForm.get('phone');
        
        // 判断信息
        if(isbn == '' || name == ''){
            alert("请输入借阅的图书 ISBN 号码");
        }
        else if(username == ''){
            alert("请输入借阅人名字");
        }
        else if(idCard == ''){
            alert("请输入借阅人卡号");
        }
        else if(phone == ''){
            alert("请输入借阅人手机号");
        }
        else{
            borrowForm.append("request", "borrow");
            borrowForm.append("name", name);
            borrowForm.append("isbn", isbn);
            borrowBook(borrowForm);
        }
    });
});

// 搜索图书
function searchBook(searchForm){
    $.ajax({
        type: "post",
        url: "/library/api/book.php",
        data: searchForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            // 设置信息
            $('.book-name').text(data[0][2]);
            $('.book-author').text(data[0][3]);
            $('.book-press').text(data[0][4]);
            $('.book-isbn').text(data[0][7]);
            $('.book-quantity').text(data[0][6]);
        },
        error: function (data) {
            // 报错
            // alert("服务器错误");
            // 日志
            console.log(data);
        }
    });
}

// 借阅图书
function borrowBook(borrowForm){
    $.ajax({
        type: "post",
        url: "/library/api/book.php",
        data: borrowForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            console.log(data);

            if(data.resultCode == 0){
                alert("借阅图书失败，借阅人身份不存在或该图书库存不足");
            }
            else if(data.resultCode == 1){
                alert("借阅成功");
                window.location.reload('./');
            }
            else if(data.resultCode == -1){
                alert("借阅错误");
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