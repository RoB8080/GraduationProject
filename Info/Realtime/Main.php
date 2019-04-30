<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../../lib/d3.v5.min.js" charset="utf-8"></script>
    <script src="../../lib/jquery-3.3.1.js" charset="utf-8"></script>
    <script src="MainScript.js" charset="utf-8"></script>
    <script src="../../js/Test.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://rob8080.github.io/Filters/filtersStyle.css" type="text/css" />
    <link rel="stylesheet" href="../../css/InformationStyle.css" type="text/css" />
    <link rel="stylesheet" href="../../css/PieStyle.css" type="text/css" />
</head>
<body>
<div class="panel" id="APG">
    <div class="panel_header">可用引航员等级</div>
    <div class="panel_content">
        <svg id="available_pilot_grade">
            <g class="tips"></g>
        </svg>
    </div>
</div>
<div class="panel" id="PS">
    <div class="panel_header">引航员实时状态</div>
    <div class="panel_content">
        <svg id="pilot_state">
            <g class="tips"></g>
        </svg>
    </div>
</div>
</body>
</html>