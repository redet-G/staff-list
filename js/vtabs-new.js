(function ($) {
    'use strict';
    $(function () { 
        var timeout = null;
        var vtCOWrapID = '#abcfslVTCNWrapID';
        var vtCOCntCntrID = '#abcfslVTCNCntCntrID';
        var storageKeyCO = 'abcfslStorageKeyCO';
        var vtFWrapID = '#abcfslVTFWrapID';
        var vtFCntCntrID = '#abcfslVTFCntCntrID';
        var vtActiveCls = 'abcflVTabsTabActive';
        var storageKeyF = 'abcfslStorageKeyF';
        // Grab the wrapper for the Navigation Tabs 
        var vtFWrap = $(vtFWrapID).children('.abcflVTabsNavCntr'), tabIndex1 = null;
        var vtTOWrap = $(vtCOWrapID).children('.abcflVTabsNavCntr'), tabIndex1 = null;

        var savedCOTab = sessionStorage.getItem(storageKeyCO);
        console.log('saved_TO_Tab');
        console.log(savedCOTab);

        var savedFTab = sessionStorage.getItem(storageKeyF);
        console.log('saved_F_Tab');
        console.log(savedFTab);

        if(savedCOTab){
            if(savedCOTab != 'CN1'){ $(vtCOWrapID + ' ul.abcflVTabsNavCntr li#CN1').removeClass(vtActiveCls);}
            $(vtCOWrapID + ' ul.abcflVTabsNavCntr li#' + savedCOTab).addClass(vtActiveCls);
            // Hide the old active content
            $(vtCOCntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
            // Display the new content
            $(vtCOCntCntrID + ' #' + savedCOTab) .removeClass('hidden');
        }

        if(savedFTab){
            if(savedFTab != 'F1'){ $(vtFWrapID + ' ul.abcflVTabsNavCntr li#F1').removeClass(vtActiveCls);}
            $(vtFWrapID + ' ul.abcflVTabsNavCntr li#' + savedFTab).addClass(vtActiveCls);
            // Hide the old active content
            $(vtFCntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
            // Display the new content
            $(vtFCntCntrID + ' #' + savedFTab) .removeClass('hidden');
        }

        vtTOWrap.children().each(function () {
            $(this).on('click', function (evt) {
                evt.preventDefault();

                console.log('clicked TO');

                // If this tab is not active.
                if (!$(this).hasClass(vtActiveCls)) {

                    // Unmark the current tab and mark the new one as active
                    $('.' + vtActiveCls, vtCOWrapID).removeClass(vtActiveCls);
                    $(this).addClass(vtActiveCls);

                    // Save the index of the tab that's just been marked as active. It will be 0 - 40.
                    tabIndex1 = $(this).index();
                    sessionStorage.setItem(storageKeyCO, this.id);                    

                    // Hide the old active content
                    $(vtCOCntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
                    $(vtCOCntCntrID).children('div:nth-child(' + (tabIndex1) + ')').addClass('hidden');

                    // And display the new content
                    $(vtCOCntCntrID).children('div:nth-child( ' + (tabIndex1 + 1) + ')').removeClass('hidden');

                    $('#sort-items-tbl td').each(function () { $(this).css('width', $(this).width() + 'px'); });
                }
            });
        });

        vtFWrap.children().each(function () {
            $(this).on('click', function (evt) {
                evt.preventDefault();

                console.log('clicked F');

                if (!$(this).hasClass(vtActiveCls)) {
                    $('.' + vtActiveCls, vtFWrapID).removeClass(vtActiveCls);
                    $(this).addClass(vtActiveCls);
                    tabIndex1 = $(this).index();
                    sessionStorage.setItem(storageKeyF, this.id);                  
                    $(vtFCntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
                    $(vtFCntCntrID).children('div:nth-child(' + (tabIndex1) + ')').addClass('hidden');
                    $(vtFCntCntrID).children('div:nth-child( ' + (tabIndex1 + 1) + ')').removeClass('hidden');             
                }
            });
        });        
    });
})(jQuery);