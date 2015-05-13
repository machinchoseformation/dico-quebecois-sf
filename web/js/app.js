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





//from the symfony doc

var $collectionHolder;

// setup an "add a definition" link
var $addDefinitionLink = $('<a href="#" class="add_definition_link">Add a definition</a>');
var $newLinkLi = $('<li></li>').append($addDefinitionLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of definitions
    $collectionHolder = $('#appbundle_term_definitions');

    // add the "add a definition" anchor and li to the definitions ul
    $collectionHolder.after($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addDefinitionLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new definition form (see next code block)
        addDefinitionForm($collectionHolder, $newLinkLi);
    });
});

function addDefinitionForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a definition" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}