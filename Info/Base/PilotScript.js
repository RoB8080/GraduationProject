$(document).ready(function(){
    $("#pilot_info").children(".label_container").append(
        "<div class='info_line'>" +
        "<div class='info_cell col1'>工号</div>" +
        "<div class='info_cell col2'>姓名</div>" +
        "<div class='info_cell col3'>等级</div>" +
        "<div class='info_cell col4'>港区</div>" +
        "<div class='info_cell col5'>外语水平</div>" +
        "<div class='info_cell col6'>固定电话</div>" +
        "<div class='info_cell col7'>手机</div>" +
        "</div>");
    getPilotInfo(1,getFilterArray('pilot_filter'));
});
class PilotInfoLine {
    constructor(pNo,pNa,pGr,pCl,pAd,pFl,pTp,pMp) {
        this.dom=$("<div class='info_line'></div>");
        this.dom.append("<div class='info_cell col1'>"+pNo+"</div>");
        this.dom.append("<div class='info_cell col2'>"+pNa+"</div>");
        this.dom.append("<div class='info_cell col3'>"+pGr.toUpperCase()+pCl+"</div>");
        this.dom.append("<div class='info_cell col4'>"+(pAd==="1"?"上海港":"洋山")+"</div>");
        this.dom.append("<div class='info_cell col5'>"+pFl+"</div>");
        this.dom.append("<div class='info_cell col6'>"+pTp+"</div>");
        this.dom.append("<div class='info_cell col7'>"+pMp+"</div>");
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
           obj=JSON.parse(xmlhttp.responseText);
           let len = obj.results.length;
           for (let i=0;i<len;i++) {
               let pilotInfoLine=new PilotInfoLine(obj.results[i].pNo,obj.results[i].pNa,obj.results[i].pGr,obj.results[i].pCl,obj.results[i].pAd,obj.results[i].pFl.length===0?"&nbsp;":obj.results[i].pFl,obj.results[i].pTp,obj.results[i].pMp);
               $("#pilot_info").children(".main_container").append(pilotInfoLine.dom);
           }
        }
    };
    xmlhttp.open("GET","/Info/Base/PilotQuery.php?s="+((start-1)*40)+suffix,true);
    xmlhttp.send();
}