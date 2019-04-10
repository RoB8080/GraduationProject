<script>
    $(document).ready(function(){pilotGradeSVG();pilotAddrSVG();});
function pilotGradeSVG() {
    var width = 300;
    var height = 300;
    var svg = d3.select("#pilot_grade_svg");
    var color = ["#ffaaaa","#ff8888","#ff6666"];   //有十种颜色的颜色比例尺

    var dataset=[],label=[];
    <?php
    get_pilot_grade_data();
    ?>
    var pie = d3.pie();
    var piedata = pie(dataset);

    var outerRadius = 145; //外半径
    var innerRadius = 95; //内半径，为0则中间没有空白

    var arc = d3.arc()  //弧生成器
        .innerRadius(innerRadius)   //设置内半径
        .outerRadius(outerRadius);  //设置外半径

    var arcs = svg.selectAll("g")
        .data(piedata)
        .enter()
        .append("g")
        .attr("transform","translate("+ (width/2) +","+ (width/2) +")");

    arcs.append("path")
        .attr("fill",function(d,i){
            return color[i];
        })
        .attr("d",function(d){
            return arc(d);   //调用弧生成器，得到路径值
        })
        .attr("stroke","#ffe");

    arcs.append("text")
        .attr("transform",function(d){
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("text-anchor","middle")
        .attr("font-size","22px")
        .attr("fill","#444444")
        .text(function(d){
            return d.data;
        });

}
function pilotAddrSVG() {
    var width = 300;
    var height = 300;
    var svg = d3.select("#pilot_addr_svg");
    var color = ["#77ff77","#7777ff","#ff7777"];

    var dataset=[],label=[];
    <?php
    get_pilot_addr_data();
    ?>
    var pie = d3.pie();
    var piedata = pie(dataset);

    var outerRadius = 145; //外半径
    var innerRadius = 95; //内半径，为0则中间没有空白

    var arc = d3.arc()  //弧生成器
        .innerRadius(innerRadius)   //设置内半径
        .outerRadius(outerRadius);  //设置外半径

    var arcs = svg.selectAll("g")
        .data(piedata)
        .enter()
        .append("g")
        .attr("transform","translate("+ (width/2) +","+ (width/2) +")");

    arcs.append("path")
        .attr("fill",function(d,i){
            return color[i];
        })
        .attr("d",function(d){
            return arc(d);   //调用弧生成器，得到路径值
        })
        .attr("stroke","#ffe");

    arcs.append("text")
        .attr("transform",function(d){
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("text-anchor","middle")
        .attr("font-size","22px")
        .attr("fill","#444444")
        .text(function(d){
            return d.data;
        });

}
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
function get_pilot_addr_data() {
    db_OpenConn();
    $sql="SELECT t_base_pilotinfo.CHPILOTADSCRIPTCODE,count(t_base_pilotinfo.CHPILOTADSCRIPTCODE) FROM t_base_pilotinfo GROUP BY CHPILOTADSCRIPTCODE;";
    $result=db_Query($sql);
    $t=0;
    while($row = mysqli_fetch_assoc($result)) {
        echo "label[".$t."]=\"".$row["CHPILOTADSCRIPTCODE"]."\";dataset[".$t."]=".$row["count(t_base_pilotinfo.CHPILOTADSCRIPTCODE)"].";\r\n";
        $t++;
    }
    db_CloseConn();
}