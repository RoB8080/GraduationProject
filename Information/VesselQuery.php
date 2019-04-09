<?php
include '..\php\Connector.php';
include '..\php\UsefulFunction.php';
$start=$_GET['s'];
$grade=$_GET['pGr'];
$addr=$_GET['pAd'];
db_OpenConn();
$sql="SELECT * FROM pilotplan.t_base_pilotinfo";
if($grade!="000"||$addr!="00") {
    $sql=$sql." WHERE";
}
if($grade!="000") {
    $sql=$sql." (";
    $gradeA=string_to_bool_array($grade);
    if($gradeA[0]){
        $sql=$sql." CHPILOTGRADE='A' OR CHPILOTGRADE='a'";
        if($gradeA[1])
            $sql=$sql." OR CHPILOTGRADE='B' OR CHPILOTGRADE='b'";
        else {
            if($gradeA[2])
                $sql=$sql." OR CHPILOTGRADE='C' OR CHPILOTGRADE='c'";
        }
    }
    else {
        if($gradeA[1]){
            $sql=$sql." CHPILOTGRADE='B' OR CHPILOTGRADE='b'";
            if($gradeA[2])
                $sql=$sql." OR CHPILOTGRADE='C' OR CHPILOTGRADE='c'";
        }
        else {
            $sql=$sql." CHPILOTGRADE='C' OR CHPILOTGRADE='c'";
        }
    }
    $sql=$sql.")";
    if($addr!="00")
        $sql=$sql." AND";
}
if($addr!="00") {
    $addrA=string_to_bool_array($addr);
    if($addrA[0])
        $sql=$sql." CHPILOTADSCRIPTCODE=1";
    else
        $sql=$sql." CHPILOTADSCRIPTCODE=2";
}
$sql=$sql." LIMIT ".($start).",40";
$result=db_Query($sql);
while($row = mysqli_fetch_assoc($result)) {
    echo $row["CHPILOTNO"].",".$row["VCPILOTNAME"].",".$row["CHPILOTGRADE"].",".$row["CHPILOTADSCRIPTCODE"].";";
}
db_CloseConn();