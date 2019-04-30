$(document).ready(function(){
    $("#vessel_info").children(".label_container").append(
        "<div class='info_line'>" +
        "<div class='info_cell col1'>船名</div>" +
        "<div class='info_cell col2'>呼号</div>" +
        "<div class='info_cell col3'>类型</div>" +
        "<div class='info_cell col4'>国籍</div>" +
        "<div class='info_cell col5'>总吨位</div>" +
        "<div class='info_cell col6'>净吨位</div>" +
        "<div class='info_cell col7'>船只长度</div>" +
        "</div>");
    getVesselInfo(1,getFilterArray('vessel_filter'));
});

class VesselInfoLine {
    constructor(vNa,vCn,vTp,vNc,vTt,vNt,vLt) {
        this.dom=$("<div class='info_line'></div>");
        this.dom.append("<div class='info_cell col1'>"+vNa+"</div>");
        this.dom.append("<div class='info_cell col2'>"+vCn+"</div>");
        this.dom.append("<div class='info_cell col3'>"+vTp+"</div>");
        this.dom.append("<div class='info_cell col4'>"+vNc+"</div>");
        this.dom.append("<div class='info_cell col5'>"+vTt+"吨</div>");
        this.dom.append("<div class='info_cell col6'>"+vNt+"吨</div>");
        this.dom.append("<div class='info_cell col7'>"+vLt+"米</div>");
    }
}

function getVesselInfo(start,filters){
    $(".main_container").children().remove();
    let suffix="";
    suffix+=filters["vesselTp"]===""?"":"&vTp="+filters["vesselTp"];
    suffix+=filters["vesselSz"]===""?"":"&vSz="+filters["vesselSz"];
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            obj=JSON.parse(xmlhttp.responseText);
            let len = obj.results.length;
            for (let i=0;i<len;i++) {
                let vesselInfoLine=new VesselInfoLine(obj.results[i].vNa,obj.results[i].vCn,obj.results[i].vTp,obj.results[i].vNc,obj.results[i].vTt,obj.results[i].vNt,obj.results[i].vLt);
                $("#vessel_info").children(".main_container").append(vesselInfoLine.dom);
            }
        }
    };
    xmlhttp.open("GET","/Info/Base/VesselQuery.php?s="+((start-1)*40)+suffix,true);
    xmlhttp.send();
}