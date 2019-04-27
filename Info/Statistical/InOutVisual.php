<script>
    $(document).ready(function(){CountDataGet();$(".svg_container").show();});

    let dataset,dataM=[],mon=[],dataY=[],year=[];

    function CountDataGet() {
        let url="/Info/Statistical/InOutQuery.php";
        getObject(url,yearlyCountDataShow);
    }
    function yearlyCountDataShowB() {
        $("#inout_monthly_svg").children().remove();
        let svg = d3.select("#inout_monthly_svg");

        let min = Math.floor(d3.min(dataY)/100)*100-50,
            max = Math.ceil(d3.max(dataY)/100)*100+50,
            width = document.body.clientWidth,
            height = document.body.clientHeight,
            margin = 50,
            xScale = d3.scaleOrdinal(d3.timeYears(new Date(2016,0,1),new Date()),d3.range(margin, width - margin,width/(d3.timeYear.count(new Date(2016,0,15),new Date())+1))),
            yScale = d3.scaleLinear([min,max],[height - margin, margin]),
            xAxis = d3.axisBottom(xScale).tickFormat(d3.timeFormat("%y")),
            yAxis = d3.axisLeft(yScale);
        svg.attr("width",width).attr("height",height);
        d3.select("#label1").attr("transform","translate("+(margin+5)+","+(margin-15)+")");
        d3.select("#label2").attr("transform","translate("+(width-margin)+","+(height-margin+18)+")");

        let duration=1300,sum=-duration,length=dataY.length-1;
        let linearGra = svg.append("defs")
            .append("linearGradient")
            .attr("id","lineFill")
            .attr("y1","0%")
            .attr("y2","0%")
            .attr("x1","0%")
            .attr("x2","100%");
        let GraStart = linearGra.append("stop")
            .attr("style","stop-color:#ffe;stop-opacity:1;");
        let GraEnd = linearGra.append("stop")
            .attr("style","stop-color:#ffe;stop-opacity:0;");

        svg.append("svg:g")
            .call(xAxis)
            .attr("class","xAxis")
            .attr("transform","translate(0,"+(height-margin)+")");
        svg.append("svg:g")
            .call(yAxis)
            .attr("class","yAxis")
            .attr("transform","translate("+margin+",0)");
        let parseTime = d3.timeParse("%Y");
        let lineGen = d3.line()
            .x(function(d) {
                return xScale(parseTime(d[0]));
            })
            .y(function(d) {
                return yScale(d[1]);
            });
        svg.append("svg:path")
            .attr("d", lineGen(year))
            .attr("fill", "none")
            .attr("stroke","url(#lineFill)")
            .attr("stroke-width",1);

        let points = svg.append("g")
            .attr("class", "dots");

        points.selectAll(".dot")
            .data(year)
            .enter()
            .append("circle")
            .attr("class", "dot")
            .attr("r", "0")
            .attr("fill", "#ffe")
            .attr("cx", function (d) {
                return xScale(parseTime(d[0]));
            })
            .attr("cy", function (d) {
                return yScale(d[1]);
            })
            .on("mouseover", function (d) {
                let t = d3.select(this),th=46,tw=80;
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
                    .attr("transform","translate("+t.attr("cx")+","+(parseFloat(t.attr("cy"))-22)+")")
                    .attr("text-anchor","middle")
                    .attr("font-size","17px")
                    .attr("fill","#ffe")
                    .attr("class","tooltip")
                    .text(d[1]+"艘");
                svg.append('text')
                    .attr("transform","translate("+t.attr("cx")+","+(parseFloat(t.attr("cy"))-41)+")")
                    .attr("text-anchor","middle")
                    .attr("font-size","17px")
                    .attr("fill","#ffe")
                    .attr("class","tooltip")
                    .text(d[0]+"年");
                t.attr("r", "6").attr("fill","#8484ef");
            })
            .on("mouseout", function () {
                $(".tooltip").remove();
                d3.select(this)
                    .attr("r", "3")
                    .attr("fill","#ffe");
            })
            .on("click",function(d){monthlyCountDataShow(d[0])})
            .transition()
            .delay(function(){
                sum+=duration;
                return sum;
            })
            .duration(800)
            .attrTween("r",function(){
                let i = d3.interpolateNumber(0, 6);
                return function (t) {
                    if(t<0.5) {
                        return 0;
                    }
                    else {
                        return i(t-0.5);
                    }
                }
            })
            .on("start",function(d,i){
                GraStart.transition()
                    .duration(duration-800)
                    .attrTween("offset",function(){
                        let j = d3.interpolateNumber(100/length*(i-1), 100/length*i-0.01);
                        return function (t) {
                            return j(t)+"%";
                        }
                    });
                GraEnd.transition()
                    .duration(duration-300)
                    .attrTween("offset",function(){
                        let j = d3.interpolateNumber(100/length*(i-1)+0.01, 100/length*i);
                        return function (t) {
                            return j(t)+"%";
                        }
                    })
            })
    }
    function yearlyCountDataShow(obj) {
        let svg = d3.select("#inout_monthly_svg");

        dataset=obj.results;
        dataset.forEach(function(e) {
            mon.push(e.label);
            dataM.push(e.data);
        });
        let temp=[];
        for(let i = 0,cYear="";i<dataM.length;i++) {
            let y = mon[i].substring(0,4);
            if(cYear!==y) {
                if(cYear!=="") {
                    year.push(temp);
                    dataY.push(temp[1]);
                }
                cYear=y;
                temp=[y,parseInt(dataM[i])];
            }
            else{
                temp[1]+=parseInt(dataM[i]);
            }
        }
        year.push(temp);
        dataY.push(temp[1]);

        let min = Math.floor(d3.min(dataY)/100)*100-50,
            max = Math.ceil(d3.max(dataY)/100)*100+50,
            width = document.body.clientWidth,
            height = document.body.clientHeight,
            margin = 50,
            xScale = d3.scaleOrdinal(d3.timeYears(new Date(2016,0,1),new Date()),d3.range(margin, width - margin,width/(d3.timeYear.count(new Date(2016,0,15),new Date())+1))),
            yScale = d3.scaleLinear([min,max],[height - margin, margin]),
            xAxis = d3.axisBottom(xScale).tickFormat(d3.timeFormat("%y")),
            yAxis = d3.axisLeft(yScale);
        svg.attr("width",width).attr("height",height);
        d3.select("#label1").attr("transform","translate("+(margin+5)+","+(margin-15)+")");
        d3.select("#label2").attr("transform","translate("+(width-margin)+","+(height-margin+18)+")");

        let duration=1300,sum=-duration,length=dataY.length-1;
        let linearGra = svg.append("defs")
            .append("linearGradient")
            .attr("id","lineFill")
            .attr("y1","0%")
            .attr("y2","0%")
            .attr("x1","0%")
            .attr("x2","100%");
        let GraStart = linearGra.append("stop")
            .attr("style","stop-color:#ffe;stop-opacity:1;");
        let GraEnd = linearGra.append("stop")
            .attr("style","stop-color:#ffe;stop-opacity:0;");

        svg.append("svg:g")
            .call(xAxis)
            .attr("class","xAxis")
            .attr("transform","translate(0,"+(height-margin)+")");
        svg.append("svg:g")
            .call(yAxis)
            .attr("class","yAxis")
            .attr("transform","translate("+margin+",0)");
        let parseTime = d3.timeParse("%Y");
        let lineGen = d3.line()
            .x(function(d) {
                return xScale(parseTime(d[0]));
            })
            .y(function(d) {
                return yScale(d[1]);
            });
        svg.append("svg:path")
            .attr("d", lineGen(year))
            .attr("fill", "none")
            .attr("stroke","url(#lineFill)")
            .attr("stroke-width",1);

        let points = svg.append("g")
            .attr("class", "dots");

        points.selectAll(".dot")
            .data(year)
            .enter()
            .append("circle")
            .attr("class", "dot")
            .attr("r", "0")
            .attr("fill", "#ffe")
            .attr("cx", function (d) {
                return xScale(parseTime(d[0]));
            })
            .attr("cy", function (d) {
                return yScale(d[1]);
            })
            .on("mouseover", function (d) {
                let t = d3.select(this),th=46,tw=80;
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
                    .attr("transform","translate("+t.attr("cx")+","+(parseFloat(t.attr("cy"))-22)+")")
                    .attr("text-anchor","middle")
                    .attr("font-size","17px")
                    .attr("fill","#ffe")
                    .attr("class","tooltip")
                    .text(d[1]+"艘");
                svg.append('text')
                    .attr("transform","translate("+t.attr("cx")+","+(parseFloat(t.attr("cy"))-41)+")")
                    .attr("text-anchor","middle")
                    .attr("font-size","17px")
                    .attr("fill","#ffe")
                    .attr("class","tooltip")
                    .text(d[0]+"年");
                t.attr("r", "6").attr("fill","#8484ef");
            })
            .on("mouseout", function () {
                $(".tooltip").remove();
                d3.select(this)
                    .attr("r", "3")
                    .attr("fill","#ffe");
            })
            .on("click",function(d){monthlyCountDataShow(d[0])})
            .transition()
            .delay(function(){
                sum+=duration;
                return sum;
            })
            .duration(800)
            .attrTween("r",function(){
                let i = d3.interpolateNumber(0, 6);
                return function (t) {
                    if(t<0.5) {
                        return 0;
                    }
                    else {
                        return i(t-0.5);
                    }
                }
            })
            .on("start",function(d,i){
                GraStart.transition()
                    .duration(duration-800)
                    .attrTween("offset",function(){
                        let j = d3.interpolateNumber(100/length*(i-1), 100/length*i-0.01);
                        return function (t) {
                            return j(t)+"%";
                        }
                    });
                GraEnd.transition()
                    .duration(duration-300)
                    .attrTween("offset",function(){
                        let j = d3.interpolateNumber(100/length*(i-1)+0.01, 100/length*i);
                        return function (t) {
                            return j(t)+"%";
                        }
                    })
            })
    }
    function monthlyCountDataShow(tYear) {
        $("#inout_monthly_svg").children().remove();
        let svg = d3.select("#inout_monthly_svg");

        let tDataM=[],tMon=[];
        for(let i = 0;i<dataM.length;i++) {
            let y = mon[i].substring(0,4);
            if(tYear===y) {
                tDataM.push(parseInt(dataM[i]));
                tMon.push(mon[i]);
            }
        }

        let parseTime = d3.timeParse("%Y-%m"),
            min = Math.floor(d3.min(tDataM)/100)*100-50,
            max = Math.ceil(d3.max(tDataM)/100)*100+50,
            width = document.body.clientWidth,
            height = document.body.clientHeight,
            margin = 50,
            xScale = d3.scaleOrdinal(d3.timeMonths(new Date(parseInt(tYear)-1,11,1),new Date(parseInt(tYear),11,15)),d3.range(margin, width - margin,width/(d3.timeMonth.count(new Date(parseInt(tYear)-1,11,15),new Date(parseInt(tYear),11,15))+3))),
            yScale = d3.scaleLinear([min,max],[height - margin, margin]),
            xAxis = d3.axisBottom(xScale).tickFormat(d3.timeFormat("%y/%m")),
            yAxis = d3.axisLeft(yScale);
        svg.attr("width",width).attr("height",height);
        d3.select("#label1").attr("transform","translate("+(margin+5)+","+(margin-15)+")");
        d3.select("#label2").attr("transform","translate("+(width-margin)+","+(height-margin+18)+")");

        let duration=1300,sum=-duration,length=tDataM.length-1;
        let linearGra = svg.append("defs")
            .append("linearGradient")
            .attr("id","lineFill")
            .attr("y1","0%")
            .attr("y2","0%")
            .attr("x1","0%")
            .attr("x2","100%");
        let GraStart = linearGra.append("stop")
            .attr("style","stop-color:#ffe;stop-opacity:1;");
        let GraEnd = linearGra.append("stop")
            .attr("style","stop-color:#ffe;stop-opacity:0;");

        svg.append("svg:g")
            .call(xAxis)
            .attr("class","xAxis")
            .attr("transform","translate(0,"+(height-margin)+")");
        svg.append("svg:g")
            .call(yAxis)
            .attr("class","yAxis")
            .attr("transform","translate("+margin+",0)");
        let lineGen = d3.line()
            .x(function(d,i) {
                return xScale(parseTime(tMon[i]));
            })
            .y(function(d) {
                return yScale(d);
            });
        svg.append("svg:path")
            .attr("d", lineGen(tDataM))
            .attr("fill", "none")
            .attr("stroke","url(#lineFill)")
            .attr("stroke-width",1);

        let points = svg.append("g")
            .attr("class", "dots");

        points.selectAll(".dot")
            .data(tDataM)
            .enter()
            .append("circle")
            .attr("class", "dot")
            .attr("r", "0")
            .attr("fill", "#ffe")
            .attr("cx", function (d,i) {
                return xScale(parseTime(tMon[i]));
            })
            .attr("cy", function (d) {
                return yScale(d);
            })2w
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
                    .attr("transform","translate("+t.attr("cx")+","+(parseFloat(t.attr("cy"))-20)+")")
                    .attr("text-anchor","middle")
                    .attr("font-size","17px")
                    .attr("fill","#ffe")
                    .attr("class","tooltip")
                    .text(tDataM[i]+"艘");
                svg.append('text')
                    .attr("transform","translate("+t.attr("cx")+","+(parseFloat(t.attr("cy"))-37)+")")
                    .attr("text-anchor","middle")
                    .attr("font-size","17px")
                    .attr("fill","#ffe")
                    .attr("class","tooltip")
                    .text(tMon[i]);
                t.attr("r", "6").attr("fill","#8484ef");
            })
            .on("mouseout", function () {
                $(".tooltip").remove();
                d3.select(this)
                    .attr("r", "3")
                    .attr("fill","#ffe");
            })
            .on("click", function() {yearlyCountDataShowB()})
            .transition()
            .delay(function(){
                sum+=duration;
                return sum;
            })
            .duration(800)
            .attrTween("r",function(){
                let i = d3.interpolateNumber(0, 6);
                return function (t) {
                    if(t<0.5) {
                        return 0;
                    }
                    else {
                        return i(t-0.5);
                    }
                }
            })
            .on("start",function(d,i){
                GraStart.transition()
                    .duration(duration-800)
                    .attrTween("offset",function(){
                        let j = d3.interpolateNumber(100/length*(i-1), 100/length*i-0.01);
                        return function (t) {
                            return j(t)+"%";
                        }
                    });
                GraEnd.transition()
                    .duration(duration-300)
                    .attrTween("offset",function(){
                        let j = d3.interpolateNumber(100/length*(i-1)+0.01, 100/length*i);
                        return function (t) {
                            return j(t)+"%";
                        }
                    })
            })
    }
</script>