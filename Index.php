<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="./js/d3.v5.min.js" charset="utf-8"></script>
    <script src="./js/jquery-3.3.1.js" charset="utf-8"></script>
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
                <li class="selected" id="li_1"><a href="Information/Pilot.php" target="iframe_main" onclick="selectPage(1)">引航员</a></li>
                <li id="li_2"><a href="" target="iframe_main" onclick="selectPage(2)">登记船只</a></li>
                <li id="li_3"><a href="" target="iframe_main" onclick="selectPage(3)">港口</a></li>
            </ul>
        </div>
        <div class="list_title">历史数据</div>
        <div class="list_container">
            <ul>
                <li id="li_11"><a href="" target="iframe_main" onclick="selectPage(11)">进出港统计</a></li>
                <li id="li_12"><a href="" target="iframe_main" onclick="selectPage(12)">登记船只</a></li>
                <li id="li_13"><a href="" target="iframe_main" onclick="selectPage(13)">港口</a></li>
            </ul>
        </div>
    </nav>
    <iframe name="iframe_main" src="Information/Pilot.php"></iframe>
</div>
<footer>
    <span>毕业设计 沈隽杰 201510311190</span>
</footer>
</body>
</html>
