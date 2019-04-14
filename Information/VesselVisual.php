<script>
    $(document).ready(function(){vesselNationSVG();vesselTypeSVG();});
function vesselNationSVG() {
    var width = 400;
    var height = 400;
    var svg = d3.select("#vessel_nation_svg");
    var trans = [];//国家颜色数组
    trans["ML"]="#eeec2c";trans["PA"]="#7777ee";trans["MY"]="#ee5e3f";
    trans["BS"]="#55cdee";trans["KH"]="#ee7b64";trans["KR"]="#ee527e";
    trans["CY"]="#ac67ee";

    var dataset=[],label=[],code=[];
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
            return trans[code[i]];
        })
        .attr("stroke","#ffe")
        .attr("d",function(d){
            return arc(d);   //调用弧生成器，得到路径值
        })
        .on("mouseover",function(){$(this).siblings().toggle(200)})
        .on("mouseout",function(){$(this).siblings().toggle(200)});

    arcs.append("text")
        .attr("transform",function(d){
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("text-anchor","middle")
        .attr("font-size","20px")
        .attr("font-weight","bold")
        .attr("fill","#444444")
        .text(function(d,i){
            return label[i];
        });

    arcs.append("text")
        .attr("transform",function(d){
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("text-anchor","middle")
        .attr("font-size","22px")
        .attr("font-weight","bolder")
        .attr("fill","#444444")
        .attr("display","none")
        .text(function(d,i){
            return d.data;
        });

}
function vesselTypeSVG() {
        var width = 400;
        var height = 400;
        var svg = d3.select("#vessel_type_svg");
        var trans = [];//转换数组
        trans["01"]="#b9eebf";trans["03"]="#b7bfee";
        trans["11"]="#76ee77";trans["12"]="#8586ee";
        trans["25"]="#ee2f4d";

        var code=[],dataset=[],label=[];
        <?php
        get_vessel_type_data();
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
                return trans[code[i]];
            })
            .attr("stroke","#ffe")
            .attr("d",function(d){
                return arc(d);   //调用弧生成器，得到路径值
            })
            .on("mouseover",function(){$(this).siblings().toggle(200)})
            .on("mouseout",function(){$(this).siblings().toggle(200)});

        arcs.append("text")
            .attr("transform",function(d){
                return "translate(" + arc.centroid(d) + ")";
            })
            .attr("text-anchor","middle")
            .attr("font-size","20px")
            .attr("font-weight","bold")
            .attr("fill","#444444")
            .text(function(d,i){
                return label[i];
            });

        arcs.append("text")
            .attr("transform",function(d){
                return "translate(" + arc.centroid(d) + ")";
            })
            .attr("text-anchor","middle")
            .attr("font-size","22px")
            .attr("font-weight","bolder")
            .attr("fill","#444444")
            .attr("display","none")
            .text(function(d,i){
                return d.data;
            });

    }
</script>
<?php
function get_vessel_nation_data() {
    db_OpenConn();
    $sql="SELECT t_base_vesinfo.CHNATIONCODE,t_code_nationcode.VCNATIONCNNAME,count(t_base_vesinfo.CHNATIONCODE) FROM t_base_vesinfo INNER JOIN pilotplan.t_code_nationcode ON t_base_vesinfo.CHNATIONCODE=t_code_nationcode.VCNATIONCODE GROUP BY CHNATIONCODE;";
    $result=db_Query($sql);
    $t=0;
    while($row = mysqli_fetch_assoc($result)) {
        echo "code[".$t."]=\"".$row["CHNATIONCODE"]."\";label[".$t."]=\"".$row["VCNATIONCNNAME"]."\";dataset[".$t."]=".$row["count(t_base_vesinfo.CHNATIONCODE)"].";\r\n";
        $t++;
    }
    db_CloseConn();
}
function get_vessel_type_data() {
    db_OpenConn();
    $sql="SELECT t_base_vesinfo.CHVESTYPECODE,t_code_vestypecode.VCVESTYPENAME,count(t_base_vesinfo.CHVESTYPECODE) FROM t_base_vesinfo INNER JOIN t_code_vestypecode ON t_code_vestypecode.CHVESTYPECODE=t_base_vesinfo.CHVESTYPECODE GROUP BY t_base_vesinfo.CHVESTYPECODE;";
    $result=db_Query($sql);
    $t=0;
    while($row = mysqli_fetch_assoc($result)) {
        echo "code[".$t."]=\"".$row["CHVESTYPECODE"]."\";label[".$t."]=\"".$row["VCVESTYPENAME"]."\";dataset[".$t."]=".$row["count(t_base_vesinfo.CHVESTYPECODE)"].";\r\n";
        $t++;
    }
    db_CloseConn();
}