let xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
{
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        obj=JSON.parse(xmlhttp.responseText);
        visualize(obj.dataset,obj.extent);
    }
};
xmlhttp.open("GET","/Info/Statistical/VesselSizeQuery.php",true);
xmlhttp.send();

function visualize(dataset,extent){
    let width = document.body.clientWidth,
        height = document.body.clientHeight,
        tpWidth = 140,
        max = Math.ceil(extent/100)*100,
        margin = 50,
        tHeight = height- 2 * margin,
        svg = d3.select("#vessel_size_svg"),
        xScale = d3.scaleBand(d3.timeMonths(new Date(2016,0,1),new Date()),[margin, width - margin]).paddingInner(0).paddingOuter(0),
        yScale = d3.scaleLinear([0,max],[height - margin, margin]),
        xAxis = d3.axisBottom(xScale).tickFormat(d3.timeFormat("%y/%m")),
        yAxis = d3.axisLeft(yScale);
    svg.attr("width",width).attr("height",height);
    d3.select("#tipsBackground").attr("transform","translate("+(width-margin-tpWidth)+","+(margin)+")");
    d3.select("#tipsRect5").attr("transform","translate("+(width-margin-tpWidth+5)+","+(margin+5)+")");
    d3.select("#tipsLabel5").attr("transform","translate("+(width-margin-tpWidth+39)+","+(margin+13)+")");
    d3.select("#tipsRect4").attr("transform","translate("+(width-margin-tpWidth+5)+","+(margin+25)+")");
    d3.select("#tipsLabel4").attr("transform","translate("+(width-margin-tpWidth+39)+","+(margin+33)+")");
    d3.select("#tipsRect3").attr("transform","translate("+(width-margin-tpWidth+5)+","+(margin+45)+")");
    d3.select("#tipsLabel3").attr("transform","translate("+(width-margin-tpWidth+39)+","+(margin+53)+")");
    d3.select("#tipsRect2").attr("transform","translate("+(width-margin-tpWidth+5)+","+(margin+65)+")");
    d3.select("#tipsLabel2").attr("transform","translate("+(width-margin-tpWidth+39)+","+(margin+73)+")");
    d3.select("#tipsRect1").attr("transform","translate("+(width-margin-tpWidth+5)+","+(margin+85)+")");
    d3.select("#tipsLabel1").attr("transform","translate("+(width-margin-tpWidth+39)+","+(margin+93)+")");
    svg.append("svg:g")
        .call(xAxis)
        .attr("transform","translate(0,"+(height-margin)+")")
        .attr("class","xAxis");
    svg.append("svg:g")
        .call(yAxis)
        .attr("transform","translate("+(margin-1)+",0)")
        .attr("class","yAxis");
    let parseTime = d3.timeParse("%Y-%m");
    let g = svg.append("g");
    let delaytime=1000,duration=800,sum=[];

    g.selectAll(".rect_1")
        .data(dataset)
        .enter()
        .append("rect")
        .attr("class","rect_1")
        .attr("x",function(d){
            return xScale(parseTime(d.mon));
        })
        .attr("width", xScale.bandwidth())
        .transition()
        .delay(delaytime)
        .duration(duration)
        .attrTween("height", function(d){
            let i = d3.interpolateNumber(0, tHeight - yScale(d.count[0])+ margin);
            return function (t) {
                return i(t);
            }
        })
        .attrTween("y", function(d,i){
            let j = d3.interpolateNumber(tHeight + margin,yScale(d.count[0]));
            sum[i]=d.count[0];
            return function (t) {
                return j(t);
            }
        });
    delaytime += duration;
    g.selectAll(".rect_2")
        .data(dataset)
        .enter()
        .append("rect")
        .attr("class","rect_2")
        .attr("x",function(d){
            return xScale(parseTime(d.mon));
        })
        .attr("width", xScale.bandwidth())
        .transition()
        .delay(delaytime)
        .duration(duration)
        .attrTween("height", function(d){
            let i = d3.interpolateNumber(0, tHeight - yScale(d.count[1])+ margin);
            return function (t) {
                return i(t);
            }
        })
        .attrTween("y", function(d,i){
            let j = d3.interpolateNumber(yScale(sum[i]),yScale(sum[i]+d.count[1]));
            sum[i]+=d.count[1];
            return function (t) {
                return j(t);
            }
        });
    delaytime += duration;
    g.selectAll(".rect_3")
        .data(dataset)
        .enter()
        .append("rect")
        .attr("class","rect_3")
        .attr("x",function(d){
            return xScale(parseTime(d.mon));
        })
        .attr("width", xScale.bandwidth())
        .transition()
        .delay(delaytime)
        .duration(duration)
        .attrTween("height", function(d){
            let i = d3.interpolateNumber(0, tHeight - yScale(d.count[2])+ margin);
            return function (t) {
                return i(t);
            }
        })
        .attrTween("y", function(d,i){
            let j = d3.interpolateNumber(yScale(sum[i]),yScale(sum[i]+d.count[2]));
            sum[i]+=d.count[2];
            return function (t) {
                return j(t);
            }
        });
    delaytime += duration;
    g.selectAll(".rect_4")
        .data(dataset)
        .enter()
        .append("rect")
        .attr("class","rect_4")
        .attr("x",function(d){
            return xScale(parseTime(d.mon));
        })
        .attr("width", xScale.bandwidth())
        .transition()
        .delay(delaytime)
        .duration(duration)
        .attrTween("height", function(d){
            let i = d3.interpolateNumber(0, tHeight - yScale(d.count[3])+ margin);
            return function (t) {
                return i(t);
            }
        })
        .attrTween("y", function(d,i){
            let j = d3.interpolateNumber(yScale(sum[i]),yScale(sum[i]+d.count[3]));
            sum[i]+=d.count[3];
            return function (t) {
                return j(t);
            }
        });
    delaytime += duration;
    g.selectAll(".rect_5")
        .data(dataset)
        .enter()
        .append("rect")
        .attr("class","rect_5")
        .attr("x",function(d){
            return xScale(parseTime(d.mon));
        })
        .attr("width", xScale.bandwidth())
        .transition()
        .delay(delaytime)
        .duration(duration)
        .attrTween("height", function(d){
            let i = d3.interpolateNumber(0, tHeight - yScale(d.count[4])+ margin);
            return function (t) {
                return i(t);
            }
        })
        .attrTween("y", function(d,i){
            let j = d3.interpolateNumber(yScale(sum[i]),yScale(sum[i]+d.count[4]));
            return function (t) {
                return j(t);
            }
        });
    let t = $(".tipsG");
    $("#vessel_size_svg").remove(".tipsG").append(t);
    $(".svg_container").show();
}