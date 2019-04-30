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
<div style="overflow-y: scroll; overflow-x: hidden;  height:100%">
    <div class="panel" id="VT">
        <div class="panel_header">船只类型</div>
        <div class="panel_content">
            <svg id="vessel_type_svg">
                <g class="tips"></g>
            </svg>
        </div>
    </div>
    <div class="panel" id="VN">
        <div class="panel_header">船只国籍</div>
        <div class="panel_content">
            <svg id="vessel_nation_svg">
                <g class="tips"></g>
            </svg>
        </div>
    </div>
    <div class="panel" id="VS">
        <div class="panel_header">船只尺寸</div>
        <div class="panel_content">
            <svg id="vessel_size_svg">
                <g class="tips"></g>
            </svg>
        </div>
    </div>
</div>

</body>
<?php include 'VesselVisual.php' ?>
</html>