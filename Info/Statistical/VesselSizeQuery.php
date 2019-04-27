<?php
include '..\..\php\Connector.php';
include '..\..\php\UsefulFunction.php';
db_OpenConn();
$sql="SELECT * FROM t_data_monthly;";
$result=db_Query($sql);
echo "{\"dataset\":[";
$row = mysqli_fetch_assoc($result);
$max = $row["VESCOUNT"];
echo "{\"mon\":\"".$row["MON"]."\",\"count\":[".$row["T1VESCOUNT"].",".$row["T2VESCOUNT"].",".$row["T3VESCOUNT"].",".$row["T4VESCOUNT"].",".$row["T5VESCOUNT"]."]}";
while($row = mysqli_fetch_assoc($result)) {
    echo ",{\"mon\":\"".$row["MON"]."\",\"count\":[".$row["T1VESCOUNT"].",".$row["T2VESCOUNT"].",".$row["T3VESCOUNT"].",".$row["T4VESCOUNT"].",".$row["T5VESCOUNT"]."]}";
    $t = $row["VESCOUNT"];
    $max = $t>$max?$t:$max;
}
echo "],\"extent\":".$max."}";
db_CloseConn();