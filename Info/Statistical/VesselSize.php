<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../../lib/d3.v5.min.js" charset="utf-8"></script>
    <script src="../../lib/jquery-3.3.1.js" charset="utf-8"></script>
    <script src="VesselSizeScript.js" charset="utf-8"></script>
    <link rel="stylesheet" href="../../css/InformationStyle.css" type="text/css" />
    <link rel="stylesheet" href="VesselSize.css" type="text/css" />
</head>
<body>
<div class="svg_container">
    <svg id="vessel_size_svg">
        <g class="tipsG">
            <rect class="tips_bk" id="tipsBackground" height="104" width="140"></rect>
            <rect class="rect_1" id="tipsRect1" height="13" width="22"></rect>
            <rect class="rect_2" id="tipsRect2" height="13" width="22"></rect>
            <rect class="rect_3" id="tipsRect3" height="13" width="22"></rect>
            <rect class="rect_4" id="tipsRect4" height="13" width="22"></rect>
            <rect class="rect_5" id="tipsRect5" height="13" width="22"></rect>
            <text class="tips_lb" id="tipsLabel1">150米以下</text>
            <text class="tips_lb" id="tipsLabel2">150-180米</text>
            <text class="tips_lb" id="tipsLabel3">180-250米</text>
            <text class="tips_lb" id="tipsLabel4">250-300米</text>
            <text class="tips_lb" id="tipsLabel5">300米以上</text>
        </g>
    </svg>
</div>
</body>
</html>