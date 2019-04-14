$(document).ready(function(){
    $("#vessel_info").children(".label_container").append(
        "<div class='info_line'>" +
        "<div class='info_cell col1'>船舶名</div>" +
        "<div class='info_cell col2'>类型</div>" +
        "<div class='info_cell col3'>国籍</div>" +
        "<div class='info_cell col4'>总吨位</div>" +
        "<div class='info_cell col4'>净吨位</div>" +
        "</div>");
    getVesselInfo(1,getFilterArray('vessel_filter'));
});

class VesselInfoLine {
    constructor(vNa,vTp,vNc,vTt,vNt) {
        this.dom=$("<div class='info_line'></div>");
        this.dom.append("<div class='info_cell col1'>"+vNa+"</div>");
        this.dom.append("<div class='info_cell col2'>"+vTp+"</div>");
        this.dom.append("<div class='info_cell col3'>"+vNc+"</div>");
        this.dom.append("<div class='info_cell col4'>"+vTt+"吨</div>");
        this.dom.append("<div class='info_cell col4'>"+vNt+"吨</div>");
    }
}

function getVesselInfo(start,filters){
    $(".main_container").children().remove();
    let suffix="";
    suffix+=filters["vesselTp"]===""?"":"&vTp="+filters["vesselTp"];
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            obj=JSON.parse(xmlhttp.responseText);
            let len = obj.results.length;
            for (let i=0;i<len;i++) {
                let vesselInfoLine=new VesselInfoLine(obj.results[i].vNa,obj.results[i].vTp,obj.results[i].vNc,obj.results[i].vTt,obj.results[i].vNt);
                $("#vessel_info").children(".main_container").append(vesselInfoLine.dom);
            }
        }
    };
    xmlhttp.open("GET","/Information/VesselQuery.php?s="+((start-1)*40)+suffix,true);
    xmlhttp.send();5
}