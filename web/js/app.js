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