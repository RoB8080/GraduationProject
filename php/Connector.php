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
    if(! $conn )
    {
        die('Could not connect: ' . mysqli_error());
    }
    echo '数据库连接成功！';
}
//关闭数据库连接
function db_CloseConn() {
    global $conn;
    mysqli_close($conn);
    echo "close";
}
//执行一次查询
function db_Query($query) {
    global $conn;
    return mysqli_query($conn,$query);
}
