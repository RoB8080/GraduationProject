<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="lib/d3.v5.min.js" charset="utf-8"></script>
    <script src="lib/jquery-3.3.1.js" charset="utf-8"></script>
    <script src="./js/IndexScript.js" charset="utf-8"></script>
    <link rel="stylesheet" href="./css/Default.css" type="text/css" />
    <title></title>
</head>
<body>
<header><div class="title">引航大数据可视化</div></header>
<div class="content">
    <nav>
        <div class="list_title">基础数据</div>
        <div class="list_container">
            <ul>
                <li class="selected" id="li_1"><a href="Info/Base/Pilot.php" target="iframe_main" onclick="selectPage(1)">引航员概览</a></li>
                <li id="li_2"><a href="Info/Base/PilotDetail.php" target="iframe_main" onclick="selectPage(2)">引航员详情</a></li>
                <li id="li_3"><a href="Info/Base/Vessel.php" target="iframe_main" onclick="selectPage(3)">登记船只</a></li>
                <li id="li_4"><a href="Info/Base/VesselDetail.php" target="iframe_main" onclick="selectPage(4)">船只详情</a></li>
            </ul>
        </div>
        <div class="list_title">历史数据</div>
        <div class="list_container">
            <ul>
                <li id="li_11"><a href="Info/Statistical/InOut.php" target="iframe_main" onclick="selectPage(11)">引航任务趋势</a></li>
                <li id="li_12"><a href="Info/Statistical/VesselSize.php" target="iframe_main" onclick="selectPage(12)">船只尺寸趋势</a></li>
                <li id="li_13"><a href="Info/Statistical/Nation.php" target="iframe_main" onclick="selectPage(13)">国家贸易量</a></li>
            </ul>
        </div>
        <div class="list_title">实时数据</div>
        <div class="list_container">
            <ul>
                <li id="li_21"><a href="Info/Realtime/Main.php" target="iframe_main" onclick="selectPage(21)">数据面板</a></li>
                <li id="li_22"><a href="Info/Realtime/Map.php" target="iframe_main" onclick="selectPage(22)">地图面板</a></li>
            </ul>
        </div>
    </nav>
    <iframe name="iframe_main" src="Info/Base/Pilot.php" frameborder="0" scrolling="no"></iframe>
</div>
<footer>
    <span>毕业设计 沈隽杰 201510311190</span>
</footer>
</body>
</html>
