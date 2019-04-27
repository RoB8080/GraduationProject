$(document).ready(function (){visualMap()});

function visualMap() {
    let width = document.body.clientWidth,
        height = document.body.clientHeight;
    width = (width/height>7/6)?height*7/6:width;
    height = (width/height<7/6)?width/7*6:height;
    let svg = d3.select("#map_svg").attr("height", height).attr("width", width);
    let g = svg.append("g");
    let projection = d3.geoMercator()
        .translate([width / 2, height / 2])
        .scale(width * 53)
        .rotate([-121.9,-31.02]);
    let path = d3.geoPath()
        .projection(projection);
    g.append("path")
        .datum({type: "Sphere"})
        .attr("id", "sphere")
        .attr("d", path);
    d3.json("../../geo/sh_land.json")
        .then(function (world) {
            let inner_g = g.append("g").attr("class", "ig");
            inner_g.append("path")
                .datum(topojson.merge(world, world.objects.collection.geometries))
                .attr("class", "land")
                .attr("d", path);
        });
}

function visualLocation() {

}
