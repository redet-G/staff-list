jQuery(document).ready(function($){

    var custom_uploader;
    //console.log(abcfsl_si.selectButton); abcfsl_si.btnImgL

    //btn ID
    $(abcfsl_si.btnImgL).click(function(e) {

        e.preventDefault();

        //console.log(abcfsl_si.btnImgL);

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            //title: abcfsl_si.title,
            button: { text:  abcfsl_si.button },
            library: { type: 'image' },
            frame:    'select',
            state:   'mystate'
        });

        custom_uploader.states.add([
          new wp.media.controller.Library({
            id: 'mystate',
            title: abcfsl_si.title,
            priority: 20,
            toolbar: 'select',
            filterable: 'uploaded',
            library: wp.media.query( custom_uploader.options.library ),
            multiple: false,
            editable: false,
            displayUserSettings: false,
            displaySettings: true,
            allowLocalEdits: true
          })
        ]);

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();

            //$(gtm_marker_img.urlTxt).val(attachment.url);
            //var media_thumbnail = media_attachment.sizes.thumbnail.url;
            //
            //var selectedSizeUrl = attachment.sizes[$('select[name="size"]').val()].url;
            //console.log(selectedSizeUrl);
            //$(gtm_marker_img.urlTxt).val(selectedSizeUrl);

            console.log(attachment.id);

            $(abcfsl_si.imgUrlL).val(attachment.sizes[$('select[name="size"]').val()].url);
            $(abcfsl_si.imgIDL).val(attachment.id);
            //var media_thumbnail = media_attachment.sizes.thumbnail.url;
        });

        //Open the uploader dialog
        custom_uploader.open();
    });

    $(abcfsl_si.btnImgS).click(function(e) {

        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            //title: abcfsl_si.title,
            button: { text:  abcfsl_si.button },
            library: { type: 'image' },
            frame:    'select',
            state:   'mystate'
        });

        custom_uploader.states.add([
          new wp.media.controller.Library({
            id: 'mystate',
            title: abcfsl_si.title,
            priority: 20,
            toolbar: 'select',
            filterable: 'uploaded',
            library: wp.media.query( custom_uploader.options.library ),
            multiple: false,
            editable: false,
            displayUserSettings: false,
            displaySettings: true,
            allowLocalEdits: true
          })
        ]);

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();

            $(abcfsl_si.imgUrlS).val(attachment.sizes[$('select[name="size"]').val()].url);
            $(abcfsl_si.imgIDS).val(attachment.id);
        });

        //Open the uploader dialog
        custom_uploader.open();
    });
});