<?php
include '..\php\Connector.php';
include '..\php\UsefulFunction.php';
$sql=[
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '1' WHERE CHPILOTCODE = '260016';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTGRADE = 'A',CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260061';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '1' WHERE CHPILOTCODE = '260069';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '1' WHERE CHPILOTCODE = '260072';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '1' WHERE (CHPILOTCODE = '260098');",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTGRADE = 'B', CHPILOTCLASS = '1' WHERE CHPILOTCODE = '260019';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTGRADE = 'B', CHPILOTCLASS = '1' WHERE CHPILOTCODE = '260061';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260016';",
    "INSERT INTO pilotplan.t_data_pilot (CHPILOTCODE, CHPILOTGRADE, CHPILOTCLASS, CHPILOTSTATE) VALUES ('260012', 'A', '1', '1');",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260063';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260064';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260069';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260072';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTGRADE = 'B' WHERE CHPILOTCODE = '260081';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTGRADE = 'C', CHPILOTCLASS = '1' WHERE CHPILOTCODE = '260082';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTGRADE = 'C', CHPILOTCLASS = '1' WHERE CHPILOTCODE = '260095';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260098';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTGRADE = 'A', CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260019';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '1' WHERE CHPILOTCODE = '260063';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTCLASS = '1' WHERE CHPILOTCODE = '260064';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTGRADE = 'B', CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260082';",
    "UPDATE pilotplan.t_data_pilot SET CHPILOTGRADE = 'B', CHPILOTCLASS = '2' WHERE CHPILOTCODE = '260095';",
    "DELETE FROM pilotplan.t_data_pilot WHERE (CHPILOTCODE = '260012');"
];
db_OpenConn();
$result = db_Query($sql[(int)$_GET["cc"]]);
db_CloseConn();
