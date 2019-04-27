function getObject(url,call) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            obj=JSON.parse(xmlhttp.responseText);
            call(obj);
        }
    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
function getObject(url,call,p1) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            obj=JSON.parse(xmlhttp.responseText);
            call(obj,p1);
        }
    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
function getObject(url,call,p1,p2) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            obj=JSON.parse(xmlhttp.responseText);
            call(obj,p1,p2);
        }
    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}