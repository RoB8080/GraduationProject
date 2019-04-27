<?php
include '..\..\php\Connector.php';
include '..\..\php\UsefulFunction.php';
db_OpenConn();
switch($_GET['d']) {
    case "1":d1();break;
    case "2":d2($_GET['a']);break;
    default:d1();
}
db_CloseConn();

function d1() {
    $sql="SELECT CHPILOTADSCRIPTCODE,count(CHPILOTADSCRIPTCODE) FROM t_base_pilotinfo GROUP BY CHPILOTADSCRIPTCODE;";
    $result=db_Query($sql);
    echo "{\"results\":[";
    $row = mysqli_fetch_assoc($result);
    echo "{\"label\":\"".$row["CHPILOTADSCRIPTCODE"]."\",\"data\":\"".$row["count(CHPILOTADSCRIPTCODE)"]."\"}";
    while($row = mysqli_fetch_assoc($result)) {
        echo ",{\"label\":\"".$row["CHPILOTADSCRIPTCODE"]."\",\"data\":\"".$row["count(CHPILOTADSCRIPTCODE)"]."\"}";
    }
    echo "]}";
};

function d2($a) {
    $sql="SELECT CHPILOTGRADE,COUNT(CHPILOTGRADE) FROM t_base_pilotinfo WHERE CHPILOTADSCRIPTCODE='".$a."' GROUP BY CHPILOTGRADE ORDER BY CHPILOTGRADE;";
    $result=db_Query($sql);
    echo "{\"results\":[";
    $row = mysqli_fetch_assoc($result);
    echo "{\"label\":\"".$row["CHPILOTGRADE"]."\",\"data\":\"".$row["COUNT(CHPILOTGRADE)"]."\"}";
    while($row = mysqli_fetch_assoc($result)) {
        echo ",{\"label\":\"".$row["CHPILOTGRADE"]."\",\"data\":\"".$row["COUNT(CHPILOTGRADE)"]."\"}";
    }
    echo "]}";
};