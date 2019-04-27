<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../../lib/d3.v5.min.js" charset="utf-8"></script>
    <script src="../../lib/jquery-3.3.1.js" charset="utf-8"></script>
    <script src="https://rob8080.github.io/Filters/filters.js" charset="utf-8"></script>
    <script src="VesselScript.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://rob8080.github.io/Filters/filtersStyle.css" type="text/css" />
    <link rel="stylesheet" href="../../css/InformationStyle.css" type="text/css" />
    <link rel="stylesheet" href="Vessel.css" type="text/css" />
</head>
<?php include '..\..\php\Connector.php' ?>
<?php include '..\..\php\UsefulFunction.php' ?>
<body>
<div class="data_container">
    <div class="filter_container" id="vessel_filter">
        <div class="filter_selector_container" name="vesselTp">
            <span>类型:</span>
            <button class="selected" type="nL">不限</button>
            <button>集装箱</button>
            <button>散杂货</button>
            <button>油轮</button>
            <button>拖轮</button>
            <button>化工品</button>
        </div>
        <button class="filter_commit_button" onclick="getVesselInfo(1,getFilterArray('vessel_filter'))">筛选</button>
    </div>
    <div class="info_container" id="vessel_info" class="info_container">
        <div class="label_container"></div>
        <div class="main_container"></div>
    </div>
</div>
</body>
</html>