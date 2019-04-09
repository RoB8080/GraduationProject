<script>
    $(document).ready(function(){vesselNationSVG()});
function vesselNationSVG() {
    var width = 400;
    var height = 400;
    var svg = d3.select("#vessel_nation_svg");
    var trans = [];//国家颜色数组
    trans["ML"]=["#eeec2c","马里"];trans["PA"]=["#7777ee","巴拿马"];trans["MY"]=["#ee5e3f","马来西亚"];
    trans["BS"]=["#55cdee","巴哈马"];trans["KH"]=["#ee7b64","柬埔寨"];trans["KR"]=["#ee527e","韩国"];
    trans["CY"]=["#ac67ee","塞浦路斯"];

    var dataset=[],label=[];
    <?php
    get_vessel_nation_data();
    ?>
    var pie = d3.pie();
    var piedata = pie(dataset);

    var outerRadius = 190; //外半径
    var innerRadius = 90; //内半径，为0则中间没有空白

    var arc = d3.arc()  //弧生成器
        .innerRadius(innerRadius)   //设置内半径
        .outerRadius(outerRadius);  //设置外半径

    var arcs = svg.selectAll("g")
        .data(piedata)
        .enter()
        .append("g")
        .attr("transform","translate("+ (width/2) +","+ (height/2) +")");

    arcs.append("path")
        .attr("fill",function(d,i){
            return trans[label[i]][0];
        })
        .attr("stroke","#ffe")
        .attr("d",function(d){
            return arc(d);   //调用弧生成器，得到路径值
        })
        .on("mouseover",function(){$(this).siblings().toggle()})
        .on("mouseout",function(){$(this).siblings().toggle()});

    arcs.append("text")
        .attr("transform",function(d){
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("text-anchor","middle")
        .attr("font-size","20px")
        .attr("font-weight","bold")
        .attr("fill","#444444")
        .attr("display","none")
        .text(function(d,i){
            return trans[label[i]][1];
        });

    arcs.append("text")
        .attr("transform",function(d){
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("text-anchor","middle")
        .attr("font-size","22px")
        .attr("font-weight","bolder")
        .attr("fill","#444444")
        .text(function(d,i){
            return d.data;
        });

}
</script>
<?php
function get_vessel_nation_data() {
    db_OpenConn();
    $sql="SELECT t_base_vesinfo.CHNATIONCODE,count(t_base_vesinfo.CHNATIONCODE) FROM t_base_vesinfo GROUP BY CHNATIONCODE;";
    $result=db_Query($sql);
    $t=0;
    while($row = mysqli_fetch_assoc($result)) {
        echo "label[".$t."]=\"".$row["CHNATIONCODE"]."\";dataset[".$t."]=".$row["count(t_base_vesinfo.CHNATIONCODE)"].";\r\n";
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