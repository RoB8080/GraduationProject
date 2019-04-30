<?php
include '..\..\php\Connector.php';
include '..\..\php\UsefulFunction.php';
$start=$_GET['s'];
$type=$_GET['vTp'];
$size=$_GET['vSz'];
db_OpenConn();
$sql="SELECT t_base_vesinfo.VCVESCNAME,t_base_vesinfo.CHCALLNO,t_code_vestypecode.VCVESTYPENAME,t_code_nationcode.VCNATIONCNNAME,t_base_vesinfo.INVESSELTOTALTON,t_base_vesinfo.INVESSELNETTON,t_base_vesinfo.NMVESLENGTH FROM pilotplan.t_base_vesinfo INNER JOIN pilotplan.t_code_vestypecode ON t_code_vestypecode.CHVESTYPECODE=t_base_vesinfo.CHVESTYPECODE INNER JOIN pilotplan.t_code_nationcode ON t_base_vesinfo.CHNATIONCODE=t_code_nationcode.VCNATIONCODE";
$flag=true;
if($type!="00000") {
    $sql = $sql.first_test_add(" WHERE"," AND",$flag);
    $flagTp = true;
    $typeA=string_to_bool_array($type);
    $sql = $sql." (";
    if($typeA[0]){
        $sql = $sql.first_test_add(" t_base_vesinfo.CHVESTYPECODE=01"," OR t_base_vesinfo.CHVESTYPECODE=01",$flagTp);
    }
    if($typeA[1]){
        $sql = $sql.first_test_add(" t_base_vesinfo.CHVESTYPECODE=03"," OR t_base_vesinfo.CHVESTYPECODE=03",$flagTp);
    }
    if($typeA[2]){
        $sql = $sql.first_test_add(" t_base_vesinfo.CHVESTYPECODE=11"," OR t_base_vesinfo.CHVESTYPECODE=11",$flagTp);
    }
    if($typeA[3]){
        $sql = $sql.first_test_add(" t_base_vesinfo.CHVESTYPECODE=12"," OR t_base_vesinfo.CHVESTYPECODE=12",$flagTp);
    }
    if($typeA[4]){
        $sql = $sql.first_test_add(" t_base_vesinfo.CHVESTYPECODE=25"," OR t_base_vesinfo.CHVESTYPECODE=25",$flagTp);
    }
    $sql = $sql.")";
}
if($size!="00000") {
    $sql = $sql.first_test_add(" WHERE"," AND",$flag);
    $flagSz = true;
    $typeA=string_to_bool_array($size);
    $sql = $sql." (";
    if($typeA[0]){
        $sql = $sql.first_test_add(" (t_base_vesinfo.NMVESLENGTH<=150 AND t_base_vesinfo.NMVESLENGTH>0)"," OR (t_base_vesinfo.NMVESLENGTH<=150 AND t_base_vesinfo.NMVESLENGTH>0)",$flagSz);
    }
    if($typeA[1]){
        $sql = $sql.first_test_add(" (t_base_vesinfo.NMVESLENGTH<=180 AND t_base_vesinfo.NMVESLENGTH>150)"," OR (t_base_vesinfo.NMVESLENGTH<=180 AND t_base_vesinfo.NMVESLENGTH>150)",$flagSz);
    }
    if($typeA[2]){
        $sql = $sql.first_test_add(" (t_base_vesinfo.NMVESLENGTH<=250 AND t_base_vesinfo.NMVESLENGTH>180)"," OR (t_base_vesinfo.NMVESLENGTH<=250 AND t_base_vesinfo.NMVESLENGTH>180)",$flagSz);
    }
    if($typeA[3]){
        $sql = $sql.first_test_add(" (t_base_vesinfo.NMVESLENGTH<=300 AND t_base_vesinfo.NMVESLENGTH>250)"," OR (t_base_vesinfo.NMVESLENGTH<=300 AND t_base_vesinfo.NMVESLENGTH>250)",$flagSz);
    }
    if($typeA[4]){
        $sql = $sql.first_test_add(" (t_base_vesinfo.NMVESLENGTH<=2000 AND t_base_vesinfo.NMVESLENGTH>300)"," OR (t_base_vesinfo.NMVESLENGTH<=2000 AND t_base_vesinfo.NMVESLENGTH>300)",$flagSz);
    }
    $sql = $sql.")";
}
$sql=$sql." LIMIT ".($start).",40";
$result=db_Query($sql);
echo "{\"results\":[";
$row = mysqli_fetch_assoc($result);
echo "{\"vNa\":\"".$row["VCVESCNAME"]."\",\"vCn\":\"".$row["CHCALLNO"]."\",\"vTp\":\"".$row["VCVESTYPENAME"]."\",\"vNc\":\"".$row["VCNATIONCNNAME"]."\",\"vTt\":\"".$row["INVESSELTOTALTON"]."\",\"vNt\":\"".$row["INVESSELNETTON"]."\",\"vLt\":".$row["NMVESLENGTH"]."}";
while($row = mysqli_fetch_assoc($result)) {
    echo ",{\"vNa\":\"".$row["VCVESCNAME"]."\",\"vCn\":\"".$row["CHCALLNO"]."\",\"vTp\":\"".$row["VCVESTYPENAME"]."\",\"vNc\":\"".$row["VCNATIONCNNAME"]."\",\"vTt\":\"".$row["INVESSELTOTALTON"]."\",\"vNt\":\"".$row["INVESSELNETTON"]."\",\"vLt\":".$row["NMVESLENGTH"]."}";
}
echo "]}";
db_CloseConn();