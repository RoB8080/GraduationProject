<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../../lib/d3.v5.min.js" charset="utf-8"></script>
    <script src="../../lib/jquery-3.3.1.js" charset="utf-8"></script>
    <script src="https://rob8080.github.io/Filters/filters.js" charset="utf-8"></script>
    <script src="PilotScript.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://rob8080.github.io/Filters/filtersStyle.css" type="text/css" />
    <link rel="stylesheet" href="../../css/InformationStyle.css" type="text/css" />
    <link rel="stylesheet" href="Pilot.css" type="text/css" />
</head>
<body>
<div class="data_container">
    <div class="filter_container" id="pilot_filter">
        <div class="filter_selector_container" name="pilotGr">
            <span>级别:</span>
            <button class="selected" type="nL">不限</button>
            <button value="A">A级</button>
            <button value="B">B级</button>
            <button value="C">C级</button>
        </div>
        <div class="filter_selector_container" name="pilotAd">
            <span>港区:</span>
            <button class="selected" type="nL">不限</button>
            <button value="1">上海港</button>
            <button value="2">洋山</button>
        </div>
        <button class="filter_commit_button" onclick="getPilotInfo(1,getFilterArray('pilot_filter'))">筛选</button>
    </div>
    <div class="info_container" id="pilot_info" class="info_container">
        <div class="label_container"></div>
        <div class="main_container"></div>
    </div>
</div>
</body>
</html>