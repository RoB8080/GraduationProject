<script>
    var width = 400;
    var height = 400;
    var svg = d3.select("#pilot_grade_table").append("svg").attr("width", width).attr("height", height);

    svg.append("text")
        .attr("transform","translate(200, 200)")
        .attr("text-anchor","middle")
        .text("引航员级别(位)");
    var dataset=[],label=[];
    <?php
      get_pilot_grade_data();
    ?>
    var pie = d3.pie();
    var piedata = pie(dataset);

    var outerRadius = 190; //外半径
    var innerRadius = 120; //内半径，为0则中间没有空白

    var arc = d3.arc()  //弧生成器
        .innerRadius(innerRadius)   //设置内半径
        .outerRadius(outerRadius);  //设置外半径

    var arcs = svg.selectAll("g")
        .data(piedata)
        .enter()
        .append("g")
        .attr("transform","translate("+ (width/2) +","+ (width/2) +")");

    var color = ["#ffaaaa","#ff8888","#ff6666"];   //有十种颜色的颜色比例尺

    arcs.append("path")
        .attr("fill",function(d,i){
            return color[i];
        })
        .attr("d",function(d){
            return arc(d);   //调用弧生成器，得到路径值
        });

    arcs.append("text")
        .attr("transform",function(d){
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("text-anchor","middle")
        .text(function(d){
            return d.data;
        });

</script>
<?php
function get_pilot_grade_data() {
    db_OpenConn();
    $sql="SELECT t_base_pilotinfo.CHPILOTGRADE,count(t_base_pilotinfo.CHPILOTGRADE) FROM t_base_pilotinfo GROUP BY CHPILOTGRADE;";
    $result=db_Query($sql);
    $t=0;
    while($row = mysqli_fetch_assoc($result)) {
        echo "label[".$t."]=\"".$row["CHPILOTGRADE"]."\";dataset[".$t."]=".$row["count(t_base_pilotinfo.CHPILOTGRADE)"].";\r\n";
        $t++;
    }
    db_CloseConn();
}