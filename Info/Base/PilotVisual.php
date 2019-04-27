<script>
    $(document).ready(function(){pilotGradeGet(0);pilotAddrGet(0);$(".svg_container").show();});
    let delaytime=500,duration=800;
    //获取基础分级数据
    function pilotGradeGet(baseDelay) {
        let url="/Info/Base/PilotGradeQuery.php?d=1";
        let timer = d3.interval(function(){timer.stop();getObject(url,pilotGradeShow);},baseDelay+200);
    }
    //显示基础分级数据
    function pilotGradeShow(obj) {
        let dataset=obj.results,
            svg = d3.select("#PG .panel_content").append("svg").attr("id","pilot_grade_svg"),
            color = ["#ffaaaa","#ff8888","#ff6666"];
        let label=[],data=[];
        dataset.forEach(function(e) {
            label.push(e.label);
            data.push(e.data);
        });

        let height = $("#pilot_grade_svg").height(),
            arc = d3.arc().innerRadius(0).outerRadius(height*0.4),
            arc_big = d3.arc().innerRadius(0).outerRadius(height*0.45);

        let pie = d3.pie().sortValues(null);
        let piedata = pie(data);

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
            })
            .on("click",function(d,i){
                closePieR(svg,arcs,height*0.4,duration);
                $(this).siblings(".tips").remove();
                pilotGradeDetailGet(label[i],duration);
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
        let g = d3.select("#pilot_grade_svg").append("g").attr("class","tips"),lineH=4;
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
                return "transform:translate(38vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);font-size:"+lineH+"vw;"
            })
            .text(function(d,i){ return label[i]+"级" });

    }
    //获取细节分级数据
    function pilotGradeDetailGet(tGrade,baseDelay) {
        let url="/Info/Base/PilotGradeQuery.php?d=2&g="+tGrade;
        let timer = d3.interval(function(){timer.stop();getObject(url,pilotGradeDetailShow);},baseDelay+200);
    }
    //显示细节分级数据
    function pilotGradeDetailShow(obj) {
        let dataset=obj.results,
            svg = d3.select("#PG .panel_content").append("svg").attr("id","pilot_grade_svg"),
            color = ["#ffaaaa","#ff8888","#ff6666"];
        let label=[],data=[];
        dataset.forEach(function(e) {
            label.push(e.label);
            data.push(e.data);
        });

        let height = $("#pilot_grade_svg").height(),
            arc = d3.arc().innerRadius(0).outerRadius(height*0.4),
            arc_big = d3.arc().innerRadius(0).outerRadius(height*0.45);

        let pie = d3.pie().sortValues(null);
        let piedata = pie(data);
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
            })
            .on("click",function(){
                closePieR(svg,arcs,height*0.4,duration);
                $(this).siblings(".tips").remove();
                pilotGradeGet(duration);
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

        let g = d3.select("#pilot_grade_svg").append("g").attr("class","tips"),lineH=3.5;
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
                return "transform:translate(37.5vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);font-size:"+lineH+"vw;"
            })
            .text(function(d,i){ return label[i]+"级" });

    }

    //获取基础分地区数据
    function pilotAddrGet(baseDelay) {
        let url="/Info/Base/PilotAddrQuery.php?d=1";
        let timer = d3.interval(function(){timer.stop();getObject(url,pilotAddrShow);},baseDelay+200);
    }
    //显示基础分地区数据
    function pilotAddrShow(obj) {
        let dataset=obj.results,
            svg = d3.select("#PA .panel_content").append("svg").attr("id","pilot_addr_svg"),
            color = ["#4d4dff","#4fff4f"];
        let label=[],data=[];
        dataset.forEach(function(e) {
            label.push(e.label);
            data.push(e.data);
        });

        let height = $("#pilot_addr_svg").height(),
            arc = d3.arc().innerRadius(0).outerRadius(height*0.4),
            arc_big = d3.arc().innerRadius(0).outerRadius(height*0.45);

        let pie = d3.pie().sortValues(null);
        let piedata = pie(data);

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
            })
            .on("click",function(d,i){
                closePieR(svg,arcs,height*0.4,duration);
                $(this).siblings(".tips").remove();
                pilotAddrDetailGet(label[i],duration);
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
        let g = d3.select("#pilot_addr_svg").append("g").attr("class","tips"),lineH=3;
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
                return "transform:translate(37vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);font-size:"+lineH+"vw;"
            })
            .text(function(d,i){ return label[i]==="1"?"上海港":"洋山" });

    }
    //不同地区颜色表
    let addrColor=[["#4d4dff","#8080ff","#b3b3ff"],["#4fff4f","#82ff82","#b5ffb5"]];
    //获取细节分地区数据
    function pilotAddrDetailGet(tAddr,baseDelay) {
        let url="/Info/Base/PilotAddrQuery.php?d=2&a="+tAddr;
        let timer = d3.interval(function(){timer.stop();getObject(url,pilotAddrDetailShow,tAddr);},baseDelay+200);
    }
    //显示细节分地区数据
    function pilotAddrDetailShow(obj,addrCode) {
        let dataset=obj.results,
            svg = d3.select("#PA .panel_content").append("svg").attr("id","pilot_addr_svg"),
            color = addrColor[addrCode-1];
        let label=[],data=[];
        dataset.forEach(function(e) {
            label.push(e.label);
            data.push(e.data);
        });

        let height = $("#pilot_addr_svg").height(),
            arc = d3.arc().innerRadius(0).outerRadius(height*0.4),
            arc_big = d3.arc().innerRadius(0).outerRadius(height*0.45);

        let pie = d3.pie().sortValues(null);
        let piedata = pie(data);
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
            })
            .on("click",function(){
                closePieR(svg,arcs,height*0.4,duration);
                $(this).siblings(".tips").remove();
                pilotAddrGet(duration);
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

        let g = d3.select("#pilot_addr_svg").append("g").attr("class","tips"),lineH=3.5;
        g.selectAll(".tip_color")
            .data(piedata)
            .enter()
            .append("rect")
            .attr("class","tip_color")
            .attr("height",lineH + "vw")
            .attr("width",lineH * 4 / 3 + "vw")
            .attr("style",function(d,i){
                return "transform:translate(31.5vw,"+ (piedata.length>1?(3.15 + (25.2 - lineH) / (piedata.length - 1) * i):(15.75-lineH/2)) + "vw);fill:"+color[i]+";"
            });

        g.selectAll(".tip_text")
            .data(piedata)
            .enter()
            .append("text")
            .attr("class",function(d,i){return "tip_text t" + i})
            .attr("style",function(d,i){
                return "transform:translate(37.5vw,"+ ((piedata.length>1?(3.15 + (25.2 - lineH) / (piedata.length - 1) * i):(15.75-lineH/2)) + lineH / 2 + 0.3) + "vw);font-size:"+lineH+"vw;"
            })
            .text(function(d,i){ return label[i]+"级" });

    }

    function pilotAddrSVG() {
        let height = $("#pilot_addr_svg").height(),
            svg = d3.select("#pilot_addr_svg"),
            arc = d3.arc().innerRadius(0).outerRadius(height*0.4),
            arc_big = d3.arc().innerRadius(0).outerRadius(height*0.45),
            color = ["#77ff77","#7777ff","#ff7777"];

        let dataset=[],label=[];
        <?php
        get_pilot_addr_data();
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
                    .css("fill",color[i]);
            })
            .on("mouseout",function(d,i){
                d3.select(this).select("path").attr("d",arc(d));
                d3.select(this).select("text").attr("transform",function(d){
                    return "translate(" + arc.centroid(d) + ")";
                });
                $(this).siblings("g.tips").children("text.t" + i)
                    .css("fill","#ffe")
            })
            .on("click",function(){
                closePieR(svg,arcs,height*0.4,duration);
                pilotGradeGet(duration);
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

        let g = d3.select("#pilot_addr_svg g.tips"),lineH=3;
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
                return "transform:translate(36.5vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);font-size:"+lineH+"vw;"
            })
            .text(function(d,i){ return label[i]==="1"?"上海港":"洋山" });

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