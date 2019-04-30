let current_page=1,delay=3000,duration=2000;
$(document).ready(function(){enterSystem()});
function selectPage(num) {
    $("#li_"+current_page).removeClass("selected");
    current_page=num;
    $("#li_"+num).addClass("selected");
}

function enterSystem() {
    d3.select("header").transition()
        .delay(delay)
        .duration(duration)
        .attrTween("style",function(){
            let i = d3.interpolateNumber(50,15);
            let j = d3.interpolateNumber(92/document.body.clientHeight*document.body.clientWidth,62);
            return function (t) {
                $("header .title").css({"margin":(i(t)-11)+"vh 3vw 4vh 3vw","width":j(t)+"vh"});
                return "height:"+i(t)+"vh;";
            }
        });
    d3.select("footer").transition()
        .delay(delay)
        .duration(duration).attrTween("style",function(){
        let i = d3.interpolateNumber(50,7);
        return function (t) {
            return "height:"+i(t)+"vh;";
        }
    });
    d3.select(".content").transition()
        .delay(delay)
        .duration(duration).attrTween("style",function(){
        let i = d3.interpolateNumber(0,78);
        return function (t) {
            return "height:"+i(t)+"vh;";
        }
    });
}