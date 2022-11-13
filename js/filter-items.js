jQuery(document).ready(function($) {

    $('.slsBtnAddRowSlug').on('click', function() {
        var filterID = $(this).data('id');

        console.log(filterID);
        var row = $('.slsTrEmptyRowSlug' + filterID + '.screen-reader-text').clone(true);
        row.removeClass('slsTrEmptyRowSlug' + filterID + ' screen-reader-text');
        row.insertBefore('#slsTblCatSlugs' + filterID + ' tbody>tr:last');
        return false;
    });
    $('.slsBtnRemoveRowSlug').on('click', function() {
        $(this).parents('tr').remove();
        return false;
    });
    $('.slsTblCatSlugs tbody').sortable({
        opacity: 0.9,
        revert: true,
        cursor: 'move',
        handle: '.slsTdSortHandleSlug',
        axis: 'y'
    });
});

