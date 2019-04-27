<?php
include '..\..\php\Connector.php';
include '..\..\php\UsefulFunction.php';
$start=$_GET['s'];
$type=$_GET['vTp'];
db_OpenConn();
$sql="SELECT t_base_vesinfo.VCVESCNAME,t_code_vestypecode.VCVESTYPENAME,t_code_nationcode.VCNATIONCNNAME,t_base_vesinfo.INVESSELTOTALTON,t_base_vesinfo.INVESSELNETTON FROM pilotplan.t_base_vesinfo INNER JOIN pilotplan.t_code_vestypecode ON t_code_vestypecode.CHVESTYPECODE=t_base_vesinfo.CHVESTYPECODE INNER JOIN pilotplan.t_code_nationcode ON t_base_vesinfo.CHNATIONCODE=t_code_nationcode.VCNATIONCODE";
if($type!="00000") {
    $sql=$sql." WHERE False";
    $typeA=string_to_bool_array($type);
    if($typeA[0]){
        $sql=$sql." OR t_base_vesinfo.CHVESTYPECODE=01";
    }
    if($typeA[1]){
        $sql=$sql." OR t_base_vesinfo.CHVESTYPECODE=03";
    }
    if($typeA[2]){
        $sql=$sql." OR t_base_vesinfo.CHVESTYPECODE=11";
    }
    if($typeA[3]){
        $sql=$sql." OR t_base_vesinfo.CHVESTYPECODE=12";
    }
    if($typeA[4]){
        $sql=$sql." OR t_base_vesinfo.CHVESTYPECODE=25";
    }
}
$sql=$sql." LIMIT ".($start).",40";
$result=db_Query($sql);
echo "{\"results\":[";
$row = mysqli_fetch_assoc($result);
echo "{\"vNa\":\"".$row["VCVESCNAME"]."\",\"vTp\":\"".$row["VCVESTYPENAME"]."\",\"vNc\":\"".$row["VCNATIONCNNAME"]."\",\"vTt\":\"".$row["INVESSELTOTALTON"]."\",\"vNt\":\"".$row["INVESSELNETTON"]."\"}";
while($row = mysqli_fetch_assoc($result)) {
    echo ",{\"vNa\":\"".$row["VCVESCNAME"]."\",\"vTp\":\"".$row["VCVESTYPENAME"]."\",\"vNc\":\"".$row["VCNATIONCNNAME"]."\",\"vTt\":\"".$row["INVESSELTOTALTON"]."\",\"vNt\":\"".$row["INVESSELNETTON"]."\"}";
}
echo "]}";
db_CloseConn();