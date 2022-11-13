(function( $ ) {
    'use strict';
    $(function() {
        // Grab the wrapper for the Navigation Tabs abcfsl_tabs.cntrID
        var navTabs1 = $( abcfsl_tabs.cntrID1).children( '.nav-tab-wrapper' ), tabIndex1 = null;
        var navTabs2 = $( abcfsl_tabs.cntrID2).children( '.nav-tab-wrapper' ), tabIndex2 = null;


    navTabs1.children().each(function() {
        $( this ).on( 'click', function( evt ) {

            evt.preventDefault();

            // If this tab is not active...
            if ( ! $( this ).hasClass( 'nav-tab-active' ) ) {

                // Unmark the current tab and mark the new one as active
                $( '.nav-tab-active', abcfsl_tabs.cntrID1 ).removeClass( 'nav-tab-active abcfTabactive' );
                $( this ).addClass( 'nav-tab-active abcfTabactive' );

                // Save the index of the tab that's just been marked as active. It will be 0 - 3.
                tabIndex1 = $( this ).index();

                // Hide the old active content
                $( abcfsl_tabs.cntrID1 )
                        .children( 'div:not( .inside.hidden )' )
                        .addClass( 'hidden' );

                $( abcfsl_tabs.cntrID1 )
                        .children( 'div:nth-child(' + ( tabIndex1 ) + ')' )
                        .addClass( 'hidden' );

                // And display the new content
                $( abcfsl_tabs.cntrID1 )
                        .children( 'div:nth-child( ' + ( tabIndex1 + 2 ) + ')' )
                        .removeClass( 'hidden' );

                $('#sort-items-tbl td').each(function(){
                    $(this).css('width', $(this).width() +'px');
                });
            }
        });
    });

    navTabs2.children().each(function() {
        $( this ).on( 'click', function( evt ) {

            evt.preventDefault();
            if ( ! $( this ).hasClass( 'nav-tab-active' ) ) {
                $( '.nav-tab-active', abcfsl_tabs.cntrID2 ).removeClass( 'nav-tab-active abcfTabactive' );
                $( this ).addClass( 'nav-tab-active abcfTabactive' );
                tabIndex2 = $( this ).index();
                $( abcfsl_tabs.cntrID2 )
                        .children( 'div:not( .inside.hidden )' )
                        .addClass( 'hidden' );

                $( abcfsl_tabs.cntrID2 )
                        .children( 'div:nth-child(' + ( tabIndex2 ) + ')' )
                        .addClass( 'hidden' );

                $( abcfsl_tabs.cntrID2 )
                        .children( 'div:nth-child( ' + ( tabIndex2 + 2 ) + ')' )
                        .removeClass( 'hidden' );

                $('#sort-items-tbl td').each(function(){
                    $(this).css('width', $(this).width() +'px');
                });
            }
        });
    });


	});
})( jQuery );