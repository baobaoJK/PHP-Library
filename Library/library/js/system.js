$(function(){
    
    // 添加图书种类按钮
    $('.add-type-button').click(function (e) { 
        e.preventDefault();
        
        // 获取表单
        var addForm = new FormData($('#add-type-form')[0]);

        // 获取信息
        var name = addForm.get('add-type-name');

        if(name == ''){
            alert("请输入图书种类名");
        }
        else{
            addForm.append('request', 'addType');
            addTypeName(addForm);
        }
    });

    // 删除图书种类按钮
    $('.delete-type-button').click(function (e) { 
        e.preventDefault();
        
        // 获取表单
        var deleteForm = new FormData($('#delete-type-form')[0]);

        // 获取信息
        var name = deleteForm.get('delete-type-name');

        if(name == ''){
            alert("请输入图书种类名");
        }
        else{
            deleteForm.append('request', 'deleteType');
            deleteTypeName(deleteForm);
        }
    });

    // 修改管理员密码按钮
    $('.edit-admin-password-button').click(function (e) { 
        e.preventDefault();
        
        // 获取表单
        var editForm = new FormData($('#edit-admin-form')[0]);

        // 获取信息
        var name = editForm.get('edit-admin-password');

        if(name == ''){
            alert("请输入新密码");
        }
        else{
            editForm.append('request', 'editPassword');
            editAdminPassword(editForm);
        }
    });
});

// 添加图书种类
function addTypeName(addForm){
    $.ajax({
        type: "post",
        url: "/library/api/system.php",
        data: addForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.resultCode == 0){
                alert("图书种类已存在");
            }
            else if(data.resultCode == 1){
                alert("添加成功");
                window.location.reload('./');
            }
            else{
                alert("出现错误")
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

// 删除图书种类
function deleteTypeName(deleteForm){
    $.ajax({
        type: "post",
        url: "/library/api/system.php",
        data: deleteForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.resultCode == 0){
                alert("图书种类不存在");
            }
            else if(data.resultCode == 1){
                alert("删除成功");
                window.location.reload('./');
            }
            else{
                alert("出现错误")
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

// 修改管理员密码
function editAdminPassword(editForm){
    $.ajax({
        type: "post",
        url: "/library/api/system.php",
        data: editForm,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if(data.resultCode == 0){
                alert("修改失败");
            }
            else if(data.resultCode == 1){
                alert("修改成功");
                window.location.reload('./');
            }
            else{
                alert("出现错误")
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