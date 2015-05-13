//from the symfony doc

// setup an "add a definition" link
var $addDefinitionLink = $('<a href="#" class="add_definition_link">Ajouter une définition</a>');
var $newLinkLi = $('<li></li>').append($addDefinitionLink);

var $addExampleLink = $('<a href="#" class="add_example_link">Ajouter un exemple</a>');
var $newLinkLi = $('<li></li>').append($addExampleLink);

jQuery(document).ready(function() {
    $definitionCollectionHolder = $('#appbundle_term_definitions');
    $definitionCollectionHolder.after($newLinkLi);
    $definitionCollectionHolder.data('index', $definitionCollectionHolder.find(':input').length);

    $exampleCollectionHolder = $('#appbundle_term_examples');
    $exampleCollectionHolder.after($newLinkLi);
    $exampleCollectionHolder.data('index', $exampleCollectionHolder.find(':input').length);


    $addDefinitionLink.on('click', function(e) {
        e.preventDefault();
        addSubForm($definitionCollectionHolder, $newLinkLi);
    });
    $addExampleLink.on('click', function(e) {
        e.preventDefault();
        addSubForm($exampleCollectionHolder, $newLinkLi);
    });
});

function addSubForm($collectionHolder, $newLinkLi) {

    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}