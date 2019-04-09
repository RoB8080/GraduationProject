$(document).ready(function(){
    $("#pilot_info").children(".label_container").append(
        "<div class='info_line'>" +
        "<div class='info_cell col1'>工号</div>" +
        "<div class='info_cell col2'>姓名</div>" +
        "<div class='info_cell col3'>等级</div>" +
        "<div class='info_cell col4'>类别</div>" +
        "<div class='info_cell col5'>状态</div>" +
        "<div class='info_cell col6'>港区</div>" +
        "</div>");
    getPilotInfo(1,getFilterArray('pilot_filter'));
});
class PilotInfoLine {
    constructor(pNo,pNa,pGr,pCl,pSt,pAd) {
        this.dom=$("<div class='info_line'></div>");
        this.dom.append("<div class='info_cell col1'>"+pNo+"</div>");
        this.dom.append("<div class='info_cell col2'>"+pNa+"</div>");
        this.dom.append("<div class='info_cell col3'>"+pGr.toUpperCase()+"级</div>");
        this.dom.append("<div class='info_cell col4'>"+pCl+"</div>");
        this.dom.append("<div class='info_cell col5'>"+pSt+"</div>");
        this.dom.append("<div class='info_cell col6'>"+(pAd==="1"?"上海港":"洋山")+"</div>");
    }
}

function getPilotInfo(start,filters){
    $(".main_container").children().remove();
    let suffix="";
    suffix+=filters["pilotGr"]===""?"":"&pGr="+filters["pilotGr"];
    suffix+=filters["pilotAd"]===""?"":"&pAd="+filters["pilotAd"];
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
           let result=xmlhttp.responseText;
           let loc=result.indexOf(";");
           let pNo,pNa,pGr,pCl,pSt,pAd;
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
               t=tStr.indexOf(",");
               pCl=tStr.substring(0,t);
               tStr= tStr.substring(t+1);
               t=tStr.indexOf(",");
               pSt=tStr.substring(0,t);
               tStr= tStr.substring(t+1);
               t=tStr.indexOf(";");
               pAd=tStr.substring(0,t);
               let pilotInfoLine=new PilotInfoLine(pNo,pNa,pGr,pCl,pSt,pAd);
               $("#pilot_info").children(".main_container").append(pilotInfoLine.dom);
               result=result.substring(loc+1);
               loc=result.indexOf(";");
           }
        }
    };
    xmlhttp.open("GET","/Information/PilotQuery.php?s="+((start-1)*40)+suffix,true);
    xmlhttp.send();
}