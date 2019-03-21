<script>
    var dymwidth = document.body.clientWidth*0.45;
    var width = dymwidth>400?dymwidth:400;
    var height = width*3/4;
    var svg = d3.select("#pilot_grade_table").append("svg").attr("width", width).attr("height", height);

    var dataset;
    <?php
      get_pilot_grade_data();
    ?>
    var pie = d3.layout.pie();
    var piedata = pie(dataset[2]);

    var outerRadius = 150; //外半径
    var innerRadius = 0; //内半径，为0则中间没有空白

    var arc = d3.svg.arc()  //弧生成器
        .innerRadius(innerRadius)   //设置内半径
        .outerRadius(outerRadius);  //设置外半径

    var arcs = svg.selectAll("g")
        .data(piedata)
        .enter()
        .append("g")
        .attr("transform","translate("+ (width/2) +","+ (width/2) +")");

    var color = d3.scale.category10();   //有十种颜色的颜色比例尺

    arcs.append("path")
        .attr("fill",function(d,i){
            return color(i);
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
    $sql="SELECT CHPILOTGRADE,count(CHPILOTGRADE) FROM t_base_pilotinfo GROUP BY CHPILOTGRADE";
    $result=db_Query($sql);
    $t=0;
    while($row = mysqli_fetch_assoc($result)) {
        echo "dataset[0][".$t."]=".$row["grade"].";dataset[1][".$t."]=".$row["count"].";";
    }

}