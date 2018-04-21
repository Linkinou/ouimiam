;(function( $ ) {

    function update_live_text_labels( field, section ){
        $('.submission-form-repeatable li').each(function () {
            var thisval = $(this).find(field).val();
            $(this).find( section ).text( thisval )
        });
    }

    // function addForm($collectionHolder, $newLinkLi) {
    //     // Get the data-prototype explained earlier
    //     var prototype = $('#recipe_form_ingredients').data('prototype');
    //
    //     // get the new index
    //     var index = $collectionHolder.data('index');
    //
    //     var newForm = prototype;
    //     // You need this only if you didn't set 'label' => false in your tags field in TaskType
    //     // Replace '__name__label__' in the prototype's HTML to
    //     // instead be a number based on how many items we have
    //     // newForm = newForm.replace(/__name__label__/g, index);
    //
    //     // Replace '__name__' in the prototype's HTML to
    //     // instead be a number based on how many items we have
    //     newForm = newForm.replace(/__name__/g, index);
    //
    //     // increase the index with one for the next item
    //     $collectionHolder.data('index', index + 1);
    //
    //     // Display the form in the page in an li, before the "Add a tag" link li
    //     var $newFormLi = $('<li></li>').append(newForm);
    //     $newLinkLi.before($newFormLi);
    // }

    var $collectionHolder;
    // var $addTagLink = $('<div class="add-collection"><i class="the-icon fa fa-plus"></i> Ajouter</div>');
    // var $newLinkLi = $('<li></li>').append($addTagLink);

    $(document).ready(function(){

        update_live_text_labels('.this-section-title-field', '.section-title');
        update_live_text_labels('.this-section-label-field', '.section-label');

        // Get the ul that holds the collection of tags
        $collectionHolder = $('ul.submission-form-repeatable');
        $collectionHolder.data('index', $collectionHolder.find('.grid-container').length);

        $('.add-collection').on( 'click', function(e){
            e.preventDefault();
            var the_ul    = $(this).prev('.submission-form-repeatable'),
                cloned    = $(the_ul).find('.sfa-noindex').clone();

            // $('.accordion_in').each(function () {
            //     $(this).removeClass('acc_active')
            // });

            var index = $collectionHolder.data('index');
            var prototype = $('#recipe_form_ingredients').data('prototype');
            prototype = prototype.replace(/__name__/g, index);

            $collectionHolder.data('index', index + 1);
            cloned.find('.grid-container').html(prototype);
            $( the_ul ).append( cloned );
            cloned.removeClass('sfa-noindex');
            cloned.addClass('ac_active');
            cloned.find('.acc_content').show();
        });

        // $addTagLink.on('click', function(e) {
        //     // prevent the link from creating a "#" on the URL
        //     e.preventDefault();
        //
        //     // add a new tag form (see next code block)
        //     addForm($collectionHolder, $newLinkLi);
        // });
    });
})(jQuery);