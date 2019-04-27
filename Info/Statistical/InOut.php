<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../../lib/d3.v5.min.js" charset="utf-8"></script>
    <script src="../../lib/jquery-3.3.1.js" charset="utf-8"></script>
    <script src="../../js/AjaxFunction.js" charset="utf-8"></script>
    <link rel="stylesheet" href="../../css/InformationStyle.css" type="text/css" />
</head>
<?php include '..\..\php\Connector.php' ?>
<?php include '..\..\php\UsefulFunction.php' ?>
<body>
<div class="svg_container">
    <svg id="inout_monthly_svg">
    </svg>
</div>
</body>
<?php include 'InOutVisual.php' ?>
</html>