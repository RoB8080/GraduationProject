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
    <svg id="pilot_grade_svg" height="300" width="300">
        <text transform="translate(150, 147)" text-anchor="middle" fill="#f0f0e0" font-size="25px">引航员级别(位)</text>
        <text transform="translate(108, 170)" text-anchor="middle" style="fill:#f0f0e0;font-size:16px;">A级</text>
        <text transform="translate(158, 170)" text-anchor="middle" style="fill:#f0f0e0;font-size:16px;">B级</text>
        <text transform="translate(208, 170)" text-anchor="middle" style="fill:#f0f0e0;font-size:16px;">C级</text>
        <rect transform="translate(78, 158)" width="13" height="13" fill="#ff6666"></rect>
        <rect transform="translate(128, 158)" width="13" height="13" fill="#ff8888"></rect>
        <rect transform="translate(178, 158)" width="13" height="13" fill="#ffaaaa"></rect>
    </svg>
    <svg id="pilot_addr_svg" height="300" width="300">
        <text transform="translate(150, 147)" text-anchor="middle" fill="#f0f0e0" font-size="25px">港区引航员(位)</text>
        <text transform="translate(124, 170)" text-anchor="middle" style="fill:#f0f0e0;font-size:16px;">上海</text>
        <text transform="translate(194, 170)" text-anchor="middle" style="fill:#f0f0e0;font-size:16px;">洋山</text>
        <rect transform="translate(92, 158)" width="13" height="13" fill="#77ff77"></rect>
        <rect transform="translate(162, 158)" width="13" height="13" fill="#7777ff"></rect>
    </svg>
</div>
</body>
<?php include '..\Information\PilotVisual.php' ?>
</html>