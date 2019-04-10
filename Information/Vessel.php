<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../lib/d3.v5.min.js" charset="utf-8"></script>
    <script src="../lib/jquery-3.3.1.js" charset="utf-8"></script>
    <link rel="stylesheet" href="../css/InformationStyle.css" type="text/css" />
</head>
<?php include '..\php\Connector.php' ?>
<?php include '..\php\UsefulFunction.php'?>
<body>
<div class="svg_container">
    <svg id="vessel_type_svg" height="400" width="400">
        <text transform="translate(200, 210)" text-anchor="middle" fill="#f0f0e0" font-size="30px">船只类型</text>
    </svg>
    <svg id="vessel_nation_svg" height="400" width="400">
        <text transform="translate(200, 210)" text-anchor="middle" fill="#f0f0e0" font-size="30px">所属国家</text>
    </svg>
</div>
</div>
</body>
<?php include '..\Information\VesselVisual.php' ?>
</html>