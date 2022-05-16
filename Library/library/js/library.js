$(function(){

    // 导航栏
    $('.bar-link').click(function (e) { 
        
        var open = $(this).attr('aria-expanded');

        if(open == "false"){
            $(this).addClass('open');
            open = true;
        }
        else{
            $(this).removeClass('open');
            open = false;
        }
    });

    // tabs
    $(document).on('click','a[data-url]',function (e) { 
        e.preventDefault();

        // 获取属性
        var id = $(this).attr('data-id');
        var url =  $(this).attr('data-url');
        var name = $(this).text();
        var li = $('#tabs').children('li')
        var count = li.length;

        var urlCount = 0;

        for(var i = 0; i < count; i++){
            // alert(li.eq(i).children("a").attr("data-url"));
            var data_url = li.eq(i).children('a').attr('data-url');
            if(data_url == $(this).attr('data-url')){
                urlCount++;
            }
        }

        if(urlCount == 0){
            $('#tabs').append(
                '<li class="nav-item">' +
                '<a class="nav-link" data-id="#library-frame" data-url="' + url + '" data-toggle="link">' + name + '</a><i class="bi bi-x tab-close"></i>' +
                '</li>'
            )
        }

        $(id).attr('src', url);
        $('#tabs .nav-item a').removeClass('active');
        $('#tabs .nav-item a[data-url="' + url + '"]').addClass('active');
    });

    // 关闭tabs
    $(document).on('click','.tab-close',function (e) { 
        e.preventDefault();

        var tempUrl = $(this).parent().children('a').attr('data-url');
        var iframeUrl = $('#library-frame').attr('src');

        if(tempUrl == iframeUrl){
   
            var li = $('#tabs').children('li');

            var count = 0;

            for(var i = 0; i < li.length; i++){
                var url = li.children('a').eq(i).attr('data-url');
                if(tempUrl == url){
                    count = i + 1 == li.length ? i - 1 : i + 1;
                    break;
                }
            }

            var id = li.eq(count).children('a').attr('data-id');
            var url = li.eq(count).children('a').attr('data-url');

            $(id).attr('src', url);
            $('#tabs .nav-item a').removeClass('active');
            $('#tabs .nav-item a[data-url="' + url + '"]').addClass('active');
        }

        $(this).parent().remove();

    });

    // 退出系统按钮
    $('.exit').click(function (e) { 
        e.preventDefault();
        
        $.ajax({
            type: "get",
            url: "/library/api/exit.php",
            data: {"request": "exit"},
            dataType: "json",
            success: function (data) {
                if(data.resultCode == 0){
                    alert("登出失败，系统错误");
                }
                else if(data.resultCode == 1){
                    alert("登出成功");
                    window.location.replace('./login.php');
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
    });
});