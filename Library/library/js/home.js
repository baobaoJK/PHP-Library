$(function(){
    // 初始化
    init();

});

// 初始化
function init(){
    // 仪表盘
    getCount('book');
    getCount('overtime');
    getCount('borrow');
    getTime();

    //日志信息
    getLog();
}

// 获取图书数量
function getCount(type){

    $.ajax({
        type: "get",
        url: "/library/api/book.php",
        data: {"request": "count", "type": type},
        dataType: "json",
        success: function (data) {
            // 获取数量
            var count = data.count;

            // 设置数量
            $('.' + type + ' .subtitle').text(count);
        },
        error: function (data) {
            // 报错
            // alert('服务器错误');
            // 日志
            console.log(data);
        }
    });
}

// 系统时间
function getTime(){
    setInterval(function(){
        var date = new Date();
        var year = date.getFullYear();    //获取当前年份
        var mon = date.getMonth()+1;      //获取当前月份
        var da = date.getDate();          //获取当前日
        var day = date.getDay();          //获取当前星期几
        var h = date.getHours();          //获取小时
        var m = date.getMinutes();        //获取分钟
        var s = date.getSeconds();        //获取秒
        var weeks = new Array("日", "一", "二", "三", "四", "五", "六"); //星期
        if(h<10){h = '0' + h;}
        if(m<10){m = '0' + m;}
        if(s<10){s = '0' + s;}
        $('.time .subtitle').text(year+'-'+mon+'-'+da+' '+'星期'+weeks[day]+' '+h+':'+m+':'+s);
    },1);
}

// 获取日志信息
function getLog(){
    $.ajax({
        type: "get",
        url: "/library/api/log.php",
        data: {"request": "log"},
        dataType: "json",
        success: function (data) {
            // 数据长度
            var length = data.length;

            // 输出数据
            for(var i = 0; i < length; i++){
                $(".table tbody").append(
                    "<tr>" +
                    "<td>" + data[i][1] + "</td>" +
                    "<td>" + data[i][2] + "</td>" +
                    "<td>" + data[i][3] + "</td>" +
                    "<td>" + data[i][4] + "</td>" +
                    "</tr>"
                );
            }
        },
        error: function (data) {
            // 报错
            // alert('服务器错误');
            // 日志
            console.log(data);
        }
    });
}