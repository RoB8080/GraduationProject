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
    <svg id="inout_monthly_svg" height="480" width="640">
        <text transform="translate(39, 23)" text-anchor="middle" fill="#ffe" font-size="13px">船只数(艘)</text>
        <text transform="translate(625, 460)" text-anchor="middle" fill="#f0f0e0" font-size="13px">月份</text>
    </svg>
</div>
</body>
<?php include '..\Information\InOutVisual.php' ?>
</html>