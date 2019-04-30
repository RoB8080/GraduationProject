$(document).ready(function () {
    let timer = d3.interval(function(){timer.stop();startChangeData()},2500);
});

function startChangeData() {
    d3.interval(function(){changeData()},5000);
}

let changeCount=0;
function changeData() {
    if(changeCount++>21)
        changeCount=0;

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        }
    };
    xmlhttp.open("GET","/php/TestQuery.php?cc="+changeCount,true);
    xmlhttp.send();
}