(function( $ ) {
    'use strict';
    $(function() {
        // Grab the wrapper for the Navigation Tabs
        var vTabsMgr_1 = $( abcfsl_VTabs.mgr_1).children( '.abcflVTabsNavCntr' ), tabIndex1 = null;
        var vTabsCntCntr_1 = abcfsl_VTabs.cntCntr_1;
        var vTabsMgr_2 = $( abcfsl_VTabs.mgr_2).children( '.abcflVTabsNavCntr' ), tabIndex1 = null;
        var vTabsCntCntr_2 = abcfsl_VTabs.cntCntr_2;

        //console.log(vTabsMgr_1);

    vTabsMgr_1.children().each(function() {
        $( this ).on( 'click', function( evt ) {

            evt.preventDefault();

            // If this tab is not active...
            if ( ! $( this ).hasClass( 'abcflVTabsTabActive' ) ) {

                //console.log('hasClass');

                // Unmark the current tab and mark the new one as active
                $( '.abcflVTabsTabActive', abcfsl_VTabs.mgr_1 ).removeClass( 'abcflVTabsTabActive' );
                $( this ).addClass( 'abcflVTabsTabActive' );

                // Save the index of the tab that's just been marked as active. It will be 0 - 3.
                tabIndex1 = $( this ).index();

                //console.log(tabIndex1);

                // Hide the old active content
                $( vTabsCntCntr_1 )
                        .children( 'div:not( .inside.hidden )' )
                        .addClass( 'hidden' );

                $( vTabsCntCntr_1 )
                        .children( 'div:nth-child(' + ( tabIndex1 ) + ')' )
                        .addClass( 'hidden' );

                 //console.log($( abcfsl_VTabs.mgr_1 ).children());

                // And display the new content
                $( vTabsCntCntr_1 )
                        .children( 'div:nth-child( ' + ( tabIndex1 + 1 ) + ')' )
                        .removeClass( 'hidden' );

                //$('#sort-items-tbl td').each(function () { $(this).css('width', $(this).width() + 'px'); });
            }
        });
    });
    vTabsMgr_2.children().each(function() {
        $( this ).on( 'click', function( evt ) {

            evt.preventDefault();

            // If this tab is not active...
            if ( ! $( this ).hasClass( 'abcflVTabsTabActive' ) ) {

                // Unmark the current tab and mark the new one as active
                $( '.abcflVTabsTabActive', abcfsl_VTabs.mgr_2 ).removeClass( 'abcflVTabsTabActive' );
                $( this ).addClass( 'abcflVTabsTabActive' );

                // Save the index of the tab that's just been marked as active. It will be 0 - 3.
                tabIndex1 = $( this ).index();

                // Hide the old active content
                $( vTabsCntCntr_2 )
                        .children( 'div:not( .inside.hidden )' )
                        .addClass( 'hidden' );

                $( vTabsCntCntr_2 )
                        .children( 'div:nth-child(' + ( tabIndex1 ) + ')' )
                        .addClass( 'hidden' );

                // And display the new content
                $( vTabsCntCntr_2 )
                        .children( 'div:nth-child( ' + ( tabIndex1 + 1 ) + ')' )
                        .removeClass( 'hidden' );
            }
        });
    });

	});
})( jQuery );