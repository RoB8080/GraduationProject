let current_page=1;
function selectPage(num) {
    $("#li_"+current_page).removeClass("selected");
    current_page=num;
    $("#li_"+num).addClass("selected");
}