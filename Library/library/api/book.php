<?php
header("Content-type:text/html;charset=utf-8");

// 返回信息
$resultArray = array();

// 请求类型
$request = $_REQUEST['request'];

// 添加图书
if($request == 'add'){
    addBook();
}

// 删除图书
if($request == 'delete'){
    deleteBook();
}

// 编辑图书
if($request == 'edit'){
    editBook();
}

// 搜索图书
if($request == 'search'){
    serachBook();
}

// 获取图书数量
if($request == 'count'){
    getCount();
}

// 获取图书数据
if($request == 'get'){
    getBook();
}

// 获取图书组别
if($request == 'groups'){
    getGroups();
}

// 借阅图书
if($request == 'borrow'){
    borrowBook();
}

// 归还图书
if($request == 'return'){
    returnBook();
}

// 搜索图书
if($request == 'isbn'){
    searchIsbn();
}

// 搜索借阅图书
if($request == 'searchBorrowBook'){
    searchBorrowBook();
}

// 搜索借阅图书
if($request == 'searchBorrowBookIsbn'){
    searchBorrowBookIsbn();
}

// 搜索超时图书
if($request == 'searchOvertimeBook'){
    searchOvertimeBook();
}

// 搜索借阅图书
if($request == 'searchOvertimeBookIsbn'){
    searchOvertimeBookIsbn();
}
// 添加图书
function addBook(){

    // 获取信息
    $group = $_POST['add-group'];
    $name = $_POST['add-name'];
    $author = $_POST['add-author'];
    $press = $_POST['add-press'];
    $price = $_POST['add-price'];
    $count = $_POST['add-count'];
    $isbn = $_POST['add-isbn'];
    
    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    // 检索数据库是否有相同的 ISBN 号码
    $sql = "SELECT isbn FROM book WHERE isbn = '" . $isbn . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $row = mysqli_fetch_array($result);

        // 判断 ISBN 号码是否与数据库相同
        if($isbn != $row['isbn']){
            
            // 插入数据
            $sql = "INSERT INTO book(groups, name, author, press, price, quantity, isbn)
                    VALUES ('" . $group . "', '" . $name . "', '" . $author . "', '" . $press . "', '" . $price . "', '" . $count . "', '" . $isbn . "')";
        
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

// 删除图书
function deleteBook(){
    $id = $_POST['id'];

    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "DELETE FROM book WHERE Id = '" . $id . "'";
 
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

// 编辑图书
function editBook(){
    // 获取信息
    $id = $_POST['id'];
    $group = $_POST['edit-group'];
    $name = $_POST['edit-name'];
    $author = $_POST['edit-author'];
    $press = $_POST['edit-press'];
    $price = $_POST['edit-price'];
    $count = $_POST['edit-count'];
    $isbn = $_POST['edit-isbn'];

    global $resultArray;

    // 修改组别字段
    if(!empty($group)){
        editBookField('groups', $id, $group);
    }

    // 修改名字字段
    if(!empty($name)){
        editBookField('name', $id, $name);
    }

    // 修改借书卡字段
    if(!empty($author)){
        editBookField('author', $id, $author);
    }

    // 修改出版社字段
    if(!empty($press)){
        editBookField('press', $id, $press);
    }

    // 修改价格字段
    if(!empty($price)){
        editBookField('price', $id, $price);
    }

    // 修改图书数量字段
    if(!empty($count)){
        editBookField('quantity', $id, $count);
    }
    
    // 修改手机号字段
    if(!empty($isbn)){
        eidtBookISBN('isbn', $id, $isbn);

        if($resultArray['resultCode'] != 1){
            echo json_encode($resultArray);
            return;
        }
    }

    echo json_encode($resultArray);
}

// 编辑图书字段
function editBookField($type, $id, $text){

    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "UPDATE book SET " . $type . " = '" . $text . "' WHERE Id = '" . $id . "'";

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

// 编辑图书 ISBN 号码字段
function eidtBookISBN($type, $id, $text){
    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    // 搜索借书卡是否存在
    $sql = "SELECT " . $type . " FROM book WHERE " . $type . " = '" . $text . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $row = mysqli_fetch_array($result);
        
        if($text != $row[$type]){
            $sql = "UPDATE book SET " . $type . " = '" . $text . "' WHERE Id = '" . $id . "'";

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

// 搜索图书
function serachBook(){
    $type = $_POST['search-type'];
    $text = $_POST['search-text'];
    $start = $_POST['search-start'];

    global $resultArray;

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM book WHERE " . getSearchType($type) . " LIKE '%" . $text . "%' ORDER BY Id ASC";

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

// 获取图书数据
function getBook(){

    $start = $_GET['start'];
    $page = $_GET['page'];

    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM book ORDER BY Id ASC LIMIT " . $start . ", " . $page;

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

// 获取图书数量
function getCount(){
    $type = $_GET['type'];

    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    if($type == 'overtime'){

        $date = date("Y-m-d H-i-s");

        $sql = "SELECT count(*) as count FROM borrow WHERE '" . $date . "' > r_time";

        $result = mysqli_query($connect, $sql);
    }
    else{
        $sql = "SELECT count(*) as count FROM " . $type;

        $result = mysqli_query($connect, $sql);
    }

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

// 获取图书组别
function getGroups(){
    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM book_type";

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

// 获取搜索类型
function getSearchType($type){
    if($type == "group"){
        return 'groups';
    }
    else if($type == "name"){
        return 'name';
    }
    else if($type == "author"){
        return 'author';
    }
    else if($type == "press"){
        return 'press';
    }
    else if($type == "isbn"){
        return 'isbn';
    }
}

// 借阅图书
function borrowBook(){
    $isbn = $_POST['isbn'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $idCard = $_POST['id-card'];
    $phone = $_POST['phone'];

    global $resultArray;

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT quantity FROM book WHERE isbn = '" . $isbn . "'";

    $result = mysqli_query($connect, $sql);

    if($result){
        $row = mysqli_fetch_array($result);

        $count = $row['quantity'];

        // 判断库存是否大于 0
        if($count > 0){
        $sql = "SELECT * FROM user WHERE username = '" . $username . "' AND id_card = " . $idCard . " AND phone = '" . $phone . "'";

            $result = mysqli_query($connect, $sql);

            if($result){
                $row = mysqli_fetch_array($result);

                // 判断用户信息
                if($username == $row['username'] && $idCard == $row['id_card'] && $phone == $row['phone']){
                    $nowDate = date("Y-m-d H:i:s");
                    $futureDate = date("Y-m-d H:i:s",strtotime("+1 month"));

                    // 借阅图书
                    $sql = "INSERT INTO borrow(name, isbn, username, id_card, phone, time, r_time)
                            VALUES ('" . $name . "', '" . $isbn . "', '" . $username . "', '" . $idCard . "', '" . $phone . "', '" . $nowDate . "', '" . $futureDate . "')";
                    
                    $result = mysqli_query($connect, $sql);

                    if($result){
                        // 借阅图书信息
                        $info = "借走了 " . $name . " 书籍";
                        $sql = "INSERT INTO operation_record(time, name, book_name, info)
                                VALUES ('" . $nowDate . "', '" . $username . "', '" . $name . "', '" . $info . "')";
                        
                        $result = mysqli_query($connect, $sql);

                        if($result){
                            // 减少图书数量
                            $sql = "UPDATE book SET quantity = quantity - 1 WHERE isbn = '" . $isbn . "'";

                            $result = mysqli_query($connect, $sql);

                            if($result){
                                $resultArray = array('resultCode' => 1);
                            }
                            else{
                                $resultArray = array('resultCode' => -1);
                                echo json_encode($resultArray);
                                return;
                            }
                        }
                        else{
                            $resultArray = array('resultCode' => -1);
                            echo json_encode($resultArray);
                            return;
                        }
                    }
                    else{
                        $resultArray = array('resultCode' => -1);
                        echo json_encode($resultArray);
                        return;
                    }
                }
                else{
                    $resultArray = array('resultCode' => 0);
                    echo json_encode($resultArray);
                    return;
                }
            }
            else{
                $resultArray = array('resultCode' => 0);
                echo json_encode($resultArray);
                return;
            }
        }
        else{
            $resultArray = array('resultCode' => 0);
            echo json_encode($resultArray);
            return;
        }
    }
    else{
        $resultArray = array('resultCode' => -1);
        echo json_encode($resultArray);
        return;
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}

// 归还图书
function returnBook(){
    $id = $_POST['id'];

    global $resultArray;
    
    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM borrow WHERE Id = '" . $id . "'";

    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_array($result);
   
    // 获取信息
    $isbn = $row['isbn'];
    $username = $row['username'];
    $name = $row['name'];

    $sql = "DELETE FROM borrow WHERE Id = '" . $id . "'";
 
    $result = mysqli_query($connect, $sql);

    if($result){
        // 归还图书
        $nowDate = date("Y-m-d H:i:s");
        $info = "归还了 " . $name . " 书籍";
        $sql = "INSERT INTO operation_record(time, name, book_name, info)
                VALUES ('" . $nowDate . "', '" . $username . "', '" . $name . "', '" . $info . "')";
        
        $result = mysqli_query($connect, $sql);

        if($result){
            // 增加图书数量
            $sql = "UPDATE book SET quantity = quantity + 1 WHERE isbn = '" . $isbn . "'";

            $result = mysqli_query($connect, $sql);

            if($result){
                $resultArray = array('resultCode' => 1);
            }
            else{
                $resultArray = array('resultCode' => -1);
            }
        }
        else{
            $resultArray = array('resultCode' => -1);
        }
    }
    else{
        $resultArray = array('resultCode' => 0);
    }

    mysqli_close($connect);

    echo json_encode($resultArray);
}

// 搜索借阅图书
function searchIsbn(){
    $text = $_POST['search-text'];

    global $resultArray;

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM book WHERE isbn = '" . $text . "'";

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

// 搜索借阅图书
function searchBorrowBook(){

    $start = $_GET['start'];
    $page = $_GET['page'];

    global $resultArray;

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);
    
    $sql = "SELECT * FROM borrow ORDER BY Id ASC LIMIT " . $start . ", " . $page;

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

// 搜索借阅图书
function searchBorrowBookIsbn(){

    // isbn
    $isbn = $_POST['search-text'];

    global $resultArray;

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $sql = "SELECT * FROM borrow WHERE isbn = '" . $isbn . "'";

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

// 搜索超时图书
function searchOvertimeBook(){

    $start = $_GET['start'];
    $page = $_GET['page'];

    global $resultArray;

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);
    
    $date = date("Y-m-d H-i-s");
        
    $sql = "SELECT * FROM borrow WHERE '" . $date . "' > r_time ORDER BY Id ASC LIMIT " . $start . ", " . $page;

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

// 搜索超时图书
function searchOvertimeBookIsbn(){

    // isbn
    $isbn = $_POST['search-text'];

    global $resultArray;

    include 'dbconfig.php';

    $connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $library_database);

    $date = date("Y-m-d H-i-s");

    $sql = "SELECT * FROM borrow WHERE isbn = '" . $isbn . "' AND '" . $date . "' > r_time";

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

?>