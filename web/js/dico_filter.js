//from http://weblog.west-wind.com/posts/2014/May/12/Filtering-List-Data-with-a-jQuerysearchFilter-Plugin
$.expr[":"].containsNoCase = function(el, i, m) {
    var search = m[3];
    if (!search) return false;
    return new RegExp(search, "i").test($(el).text());
};

$("#filter_input").on("keyup", function(){
    var filterVal = $(this).val();
    $("#dico li").show();
    $("#dico a").each(function(){
        $(this).not(":containsNoCase(" + filterVal + ")").parent().hide();
    });
});