<?php
include '..\..\php\Connector.php';
include '..\..\php\UsefulFunction.php';
db_OpenConn();
$sql="SELECT MON,VESCOUNT FROM t_data_monthly;";
$result=db_Query($sql);
echo "{\"results\":[";
$row = mysqli_fetch_assoc($result);
echo "{\"label\":\"".$row["MON"]."\",\"data\":\"".$row["VESCOUNT"]."\"}";
while($row = mysqli_fetch_assoc($result)) {
    echo ",{\"label\":\"".$row["MON"]."\",\"data\":\"".$row["VESCOUNT"]."\"}";
}
echo "]}";
db_CloseConn();