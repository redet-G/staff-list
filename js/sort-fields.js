jQuery(document).ready(function($) {
    $('#fieldsSortCntrL .sortable-list').sortable({
            axis: 'y',
            placeholder: 'sortPlaceholder',
            forcePlaceholderSize: true,
            update: function(event, ui) {
                var items = $(this).sortable('toArray');
                var postID = $("#fieldsSortCntrL > ul").attr("id");
                var data = {
                        action: 'update_field_order_l',
                        order: items,
                        postid: postID
                };
                $.post(ajaxurl, data);
            }
    }).disableSelection();
    $('#fieldsSortCntrS .sortable-list').sortable({
            axis: 'y',
            placeholder: 'sortPlaceholder',
            forcePlaceholderSize: true,
            update: function(event, ui) {
                var items = $(this).sortable('toArray');
                var postID = $("#fieldsSortCntrS > ul").attr("id");
                var data = {
                        action: 'update_field_order_s',
                        order: items,
                        postid: postID
                };
                $.post(ajaxurl, data);
            }
    }).disableSelection();
});
