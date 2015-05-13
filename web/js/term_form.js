//from the symfony doc

// setup an "add a def" link
var $addDefLink = $('<a href="#" class="add_def_link">Ajouter une définition</a>');
var $newDefLinkLi = $('<li></li>').append($addDefLink);

var $addExLink = $('<a href="#" class="add_ex_link">Ajouter un exemple</a>');
var $newExLinkLi = $('<li></li>').append($addExLink);

jQuery(document).ready(function() {
    $defCollectionHolder = $('#appbundle_term_definitions');
    $defCollectionHolder.after($newDefLinkLi);
    $defCollectionHolder.data('index', $defCollectionHolder.find(':input').length);

    $exCollectionHolder = $('#appbundle_term_examples');
    $exCollectionHolder.after($newExLinkLi);
    $exCollectionHolder.data('index', $exCollectionHolder.find(':input').length);


    $addDefLink.on('click', function(e) {
        e.preventDefault();
        addSubForm($defCollectionHolder, $newDefLinkLi);
    });
    $addExLink.on('click', function(e) {
        e.preventDefault();
        addSubForm($exCollectionHolder, $newExLinkLi);
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