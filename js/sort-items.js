jQuery(document).ready(function($) {
    if ($('#sort-items-tbl').length > 0){
            $('#sort-items-tbl tbody').sortable({
                    axis: 'y',
                    handle: '.column-order img, .column-photo img',
                    placeholder: 'ui-sortable-placeholder',
                    opacity: 0.8,
                    forcePlaceholderSize: true,
                    update: function(event, ui) {
                        var items = $(this).sortable('toArray');
                        var data = {
                                action: 'update_list_order',
                                security: abcfslVars.ajaxNonce,
                                order: items
                        };
                        $.post(ajaxurl, data);
                    }
            }).disableSelection();
    }
});