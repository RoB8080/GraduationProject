<script>
    let dataset=[];
    <?php
    ?>
    let width = document.body.clientWidth,
        height = document.body.clientHeight;
    width = (width/height>4/3)?height*4/3:width;
    height = (width/height<4/3)?width/4*3:height;
    let svg = d3.select("#map_svg").attr("height", height).attr("width", width);
    let g = svg.append("g");
    let projection = d3.geoMercator()
        .translate([width / 2, height / 2])
        .scale(width * 25)
        .rotate([-121.7,-31.06]);
    let path = d3.geoPath()
        .projection(projection);
    g.append("path")
        .datum({type: "Sphere"})
        .attr("id", "sphere")
        .attr("d", path);
    d3.json("../../geo/sh_land_01.json")
        .then(function (world) {
            let inner_g = g.append("g").attr("class", "ig");
            inner_g.selectAll(".land")
                .data(topojson.feature(world, world.objects.collection))
                .enter()
                .attr("class", "land")
                .attr("d", path);
        });
    d3.json("../../geo/sh_land_02.json")
        .then(function (world) {
            let inner_g = g.append("g").attr("class", "ig");
            inner_g.append("path")
                .datum(topojson.merge(world, world.objects.collection.geometries))
                .attr("class", "land")
                .attr("d", path);
        });
</script>
<?php
function get_nation_count_data() {
    db_OpenConn();
    $sql="SELECT t_data_nation.*,LONGITUDE,LATITUDE FROM t_data_nation JOIN t_data_nationloc ON t_data_nation.VCNATIONCODE = t_data_nationloc.VCNATIONCODE;";
    $result=db_Query($sql);
    $t=0;
    while($row = mysqli_fetch_assoc($result)) {
        echo "dataset[".$t."]={'code':'".$row["VCNATIONCODE"]."','vescount':[".$row["VESFROMCOUNT"].",".$row["VESTOCOUNT"]."],'name':'".$row["VCNATIONCNNAME"]."','location':[".$row["LONGITUDE"].",".$row["LATITUDE"]."]};\r\n";
        $t++;
    }
    db_CloseConn();
}