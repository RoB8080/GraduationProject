<?php
include '..\..\php\Connector.php';
include '..\..\php\UsefulFunction.php';
db_OpenConn();
switch($_GET['d']) {
    case "1":d1();break;
    case "2":d2($_GET['g']);break;
    default:d1();
}
db_CloseConn();

function d1() {
    $sql="SELECT CHPILOTGRADE,count(CHPILOTGRADE) FROM t_base_pilotinfo GROUP BY CHPILOTGRADE ORDER BY CHPILOTGRADE;";
    $result=db_Query($sql);
    echo "{\"results\":[";
    $row = mysqli_fetch_assoc($result);
    echo "{\"label\":\"".$row["CHPILOTGRADE"]."\",\"data\":\"".$row["count(CHPILOTGRADE)"]."\"}";
    while($row = mysqli_fetch_assoc($result)) {
        echo ",{\"label\":\"".$row["CHPILOTGRADE"]."\",\"data\":\"".$row["count(CHPILOTGRADE)"]."\"}";
    }
    echo "]}";
};

function d2($g) {
    $sql="SELECT CHPILOTGRADE,CHPILOTCLASS,COUNT(*) FROM pilotplan.t_base_pilotinfo WHERE CHPILOTGRADE='".$g."' GROUP BY CHPILOTGRADE,CHPILOTCLASS ORDER BY CHPILOTCLASS;";
    $result=db_Query($sql);
    echo "{\"results\":[";
    $row = mysqli_fetch_assoc($result);
    echo "{\"label\":\"".$row["CHPILOTGRADE"].$row["CHPILOTCLASS"]."\",\"data\":\"".$row["COUNT(*)"]."\"}";
    while($row = mysqli_fetch_assoc($result)) {
        echo ",{\"label\":\"".$row["CHPILOTGRADE"].$row["CHPILOTCLASS"]."\",\"data\":\"".$row["COUNT(*)"]."\"}";
    }
    echo "]}";
};