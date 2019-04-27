function closePieR(svg,arcs,originalR,duration) {
    arcs.on("mouseover",null)
        .on("mouseout",null)
        .on("click",null);
    arcs.select("text").remove();
    arcs.select("path")
        .transition()
        .on("end",function() {svg.remove();})
        .duration(duration)
        .attrTween("d",function(d){
            let i = d3.interpolateNumber(originalR, 0);
            return function (t) {
                let tArc = d3.arc().innerRadius(0).outerRadius(i(t));
                return tArc(d);
            }
        });
}