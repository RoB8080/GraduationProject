$(document).ready(function(){
    $("#vessel_info").children(".label_container").append(
        "<div class='info_line'>" +
        "<div class='info_cell col1'>船舶名</div>" +
        "<div class='info_cell col2'>类型</div>" +
        "<div class='info_cell col3'>国籍</div>" +
        "</div>");
    getPilotInfo(1,getFilterArray('pilot_filter'));
});
class VesselInfoLine {
    constructor(pNo,pNa,pGr,pAd) {
        this.dom=$("<div class='info_line'></div>");
        this.dom.append("<div class='info_cell col1'>"+pNo+"</div>");
        this.dom.append("<div class='info_cell col2'>"+pNa+"</div>");
        this.dom.append("<div class='info_cell col3'>"+pGr.toUpperCase()+"级</div>");
        this.dom.append("<div class='info_cell col4'>"+(pAd==="1"?"上海港":"洋山")+"</div>");
    }
}

function getPilotInfo(start,filters){
    $(".main_container").children().remove();
    let suffix="";
    suffix+=filters["pilotGr"]===""?"":"&pGr="+filters["pilotGr"];
    suffix+=filters["pilotAd"]===""?"":"&pAd="+filters["pilotAd"];
    console.log(suffix);
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
           let result=xmlhttp.responseText;
           let loc=result.indexOf(";");
           let pNo,pNa,pGr,pAd;
           while (loc>-1) {
               let tStr=result.substring(0,loc+1);
               let t=tStr.indexOf(",");
               pNo=tStr.substring(0,t);
               tStr= tStr.substring(t+1);
               t=tStr.indexOf(",");
               pNa=tStr.substring(0,t);
               tStr= tStr.substring(t+1);
               t=tStr.indexOf(",");
               pGr=tStr.substring(0,t);
               tStr= tStr.substring(t+1);
               t=tStr.indexOf(";");
               pAd=tStr.substring(0,t);
               let pilotInfoLine=new PilotInfoLine(pNo,pNa,pGr,pAd);
               $("#pilot_info").children(".main_container").append(pilotInfoLine.dom);
               result=result.substring(loc+1);
               loc=result.indexOf(";");
           }
        }
    };
    xmlhttp.open("GET","/php/PilotQuery.php?s="+((start-1)*40)+suffix,true);
    xmlhttp.send();
}