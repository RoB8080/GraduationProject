<script>
    let dataset=[];
    <?php
        get_nation_count_data();
    ?>
    let width = document.body.clientWidth,
        height = document.body.clientHeight;
    let svg = d3.select("#nation_svg").attr("height", height).attr("width", width);
    let g = svg.append("g");
    let zoom = d3.zoom().scaleExtent([1, 8]).on("zoom", zoomed);


    svg.append("rect")
        .attr("class", "overlay")
        .attr("width", width)
        .attr("height", height)
        .call(zoom);
    let projection = d3.geoNaturalEarth2()
        .translate([width / 2, height / 2])
        .scale(width * 0.165);
    let path = d3.geoPath()
        .projection(projection);
    g.append("path")
        .datum({type: "Sphere"})
        .attr("id", "sphere")
        .attr("d", path);
    d3.json("../../lib/110m.json")
        .then(function (world) {
            let inner_g = g.append("g").attr("class", "ig");
            inner_g.append("path")
                .datum(topojson.merge(world, world.objects.land.geometries))
                .attr("class", "land")
                .attr("d", path);
            inner_g.append("path")
                .datum(topojson.mesh(world, world.objects.countries, function (a, b) {
                    return a !== b;
                }))
                .attr("class", "border")
                .attr("d", path);
        });

    let locs = svg.append("g").attr("class","locations");
    locs.selectAll(".location")
        .data(dataset)
        .enter()
        .append("circle")
        .attr("class","location")
        .attr("fill","#cb1b45")
        .attr("transform",function(d){
            let loc = projection([d.location[0], d.location[1]]);
            return "translate("+ loc[0] + "," + loc[1] +")";
        })
        .on("mouseover", function (d, i) {
            let th=58,tw=104,loc = projection([d.location[0], d.location[1]]);
            d3.select(this).attr("fill","#ffe");
            locs.append('rect')
                .attr("transform","translate("+(loc[0]-tw/2)+","+(loc[1]-th-10)+")")
                .attr("width",tw+"px")
                .attr("height",th+"px")
                .attr("fill","#667")
                .attr("opacity", "0.6")
                .attr("rx","5px")
                .attr("ry","5px")
                .attr("class","tooltip");
            locs.append('text')
                .attr("transform","translate("+loc[0]+","+(loc[1]-50)+")")
                .attr("text-anchor","middle")
                .attr("font-size","17px")
                .attr("fill","#ffe")
                .attr("class","tooltip")
                .text(dataset[i].name);
            locs.append('text')
                .attr("transform","translate("+loc[0]+","+(loc[1]-33)+")")
                .attr("text-anchor","middle")
                .attr("font-size","17px")
                .attr("fill","#ffe")
                .attr("class","tooltip")
                .text("来自："+dataset[i].vescount[0]);
            locs.append('text')
                .attr("transform","translate("+loc[0]+","+(loc[1]-16)+")")
                .attr("text-anchor","middle")
                .attr("font-size","17px")
                .attr("fill","#ffe")
                .attr("class","tooltip")
                .text("去往："+dataset[i].vescount[1]);
        })
        .on("mouseout", function (d, i) {
            $(".tooltip").remove();
            d3.select(this)
                .attr("fill","#cb1b45");
        })
        .transition()
        .delay(800)
        .duration(800)
        .attrTween("r", function(d){
            let i = d3.interpolateNumber(0, CtoS(d.vescount[0]+d.vescount[1]));
            return function (t) {
                return i(t);
            }
        });
    function CtoS(c){
        let sizeScale=d3.scaleLinear([100,1000],[3,13]);
        return sizeScale((c<100?100:c)>1000?1000:c);
    }

    function zoomed() {
        console.log(d3.event);
        g.attr("transform",
            "translate(" + d3.event.transform.x + "," + d3.event.transform.y + ")" +
            "scale(" + d3.event.transform.k + ")"
        );
        locs.attr("transform",
            "translate(" + d3.event.transform.x + "," + d3.event.transform.y + ")" +
            "scale(" + d3.event.transform.k + ")"
        );
    }
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