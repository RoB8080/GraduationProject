<?php
$start=$_GET['s'];
db_OpenConn();
$sql="SELECT * FROM pilotplan.t_base_pilotinfo LIMIT ".($s).",20;";
$result=db_Query($sql);
$t=0;
while($row = mysqli_fetch_assoc($result)) {
    echo "label[".$t."]=\"".$row["CHPILOTGRADE"]."\";dataset[".$t."]=".$row["count(t_base_pilotinfo.CHPILOTGRADE)"].";\r\n";
    $t++;
}
db_CloseConn();