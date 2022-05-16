<?php
header("Content-type:text/html;charset=utf-8");

// 返回信息
$resultArray = array();

// 请求类型
$request = $_REQUEST['request'];

// 添加用户
if($request == 'add'){
    addUser();
}

// 删除用户
if($request == 'delete'){
    deleteUser();
}

// 编辑用户
if($request == 'edit'){
    editUser();
}

// 搜索用户
if($request == 'search'){
    serachUser();
}

// 获取用户数量
if($request == 'count'){
    getCount();
}

// 获取用户数据
if($request == 'get'){
    getUser();
}

// 添加用户
function addUser(){

    // 获取信息
    $name = $_POST['add-name'];
    $gender = $_POST['add-gender'];
    $idCard = $_POST['add-id-card'];
    $phone = $_POST['add-phone'];
    $identity = $_POST['add-identity'];
    
    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    // 检索数据库是否有相同的 借书卡 或 手机号
    $sql = "SELECT id_card, phone FROM user WHERE id_card = '" . $idCard . "' OR phone = '" . $phone . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $row = mysqli_fetch_array($result);

        // 判断 借书卡 或 手机号 是否与数据库相同
        if($idCard != $row['id_card'] && $phone != $row['phone']){
            
            $bookCount = 0;
            
            if($identity == 'student'){
                $bookCount = 3;
                $identity = "学生";
            }
            if($identity == 'teacher'){
                $bookCount = 5;
                $identity = "老师";
            }

            // 插入数据
            $sql = "INSERT INTO user(groups, name, username, password, gender, id_card, phone, identity, book_count)
                    VALUES ('user', '" . $name . "', '" . $name . "', '123456', '" . $gender . "', '" . $idCard . "', '" . $phone . "', '" . $identity. "', '" . $bookCount . "')";
        
            $result = mysqli_query($connect, $sql);
            
            if($result){
                $resultArray = array('resultCode' => 1);
            }
            else{
                $resultArray = array('resultCode' => 0);
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

// 删除用户
function deleteUser(){
    $id = $_POST['id'];

    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "DELETE FROM user WHERE Id = '" . $id . "'";
 
    $result = mysqli_query($connect, $sql);

    if($result){
        $resultArray = array('resultCode' => 1);
    }
    else{
        $resultArray = array('resultCode' => 0);
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}

// 编辑用户
function editUser(){
    // 获取信息
    $id = $_POST['id'];
    $name = $_POST['edit-name'];
    $gender = $_POST['edit-gender'];
    $idCard = $_POST['edit-id-card'];
    $phone = $_POST['edit-phone'];
    $identity = $_POST['edit-identity'];

    global $resultArray;

    // 修改名字字段
    if(!empty($name)){
        editUserField('name', $id, $name);
    }

    // 修改性别字段
    if(!empty($gender)){
        editUserField('gender', $id, $gender);
    }

    // 修改借书卡字段
    if(!empty($idCard)){
        eidtUserSingle('id_card', $id, $idCard);

        if($resultArray['resultCode'] != 1){
            echo json_encode($resultArray);
            return;
        }
    }

    // 修改手机号字段
    if(!empty($phone)){
        eidtUserSingle('phone', $id, $phone);

        if($resultArray['resultCode'] != 1){
            echo json_encode($resultArray);
            return;
        }
    }

    // 修改身份字段
    if(!empty($identity)){
        if($identity == "student"){
            $identity = "学生";
        }
        if($identity == "teacher"){
            $identity = "老师";
        }

        editUserField('identity', $id, $identity);
    }

    echo json_encode($resultArray);
}

// 编辑用户字段
function editUserField($type, $id, $text){

    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "UPDATE user SET " . $type . " = '" . $text . "' WHERE Id = '" . $id . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $resultArray = array('resultCode' => 1);
    }
    else{
        $resultArray = array('resultCode' => 0);
    }

    mysqli_close($connect);

    return $resultArray;
}

// 编辑用户借书卡 或 手机号 字段
function eidtUserSingle($type, $id, $text){
    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    // 搜索借书卡是否存在
    $sql = "SELECT " . $type . " FROM user WHERE " . $type . " = '" . $text . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $row = mysqli_fetch_array($result);
        
        if($text != $row[$type]){
            $sql = "UPDATE user SET " . $type . " = '" . $text . "' WHERE Id = '" . $id . "'";

            $result = mysqli_query($connect, $sql);

            if($result){
                $resultArray = array('resultCode' => 1);
            }
            else{
                $resultArray = array('resultCode' => 0);
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

    return $resultArray;
}

// 搜索用户
function serachUser(){
    $type = $_POST['search-type'];
    $text = $_POST['search-text'];
    $start = $_POST['search-start'];

    global $resultArray;

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM user WHERE " . getSearchType($type) . " LIKE '%" . $text . "%' ORDER BY Id ASC";

    $result = mysqli_query($connect, $sql);

    if($result){
        $data = mysqli_fetch_all($result);
        $resultArray = $data;
    }
    else{
        $resultArray = array('resultCode' => 0);
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}

// 获取用户数量
function getCount(){
    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT count(*) as count FROM user";

    $result = mysqli_query($connect, $sql);

    if($result){
        $row = mysqli_fetch_array($result);

        $resultArray = array('count' => $row['count']);
    }
    else{
        $resultArray = array('resultCode' => 0);
    }

    // $resultArray = array('count' => 10);

    mysqli_close($connect);

    echo json_encode($resultArray);
}

// 获取用户数据
function getUser(){

    $start = $_GET['start'];
    $page = $_GET['page'];

    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM user ORDER BY Id ASC LIMIT " . $start . ", " . $page;

    $result = mysqli_query($connect, $sql);

    if($result){
        $resultArray = mysqli_fetch_all($result);
    }
    else{
        $resultArray = array('resultCode' => 0);
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}

// 获取搜索类型
function getSearchType($type){
    if($type == "name"){
        return 'name';
    }
    else if($type == "id-card"){
        return 'id_card';
    }
    else if($type == "phone"){
        return 'phone';
    }
}
?>