<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../../lib/d3.v5.min.js" charset="utf-8"></script>
    <script src="../../lib/jquery-3.3.1.js" charset="utf-8"></script>
    <script src="../../js/AjaxFunction.js" charset="utf-8"></script>
    <link rel="stylesheet" href="../../css/InformationStyle.css" type="text/css" />
    <link rel="stylesheet" href="../../css/PieStyle.css" type="text/css" />
    <script src="../../js/PieScript.js" charset="utf-8"></script>
</head>
<?php include '..\..\php\Connector.php' ?>
<?php include '..\..\php\UsefulFunction.php' ?>
<body>
<div class="panel" id="PG">
    <div class="panel_header">引航员等级</div>
    <div class="panel_content"></div>
</div>
<div class="panel" id="PA">
    <div class="panel_header">引航员港区分布</div>
    <div class="panel_content"></div>
</div>
</body>
<?php include 'PilotVisual.php' ?>
</html>