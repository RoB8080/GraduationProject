<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="../js/d3.v5.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="../css/InformationStyle.css" type="text/css" />
    <title></title>
</head>
<?php include '..\php\Connector.php' ?>
<body>
<div id="pilot_grade_table">
    <svg id="pilot_grade_svg" height="400" width="400">
        <text transform="translate(200, 200)" text-anchor="middle" fill="#f0f0e0" font-size="25px">引航员级别(位)</text>
        <text transform="translate(159, 225)" text-anchor="middle" style="fill:#f0f0e0;font-size:16px;">A级</text>
        <text transform="translate(209, 225)" text-anchor="middle" style="fill:#f0f0e0;font-size:16px;">B级</text>
        <text transform="translate(259, 225)" text-anchor="middle" style="fill:#f0f0e0;font-size:16px;">C级</text>
        <rect transform="translate(126, 212)" width="14" height="14" fill="#ff6666"></rect>
        <rect transform="translate(176, 212)" width="14" height="14" fill="#ff8888"></rect>
        <rect transform="translate(226, 212)" width="14" height="14" fill="#ffaaaa"></rect>
    </svg>
</div>
<div class="filter_container">
    <div class="filter_button_group">
        <span class="filter_button left selected g1" onclick="filter_button_select">不限</span>
        <span class="filter_button g2">A级</span>
        <span class="filter_button g2">B级</span>
        <span class="filter_button right g2">C级</span>
    </div>
</div>
<div id="pilot_info_container">
    <div class="pilot_info_cell"></div>
</div>
</body>
<?php include '..\php\Visualization.php' ?>
</html>
