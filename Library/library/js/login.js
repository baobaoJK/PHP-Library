$(function(){
    
    // 登录按钮
    $('#login-button').click(function (e) { 
        e.preventDefault();
        
        // 获取表单
        var loginForm = new FormData($('.login-form')[0]);
        
        var username = loginForm.get('username');
        var password = loginForm.get('password');

        // 判断表单内容
        if(username == ''){
            alert("请输入用户名");
        }
        else if(password == ''){
            alert("请输入密码");
        }
        else{
            loginForm.append('request', 'login');
            login(loginForm);
        }
    });
});

// 登录
function login(loginForm){
    $.ajax({
        type: "post",
        url: "/library/api/login.php",
        data: loginForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            console.log(data);
            if(data.resultCode == 0){
                alert("用户名或密码错误");
            }
            else if(data.resultCode == 1){
                alert("登录成功");
                window.location.replace('./library.php');
            }
            else{
                alert('出现错误');
            }
        },
        error: function (data) {
            // 报错
            // alert("服务器出错");
            // 日志
            console.log(data);
        }
    });
}