<script>
    $(document).ready(function(){vesselNationSVG();vesselTypeSVG();vesselSizeSVG();$(".svg_container").show();});

    let delaytime=500,duration=800;

    function vesselNationSVG() {
        let height = $("#vessel_type_svg").height(),
            svg = d3.select("#vessel_nation_svg"),
            arc = d3.arc().innerRadius(0).outerRadius(height*0.4),
            arc_big = d3.arc().innerRadius(0).outerRadius(height*0.45);

        let trans = [];//国家颜色数组
        trans["ML"]="#eeec2c";trans["PA"]="#7777ee";trans["MY"]="#ee5e3f";
        trans["BS"]="#55cdee";trans["KH"]="#ee7b64";trans["KR"]="#ee527e";
        trans["CY"]="#ac67ee";

        let dataset=[],label=[],code=[];
        <?php
        get_vessel_nation_data();
        ?>
        let pie = d3.pie().sortValues(null);
        let piedata = pie(dataset);

        let arcs = svg.selectAll(".arc_g")
            .data(piedata)
            .enter()
            .append("g")
            .attr("class","arc_g")
            .attr("transform","translate("+ (height/2) +","+ (height/2) +")")
            .on("mouseover",function(d,i){
                d3.select(this).select("path").attr("d",arc_big(d));
                d3.select(this).select("text").attr("transform",function(d){
                    return "translate(" + arc_big.centroid(d) + ")";
                });
                $(this).siblings("g.tips").children("text.t" + i)
                    .css("fill",trans[code[i]]);
            })
            .on("mouseout",function(d,i){
                d3.select(this).select("path").attr("d",arc(d));
                d3.select(this).select("text").attr("transform",function(d){
                    return "translate(" + arc.centroid(d) + ")";
                });
                $(this).siblings("g.tips").children("text.t" + i)
                    .css("fill","#ffe");
            });

        arcs.append("path")
            .attr("fill",function(d,i){
                return trans[code[i]];
            })
            .attr("stroke","#ffe")
            .transition()
            .delay(delaytime)
            .duration(duration)
            .attrTween("d",function(d){
                let i = d3.interpolateNumber(0, 0.4);
                return function (t) {
                    let tArc = d3.arc().innerRadius(0).outerRadius(height*i(t));
                    return tArc(d);
                }
            });

        arcs.append("text")
            .attr("transform",function(d){
                return "translate(" + arc.centroid(d) + ")";
            })
            .attr("font-size","22px")
            .attr("font-weight","bolder")
            .attr("fill","#444444")
            .transition()
            .delay(delaytime+duration)
            .text(function(d){
                return d.data;
            });

        let g = d3.select("#vessel_nation_svg g.tips"),lineH=2.2;
        g.selectAll(".tip_color")
            .data(piedata)
            .enter()
            .append("rect")
            .attr("class","tip_color")
            .attr("height",lineH + "vw")
            .attr("width",lineH * 4 / 3 + "vw")
            .attr("style",function(d,i){
                return "transform:translate(31.5vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + "vw);fill:"+trans[code[i]]+";")
            });

        g.selectAll(".tip_text")
            .data(piedata)
            .enter()
            .append("text")
            .attr("class",function(d,i){return "tip_text t" + i})
            .attr("style",function(d,i){
                return "transform:translate(35.5vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);font-size:"+lineH+"vw;"
            })
            .text(function(d,i){ return label[i] });
    }

    function vesselTypeSVG() {
        let height = $("#vessel_type_svg").height(),
            svg = d3.select("#vessel_type_svg"),
            arc = d3.arc().innerRadius(0).outerRadius(height*0.4),
            arc_big = d3.arc().innerRadius(0).outerRadius(height*0.45);
        let trans = [];//转换数组
        trans["01"]="#e65c5c";trans["03"]="#e6e65c";
        trans["11"]="#5ce65c";trans["12"]="#5ce6e6";
        trans["25"]="#5c5ce6";

        let code=[],dataset=[],label=[];
        <?php
        get_vessel_type_data();
        ?>
        let pie = d3.pie().sortValues(null);
        let piedata = pie(dataset);

        let arcs = svg.selectAll(".arc_g")
            .data(piedata)
            .enter()
            .append("g")
            .attr("class","arc_g")
            .attr("transform","translate("+ (height/2) +","+ (height/2) +")")
            .on("mouseover",function(d,i){
                d3.select(this).select("path").attr("d",arc_big(d));
                d3.select(this).select("text").attr("transform",function(d){
                    return "translate(" + arc_big.centroid(d) + ")";
                });
                $(this).siblings("g.tips").children("text.t" + i)
                    .css("fill",trans[code[i]]);
            })
            .on("mouseout",function(d,i){
                d3.select(this).select("path").attr("d",arc(d));
                d3.select(this).select("text").attr("transform",function(d){
                    return "translate(" + arc.centroid(d) + ")";
                });
                $(this).siblings("g.tips").children("text.t" + i)
                    .css("fill","#ffe");
            });

        arcs.append("path")
            .attr("fill",function(d,i){
                return trans[code[i]];
            })
            .attr("stroke","#ffe")
            .transition()
            .delay(delaytime)
            .duration(duration)
            .attrTween("d",function(d){
                let i = d3.interpolateNumber(0, 0.4);
                return function (t) {
                    let tArc = d3.arc().innerRadius(0).outerRadius(height*i(t));
                    return tArc(d);
                }
            });

        arcs.append("text")
            .attr("transform",function(d){
                return "translate(" + arc.centroid(d) + ")";
            })
            .attr("font-size","22px")
            .attr("font-weight","bolder")
            .attr("fill","#444444")
            .transition()
            .delay(delaytime+duration)
            .text(function(d){
                return d.data;
            });

        let g = d3.select("#vessel_type_svg g.tips"),lineH=2.7;
        g.selectAll(".tip_color")
            .data(piedata)
            .enter()
            .append("rect")
            .attr("class","tip_color")
            .attr("height",lineH + "vw")
            .attr("width",lineH * 4 / 3 + "vw")
            .attr("style",function(d,i){
                return "transform:translate(31.5vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + "vw);fill:"+trans[code[i]]+";")
            });

        g.selectAll(".tip_text")
            .data(piedata)
            .enter()
            .append("text")
            .attr("class",function(d,i){return "tip_text t" + i})
            .attr("style",function(d,i){
                return "transform:translate(37vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);font-size:"+lineH+"vw;"
            })
            .text(function(d,i){ return label[i] });

    }

    function vesselSizeSVG() {
        let height = $("#vessel_size_svg").height(),
            svg = d3.select("#vessel_size_svg"),
            arc = d3.arc().innerRadius(0).outerRadius(height*0.4),
            arc_big = d3.arc().innerRadius(0).outerRadius(height*0.45),
            color = ["#652bd9","#7b4cd9","#906cd9","#a68dd9","#bcadd9"];

        let dataset=[0,0,0,0,0],data=[],label=["300米以上","250-300米","180-250米","150-180米","150米以下"];
        <?php
        get_vessel_size_data();
        ?>
        data.forEach(function(e) {
            if (e<150) {
                dataset[4]++;
            } else if (e<180) {
                dataset[3]++;
            } else if (e<250) {
                dataset[2]++;
            } else if (e<300) {
                dataset[1]++;
            } else {
                dataset[0]++;
            }
        });
        let pie = d3.pie().sortValues(null);
        let piedata = pie(dataset);

        let arcs = svg.selectAll(".arc_g")
            .data(piedata)
            .enter()
            .append("g")
            .attr("class","arc_g")
            .attr("transform","translate("+ (height/2) +","+ (height/2) +")")
            .on("mouseover",function(d,i){
                d3.select(this).select("path").attr("d",arc_big(d));
                d3.select(this).select("text").attr("transform",function(d){
                    return "translate(" + arc_big.centroid(d) + ")";
                });
                $(this).siblings("g.tips").children("text.t" + i)
                    .css("fill",color[i]);
            })
            .on("mouseout",function(d,i){
                d3.select(this).select("path").attr("d",arc(d));
                d3.select(this).select("text").attr("transform",function(d){
                    return "translate(" + arc.centroid(d) + ")";
                });
                $(this).siblings("g.tips").children("text.t" + i)
                    .css("fill","#ffe");
            });

        arcs.append("path")
            .attr("fill",function(d,i){
                return color[i];
            })
            .attr("stroke","#ffe")
            .transition()
            .delay(delaytime)
            .duration(duration)
            .attrTween("d",function(d){
                let i = d3.interpolateNumber(0, 0.4);
                return function (t) {
                    let tArc = d3.arc().innerRadius(0).outerRadius(height*i(t));
                    return tArc(d);
                }
            });

        arcs.append("text")
            .attr("transform",function(d){
                return "translate(" + arc.centroid(d) + ")";
            })
            .attr("font-size","22px")
            .attr("font-weight","bolder")
            .attr("fill","#444444")
            .transition()
            .delay(delaytime+duration)
            .text(function(d){
                return d.data;
            });

        let g = d3.select("#vessel_size_svg g.tips"),lineH=2.2;
        g.selectAll(".tip_color")
            .data(piedata)
            .enter()
            .append("rect")
            .attr("class","tip_color")
            .attr("height",lineH + "vw")
            .attr("width",lineH * 4 / 3 + "vw")
            .attr("style",function(d,i){
                return "transform:translate(31.5vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + "vw);fill:"+color[i]+";")
            });

        g.selectAll(".tip_text")
            .data(piedata)
            .enter()
            .append("text")
            .attr("class",function(d,i){return "tip_text t" + i})
            .attr("style",function(d,i){
                return "transform:translate(35.5vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);font-size:"+lineH+"vw;"
            })
            .text(function(d,i){ return label[i] });

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
function get_vessel_size_data() {
    db_OpenConn();
    $sql="SELECT NMVESLENGTH FROM t_base_vesinfo;";
    $result=db_Query($sql);
    $t=0;
    while($row = mysqli_fetch_assoc($result)) {
        echo "data[".$t."]=".$row["NMVESLENGTH"].";\r\n";
        $t++;
    }
    db_CloseConn();
}