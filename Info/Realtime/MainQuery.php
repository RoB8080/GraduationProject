<?php
include '..\..\php\Connector.php';
include '..\..\php\UsefulFunction.php';
db_OpenConn();
echo "{\"results\":{";
availablePilotGrade();
echo ",";
PilotState();
echo "}}";
db_CloseConn();

function availablePilotGrade() {
    $sql="SELECT CHPILOTGRADE,CHPILOTCLASS,COUNT(*) FROM pilotplan.t_base_pilotinfo GROUP BY CHPILOTGRADE,CHPILOTCLASS ORDER BY CHPILOTGRADE,CHPILOTCLASS;";
    $result=db_Query($sql);
    echo "\"apg\":[";
    $row = mysqli_fetch_assoc($result);
    echo "{\"label\":\"".$row["CHPILOTGRADE"].$row["CHPILOTCLASS"]."\",\"data\":\"".$row["COUNT(*)"]."\"}";
    while($row = mysqli_fetch_assoc($result)) {
        echo ",{\"label\":\"".$row["CHPILOTGRADE"].$row["CHPILOTCLASS"]."\",\"data\":\"".$row["COUNT(*)"]."\"}";
    }
    echo "]";
}

function PilotState() {
    $sql="SELECT CHPILOTSTATE,COUNT(*) FROM pilotplan.t_base_pilotinfo GROUP BY CHPILOTSTATE ORDER BY CHPILOTSTATE;";
    $result=db_Query($sql);
    echo "\"ps\":[";
    $row = mysqli_fetch_assoc($result);
    echo "{\"label\":\"".transState($row["CHPILOTSTATE"]-0)."\",\"data\":\"".$row["COUNT(*)"]."\"}";
    while($row = mysqli_fetch_assoc($result)) {
        echo ",{\"label\":\"".transState($row["CHPILOTSTATE"]-0)."\",\"data\":\"".$row["COUNT(*)"]."\"}";
    }
    echo "]";
}

function transState($num) {
    switch($num) {
        case 1:return "在上海";break;
        case 2:return "在铜沙";break;
        case 3:return "在进口";break;
        case 4:return "在出口";break;
        case 5:return "在移泊";break;
        case 6:return "过驳";break;
        case 7:return "在金山";break;
        case 8:return "公派";break;
        case 9:return "试航";break;
        case 10:return "领导";break;
        case 11:return "学习";break;
        case 12:return "考证";break;
        case 13:return "病假";break;
        case 14:return "轮休";break;
        case 15:return "公休";break;
        case 16:return "拉牌";break;
        default:return "未知";break;
    }
}


