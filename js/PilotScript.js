class PilotInfoCell {
    constructor(gd) {
        let dom=$("<div class='pilot_info_cell'></div>");
        dom.append("<div>");
    }
}

function getPilotInfo(start){
    let xmlhttp;
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
           let result=xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","PilotQuery.php?s="+((start-1)*20),true);
    xmlhttp.send();

}