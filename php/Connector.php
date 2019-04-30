<?php
$dbhost = 'localhost:3306';
$dbuser = 'pilotplan';
$dbpass = 'pilotplan';
$dbname = 'pilotplan';

$conn;

//连接数据库
function db_OpenConn() {
    global $dbhost, $dbuser, $dbpass, $dbname, $conn;
    $conn = mysqli_connect('p:'.$dbhost, $dbuser, $dbpass, $dbname);
    if($conn->connect_error)
    {
        die('连接失败: ' . $conn->connect_error);
    }
}
//关闭数据库连接
function db_CloseConn() {
    global $conn;
    mysqli_close($conn);
}
//执行一次查询
function db_Query($query) {
    global $conn;
    return mysqli_query($conn,$query);
}
//获取影响行数
function db_AffectRows() {
    global $conn;
    return mysqli_affected_rows($conn);
}
//获取错误数据
function db_Error() {
    global $conn;
    return mysqli_error($conn);
}
