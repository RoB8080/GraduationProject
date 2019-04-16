<script>
    $(document).ready(function(){monthlyCountDataSVG();});
function monthlyCountDataSVG() {
    let data=[],mon=[];
    <?php
    get_monthly_count_data();
    ?>
    let min = Math.floor(d3.min(data)/100)*100,
        max = Math.ceil(d3.max(data)/100)*100,
        width = document.body.clientWidth,
        height = document.body.clientHeight,
        margin = 50,
        svg = d3.select("#inout_monthly_svg"),
        xScale = d3.scaleLinear([new Date(2017,0,1),new Date()],[margin, width - margin]),
        yScale = d3.scaleLinear([min,max],[height - margin, margin]),
        xAxis = d3.axisBottom(xScale).tickFormat(d3.timeFormat("%Y-%m")),
        yAxis = d3.axisLeft(yScale);
    svg.attr("width",width).attr("height",height);
    d3.select("#label1").attr("transform","translate("+(margin+5)+","+(margin-15)+")");
    d3.select("#label2").attr("transform","translate("+(width-margin)+","+(height-margin+18)+")");
    svg.append("svg:g")
        .call(xAxis)
        .attr("transform","translate(0,"+(height-margin)+")");
    svg.append("svg:g")
        .call(yAxis)
        .attr("transform","translate("+margin+",0)");
    let parseTime = d3.timeParse("%Y-%m");
    let lineGen = d3.line()
        .x(function(d,i) {
            return xScale(parseTime(mon[i]));
        })
        .y(function(d) {
            return yScale(d);
        });
    svg.append("svg:path")
        .attr("d", lineGen(data))
        .attr("fill", "none")
        .attr("stroke","#ffe")
        .attr("stroke-width",1);

    let points = svg.append("g")
        .attr("class", "dots");


    points.selectAll(".dot")
        .data(data)
        .enter()
        .append("circle")
        .attr("class", "dot")
        .attr("r", "3")
        .attr("fill", "#ffe")
        .attr("cx", function (d,i) {
            return xScale(parseTime(mon[i]));
        })
        .attr("cy", function (d) {
            return yScale(d);
        })
        .on("mouseover", function (d, i) {
            let t = d3.select(this),th=40,tw=70;
            svg.append('rect')
                .attr("transform","translate("+(parseFloat(t.attr("cx"))-tw/2)+","+(parseFloat(t.attr("cy"))-th-10)+")")
                .attr("width",tw+"px")
                .attr("height",th+"px")
                .attr("fill","#667")
                .attr("opacity", "0.6")
                .attr("rx","5px")
                .attr("ry","5px")
                .attr("class","tooltip");
            svg.append('text')
                .attr("transform","translate("+t.attr("cx")+","+(parseFloat(t.attr("cy"))-16)+")")
                .attr("text-anchor","middle")
                .attr("font-size","17px")
                .attr("fill","#ffe")
                .attr("class","tooltip")
                .text(data[i]+"艘");
            svg.append('text')
                .attr("transform","translate("+t.attr("cx")+","+(parseFloat(t.attr("cy"))-33)+")")
                .attr("text-anchor","middle")
                .attr("font-size","17px")
                .attr("fill","#ffe")
                .attr("class","tooltip")
                .text(mon[i]);
            t.attr("r", "6").attr("fill","#8484ef");
        })
        .on("mouseout", function (d, i) {
            $(".tooltip").remove();
            d3.select(this)
                .attr("r", "3")
                .attr("fill","#ffe");
    });
}
</script>
<?php
function get_monthly_count_data() {
    db_OpenConn();
    $sql="SELECT * FROM t_data_monthly;";
    $result=db_Query($sql);
    $t=0;
    while($row = mysqli_fetch_assoc($result)) {
        echo "mon[".$t."]=\"".$row["MON"]."\";data[".$t."]=".$row["VESCOUNT"].";\r\n";
        $t++;
    }
    db_CloseConn();
}