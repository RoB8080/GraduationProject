<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../../lib/d3.v5.min.js" charset="utf-8"></script>
    <script src="https://d3js.org/d3-geo-projection.v2.min.js"></script>
    <script src="../../lib/topojson.min.js"></script>
    <script src="../../lib/jquery-3.3.1.js" charset="utf-8"></script>
    <link rel="stylesheet" href="Map.css" type="text/css" />
</head>
<?php include '..\..\php\Connector.php' ?>
<?php include '..\..\php\UsefulFunction.php' ?>
<body>
<div class="svg_container">
    <svg id="map_svg"></svg>
</div>
</body>
<?php include 'MapVisual.php' ?>
</html>