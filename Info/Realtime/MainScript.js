$(document).ready(function(){
    visualizeAll(true);
    d3.interval(function(){visualizeAll(false)},6000);
});

var aPG;
function visualizeAll(isInit) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            obj=JSON.parse(xmlhttp.responseText);
            if(isInit) {
                aPG = new AvailablePilotGrade(obj.results.apg);
                visualizePilotState(obj.results.ps);
            }
            else {
                aPG.refresh(obj.results.apg);
            }
        }
    };
    xmlhttp.open("GET","/Info/Realtime/MainQuery.php",true);
    xmlhttp.send();
}

class AvailablePilotGrade {
    //构造函数，初次生成
    constructor(dataset) {
        this.color = ["#f03232","#f06262","#f07a7a","#f09292","#f0aaaa","#f0c2c2"];
        this.svg = d3.select("#available_pilot_grade");
        this.tpg = d3.select("#available_pilot_grade g.tips");
        this.pie = d3.pie().sortValues(null);
        this.lineH = 2.5;
        this.arc = d3.arc().padAngle(0.04);

        //初次生成图表
        let label=[],data=[];
        dataset.forEach(function(e) {
            label.push(e.label);
            data.push(e.data);
        });

        let color = this.color,
            svg = this.svg,
            pie = this.pie,
            height = $("#available_pilot_grade").height(),
            total = d3.sum(data),
            piedata = pie(data),
            arc = this.arc.innerRadius(height*0.25).outerRadius(height*0.4);

        this.pPiedata = piedata;

        let sum = 0;
        piedata.forEach(function (d, i) {
            d.color = color[i];
            d.label= label[i];
            d.position = i;
            d.duration = 3000 * (d.data / d3.sum(data));
            d.delaytime = sum;
            sum += d.duration;
        });

        let arcs = svg.selectAll(".arc_g")
            .data(piedata)
            .enter()
            .append("g")
            .attr("class","arc_g")
            .attr("transform","translate("+ (height/2) +","+ (height/2) +")")
            .on("mouseover",function(d,i){$(this).siblings("g.tips").children("text.t" + i).css("fill",d.color)})
            .on("mouseout",function(d,i){$(this).siblings("g.tips").children("text.t" + i).css("fill","#ffe")});

        arcs.append("path")
            .attr("class","arc_path")
            .attr("fill",function(d,i){
                return d.color;
            })
            .attr("stroke","#ffe")
            .transition()
            .delay(function (d) {
                return d.delaytime;
            })
            .duration(function (d) {
                return d.duration;
            })
            .attrTween("d", function (d) {
                let i = d3.interpolateNumber(d.startAngle, d.endAngle);
                return function (t) {
                    d.endAngle = i(t);
                    return arc(d);
                }
            });

        arcs.append("text")
            .attr("class","arc_text")
            .attr("transform",function(d){
                return "translate(" + arc.centroid(d) + ")";
            })
            .attr("fill","#444444")
            .transition()
            .delay(function (d) {
                return d.delaytime+d.duration+100;
            })
            .text(function(d){
                return d.data;
            });

        svg.append("text")
            .attr("class","pie_sum")
            .attr("transform","translate(" + (height/2) +","+ (height/2) + ")")
            .text("共"+total+"人可用");

        let g = this.tpg,lineH=this.lineH;
        g.selectAll(".tip_color")
            .data(piedata)
            .enter()
            .append("rect")
            .attr("class","tip_color")
            .attr("height",lineH + "vw")
            .attr("width",lineH * 4 / 3 + "vw")
            .attr("style",function(d,i){
                return "transform:translate(34vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + "vw);fill:"+d.color+";")
            });

        g.selectAll(".tip_text")
            .data(piedata)
            .enter()
            .append("text")
            .attr("class",function(d,i){return "tip_text t" + i})
            .attr("style",function(d,i){
                return "transform:translate(39vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);"
            })
            .text(function(d){ return d.label });
    }
    //检查是否相同
    check(a,b) {
        let flag=false;
        a.forEach(function (d, i) {
            flag=(flag||(a[i].data!==b[i].data));
        });
        return flag;
    }
    //刷新图像
    refresh(dataset) {
        let label=[],data=[];
        dataset.forEach(function(e) {
            label.push(e.label);
            data.push(e.data);
        });

        let color = this.color,
            svg = this.svg,
            pie = this.pie,
            height = $("#available_pilot_grade").height(),
            total = d3.sum(data),
            piedata = pie(data),
            pPiedata = this.pPiedata,
            arc = this.arc.innerRadius(height*0.25).outerRadius(height*0.4);



        if(this.check(piedata,pPiedata)){
            piedata.forEach(function (d, i) {
                d.color = color[i];
                d.label= label[i];
                d.position = i;
                d.duration = 1000;
            });

            let arcs = svg.selectAll(".arc_g").data(piedata);
            arcs.selectAll(".arc_path")
                .transition()
                .duration(1000)
                .attrTween("d", function (d) {
                    let j = d3.interpolateNumber(pPiedata[d.index].startAngle,piedata[d.index].startAngle),
                        k= d3.interpolateNumber(pPiedata[d.index].endAngle,piedata[d.index].endAngle);
                    return function (t) {
                        d.startAngle = j(t);
                        d.endAngle = k(t);
                        return arc(d);
                    }
                });

            arcs.selectAll(".arc_text")
                .text("")
                .attr("transform",function(d){
                    return "translate(" + arc.centroid(piedata[d.index]) + ")";
                })
                .transition()
                .delay(1000)
                .text(function(d){
                    return piedata[d.index].data;
                });

            this.pPiedata = piedata;

            svg.select(".pie_sum")
                .attr("transform","translate(" + (height/2) +","+ (height/2) + ")")
                .text("共"+total+"人可用");

        }
    }

}

//原 分级函数
function visualizeAvailablePilotGrade(dataset){
    let label=[],data=[];
    dataset.forEach(function(e) {
        label.push(e.label);
        data.push(e.data);
    });

    let total = d3.sum(data),
        color = ["#f03232","#f06262","#f07a7a","#f09292","#f0aaaa","#f0c2c2"],
        svg = d3.select("#available_pilot_grade"),
        height = $("#available_pilot_grade").height(),
        pie = d3.pie().sortValues(null),
        piedata = pie(data),
        outerRadius = height*0.4,
        innerRadius = height*0.25,
        arc = d3.arc().innerRadius(innerRadius).outerRadius(outerRadius).padAngle(0.04);

    let sum = 0;
    piedata.forEach(function (d, i) {
        d.color = color[i];
        d.label= label[i];
        d.position = i;
        d.duration = 3000 * (d.data / d3.sum(data));
        d.delaytime = sum;
        sum += d.duration;
    });

    let arcs = svg.selectAll("g")
        .data(piedata)
        .enter()
        .append("g")
        .attr("transform","translate("+ (height/2) +","+ (height/2) +")");

    arcs.append("path")
        .attr("class","arc_path")
        .attr("fill",function(d){
            return d.color;
        })
        .attr("stroke","#ffe")
        .on("mouseover",function(d,i){$(this).parent().siblings("g.tips").children("text.t" + i).css("font-weight","bold")})
        .on("mouseout",function(d,i){$(this).parent().siblings("g.tips").children("text.t" + i).css("font-weight","normal")})
        .transition()
        .delay(function (d) {
            return d.delaytime;
        })
        .duration(function (d) {
            return d.duration;
        })
        .attrTween("d", function (d) {
            let i = d3.interpolate(d.startAngle, d.endAngle);
            return function (t) {
                d.endAngle = i(t);
                return arc(d);
            }
        });

    arcs.append("text")
        .attr("class","arc_text")
        .attr("transform",function(d){
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("fill","#444444")
        .transition()
        .delay(function (d) {
            return d.delaytime+d.duration+100;
        })
        .text(function(d){
            return d.data;
        });

    svg.append("text")
        .attr("class","pie_sum")
        .attr("transform","translate(" + (height/2) +","+ (height/2) + ")")
        .text("共"+total+"人可用");

    let g = svg.append("g").attr("class","tips"),lineH=2.5;
    g.selectAll(".tip_color")
        .data(piedata)
        .enter()
        .append("rect")
        .attr("class","tip_color")
        .attr("height",lineH + "vw")
        .attr("width",lineH * 4 / 3 + "vw")
        .attr("style",function(d,i){
            return "transform:translate(37vw,"+(3.35 + (26.8 - lineH) / (piedata.length - 1) * i + "vw);fill:"+d.color+";")
        });

    g.selectAll(".tip_text")
        .data(piedata)
        .enter()
        .append("text")
        .attr("class",function(d,i){return "tip_text t" + i})
        .attr("style",function(d,i){
            return "transform:translate(42vw,"+(3.35 + (26.8 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);"
        })
        .text(function(d){ return d.label });
}

function visualizePilotState(dataset){
    let label=[],data=[];
    dataset.forEach(function(e) {
        label.push(e.label);
        data.push(e.data);
    });

    let total = d3.sum(data),
        color = [
            "#f03232","#f07132","#f0b132","#f0f032",
            "#b1f032","#71f032","#32f032","#32f071",
            "#32f0b1","#32f0f0","#32b1f0","#3271f0",
            "#3232f0","#7132f0","#b132f0","#f032f0",
        ],
        svg = d3.select("#pilot_state"),
        height = $("#pilot_state").height(),
        pie = d3.pie().sortValues(null),
        piedata = pie(data),
        outerRadius = height*0.4,
        innerRadius = height*0.25,
        arc = d3.arc().innerRadius(innerRadius).outerRadius(outerRadius).padAngle(0.04);

    let sum = 0;
    piedata.forEach(function (d, i) {
        d.color = color[i];
        d.label= label[i];
        d.position = i;
        d.duration = 3000 * (d.data / d3.sum(data));
        d.delaytime = sum;
        sum += d.duration;
    });

    let arcs = svg.selectAll(".arc_g")
        .data(piedata)
        .enter()
        .append("g")
        .attr("class","arc_g")
        .attr("transform","translate("+ (height/2) +","+ (height/2) +")")
        .on("mouseover",function(d,i){$(this).siblings("g.tips").children("text.t" + i).css("fill",d.color)})
        .on("mouseout",function(d,i){$(this).siblings("g.tips").children("text.t" + i).css("fill","#ffe")});

    arcs.append("path")
        .attr("class","arc_path")
        .attr("fill",function(d){
            return d.color;
        })
        .attr("stroke","#ffe")
        .transition()
        .delay(function (d) {
            return d.delaytime;
        })
        .duration(function (d) {
            return d.duration;
        })
        .attrTween("d", function (d) {
            let i = d3.interpolate(d.startAngle, d.endAngle);
            return function (t) {
                d.endAngle = i(t);
                return arc(d);
            }
        });

    arcs.append("text")
        .attr("class","arc_text")
        .attr("transform",function(d){
            return "translate(" + arc.centroid(d) + ")";
        })
        .attr("fill","#444444")
        .transition()
        .delay(function (d) {
            return d.delaytime+d.duration+100;
        })
        .text(function(d){
            return d.data;
        });

    svg.append("text")
        .attr("class","pie_sum")
        .attr("transform","translate(" + (height/2) +","+ (height/2) + ")")
        .text();

    let g = svg.append("g").attr("class","tips"),lineH=1.6;
    g.selectAll(".tip_color")
        .data(piedata)
        .enter()
        .append("rect")
        .attr("class","tip_color")
        .attr("height",lineH + "vw")
        .attr("width",lineH * 4 / 3 + "vw")
        .attr("style",function(d,i){
            return "transform:translate(35.5vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + "vw);fill:"+d.color+";")
        });

    g.selectAll(".tip_text")
        .data(piedata)
        .enter()
        .append("text")
        .attr("class",function(d,i){return "tip_text t"+i})
        .attr("style",function(d,i){
            return "transform:translate(39vw,"+(3.15 + (25.2 - lineH) / (piedata.length - 1) * i + lineH / 2 + 0.3 ) + "vw);"
        })
        .text(function(d){ return d.label });
}