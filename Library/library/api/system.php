<?php
header("Content-type:text/html;charset=utf-8");

session_start();

// 返回信息
$resultArray = array();

// 请求类型
$request = $_REQUEST['request'];

// 获取请求类型
if($request == 'addType'){
    addType();
}
else if($request == 'deleteType'){
    deleteType();
}
else if($request == 'editPassword'){
    editAdminPassword();
}

// 添加图书种类
function addType(){
    global $resultArray;
    
    // 表单信息
    $name = $_POST['add-type-name'];

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    // 判断图书种类是否存在
    $sql = "SELECT * FROM book_type WHERE type_name = '" . $name . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $row = mysqli_fetch_array($result);
        $tempType = $row['type_name'];

        if($name != $tempType){

            // 插入图书种类99
            $sql = "INSERT INTO book_type(type_name) VALUES ('" . $name . "')";

            $result = mysqli_query($connect, $sql);

            if($result){
                $resultArray = array('resultCode' => 1);
            }
            else{
                $resultArray = array('resultCode' => -1);
            }
        }
        else{
            $resultArray = array('resultCode' => 0);
        }
    }
    else{
        $resultArray = array('resultCode' => -1);
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}

// 删除图书种类
function deleteType(){
    global $resultArray;
    
    // 表单信息
    $name = $_POST['delete-type-name'];

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    // 判断图书种类是否存在
    $sql = "SELECT * FROM book_type WHERE type_name = '" . $name . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $row = mysqli_fetch_array($result);

        $tempType = $row['type_name'];

        if($name == $tempType){

            // 插入图书种类99
            $sql = "DELETE FROM book_type WHERE type_name = '" . $name . "'";

            $result = mysqli_query($connect, $sql);

            if($result){
                $resultArray = array('resultCode' => 1);
            }
            else{
                $resultArray = array('resultCode' => -1);
            }
        }
        else{
            $resultArray = array('resultCode' => 0);
        }
    }
    else{
        $resultArray = array('resultCode' => -1);
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}

// 修改管理员密码
function editAdminPassword(){
    global $resultArray;
    
    // 表单信息
    $password = $_POST['edit-admin-password'];

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $admin = 'Admin';

    // 修改管理员密码
    $sql = "UPDATE user SET password = '" . $password . "' WHERE username = '" . $admin . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $resultArray = array('resultCode' => 1);
    }
    else{
        $resultArray = array('resultCode' => -1);
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}
?>